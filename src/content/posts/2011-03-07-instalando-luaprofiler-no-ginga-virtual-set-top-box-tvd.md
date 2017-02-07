---
author: admin
comments: true
layout: post
slug: instalando-luaprofiler-no-ginga-virtual-set-top-box-tvd
title: 'Instalando #LuaProfiler no #Ginga Virtual Set-top Box. #TVD'
wordpress_id: 2215
categories:
- Dicas NCL e Lua
- TV Digital
tags:
- Ginga
- Ginga Virtual STB
- Ginga-NCL
- Lua
- LuaProfiler
- NCLua
- TVD
---

[![](http://manoelcampos.com/wp-content/uploads/luaprofiler.png)](http://manoelcampos.com/wp-content/uploads/luaprofiler.png)O [LuaProfiler](http://luaprofiler.luaforge.net) é um módulo que permite fazer o [profilling](http://en.wikipedia.org/wiki/Profiling_(computer_programming)) de um programa escrito em Lua. Com tal ferramenta é possível identificar gargalos em sua aplicação, ou seja, partes do código fonte que levem mais tempo para executar que o normal, e assim poder melhorar tal código para tentar ganhar desempenho.

A forma mais fácil de instalar módulos Lua em uma distribuição Linux, como no caso do Ginga Virtual Set-top Box 0.11.2 que utiliza Ubuntu, é por meio do [LuaRocks](http://luarocks.org). No entanto, alguns módulos como o LuaProfiler não funcionam no Ginga se instalados com o LuaRocks, que automatiza o processo de instalação de módulos da mesma forma que a ferramenta apt-get (existente em várias distribuições Linux).

Assim, para usar o LuaProfiler no Ginga Virtual STB, precisaremos compilar o código fonte e fazer uma pequena alteração em tal processo.

É importante lembrar que o LuaProfiler é um módulo Lua que utiliza um módulo escrito em C, assim, seu uso deve ser apenas em ambientes de desenvolvimento e teste, como o Ginga Virtual Set-top Box. A aplicação a ser distribuída não deve ter referência alguma a tal módulo.


## Iniciando processo de instalação

Para iniciar o processo de instalação do LuaProfiler no Ginga Virtual Set-top Box, primeiro conecte via SSH no mesmo. Este tutorial foi feito com a versão 0.11.2.

No terminal SSH, baixe o LuaProfiler 2.0.2 com o comando a seguir (você também pode baixar uma versão modificada para o Ginga-NCL no final deste artigo):

```bash
wget http://luaforge.net/frs/download.php/3400/luaprofiler-2.0.2.tar.gz
```

Agora descompacte o arquivo baixado:

```bash
tar -zxvf luaprofiler-2.0.2.tar.gz
```

Entre no diretório criado:

```bash
cd luaprofiler-2.0.2
```

Edite o arquivo config.linux com o editor pico:

```bash
pico config.linux
```

Altere o texto **/usr/local/include/lua51** para **/usr/local/include/**
Este é o caminho dos arquivos header do Lua dentro do Ginga.
Para sair do pico, pressione CTRL+X, depois Y e ENTER para salvar

Edite o arquivo Makefile.linux com o pico:

```bash
pico Makefile.linux
```

Altere a linha

```bash
mkdir -p bin && $(LD) -Bshareable -o $(PROFILER_OUTPUT) $(OBJS)
```

para o valor abaixo

```bash
mkdir -p bin && $(LD) -Bshareable -o $(PROFILER_OUTPUT) $(OBJS) /usr/local/lib/liblua.a
```

Isto fará com que as bibliotecas padrões de Lua sejam linkadas no módulo luaprofiler.so que será criado na compilação.
Tal alteração é necessária pois, com a instalação padrão ou usando LuaRocks, provavelmente você receberá o erro "undefined symbol: luaL_openlib" quando tentar executar o LuaProfiler em uma aplicação NCLua, indicando que a função luaL_openlib não existe no interpretador Lua utilizado no Ginga. Procurando na web vi que tal função foi substituída por luaL_register, mas alterando o código para esta função também não compila, indicando que tal função não existe.

Provavelmente isto é devido à forma como o interpretador Lua foi compilado no Ginga, que é resolvido linkando a biblioteca liblua.a no módulo luaprofiler.so, tornando o LuaProfiler independente das bibliotecas de Lua do interpretador no Ginga. Ele mesmo já carregará tais bibliotecas. Isto não é o ideal e nem aconselhável, mas como estamos em um ambiente de testes, resolve o problema.

Feita a alteração, saia do editor pressionando CTRL+X, depois Y e ENTER para salvar.

Agora faça uma cópia do arquivo Makefile.linux com o nome de Makefile (pois o comando make procurará um arquivo com este nome):

```bash
cp Makefile.linux Makefile
```

Compile os fontes e instale o módulo com os comandos abaixo:

```bash
make && make install
```

## Usando o LuaProfiler

Para usar o LuaProfiler em uma aplicação Lua, basta incluir um **require "profiler"** para usar o módulo. Para iniciar o profilling, no local desejado inclua a linha **profiler.start("profiler.log")** (que pode ser antes da chamada de uma determinada função ou no início do script). Esta linha iniciará a análise do tempo de execução de cada função no script Lua da sua aplicação e gerará um relatório com o nome de **profiler.log**.

Para finalizar o processo, você deve incluir no local desejado a linha **profiler.stop() **(que pode ser quando a aplicação receber um evento para ser finalizada ou depois da chamada de alguma função que desejar ).

## Analisando os resultados

Após encerrar a aplicação, basta abrir o arquivo profiler.log em um editor como o pico e analisar o resultado. O arquivo mostra cada chamada de função, a linha em que foi chamada, o tempo de execução e outros dados. Tal arquivo pode ser bem extenso dependendo do tamanho do seu script lua. Assim, sua análise pode ser mais complicada.

No entanto, existe o script summary.lua, dentro dos fontes do LuaProfiler, que agrupa as chamadas de cada função registrada no arquivo de saída do módulo (no nosso caso, profiler.log), o que pode facilitar a análise. O script fica no sub-diretório src/analyzer, dentro do diretório onde você descompactou os fontes do LuaProfiler. No entanto, ao utilizar tal script ocorreram alguns erros que foram corrigidos. A versão disponível para download já possui tal correção.

Usar o script summary.lua é bem simples. Para facilitar, copie o mesmo para o diretório onde está o arquivo de saída do LuaProfiler (que definimos o nome de profiler.log anteriormente, dentro da chamada a profiler.start()).

Agora, estando dentro do diretório do arquivo profiler.log, basta executar o comando abaixo:

```bash
lua summary.lua -v profiler.log > summary.xls
```

Tal comando vai ler o arquivo profiler.log e agrupar os resultados, gerando um arquivo summary.xls. Tal arquivo pode ser aberto em um aplicativo de planilhas eletrônicas como o OpenOffice Calc. O arquivo tem as colunas separadas por TAB. Assim, ao abrir no OpenOffice, será mostrada uma janela para importar o summary.xls para uma planilha. Nesta tela você deve informar que as colunas estão separadas por TAB. Após importar o arquivo, basta salvar para o formato nativo do OpenOffice ou do Microsoft Office.
