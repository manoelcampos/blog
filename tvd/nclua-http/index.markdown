---
author: admin
comments: true
date: 2010-09-25 01:32:25+00:00
layout: page
slug: nclua-http
title: 'NCLua HTTP: Conexões HTTP em Apps de #TVD'
wordpress_id: 1897
---

Quem conhece e utiliza meus projetos de TV Digital (como o [NCLua SOAP](http://ncluasoap.manoelcampos.com)) já deve saber da existência, há algum tempo, do módulo "http". Tal módulo é utilizado para a realização de requisições utilizando o protocolo HTTP. Como o mesmo ficava escondido dentro dos outros projetos, resolvi tratá-lo como um projeto separado.

A norma ABNT do Ginga-NCL (NBR 15606-2) define uma classe "tcp" para realização de requisições utilizando o protocolo de mesmo nome, a partir de scripts NCLua (scripts Lua embutidos em documentos NCL). Porém, a norma não define nenhuma implementação para o protocolo HTTP. Este é um protocolo de camada de aplicação, que é trafegado utilizando TCP. Logo, para realizar requisições HTTP, o desenvolvedor de aplicações NCLua precisa compreender tal protocolo, saber o formato das mensagens, quais cabeçalhos devem ser incluídos na mensagem de requisição, e saber o formato da mensagem de resposta para poder separar o resultado do cabeçalho da resposta. Logo, a realização de requisições HTTP em NCLua não é trivial como ocorre em linguagens como Java, Delphi, PHP e outras, onde o desenvolvedor apenas chama funções, informando a URL da página e parâmetros a serem enviados a ela.

Por este motivo, foi desenvolvido o módulo NCLua HTTP. O mesmo depende do [módulo TCP, disponibilizado pela PUC-Rio](http://www.telemidia.puc-rio.br/~francisco/nclua/tutorial/index.html) (já incluso no arquivo para download, em uma versão totalmente comentada, como já falei [aqui](http://manoelcampos.com/2010/01/29/documentacao-do-modulo-tcp-para-nclua/)).

O módulo TCP trabalha com chamadas assíncronas, tornando mais difícil para o programador obter o retorno da requisição, pois ele **não** pode simplesmente chamar uma função para realizar uma requisição e receber o retorno, como exemplificado abaixo:

[lua]response = send_request(host, request)[/lua]

O módulo NCLua HTTP facilita o envio de requisições, encapsulando todo o gerenciamento das requisições assíncronas do protocolo TCP no Ginga-NCL. No entanto, a chamada ainda não é tão simples como o exemplo apresentado, mas já facilita muito o uso e deixa o programador livre de conhecer os detalhes do protocolo HTTP.

O módulo também permite a realização de requisições que requerem [autenticação básica](http://en.wikipedia.org/wiki/Basic_access_authentication). Para realizar tal autenticação, os dados de login e senha devem ser codificados utilizando o esquema [base64](http://en.wikipedia.org/wiki/Base_64). Para isso, foi utilizado o [módulo base64 disponível no Lua Users](http://lua-users.org/wiki/BaseSixtyFour).

O arquivo do módulo para download contém um diretório doc com toda a documentação, exemplos de utilização e todos os módulos que ele utiliza.

A seguir é demonstrado um exemplo simples de uso do módulo, que envia uma requisição GET a uma página em um servidor Web. O exemplo está disponível no arquivo para download, estando todo comentado.

[lua]
package.path = package.path .. ';lib/?.lua'
require "http"

function callback(header, body)
  if body then
     print("\n\n\n", body, "\n\n\n")
  end
end

http.request("http://manoelcampos.com/arquivos/pagina.html", callback)
[/lua]



## Download


[Acesse a página do projeto no GitHub para fazer o download](http://github.com/manoelcampos/NCLuaHTTP).
