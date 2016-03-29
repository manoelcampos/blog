---
author: admin
comments: true
layout: post
slug: liberado-ncluasoap-0-5-6-4
title: 'Liberado #NCLuaSOAP 0.5.6.4: Suporte a params Array e Struct'
wordpress_id: 1788
categories:
- Software
- Software Livre
- TV Digital
tags:
- Array
- Ginga
- GingaNCL
- Lua
- NCL
- NCLua
- NCLuaSOAP
- Struct
- TVD
- WS
---

Mais uma versão do NCLua SOAP liberada. As novidades são:



	
  * suporte a métodos de Web Service que recebem parâmetros dos tipos array e struct/record;

	
  * incluído exemplo para acesso a método de WS que recebe um struct como parâmetro.


Colaboração de Samuel da Costa Alves Basilio.




--more Leia Mais--





Para consumir tais métodos remotos, dentro da sub-tabela params, da tabela msgTable que deve ser passada como parâmetro para o método ncluasoap.call, deve-se incluir uma tabela lua com índices numéricos (quando o parâmetro do método remoto for um array) e uma tabela lua com índices nomeados (quando o parâmetro do método remoto for um struct/record).







Abaixo é apresentado um exemplo de código lua para chamar o método remoto estados2 de um Web Service PHP, que retorna a lista de estados de uma determinada região, em uma determinada ordem. No entanto, tal método deve receber uma struct de nome dados, contendo os campos regiao e ordem.





Para realizar a chamada ao método remoto, precisamos criar uma tabela contendo as informações necessários para chamar o método. Chamamos tal tabela de msgTable no exemplo abaixo. Dentre os campos desta tabela, deve existir um campo params (que também é uma tabela), onde serão incluídos os parâmetros a serem passados ao método remoto do WS.





Como o nosso método remoto requer uma struct, tal estrutura será representada em lua por uma tabela também. Assim, dentro da tabela params, incluimos uma tabela de nome dados (o nome do parâmetro no método remoto). Tal tabela possui os campos ordem e regiao, que contém os valores a serem recebidos pelo método remoto.





Na última linha do exemplo abaixo, chamados o método call do módulo NCLua SOAP, passando a tabela msgTable, para gerar a chamada HTTP/SOAP para realizar a requisição ao Web Service, invocando o método remoto estados2.





A função getResponse processará a resposta, da mesma forma como tem sido feito nas versões anteriores do módulo. Tal exemplo apenas exibirá o resultado no terminal, não mostrando nada na tela para o usuário/telespectador, pois trata-se apenas de um exemplo.


<pre>
<code class="lua">

require "ncluasoap"

---Função para processar a resposta da requisição SOAP enviada ao WS
--@param result Resultado da chamada ao método remoto via SOAP.
--No caso deste Web Service, o resultado é uma variável
--primitiva simples (ou seja, contendo apenas um valor)
local function getResponse(result)
   print("\n\n\n----Lista de Estados da Região Escolhida")
   print(result)
   print("-----------------------------------------\n\n\n")
end

local msgTable = {
  address = "http://manoelcampos.com/estadosws/server.php",
  namespace = "manoelcampos.com",
  operationName = "estados2",
  params = {
    dados = {
      --Ordenar o resultado pelo nome do campo
      --especificado (opções são: estado ou uf)
      ordem = "estado",
      --Obter apenas os estados da região do país especificada
      regiao = "norte"
    }
  }
}

--O serviço sendo acessado só aceita SOAP 1.1
local soapVersion = "1.1"
ncluasoap.call(msgTable, getResponse, soapVersion)
</code>
</pre>



Para passar um array para um método remoto, basta construir o seu array como uma tabela lua de índices numéricos e incluí-la dentro do campo params da tabela msgTable, como mostra o exemplo de código abaixo:


<pre>
<code class="lua">

require "ncluasoap"

local function getResponse(result)
   print(result)
end

local msgTable = {
  address = "ENDEREÇO_DO_WEB_SERVICE",
  namespace = "NAMESPACE_DO_WEB_SERVICE",
  operationName = "NOME_DO_MÉTODO_REMOTO",
  params = {
    --Vetor de inteiros a ser passado para o método remoto
    numeros =  {19, 8, 29, 5}
  }
}

ncluasoap.call(msgTable, getResponse)
</code>
</pre>


No exemplo anterior, o método remoto a ser chamado deve receber um parâmetro de nome numeros, do tipo array de inteiros.

Os novos recursos implementados foram testados apenas com um WS PHP e outro Java. Relatos de sucesso ou falhas com outros Web Services, que requeiram structs ou arrays como parâmetros, são bem vindos.

Para download da nova versão acesse [http://github.com/manoelcampos/NCLuaSOAP](http://github.com/manoelcampos/NCLuaSOAP)

Contribua: comente, avalie, relate o uso do módulo em seus projetos e dê retweet neste artigo (ufa!).
