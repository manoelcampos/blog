---
author: admin
comments: true
layout: post
slug: lendo-xml-em-lua-com-luaxml-parser-totalmente-lua-tvd-gingancl
title: 'Lendo XML em Lua com LuaXML: parser totalmente Lua. #TVD #GingaNCL'
wordpress_id: 2513
categories:
- TV Digital
tags:
- Ginga-NCL
- Lua
- Lua XML Parser
- LuaUsers
- LuaXML
- Parser
- TVD
- XML
---

Tenho visto ainda nos fóruns de discussão algumas perguntas de como ler arquivos XML em Lua.
Existem alguns módulos Lua que utilizam bibliotecas em C para fazer isto, como o [LuaXML](http://viremo.eludi.net/) do site [viremo.eludi.net](http://viremo.eludi.net/LuaXML/).

No entanto, no Ginga-NCL (subsistema do middleware Ginga do Sistema Brasileiro de TV Digital), não é possível usar módulos em C em aplicações enviadas via broadcast. Assim, para fazer o parse de arquivos XML em aplicações Lua para TVD, é preciso usar um parser escrito inteiramente em Lua.


--more Leia Mais--


No site [LuaUsers](http://lua-users.org/wiki/LuaXml) existem algumas opções de parsers XML para Lua, alguns deles usam módulos escritos em C também.
Na seção Lua-only XML parsers existem algumas opções de módulos escritos inteiramente em Lua. Destes, o que acho mais completo e fácil de usar é o módulo LuaXML (isso mesmo, o mesmo nome do anterior, por isso há certa confusão quando se fala em LuaXML) .
Com tal módulo é possível fazer o parse de um XML carregado a partir de um arquivo no disco, obtido via HTTP, ou estaticamente definido em uma variável string. O módulo transforma o arquivo XML em uma tabela Lua, assim, fica muito simples de manipular.

Na página do [LuaXML no LuaUsers ](http://lua-users.org/wiki/LuaXml) existe uma versão original do módulo para Lua 4 e uma versão para Lua 5, adaptada por mim a partir da versão original. Baixe tal versão no link em (Lua 5 version available at [3]).


## Usando o módulo LuaXML do LuaUsers


Vamos criar agora uma aplicação para mostrar como usar tal módulo. Primeiro crie um arquivo de nome dados.xml com o conteúdo abaixo (o arquivo está disponível no pacote para download):

[xml]
<?xml version="1.0" encoding="ISO-8859-1"?>
<pessoas>
  <pessoa tipo="F">
    <nome>Manoel</nome>
    <cidade>Palmas-TO</cidade>
  </pessoa>
  <pessoa tipo="F">
    <nome>Breno</nome>
    <cidade>Palmas-TO</cidade>
  </pessoa>
  <pessoa tipo="J">
    <nome>UnB</nome>
    <cidade>Brasília-DF</cidade>
  </pessoa>
</pessoas>
[/xml]

O arquivo XML armazena dados de pessoas físicas e jurídicas. Cada tag pessoa tem um atributo tipo que identifica isto.

Bem, depois de baixar o LuaXML do LuaUsers no link mostrado anteriormente, descompacte ele na raiz da pasta da aplicação e em seguida renomeie seu diretório para LuaXML.

Agora crie um arquivo de nome main.lua, na mesma pasta do dados.xml. A aplicação Lua é bem simples, e como não usa nenhum recurso do Ginga, pode ser executada diretamente no interpretador Lua no seu computador e funcionar em qualquer plataforma.

O código de main.lua é mostrado abaixo, e comentado em seguida:
(arquivo disponível no pacote para download no final do artigo)

[lua]
dofile("LuaXML/xml.lua")
dofile("LuaXML/handler.lua")

---Imprime uma tabela, de forma recursiva
--@param tb A tabela a ser impressa
--@param level Apenas usado internamente para
--imprimir espaços para representar os níveis
--dentro da tabela.
function printable(tb, level)
  level = level or 1
  local spaces = string.rep(' ', level*2)
  for k,v in pairs(tb) do
      if type(v) ~= "table" then
         print(spaces .. k..'='..v)
      else
         print(spaces .. k)
         level = level + 1
         printable(v, level)
      end
  end
end

local filename = "dados.xml"
local xmltext = ""
local f, e = io.open(filename, "r")
if f then
  --Lê todo o conteúdo do arquivo
  xmltext = f:read("*a")
else
  error(e)
end

--Instancia o objeto que é responsável por
--armazenar o XML em forma de uma table lua
local xmlhandler = simpleTreeHandler()

--Instancia o objeto que faz o parser do XML para uma table lua.
--O xmlhandler foi instanciado lá no início do código
local xmlparser = xmlParser(xmlhandler)
xmlparser:parse(xmltext)

--Imprimindo a tabela recursivamente
--printable(xmlhandler.root)

--Imprimindo manualmente (uma vez que a estrutura do XML é conhecida previamente)
for k, p in pairs(xmlhandler.root.pessoas.pessoa) do
  print("Nome:", p.nome, "Cidade:", p.cidade, "Tipo:", p._attr.tipo)
end
[/lua]

Nas linhas 1 e 2 o módulo é carregado. Como o mesmo não foi implementado usando o recurso module da linguagem Lua, o mesmo não pode ser carregado com require.

Entre as linhas 4 e 21 é definida a função printable, que imprime uma tabela no terminal. Ela percorre toda a estrutura da tabela recursivamente e imprime cada elemento encontrado. Assim, fica fácil exibir o conteúdo de um arquivo XML após executar o parse com o LuaXML. Desta forma, não é preciso saber a estrutura do XML, basta passar a tabela resultante do parse para a função. Isto será demonstrado em seguida.

Algumas linhas são auto-explicativas e não serão comentadas.
Entre as linhas 23 e 31 é feito o carregamento do arquivo XML do disco.

Com o conteúdo do XML em memória (em uma variável string), podemos agora instanciar o parser.
As linhas 33 a 39 fazem isso.

A linha 40 executa o parse do XML armazenado na variável xmltext, gerando uma tabela lua que representa o XML.
Para acessar tal tabela, basta usar a variável xmlhandler.root.

A linha 43 (que está comentada), chama a função printable para imprimir a tabela que representa o XML (xmlhandler.root).
A função é útil quando você não conhece previamente a estrutura do XML e deseja exibir seu conteúdo na tela, de forma estruturada.

Quando você conhece previamente a estrutura do XML, pode usar um código mais personalizado para acessar e imprimir os elementos, como mostra o código entre as linhas 45 a 48. Neste trecho, simplesmente é usado um for para percorrer a tabela. Como xmlhandler.root e a tabela que representa o XML, os itens dela são as tags do XML. Como nosso XML tem um elemento raiz de nome pessoas, e este possui várias tags pessoa, na tabela Lua, pessoa funcionará como um array (vetor). Assim, na linha 46 o array pessoa é acessado a partir do elemento pessoas. Com isto, a variável p do for representa cada pessoa dentro da tag pessoas. Agora fica fácil acessar as tags de cada pessoa (nome e cidade) na linha 47. Como nosso arquivo XML possui um atributo para cada tag pessoa, tais atributos são armazenados em um elemento _attr no item que representa a tag pessoa no XML. Assim, cada atributo será acessado por _attr.nome_do_atributo, como mostra a linha 47.


## Conclusão


Como pôde ser visto, fazer o parse de arquivos XML em Lua com o LuaXML do LuaUsers é bem simples e intuitivo.
Um [tutorial em PDF, elaborado por Johnny Moreira Gomes](http://manoelcampos.com/wp-content/uploads/tutorial_lua_xml_parser1.pdf), está disponível [neste link](http://manoelcampos.com/wp-content/uploads/tutorial_lua_xml_parser1.pdf). Os fontes da aplicação podem ser baixados a seguir.

[attachments title="Downloads" force_saveas=1 size="custom"]
