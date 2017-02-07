---
author: admin
comments: true
layout: post
slug: liberado-ncluasoap-0-5-6-5
title: 'Liberado #NCLuaSOAP 0.5.6.5: Suporte a Autenticação HTTP'
wordpress_id: 1858
categories:
- TV Digital
tags:
- Ginga
- GingaNCL
- HTTP Authentication
- Lua
- NCL
- NCLua
- TVD
- WS
---

Mais uma versão do NCLua SOAP liberada. Nela foi incluído suporte ao consumo de Web Services que requerem [autenticação HTTP (Basic Authentication)](http://en.wikipedia.org/wiki/Basic_authentication), solicitando um usuário e senha para acessar o serviço. Tal recurso já estava implementado no módulo HTTP (implementado por mim, utilizando o módulo TCP disponível em [http://www.lua.inf.puc-rio.br/~francisco/nclua/tutorial/exemplo_06.html](http://www.lua.inf.puc-rio.br/~francisco/nclua/tutorial/exemplo_06.html)) e foi apenas utilizado pelo NCLua SOAP. O exemplo9httpauth foi incluído, que acessa o Web Service disponível em [http://manoelcampos.com/apps/httpauth/server.php](http://manoelcampos.com/apps/httpauth/server.php), retornando a lista de estados de uma determinada região do país.

Para realizar a autenticação HTTP foram incluídos os parâmetros httpUser e httpPasswd (opcionais) no método call do módulo ncluasoap.

Mais detalhes podem ser vistos na documentação do módulo, no diretório doc. Ao acessar o Web Service citado (como pode ser visto fazendo o acesso via Web Browser, em [http://manoelcampos.com/apps/httpauth/server.php](http://manoelcampos.com/apps/httpauth/server.php)) será solicitado usuário e senha. Utilize o usuário **visitante** e a senha **visitante**. A aplicação de exemplo exemplo9httpauth já passa estes dados para logar no servidor e consumir o serviço web.

Para realizar a autenticação HTTP, foram incluídos os parâmetros (opcionais) httpUser e httpPasswd no método call do módulo ncluasoap. Para mais detalhes, veja a documentação no diretório doc.

Baixe a nova versão em [http://github.com/manoelcampos/NCLuaSOAP](http://github.com/manoelcampos/NCLuaSOAP)
