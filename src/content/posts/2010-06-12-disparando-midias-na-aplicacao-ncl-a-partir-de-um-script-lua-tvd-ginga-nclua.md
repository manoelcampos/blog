---
author: admin
comments: true
layout: post
slug: disparando-midias-na-aplicacao-ncl-a-partir-de-um-script-lua-tvd-ginga-nclua
title: 'Disparando mídias na aplicação #NCL a partir de um script #Lua. #TVD #Ginga #NCLua'
wordpress_id: 1666
categories:
- Dicas NCL e Lua
- TV Digital
---

Na seção de dicas NCL/Lua de hoje, vou mostrar como, a partir de um script Lua, iniciar mídias definidas na aplicação NCL.


## Pré-requisitos


Para acompanhar este artigo, são necessários conhecimentos básicos de NCL, Lua e NCLua (como o módulo event). Você pode utilizar o [Eclipse](http://www.eclipse.org/) com o plugin [NCLEclipse](http://www.laws.deinf.ufma.br/~ncleclipse/). Recomenda-se utilizar a última versão do [Ginga Virtual Set-top Box](http://www.gingancl.org/ferramentas.html).

Um [tutorial de como estruturar o ambiente de desenvolvimento](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl) está disponível [aqui](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl).

Não vou explicar detalhes básicos de NCL como regiões e descritores, sendo assumido que o leitor já conhece tais recursos.


--more Leia Mais--


## Iniciando


Primeiro crie um diretório para aplicação. Dentro dele crie um arquivo main.ncl e outro main.lua.
Crie um sub-diretório media. Neste, coloque duas imagens: uma com o nome de img1.png e outra como img2.png.


## Construindo o NCL


Abra o arquivo main.ncl e adicione 3 regiões (duas para as imagens e uma para a o nó lua):

<pre>
<code class="xml">

&lt;regionBase&gt;
	&lt;region id="rgImg1" width="40" height="32" left="2" top="2" /&gt;
	&lt;region id="rgImg2" width="40" height="32" left="2" top="100" /&gt;
	&lt;region id="rgLua"  width="100%" height="30%" left="0" top="70%" /&gt;
&lt;/regionBase&gt;
</code>
</pre>


Agora vamos criar os descritos para estas regiões:

<pre>
<code class="xml">

&lt;descriptorBase&gt;
	&lt;descriptor id="dImg1" region="rgImg1" /&gt;
	&lt;descriptor id="dImg2" region="rgImg2" /&gt;
	&lt;descriptor id="dLua"    region="rgLua" /&gt;
&lt;/descriptorBase&gt;
</code>
</pre>


Nossa aplicação NCL terá apenas um conector, definindo que, quando o valor de um atributo for setado, uma mídia será iniciada:

<pre>
<code class="xml">

&lt;connectorBase&gt;
  &lt;!--Quando um valor de uma propriedade for alterado, inicia uma determinada mídia --&gt;
	&lt;causalConnector id="onEndAttributionStart"&gt;
		&lt;simpleCondition role="onEndAttribution" /&gt;
		&lt;simpleAction role="start" /&gt;
	&lt;/causalConnector&gt;
&lt;/connectorBase&gt;
</code>
</pre>


A finalidade do conector ficará mais clara logo.

Vamos agora adicionar as mídias para as imagens colocadas no diretório media:

<pre>
<code class="xml">

	&lt;media id="img1" src="media/img1.png" descriptor="dImg1"/&gt;
	&lt;media id="img2" src="media/img2.png" descriptor="dImg2"/&gt;
</code>
</pre>



### Adicionando a mídia Lua


Agora vamos incluir a mídia para o arquivo main.lua (que por enquanto está vazio). Esta mídia deverá conter duas propriedades que definiremos com os nomes de sinal1 e sinal2, como pode ser visto abaixo:

<pre>
<code class="xml">

	&lt;media id="lua" src="main.lua" descriptor="dLua"&gt;
		&lt;property name="sinal1"/&gt;
		&lt;property name="sinal2"/&gt;
	&lt;/media&gt;
</code>
</pre>


Tais propriedades são a chave para permitir iniciar mídias no NCL a partir do script Lua. O nome delas indica que serão utilizadas como um sinal para que mídias específicas sejam iniciadas. Assim, quando for atribuído, a partir do script Lua, um valor à propriedade sinal1 (qualquer valor), o NCL iniciará a mídia img1. O mesmo ocorrerá com a propriedade sinal2 e a mídia img2.

Agora fica clara a finalidade do conector onEndAttributionStart, que será usado em um link NCL: quando for atribuído um valor a uma propriedade de uma mídia, outra mídia é iniciada.

Bem, agora precisamos incluir uma porta para iniciar a mídia Lua, com o código a seguir:

<pre>
<code class="xml">

	&lt;port id="pInicio" component="lua"/&gt;
</code>
</pre>



### Adicionando links NCL


Precisamos agora adicionar links NCL para detectar a alteração das propriedades do nó Lua, usando o código abaixo:

<pre>
<code class="xml">

  &lt;!--Quando a propriedade sinal1 do nó lua for setada, inicia a img1--&gt;
	&lt;link xconnector="onEndAttributionStart"&gt;
		&lt;bind role="onEndAttribution" component="lua" interface="sinal1"/&gt;
		&lt;bind role="start" component="img1" /&gt;
	&lt;/link&gt;

  &lt;!--Quando a propriedade sinal2 do nó lua for setada, inicia a img2--&gt;
	&lt;link xconnector="onEndAttributionStart"&gt;
		&lt;bind role="onEndAttribution" component="lua" interface="sinal2"/&gt;
		&lt;bind role="start" component="img2" /&gt;
	&lt;/link&gt;
</code>
</pre>


Observe que, no caso do primeiro link, quando for atribuído um valor à propriedade sinal1 do nó lua, a mídia img1 é iniciada. O mesmo ocorrerá para a propriedade sinal2 e a mídia img2.


## Escrevendo o script Lua


Abra o arquivo main.lua. Poderia ser definida qualquer condição para o disparo das mídias img1 e img2, que pode variar de acordo com suas necessidades. Aqui, para simplificar, nossas condições serão as seguintes: após 2 segundos que a script lua tiver iniciado, será atribuído um valor qualquer à propriedade sinal1; e após 5 segundos, será atribuído um valor qualquer à propriedade sinal2 do nó lua.

Convencionalmente, para cada propriedade definida no nó lua dentro do NCL, criaremos uma função de mesmo nome no script Lua. Logo, teremos as funções sinal1 e sinal2. Vamos criar a definição das funções com o código abaixo:

<pre>
<code class="lua">

local function sinal1()

end

local function sinal2()

end
</code>
</pre>


Vamos definir o corpo das funções depois. Agora, vamos incluir, após as funções, o código que define as condições para a atribuição dos valores às propriedades do nó lua, com o código abaixo:

<pre>
<code class="lua">

event.timer(2000, sinal1)
event.timer(5000, sinal2)
</code>
</pre>


A função timer do módulo event, executa a função definida no seu segundo parâmetro, após o tempo (em milisegundos) definido no primeiro parâmetro. Assim, após 2 segundos, a função sinal1 será chamada; e após 5 segundos, a função sinal2.

Bem, agora falta definir o código a ser inserido dentro das funções definidas anteriormente. Para a função sinal1, inserida o código abaixo:

<pre>
<code class="lua">

local evt = {
          class = 'ncl',
          type  = 'attribution',
          name  = 'sinal1',
          value = 1,
       }
evt.action = 'start'; event.post(evt)
evt.action = 'stop' ; event.post(evt)
</code>
</pre>


Inicialmente é criada uma tabela de nome evt, que contém os dados necessários para disparar um evento a partir do script lua. Abaixo os campos desta tabela são explicados:



	
  * class: o valor "ncl" define um tipo de evento que permite a comunicação entre o script lua e o documento NCL (e vice-versa).

	
  * type: o valor "attribution" define que o evento a ser disparado atribuirá um valor a uma propriedade. Como estamos dentro do script lua, este só pode, de forma direta, alterar apenas as propriedades do nó NCL onde foi definido.

	
  * name: o valor "sinal2" define o nome da propriedade que será alterada no nó lua

	
  * value: indica o valor a ser atribuído à propriedade, neste caso, o valor 1.


Na penúltima linha, é atribuído o valor "start" para o campo action, para indicar que deve ser iniciada a atribuição do valor à propriedade do nó lua. Depois o evento é disparado com event.post(evt).

Os eventos do tipo attribution precisam ser iniciados, fazendo um event.post passando uma tabela evt contendo o campo action igual a "start" (penúltima linha); e depois precisam ser finalizados, fazendo um event.post passando uma tabela evt contendo o campo action igual a "stop" (última linha).

E pra finalizar, o código da função sinal2 é o mesmo (desculpem pela duplicação de código, mas foi com a intenção de simplificar), alterando sinal1 para sinal2 e o valor 1 para 2 (pode-se usar qualquer valor, coloquei 2 apenas para combinar com sinal2).

Veja o código completo do arquivo main.lua abaixo:

<pre>
<code class="lua">

local function sinal1()
  local evt = {
    class = 'ncl',
    type  = 'attribution',
    name  = 'sinal1',
    value = 1,
  }
  evt.action = 'start'; event.post(evt)
  evt.action = 'stop' ; event.post(evt)
end

local function sinal2()
  local evt = {
    class = 'ncl',
    type  = 'attribution',
    name  = 'sinal2',
    value = 2,
  }
  evt.action = 'start'; event.post(evt)
  evt.action = 'stop' ; event.post(evt)
end

event.timer(2000, sinal1)
event.timer(5000, sinal2)
</code>
</pre>


e o código do main.ncl:

<pre>
<code class="xml">

&lt;?xml version="1.0" encoding="ISO-8859-1"?&gt;
&lt;ncl id="main" xmlns="http://www.ncl.org.br/NCL3.0/EDTVProfile"&gt;
  &lt;head&gt;
    &lt;regionBase&gt;
	    &lt;region id="rgImg1" width="40" height="32" left="2" top="2" /&gt;
	    &lt;region id="rgImg2" width="40" height="32" left="2" top="100" /&gt;
	    &lt;region id="rgLua"  width="100%" height="30%" left="0" top="70%" /&gt;
    &lt;/regionBase&gt;

    &lt;descriptorBase&gt;
	    &lt;descriptor id="dImg1" region="rgImg1" /&gt;
	    &lt;descriptor id="dImg2" region="rgImg2" /&gt;
	    &lt;descriptor id="dLua"  region="rgLua" /&gt;
    &lt;/descriptorBase&gt;

    &lt;connectorBase&gt;
	    &lt;causalConnector id="onEndAttributionStart"&gt;
		    &lt;simpleCondition role="onEndAttribution" /&gt;
		    &lt;simpleAction role="start" /&gt;
	    &lt;/causalConnector&gt;
    &lt;/connectorBase&gt;
  &lt;/head&gt;

  &lt;body&gt;
	  &lt;port id="pInicio" component="lua"/&gt;

	  &lt;media id="img1" src="media/img1.png" descriptor="dImg1"/&gt;
	  &lt;media id="img2" src="media/img2.png" descriptor="dImg2"/&gt;

	  &lt;media id="lua" src="main.lua" descriptor="dLua"&gt;
		  &lt;property name="sinal1"/&gt;
		  &lt;property name="sinal2"/&gt;
	  &lt;/media&gt;

	  &lt;link xconnector="onEndAttributionStart"&gt;
		  &lt;bind role="onEndAttribution" component="lua" interface="sinal1"/&gt;
		  &lt;bind role="start" component="img1" /&gt;
	  &lt;/link&gt;

	  &lt;link xconnector="onEndAttributionStart"&gt;
		  &lt;bind role="onEndAttribution" component="lua" interface="sinal2"/&gt;
		  &lt;bind role="start" component="img2" /&gt;
	  &lt;/link&gt;
  &lt;/body&gt;
&lt;/ncl&gt;
</code>
</pre>



## Conclusão


Pronto, basta executar a aplicação NCL e ver o resultado. Após 2 segundos a img1 será mostrada, e após 5 segundos, a img2.

A utilidade para este recurso depende das necessidades de cada projeto.
Gostou do artigo? Contribua: comente, avalie e retweet.

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]
