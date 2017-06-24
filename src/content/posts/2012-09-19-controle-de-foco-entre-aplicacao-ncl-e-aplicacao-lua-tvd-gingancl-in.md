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

[![](http://manoelcampos.com.br/wp-content/uploads/tabs.jpg)](http://manoelcampos.com.br/wp-content/uploads/tabs.jpg)Uma das grandes dificuldades que alguns desenvolvedores NCL/Lua tem é em alternar o controle de foco entre a aplicação NCL e Lua, para, quando estiver na aplicação NCL, esta controlar o foco, por exemplo, dos itens de um menu, quando o usuário utilizar as setas do controle remoto para navegar por eles. Quando uma aplicação Lua é iniciada, normalmente deseja-se que o controle de foco e captura de teclas passar para ela. Nestes casos, quando a aplicação lua é finalizada, é preciso fazer o controle de foco voltar para a aplicação NCL, para que o usuário continue alternando o foco entre os itens do menu.

Neste artigo vou mostrar como resolver esta questão. Para isto, vamos criar uma aplicação NCL contendo imagens que representarão itens de um menu.  A aplicação terá 3 itens no menu que ficará posicionado verticalmente, no canto superior esquerdo da tela. Quando o usuário utilizar as setas para cima e para baixo no controle remoto, o foco mudará de um item para o outro. Quando ele pressionar enter sobre o primeiro item, uma aplicação Lua será iniciada e um imagem de um botão vermelho será iniciado. A aplicação lua passará a ter o controle de foco, capturando os eventos ocorridos (como pressionamento de teclas) e exibindo isso na tela. Quando o usuário pressionar o botão vermelho, a aplicação Lua será finalizada, voltando para o NCL que passará a controlar o foco novamente.

Bem, vou mostrar apenas os pontos principais. Todo o código pode ser baixado no final do artigo.
Para começar, vamos criar as regiões para nossas mídias, com o código a seguir:

```xml
<region id="rgLua" width="100%" height="100%" />
<region id="rgVoltar" right="48" top="0" width="48" height="48" />
<region id="rgMenu" left="0" height="100%" width="150">
<region id="rgMenu1" width="164" height="49" left="0" top="10" />
<region id="rgMenu2" width="164" height="49" left="0" top="60" />
<region id="rgMenu3" width="164" height="49" left="0" top="120" />
```

Agora vamos inserir os descritores para as mídias:

```xml
<descriptor id="dLua" region="rgLua" focusIndex="0" />
<descriptor id="dMenu1" region="rgMenu1" focusIndex="1" moveDown="2" moveUp="3" />
<descriptor id="dMenu2" region="rgMenu2" focusIndex="2" moveDown="3" moveUp="1" />
<descriptor id="dMenu3" region="rgMenu3" focusIndex="3" moveDown="1" moveUp="2" />
<descriptor id="dVoltar" region="rgVoltar" />
```

Para permitir a navegação entre os itens do menu, é preciso definir um focusIndex para cada um. Este é um valor inteiro que funciona como um tabindex do HTML, definindo a ordem dos itens. Por meio das propriedades moveDown, moveUp, moveLeft e moveRight (estas duas últimas não utilizadas aqui) podemos definir para qual item do menu o foco irá quando o usuário pressionar, respectivamente, as setas para baixo, para cima, para a esquerda e para a direita.

Um detalhe importante, para fazer a troca do controle de foco entre a aplicação NCL e a Lua funcionar, é definir um focusIndex para a mídia Lua. Neste caso, utilizei o valor 0 (zero).

O botão voltar não precisa de focusIndex pois ele não receberá o foco. Quando ele for iniciado, independente de onde o foco esteja, se o usuário pressionar o vermelho, a aplicação Lua será finalizada.

Para o sincronismo das mídias vamos precisar de alguns conectores (que não mostrarei o código por serem básicos e podem ser vistos no arquivo para download) sendo os primeiros: onBeginStartN, onBeginStopN, onEndStop, onEndStartNStop. Se você está criando a aplicação do zero, sugiro utilizar o plugin NCLEclipse que já permite automaticamente criar um arquivo contendo todos estes conectores básicos e mais alguns.

Precisaremos ainda de um conector onKeySelectionStop. O mesmo define que, quando uma tecla for pressionada, será dado stop em uma determinada mídia.

Ainda precisaremos de um conector onSelectionStart. Este define que, quando um item em foco for acionado com a tecla OK (ENTER), uma mídia será iniciada.

Para finalizar, precisaremos ainda de conectores onBeginSet (que, quando uma mídia iniciar, seta valor para uma propriedade de qualquer mídia) e um onEndSet (que, quando uma mídia finalizar, seta valor para uma propriedade de qualquer mídia).

Incluídos os conectores, vamos inserir a porta para iniciar a primeira mídia e as mídias:

```xml
<port id="pInicial" component="menu1"/>

<media id="menu1" src="media/menu1.png" descriptor="dMenu1"/>
<media id="menu2" src="media/menu2.png" descriptor="dMenu2"/>
<media id="menu3" src="media/menu3.png" descriptor="dMenu3"/>
<media id="lua"   src="main.lua" descriptor="dLua" />
<media id="voltar" src="media/red.png" descriptor="dVoltar" />
```

Agora, para permitir a alternância de foco entre a aplicação NCL e a Lua, precisamos incluir uma mídia do tipo application/x-ginga-settings. Uma mídia deste tipo possui variáveis de ambiente reservadas. Uma destas propriedades é a service.currentKeyMaster. Segundo a norma ABNT NBR 15606-2, tal propriedade armazena:

<blockquote>o identificador (id) do elemento <media> que detém o controle das chaves de navegação; se o elemento não estiver sendo apresentado ou não estiver pausado, o controle é do formatador.</blockquote>

Desta forma, vamos inserir uma mídia deste tipo para poder controlar o valor da propriedade service.currentKeyMaster:

```xml
<media id="settings" type="application/x-ginga-settings">
<property name="service.currentKeyMaster" value=""/>
</media>
```

O valor da propriedade está vazio para definir que o controle de foco inicialmente será da aplicação NCL.

Agora vamos incluir os links para controle da navegação na aplicação inteira. Este são links básicos, não tendo nenhuma relação com o controle de foco, e o código está todo comentado:

```xml
<!--Quando iniciar o primeiro item de menu, inicia os outros-->
<link xconnector="onBeginStartN">
	<bind role="onBegin" component="menu1" />
	<bind role="start" component="menu2" />
	<bind role="start" component="menu3" />
</link>

<!--Ao pressionar ENTER no menu1, inicia o lua-->
<link xconnector="onSelectionStart">
	<bind role="onSelection" component="menu1" />
	<bind role="start" component="lua" />
</link>

<!--Quando iniciar o lua, inicia o botão vermelho (que permite voltar ao menu)-->
<link xconnector="onBeginStartN">
	<bind role="onBegin" component="lua" />
	<bind role="start" component="voltar" />
</link>

<!--Quando iniciar o lua, para os menus-->
<link xconnector="onBeginStopN">
	<bind role="onBegin" component="lua" />
	<bind role="stop" component="menu1" />
	<bind role="stop" component="menu2" />
	<bind role="stop" component="menu3" />
</link>

<!--Quando pressionar RED, para o lua e volta ao menu-->
<link xconnector="onKeySelectionStop">
	<bind role="onSelection" component="voltar">
		<bindParam name="key" value="RED"/>
	</bind>
	<bind role="stop" component="lua" />
</link>

<!--Quando o lua finalizar, inicia o menu1 (outro link iniciará os outros menus)  e para o botão voltar-->
<link xconnector="onEndStartNStop">
	<bind role="onEnd" component="lua" />
	<bind role="start" component="menu1" />
	<bind role="stop" component="voltar" />
</link>	
```

Agora sim, vamos incluir os links responsáveis pela alternância do controle de foco entre a aplicação NCL e a Lua. Como declaramos a mídia settings com a propriedade service.currentKeyMaster alteriormente, vamos incluir um link que permitirá, ao iniciar a aplicação Lua, passar o controle de foco para ela:

```xml
<link xconnector="onBeginSet">
<bind role="onBegin" component="lua" />
	<bind role="set" component="settings" interface="service.currentKeyMaster">
		<bindParam name="value" value="lua"/>
	</bind>
</link>
```

Note que, quando a mídia Lua iniciar, o valor da propriedade service.currentKeyMaster  da mídia settings será alterado para "lua", que é o id da mídia Lua que controlará o foco.

Quando a mídia Lua for finalizada, precisaremos voltar o controle de foco para a aplicação NCL utilizando outro link. Para isto, apenas setamos o valor da propriedade service.currentKeyMaster para vazio, como mostrado a seguir:

```xml
<link xconnector="onEndSet">
	<bind role="onEnd" component="lua" />
	<bind role="set" component="settings" interface="service.currentKeyMaster">
		<bindParam name="value" value=""/>
	</bind>
</link>
```

Agora só falta inserir o código para o arquivo main.lua, que simplesmente interceptará os eventos gerados pela aplicação (como o pressionamento de teclas) e mostrará tais dados na tela. Segue o código:

```lua
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
```

Então é isto aí. Só lembrando, que a alternância de controle de foco só funciona se definirmos um número para o focusIndex do descritor da mídia Lua.
