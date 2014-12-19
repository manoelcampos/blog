---
author: admin
comments: true
layout: post
slug: liberado-ncluasoap-0-5-6-ws-tvd-ginga
title: 'Liberado #NCLuaSOAP 0.5.6.1 #WS #TVD #Ginga'
wordpress_id: 1633
categories:
- Software
- Software Livre
- TV Digital
tags:
- Ginga-NCL
- Lua
- NCL
- NCLua
- NCLua SOAP
- SOAP
- SOAP 1.1
- SOAP 1.2
- Web Service
- WSDL
---

Liberada nova versão do NCLua SOAP, a 0.5.6.1. Os principais recursos implementados são:



	
  * script para fazer parser de um WSDL e obter alguns dos parâmetros requeridos em uma app com NCLua SOAP;

	
  * simplificação do acesso ao valor retornado pelo WS (veja HISTORY.txt);

	
  * atualização dos exemplos disponíveis, incluindo mais documentação.


Para download do NCLua SOAP acesse [http://ncluasoap.manoelcampos.com#download](http://ncluasoap.manoelcampos.com#download)

O script wsdlParser.lua, faz o parse de arquivos WSDL, exibindo algumas das informações necessárias em uma aplicação com NCLua SOAP. Seu uso é opcional e a execução deve ser feita em um PC com Lua 5.x ou superior (fora do Ginga), podendo ser de uma das formas abaixo:

    
      lua wsdlparser.lua
      lua wsdlparser.lua url_do_wsdl


O script requer a biblioteca luasocket (pois não é um script para TVD), que pode ser intalada via apt-get no Linux, ou via luarocks em qualquer SO. As bibliotecas util e LuaXML, também necessárias, já estão dentro do diretório. O uso do script é opcional, os parâmetros que ele obtém, para que você utilize na chamada da função ncluasoap.call, você pode obter lendo o documento WSDL do Web Service.


--more Leia Mais--




Esta versão deixou muito mais fácil o acesso ao valor retornado pelo método remoto. O método getResponse, amplamente utilizado nos exemplos, teve o parâmetro xmlTable renomeado para result, para indicar que representa o retorno da função remota, que pode ou não ser uma tabela lua. Se o método remoto retornar uma variável primitiva simples (ou seja, com apenas um valor), result já será este valor, bastando imprimí-lo.

Em alguns Web Services, o resultado vinha aninhado em uma desnecessária estrutura, onde o parâmetro result (antes xmlTable) do método getResponse poderia ter uma estrutura como:

    
     {
       cepResult =  {
          diffgr = {
             NewDataSet = {
                tbCEP = {
                    nome="Cln 407", bairro="Asa Norte", UF="DF", cidade="Brasilia"
                }
             }
          }
       }
     }


Para exibir este resultado nas versões anteriores, era precisa fazer algo como:

    
    xmlTable = xmlTable.cepResult.diffgr.NewDataSet.tbCEP
    for k, v in pairs(xmlTable) do
        print(k, v)
    end


Observe que existem tabelas desnecessárias. Nesta nova versão, tal resultado fica como

    
    {
      nome="Cln 407",
      bairro="Asa Norte",
      UF="DF",
      cidade="Brasilia"
    }


Veja que para percorrer tal resultado, fica mais simples, podendo-se acessar diretamente o parâmetro result (antes xmlTable) do método getResponse:

    
    for k, v in pairs(result) do
        print(k, v)
    end


Note que o código anterior é bem mais transparente, pois o usuário sabendo que o WS devolve uma estrutura composta (com vários valores), basta usar um for nesta estrutura, de forma direta.

Outro resultado como

    
    {
      FindCountryAsXmlResult = {
        IPCountryService = {
           Country="Brasil"
        }
      }
    }


Agora será apenas o valor "Brasil", bastando dar um print no result (o result será variável primitiva simples, neste caso).

Bem mais simples, mas como pode ser visto, o código do método getResponse de suas aplicações deve ser atualizado, pois não funcionará com esta versão do NCLua SOAP. Se o seu Web Service devolve apenas um valor simples, basta dar um print em result (ou xmlTable, como definido no seu método getResponse. Sugiro alterar o nome do parâmetro para result).
Se o WS devolve um estrutura composta, basta usar o for abaixo, percorrendo diretamente o parâmetro result (antes xmlTable), que será uma tabela

    
    for k, v in pairs(result) do
        print(k, v)
    end


Veja os exemplos disponibilizados para mais detalhes.

Para baixar a nova versão do NCLua SOAP, acesse [http://ncluasoap.manoelcampos.com](http://ncluasoap.manoelcampos.com)
Não deixe de ver o arquivo HISTORY.txt para mais detalhes sobre a versão, disponível no pacote para download.

Seu feedback é muito importante. Avalie, comente e retweet este artigo.
Se está usando o NCLua SOAP em algum projeto, por favor, me informe para eu divulgar na página do módulo.
