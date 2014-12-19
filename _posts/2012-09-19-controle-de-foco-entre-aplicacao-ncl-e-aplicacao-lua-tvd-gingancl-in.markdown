---
author: admin
comments: true
layout: post
slug: controle-de-foco-entre-aplicacao-ncl-e-aplicacao-lua-tvd-gingancl-in
title: 'Controle de foco entre aplicação #NCL e aplicação #Lua. #TVD #GingaNCL #in'
wordpress_id: 2690
categories:
- Dicas NCL e Lua
- TV Digital
tags:
- foco
- Ginga
- GingaNCL
- Lua
- NCL
- service.currentKeyMaster
---

[![](http://manoelcampos.com/wp-content/uploads/tabs.jpg)](http://manoelcampos.com/wp-content/uploads/tabs.jpg)Uma das grandes dificuldades que alguns desenvolvedores NCL/Lua tem é em alternar o controle de foco entre a aplicação NCL e Lua, para, quando estiver na aplicação NCL, esta controlar o foco, por exemplo, dos itens de um menu, quando o usuário utilizar as setas do controle remoto para navegar por eles. Quando uma aplicação Lua é iniciada, normalmente deseja-se que o controle de foco e captura de teclas passar para ela. Nestes casos, quando a aplicação lua é finalizada, é preciso fazer o controle de foco voltar para a aplicação NCL, para que o usuário continue alternando o foco entre os itens do menu.



--more Leia Mais--



Neste artigo vou mostrar como resolver esta questão. Para isto, vamos criar uma aplicação NCL contendo imagens que representarão itens de um menu.  A aplicação terá 3 itens no menu que ficará posicionado verticalmente, no canto superior esquerdo da tela. Quando o usuário utilizar as setas para cima e para baixo no controle remoto, o foco mudará de um item para o outro. Quando ele pressionar enter sobre o primeiro item, uma aplicação Lua será iniciada e um imagem de um botão vermelho será iniciado. A aplicação lua passará a ter o controle de foco, capturando os eventos ocorridos (como pressionamento de teclas) e exibindo isso na tela. Quando o usuário pressionar o botão vermelho, a aplicação Lua será finalizada, voltando para o NCL que passará a controlar o foco novamente.

Bem, vou mostrar apenas os pontos principais. Todo o código pode ser baixado no final do artigo.
Para começar, vamos criar as regiões para nossas mídias, com o código a seguir:

<pre>
<code class="xml">
&lt;region id=&quot;rgLua&quot; width=&quot;100%&quot; height=&quot;100%&quot; /&gt;
&lt;region id=&quot;rgVoltar&quot; right=&quot;48&quot; top=&quot;0&quot; width=&quot;48&quot; height=&quot;48&quot; /&gt;
&lt;region id=&quot;rgMenu&quot; left=&quot;0&quot; height=&quot;100%&quot; width=&quot;150&quot;&gt;
&lt;region id=&quot;rgMenu1&quot; width=&quot;164&quot; height=&quot;49&quot; left=&quot;0&quot; top=&quot;10&quot; /&gt;
&lt;region id=&quot;rgMenu2&quot; width=&quot;164&quot; height=&quot;49&quot; left=&quot;0&quot; top=&quot;60&quot; /&gt;
&lt;region id=&quot;rgMenu3&quot; width=&quot;164&quot; height=&quot;49&quot; left=&quot;0&quot; top=&quot;120&quot; /&gt;
</code>
</pre>


Agora vamos inserir os descritores para as mídias:
<pre>
<code class="xml">
&lt;descriptor id=&quot;dLua&quot; region=&quot;rgLua&quot; focusIndex=&quot;0&quot; /&gt;
&lt;descriptor id=&quot;dMenu1&quot; region=&quot;rgMenu1&quot; focusIndex=&quot;1&quot; moveDown=&quot;2&quot; moveUp=&quot;3&quot; /&gt;
&lt;descriptor id=&quot;dMenu2&quot; region=&quot;rgMenu2&quot; focusIndex=&quot;2&quot; moveDown=&quot;3&quot; moveUp=&quot;1&quot; /&gt;
&lt;descriptor id=&quot;dMenu3&quot; region=&quot;rgMenu3&quot; focusIndex=&quot;3&quot; moveDown=&quot;1&quot; moveUp=&quot;2&quot; /&gt;
&lt;descriptor id=&quot;dVoltar&quot; region=&quot;rgVoltar&quot; /&gt;
</code>
</pre>


Para permitir a navegação entre os itens do menu, é preciso definir um focusIndex para cada um. Este é um valor inteiro que funciona como um tabindex do HTML, definindo a ordem dos itens. Por meio das propriedades moveDown, moveUp, moveLeft e moveRight (estas duas últimas não utilizadas aqui) podemos definir para qual item do menu o foco irá quando o usuário pressionar, respectivamente, as setas para baixo, para cima, para a esquerda e para a direita.

Um detalhe importante, para fazer a troca do controle de foco entre a aplicação NCL e a Lua funcionar, é definir um focusIndex para a mídia Lua. Neste caso, utilizei o valor 0 (zero).

O botão voltar não precisa de focusIndex pois ele não receberá o foco. Quando ele for iniciado, independente de onde o foco esteja, se o usuário pressionar o vermelho, a aplicação Lua será finalizada.

Para o sincronismo das mídias vamos precisar de alguns conectores (que não mostrarei o código por serem básicos e podem ser vistos no arquivo para download) sendo os primeiros: onBeginStartN, onBeginStopN, onEndStop, onEndStartNStop. Se você está criando a aplicação do zero, sugiro utilizar o plugin NCLEclipse que já permite automaticamente criar um arquivo contendo todos estes conectores básicos e mais alguns.

Precisaremos ainda de um conector onKeySelectionStop. O mesmo define que, quando uma tecla for pressionada, será dado stop em uma determinada mídia.

Ainda precisaremos de um conector onSelectionStart. Este define que, quando um item em foco for acionado com a tecla OK (ENTER), uma mídia será iniciada.

Para finalizar, precisaremos ainda de conectores onBeginSet (que, quando uma mídia iniciar, seta valor para uma propriedade de qualquer mídia) e um onEndSet (que, quando uma mídia finalizar, seta valor para uma propriedade de qualquer mídia).

Incluídos os conectores, vamos inserir a porta para iniciar a primeira mídia e as mídias:

<pre>
<code class="xml">
&lt;port id=&quot;pInicial&quot; component=&quot;menu1&quot;/&gt;

&lt;media id=&quot;menu1&quot; src=&quot;media/menu1.png&quot; descriptor=&quot;dMenu1&quot;/&gt;
&lt;media id=&quot;menu2&quot; src=&quot;media/menu2.png&quot; descriptor=&quot;dMenu2&quot;/&gt;
&lt;media id=&quot;menu3&quot; src=&quot;media/menu3.png&quot; descriptor=&quot;dMenu3&quot;/&gt;
&lt;media id=&quot;lua&quot; src=&quot;main.lua&quot; descriptor=&quot;dLua&quot; /&gt;
&lt;media id=&quot;voltar&quot; src=&quot;media/red.png&quot; descriptor=&quot;dVoltar&quot; /&gt;
</code>
</pre>

Agora, para permitir a alternância de foco entre a aplicação NCL e a Lua, precisamos incluir uma mídia do tipo application/x-ginga-settings. Uma mídia deste tipo possui variáveis de ambiente reservadas. Uma destas propriedades é a service.currentKeyMaster. Segundo a norma ABNT NBR 15606-2, tal propriedade armazena:


<blockquote>o identificador (id) do elemento <media> que detém o controle das chaves de navegação; se o elemento não estiver sendo apresentado ou não estiver pausado, o controle é do formatador.</blockquote>


Desta forma, vamos inserir uma mídia deste tipo para poder controlar o valor da propriedade service.currentKeyMaster:

<pre>
<code class="xml">
&lt;media id=&quot;settings&quot; type=&quot;application/x-ginga-settings&quot;&gt;
&lt;property name=&quot;service.currentKeyMaster&quot; value=&quot;&quot;/&gt;
&lt;/media&gt;
</code>
</pre>

O valor da propriedade está vazio para definir que o controle de foco inicialmente será da aplicação NCL.

Agora vamos incluir os links para controle da navegação na aplicação inteira. Este são links básicos, não tendo nenhuma relação com o controle de foco, e o código está todo comentado:

<pre>
<code class="xml">
&lt;!--Quando iniciar o primeiro item de menu, inicia os outros--&gt;
&lt;link xconnector=&quot;onBeginStartN&quot;&gt;
&lt;bind role=&quot;onBegin&quot; component=&quot;menu1&quot; /&gt;
&lt;bind role=&quot;start&quot; component=&quot;menu2&quot; /&gt;
&lt;bind role=&quot;start&quot; component=&quot;menu3&quot; /&gt;
&lt;/link&gt;

&lt;!--Ao pressionar ENTER no menu1, inicia o lua--&gt;
&lt;link xconnector=&quot;onSelectionStart&quot;&gt;
&lt;bind role=&quot;onSelection&quot; component=&quot;menu1&quot; /&gt;
&lt;bind role=&quot;start&quot; component=&quot;lua&quot; /&gt;
&lt;/link&gt;

&lt;!--Quando iniciar o lua, inicia o botão vermelho (que permite voltar ao menu)--&gt;
&lt;link xconnector=&quot;onBeginStartN&quot;&gt;
&lt;bind role=&quot;onBegin&quot; component=&quot;lua&quot; /&gt;
&lt;bind role=&quot;start&quot; component=&quot;voltar&quot; /&gt;
&lt;/link&gt;

&lt;!--Quando iniciar o lua, para os menus--&gt;
&lt;link xconnector=&quot;onBeginStopN&quot;&gt;
&lt;bind role=&quot;onBegin&quot; component=&quot;lua&quot; /&gt;
&lt;bind role=&quot;stop&quot; component=&quot;menu1&quot; /&gt;
&lt;bind role=&quot;stop&quot; component=&quot;menu2&quot; /&gt;
&lt;bind role=&quot;stop&quot; component=&quot;menu3&quot; /&gt;
&lt;/link&gt;

&lt;!--Quando pressionar RED, para o lua e volta ao menu--&gt;
&lt;link xconnector=&quot;onKeySelectionStop&quot;&gt;
&lt;bind role=&quot;onSelection&quot; component=&quot;voltar&quot;&gt;
&lt;bindParam name=&quot;key&quot; value=&quot;RED&quot;/&gt;
&lt;/bind&gt;

&lt;bind role=&quot;stop&quot; component=&quot;lua&quot; /&gt;
&lt;/link&gt;

&lt;!--Quando o lua finalizar, inicia o menu1 (outro link iniciará os outros menus)  e para o botão voltar--&gt;
&lt;link xconnector=&quot;onEndStartNStop&quot;&gt;
&lt;bind role=&quot;onEnd&quot; component=&quot;lua&quot; /&gt;
&lt;bind role=&quot;start&quot; component=&quot;menu1&quot; /&gt;
&lt;bind role=&quot;stop&quot; component=&quot;voltar&quot; /&gt;
&lt;/link&gt;	
</code>
</pre>

Agora sim, vamos incluir os links responsáveis pela alternância do controle de foco entre a aplicação NCL e a Lua. Como declaramos a mídia settings com a propriedade service.currentKeyMaster alteriormente, vamos incluir um link que permitirá, ao iniciar a aplicação Lua, passar o controle de foco para ela:

<pre>
<code class="xml">
&lt;link xconnector=&quot;onBeginSet&quot;&gt;
&lt;bind role=&quot;onBegin&quot; component=&quot;lua&quot; /&gt;
&lt;bind role=&quot;set&quot; component=&quot;settings&quot; interface=&quot;service.currentKeyMaster&quot;&gt;
&lt;bindParam name=&quot;value&quot; value=&quot;lua&quot;/&gt;
&lt;/bind&gt;
&lt;/link&gt;
</code>
</pre>

Note que, quando a mídia Lua iniciar, o valor da propriedade service.currentKeyMaster  da mídia settings será alterado para "lua", que é o id da mídia Lua que controlará o foco.

Quando a mídia Lua for finalizada, precisaremos voltar o controle de foco para a aplicação NCL utilizando outro link. Para isto, apenas setamos o valor da propriedade service.currentKeyMaster para vazio, como mostrado a seguir:

<pre>
<code class="xml">
&lt;link xconnector=&quot;onEndSet&quot;&gt;
&lt;bind role=&quot;onEnd&quot; component=&quot;lua&quot; /&gt;
&lt;bind role=&quot;set&quot; component=&quot;settings&quot; interface=&quot;service.currentKeyMaster&quot;&gt;
&lt;bindParam name=&quot;value&quot; value=&quot;&quot;/&gt;
&lt;/bind&gt;
&lt;/link&gt;
</code>
</pre>


Agora só falta inserir o código para o arquivo main.lua, que simplesmente interceptará os eventos gerados pela aplicação (como o pressionamento de teclas) e mostrará tais dados na tela. Segue o código:

<pre>
<code class="lua">
function handler(evt)
	local s = ""
	for k, v in pairs(evt) do
		print("\t\t",k,v)
		s = s .. k .. "=" .. v .. "; "
	end

	canvas:attrFont("vera", 14)
	canvas:attrColor(255, 255, 255, 255)
	local largura, altura = canvas:attrSize()
	canvas:drawRect("fill", 0, 0, largura, altura)
	canvas:attrColor(255, 0, 0, 255)
	canvas:drawText(10,10,s)
	canvas:flush()
end

event.register(handler)
</code>
</pre>

Então é isto aí. Só lembrando, que a alternância de controle de foco só funciona se definirmos um número para o focusIndex do descritor da mídia Lua.

Baixe o código da aplicação no link a seguir.

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]
