---
author: admin
comments: true
layout: post
slug: liberado-ncluasoap-0-5-6-6
title: 'Liberado #NCLuaSOAP 0.5.6.6'
wordpress_id: 1891
categories:
- Software
- Software Livre
- TV Digital
tags:
- GingaNCL
- Lua
- NCL
- NCLua
- SOAP
- TVD
- WS
---

Liberada mais uma versão do NCLua SOAP, a 0.5.6.6. Esta versão inclui apenas um novo recurso que permite informar o número da porta do serviço web que deseja-se acessar (caso seja uma porta diferente da 80), diretamente na URL do serviço.

Nas versões anteriores, caso os usuários precisassem usar uma porta diferente da 80, era necessário especificar o número da mesma no parâmetro port do método call do módulo ncluasoap. Alguns usuários tiveram dificuldades em consumir serviços que não utilizam a porta 80 justamente por informarem o número da porta dentro da URL do serviço. Tal restrição ocorria devido à classe TCP do NCLua requerer que a porta seja informada em um parâmetro separado. Como o NCLua SOAP possui o módulo http (também desenvolvido por mim e que facilita bastante a realização de requisições usando o protocolo de mesmo nome), isto foi resolvido diretamente neste módulo e o NCLua SOAP passou a utilizar esta nova funcionalidade.

O parâmetro port do método call do módulo ncluasoap ainda existe, para que os programas antigos que o usam não precisem ser alterados, mas vou avaliar a possibilidade de excluir definitivamente tal parâmetro. Assim, recomendo que passem a utilizar o número da porta diretamente na URL do serviço.


### Exemplo de chamada para um serviço na porta 8080, usando as versões anteriores do módulo:


[lua]
local msgTable = {
  address = "http://myserver.com/MyWebService",
  namespace = "MyNamespace",
  operationName = "calc",
  params = {
    a = 10, b = 20
  }
}

--A porta 8080 é passada como parâmetro para o método call
ncluasoap.call(msgTable, getResponse, "1.1", 8080)
[/lua]


### Mesmo exemplo usando a nova versão do módulo:


[lua]
local msgTable = {
  --A porta 8080 é passada diretamente na URL do Web Service
  address = "http://myserver.com:8080/MyWebService",
  namespace = "MyNamespace",
  operationName = "calc",
  params = {
    a = 10, b = 20
  }
}

ncluasoap.call(msgTable, getResponse, "1.1")
[/lua]

Para baixar esta nova versão, acesse [http://ncluasoap.manoelcampos.com#download](http://ncluasoap.manoelcampos.com#download)
