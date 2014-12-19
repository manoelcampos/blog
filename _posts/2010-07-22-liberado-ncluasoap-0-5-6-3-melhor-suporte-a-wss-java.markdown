---
author: admin
comments: true
layout: post
slug: liberado-ncluasoap-0-5-6-3-melhor-suporte-a-wss-java
title: 'Liberado #NCLuaSOAP 0.5.6.3: Melhor suporte a #WSs #Java'
wordpress_id: 1770
categories:
- Software
- Software Livre
- TV Digital
tags:
- Ginga
- GingaNCL
- Lua
- NCL
- NCLuaSOAP
- SOAP
- TVD
- WebService
---

Mais uma versão do NCLua SOAP liberada. As novidades são:



	
  * Correção de bug de obtenção de resultado de WS contendo um namespace prefix igual a soapenv (e não soap, soap12 ou SOAP-ENV), retornado por Web Services Java Axis2. Colaboração de Gabriel Massote Prado.

	
  * Incluído suporte a Web Services que usam um arquivo XSD externo para as definições de tipos, como os Web Services Java, construídos com a biblioteca JAX-WS. Colaboração de Marco Aurelio Freesz Junior.





--more Leia Mais--



No caso dos Web Services Java, construídos com a biblioteca JAX-WS (feitos normalmente pelo Netbeans), estes utilizam um XML Schema Definition (arquivo XSD) externo (pelo menos na versão com a qual fiz testes). Desta forma, as definições dos tipos utilizados pelo Web Service não são definidos diretamente no documento WSDL. Isto faz com que tal documento utilize uma tag xsd:import para fazer a importação do XSD. Com isto, a requisição SOAP para tais Web Services é diferente do padrão utilizado pela maioria dos Web Services em diversas linguagens. A importação do arquivo XSD faz com que seja atribuído um prefixo ao namespace definido em tal arquivo, o que obriga o uso deste prefixo nas chamadas dos métodos remotos.

Desta forma, como o NCLua SOAP ainda não possui uma ferramenta capaz de descobrir automaticamente todos os parâmetros necessários para a realização das chamadas aos métodos remotos (pois o script wsdlParser.lua ainda está em fase inicial), gerando o código Lua necessário para fazer tais chamadas, o desenvolvedor, quando for consumir um Web Service feito em Java, com a biblioteca JAX-WS, ou qualquer outro que utilize um arquivo XSD externo ao WSDL, precisará informar isto ao NCLua SOAP, na chamada do método call.

Assim, em tal método foi adicionado um novo parâmetro, de nome externalXsd. Este é um parâmetro booleano, opcional, cujo valor padrão é false. Se for passado true, o módulo assumirá que o Web Service a ser consumido possui um arquivo XSD externo e gerará a requisição SOAP de acordo com o formato necessário. Abaixo é exemplificada uma chamada ao método call, para um Web Service com a citada característica:

<pre>
<code class="lua">

--O último parâmetro (externalXsd), de valor true, indica
--que o WS usa um arquivo XSD externo para especificar as definições
--de tipos. Isto influencia no formato da requisição SOAP.
--O valor padrão dele é false.
ncluasoap.call(msgTable, getResponse, "1.1", 8080, true)
</code>
</pre>


Observe que o último parâmetro (true), indica que o Web Service usa um arquivo XSD externo ao WSDL. Veja documentação do método ncluasoap.call para mais detalhes.

Para baixar a nova versão, acesse [http://ncluasoap.manoelcampos.com](http://ncluasoap.manoelcampos.com)
