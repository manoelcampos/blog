---
author: admin
comments: true
layout: post
slug: aplicacao-de-tv-digital-usando-arquivos-de-dados-em-lua
title: 'Aplicação de TV Digital usando arquivos de dados em Lua: Dispensando o uso de XML e TXT'
wordpress_id: 1543
categories:
- Dicas NCL e Lua
- TV Digital
---

Este exemplo mostra uma [aplicação de TV Digital](http://manoelcampos.com/wp-content/uploads/lua-data-files-tvd.zip), desenvolvida com as linguagens NCL e Lua, que exibe dados a partir de um arquivo de dados Lua, ao invês de usar arquivos XML, arquivos de texto .conf (como os do Apache Web Server) ou até mesmo arquivos de texto em um formato definido por você.

Este artigo mostra como aplicar a linguagem Lua com uma das finalidades para qual a mesma foi desenvolvida: representação de dados estruturados. Com isto, dispensa-se a complexidade de tratar arquivos de texto ou XML, lendo os dados diretamente de um arquivo lua, de forma simples e transparente, usando os recursos básicos da linguagem.

## Pré-requisitos

Para acompanhar este artigo, são necessários conhecimentos básicos de NCL, Lua e NCLua (como os módulos event e canvas). Você pode utilizar o [Eclipse](http://www.eclipse.org/) com o plugin [NCLEclipse](http://www.laws.deinf.ufma.br/~ncleclipse/). Recomenda-se utilizar a última versão do [Ginga Virtual Set-top Box](http://www.gingancl.org/ferramentas.html).

Um [tutorial de como estruturar o ambiente de desenvolvimento](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl) está disponível [aqui](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl).

## A aplicação

A aplicação que criei apenas exibe algumas informações gravadas em um arquivo de dados em Lua (dados.lua). O conteúdo do mesmo é apresentado abaixo:

```lua    
---Informações a serem exibidas na aplicação
info = {
  {
    app = "NCLua Tweet",
    desc="Cliente de Twitter para TV Digital",
    url = "http://ncluatweet.manoelcampos.com"
  },
  {
    app = "NCLua SOAP",
    desc="Módulo p/ acesso a WS SOAP em aplicações de TVD",
    url = "http://ncluasoap.manoelcampos.com"
  },
  {
    app = "NCLua RSS Reader",
    desc="Leitor de Notícias em RSS para TV Digital",
    url = "http://ncluarss.manoelcampos.com"
  },
  {
    app = "Enquete para TV Digital",
    desc="Enquete com acesso ao canal de interatividade",
    url = "http://enquetetvd.manoelcampos.com"
  }
}
```

Como pode-se observar, o arquivo contendo os dados a serem exibidos, nada mais é que um script lua, que declara uma variável global de nome **info**. Esta variável é uma tabela (como se fosse um array de struct em C). Dentro da tabela **info** existem sub-tabelas (que funcionam como uma struct em C) para armazenar uma estrutura de dados contendo os campos app, desc e url. Tais dados representam nomes de aplicações, com suas respectivas descrições e endereço na internet. A partir de outro script lua, podemos acessar as variáveis definidas neste arquivo de dados (no caso, só existe a variável info), da mesma forma como fazemos convencionalmente. Para isto, precisamos carregar o arquivo de dados usando a função **loadfile** de Lua. Pelo que interpretei na norma ABNT NBR 15606-2 do Ginga-NCL, a função loadfile pode perfeitamente ser usada em aplicações de TVD, pois ela não é listada na seção **"10.1 Linguagem Lua - Funções removidas da biblioteca de Lua"** da norma, e a documentação da função está inclusa.

Para facilitar o reuso e melhorar a organização do código, criei um módulo de nome **config** (config.lua) que contém funções necessárias para carregar e manipular as variáveis de um arquivo de dados Lua. O módulo config possui funções que usam o módulo io de Lua. Mas no WTVDI/WebMedia 2010, o próprio professor Luiz Fernando Gomes Soares informou que tal módulo agora faz parte das normas do Ginga NCL.

Não vou explicar todo o código implementado, apenas os pontos principais.

O arquivo main.lua contém todo o código da aplicação. Dentro dele é carregado o módulo **config**, com a instrução require "config". O arquivo a ser carregado (dados.lua) é definido no campo **configFile** da tabela **main**.

Dentro da função tratadora de eventos, **main.handler**, quando a aplicação iniciar

```lua
if evt.class == "ncl" and evt.type == "presentation" and evt.action=="start" then
```

o arquivo de dados é carregado

```lua    
config.load(main.configFile)
```

A partir deste ponto, a variável **info**, definida em dados.lua, pode ser acessada usando-se **config.data.info**. Após o carregamento do arquivo de dados, a função **main.showInfo** é chamada para exibir o primeiro "registro" existente dentro da tabela info:

```lua    
main.showInfo(true)
```

Quando o usuário pressionar as setas para esquerda e direita, a informação anterior e posterior é exibida, respectivamente, chamando novamente a função **main.showInfo**.

## Documentação

Toda a documentação em HTML, gerada com [LuaDoc](http://luadoc.luaforge.net/), está disponível no diretório doc.

## Conclusão

Com este exemplo o desenvolvedor pode ver como é simples usar arquivos de dados em Lua no lugar de arquivos de texto ou XML. Além de tudo, o processamento destes arquivos demanda maior carga de processamento e muito mais linhas de código. Com o uso da abordagem apresentada, usa-se todos os recursos nativas da linguagem Lua, de uma simples e transparente.

O exemplo pode ser adaptado para a criação de uma aplicação que frequentemente tem causado dúvidas nos fóruns que participo: Enquetes ou Formulários de Pesquisa na TV Digital. Assim, o exemplo mostra como as perguntas e alternativas poderiam ser gravadas em um arquivo Lua e como navegar entre as perguntas. A aplicação não mostra como fazer entrada de dados, mas para perguntas objetivas, é bem simples de ser feito, pois pode-se associar as alternativas aos números do controle remoto. No caso da existência de perguntas subjetivas, que necessitam a entrada de dados alfanuméricos, na aplicação [NCLua Tweet](http://ncluatweet.manoelcampos.com) existe uma classe TextBox que permite a realização de tal tarefa. A classe é apenas um protótipo, e só funciona para apenas um campo no formulário, mas seria adequada para uma aplicação com um questionário onde é exibida apenas uma pergunta por vez (semelhante ao que foi feito nesta aplicação, como pode ser conferido no vídeo).

Caso seja preciso enviar os dados coletados para um servidor remoto, utilizando o canal de interatividade, uma [aplicação de enquete](http://enquetetvd.manoelcampos.com) bem simples, com apenas uma pergunta e que não usa a abordagem de arquivos de dados apresentada aqui, pode ser baixada [neste link](http://enquetetvd.manoelcampos.com).

No final, juntando as informações dos três projetos apresentados, é possível criar uma aplicação de enquete ou questionário de pesquisa, sem muita dificuldade.

## Para saber mais

Deixo aqui uma dica para continuarem os estudos: Qual a diferença entre o uso de dois-pontos ( : ) e ponto ao acessar uma função dentro de uma tabela? [Veja minha resposta aqui](http://groups.google.com/group/lua-br/browse_thread/thread/586df782e62c77fd/34fee5cc59654a5e?lnk=gst&q=Dúvida+no+uso+do+dois+pontos).

Como pode ser visto no código do aplicativo, eu usei ponto na definição e acesso de todas as funções da tabela **main** (em main.lua). Em um aplicativo maior, onde fosse utilizada uma abordagem orientada a objetos, eu usaria dois-pontos. Como este é um aplicativo pequeno, que não tem uma lógica de objetos (logo, nada de reutilização de classes dentro dele), acabei usando ponto.

## Licença

[](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)

[](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)

[![](/files/by-nc-sa.png)](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)
