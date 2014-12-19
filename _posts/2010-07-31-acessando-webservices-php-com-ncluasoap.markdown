---
author: admin
comments: true
layout: post
slug: acessando-webservices-php-com-ncluasoap
title: 'Acessando #WebServices #PHP com #NCLuaSOAP'
wordpress_id: 1811
categories:
- Software
- Software Livre
- TV Digital
tags:
- Ginga
- GingaNCL
- Lua
- NCL
- NCLua
- NCLuaSOAP
- PHP
- TVD
- WS
---

Desde a versão 0.5.5 do NCLua SOAP, foi incluído suporte para que os parâmetros sejam gerados, no XML, na mesma ordem em que foram definidos na tabela Lua, resolvendo problema encontrado com Web Services PHP desenvolvidos com a biblioteca nuSOAP.

Neste artigo mostrarei como fazer acesso a tais Web Services, a partir de aplicações de TV Digital, desenvolvidas em NCL/Lua, utilizando o módulo [NCLua SOAP](http://ncluasoap.manoelcampos.com).


## Iniciando


O acesso a WebServices em PHP com NCLua SOAP pode ter uma pequena particularidade. Tais WS, desenvolvidos com a biblioteca [nuSOAP](http://sourceforge.net/projects/nusoap/), desconsideram o nome dos parâmetros de entrada (isto pode depender da versão da biblioteca), considerando apenas a ordem em que foram passados.


--more Leia Mais--




Como a requisição XML a ser enviada ao Web Service é gerada a partir de uma tabela Lua, que é percorrida com o comando pairs de Lua, tal comando acessa os elementos em ordem arbitrária (Programming in Lua, 2nd ed). Isto pode fazer com que os parâmetros sejam passados em ordem incorreta ao Web Service. Assim, para resolver esse problema com WS PHP, pode-se incluir cada parâmetro de entrada na tabela Lua, dentro de uma sub-tabela anônima, como no exemplo abaixo:

    
      params = {
        {ordem = "estado"},
        {regiao = "sudeste"}
      }


Observe que o parâmetro ordem está definido dentro de uma sub-tabela sem nome, assim como o parâmetro regiao. Desta forma, a tabela params funciona como um vetor (array). Isto garante que os parâmetros sejam acessados, para geração do XML, na mesma ordem em que foram definidos, resolvendo o problema dos WS em PHP com nuSOAP. O uso das sub-tabelas anônimas resolve o problema pois, quando tais sub-tabelas não possuem um nome (string), um índice (numérico) é automaticamente atribuído a cada uma delas, seguindo a ordem em que foram definidas. Isto faz com que, quando acessadas, seja seguida a ordem dos índices numéricos.

O exemplo 6, disponível no arquivo para download do NCLua SOAP, contém os fontes completos de uma aplicação que acessa um WS em PHP feito com nuSOAP, que retorna a lista de estados de uma determinada região do país, separados por \n, exibindo isto no terminal. Se os parâmetros não forem declarados como mostrado aqui, eles podem ser passados na ordem errada para o WS.

Como o primeiro parâmetro (de nome ordem) deve conter o nome da coluna da tabela no banco de dados, pela qual deseja-se ordenar o resultado, se os parâmetros forem invertidos, isto vai causar erro na execução da instrução SQL no WS, retornando uma mensagem de erro. Assim, para garantir, deve-se usar a abordagem apresentada no código anterior.

Outra abordagem para acesso a um WS PHP, feito com nuSOAP, é definir os próprios parâmetros anonimamente, como abaixo. Somente a ordem é que importa, os nomes dos parâmetros não.

    
    params = {"estado", "sudeste"}


Esta forma é mais simples e a ordem dos parâmetros é obedecida ao gerar o XML, no entanto, perde-se a identificação do nome dos parâmetros, tornando menos legível o código fonte.


## Tutoriais




[Criando um Web Service PHP com NuSoap e acessando-o com NCLua Soap - por Johnny Moreira Gomes](http://www.ufjf.br/lapic/files/2010/05/TutorialNuSoapNCLuaSoap.pdf) ([link alternativo](http://manoelcampos.com/wp-content/uploads/tutorial-nusoap-ncluasoap.pdf))


Se você tiver exemplos, compartilhe conosco. [Entre em contato aqui](/contato).


## Download


Para download do NCLua SOAP, acesse [http://ncluasoap.manoelcampos.com#download](http://ncluasoap.manoelcampos.com#download).
