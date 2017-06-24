---
author: admin
comments: true
layout: post
slug: redimensionando-e-restaurando-um-video-em-aplicacao-ncl-parte-1-tvd-in
title: 'Redimensionando e restaurando um vídeo em aplicação #NCL - Parte 1. #TVD #in'
wordpress_id: 2664
categories:
- Dicas NCL e Lua
- TV Digital
tags:
- Ginga
- GingaNCL
- NCL
- onBeginSet
- Redimensionar
- Vídeo
---

[![](http://manoelcampos.com.br/wp-content/uploads/resize.png)](http://manoelcampos.com.br/wp-content/uploads/resize.png)Quando se reduz um objeto, como um vídeo, em uma aplicação NCL (ou qualquer outra) para 50%, por exemplo, para voltar ao tamanho original, não adianta setar as propriedades width e height para 100%. Isto apenas fará com que as dimensões do vídeo sejam alteradas para 100% do valor atual.

Se o vídeo tinha 400x400 e foi reduzido para 50%, seu tamanho atual é 200x200. Assim, 100% será referente ao tamanho atual. Assim, alterar as dimensões para 100% não fará efeito nenhum sobre o tamanho do vídeo, pois 100% de 200x200 é 200x200 :).

Para voltar o vídeo ao tamanho anterior de 400x400, teremos que alterar suas dimensões para 200% do valor atual.
Para encontrar tal percentual, pode-se resolver a regra de 3 abaixo:

100% - dimensao_atual
x - dimensao_original

O cálculo deve ser feito para a largura e depois para a altura. Usando tal fórmula, um vídeo que foi reduzido para 50%, para voltar ao tamanho original terá que ter sua dimensão alterada para 200%.

Então, vamos à construção da aplicação. Vou explicar apenas o fundamental (a aplicação completa está disponível para download no final do artigo). Nossa aplicação terá um vídeo, que após 5 segundos de iniciado, será redimensionado para 50% e apresentará um botão vermelho. Quando o usuário pressionar o respectivo botão do controle remoto, o vídeo voltará ao tamanho original.

Para isto, precisamos de um vídeo e uma imagem para representar o botão vermelho do controle. Inclua as mídias na aplicação (tags region's, descriptor's e media's) e uma porta para o vídeo.

No vídeo, vamos incluir uma âncora quer marcará os 5 segundos de início do mesmo e vamos publicar a propriedade bounds (que define em um atributo só, o top, left, width e height da mídia) para permitir que alteremos ela por meio de um link. Segue código da mídia do vídeo:

```xml
<media id="video" src="media/video.avi" descriptor="dVideo">
	<property name="bounds"/>
	<area id="a1" begin="5s"/>
</media>
```

Agora vamos precisar criar alguns conectores. O onBeginStart será utilizado para, quando uma mídia iniciar, iniciar dar start em outra. Veja código do conector abaixo:

```xml
<causalConnector id="onBeginStart">
	<simpleCondition role="onBegin"/>
	<simpleAction role="start"/>
</causalConnector>
```

O conector onBeginSet será usado para, quando uma mídia iniciar, alterar uma propriedade de outra. Segue código do conector:

```xml
<causalConnector id="onBeginSet">
	<connectorParam name="var"/>
	<simpleCondition role="onBegin"/>
	<simpleAction role="set" value="$var"/>
</causalConnector>
```

A variável (connectorParam)  "var" é usada para permitir, no link a ser adicionado posteriormente, especificar qual valor será setado para a propriedade lá especificada (no nosso caso, será a propriedade bounds do vídeo).

Agora vamos adicionar um conector onKeySelectionStopSet para, quando o usuário pressionar um botão, parar uma mídia e setar uma propriedade de outra. Segue código:

```xml
<causalConnector id="onKeySelectionStopSet">
	<connectorParam name="var"/>
	<connectorParam name="key"/>
	<simpleCondition role="onSelection" key="$key" />
	<compoundAction operator="seq">
		<simpleAction role="set" value="$var"/>
		<simpleAction role="stop"/>
	</compoundAction>
</causalConnector>
```

A variável "var" é usada com a mesma finalidade do conector anterior. A variável key é usado para, somente no link, especificar qual tecla iniciará as ações do conector. Desta forma, o conector fica mais reutilizável.

Bem, agora vamos para os links. O primeiro link iniciará a imagem do botão vermelho quando a âncora de 5 segundos do vídeo iniciar, usando o conector onBeginStart criado anteriormente:

```xml
<link xconnector="onBeginStart">
	<bind role="onBegin" component="video" interface="a1"/>
	<bind role="start" component="botao" />
</link>
```

Agora, vamos inserir um link para, quando a âncora de 5 segundos do vídeo iniciar, alterar o tamanho do mesmo para 50%:

```xml
<link xconnector="onBeginSet">
	<bind role="onBegin" component="video" interface="a1"/>
	<bind role="set" component="video" interface="bounds">
		<bindParam name="var" value="0,0,50%,50%"/>
	</bind>
</link>
```

Por fim, vamos inserir um link para, quando o usuário pressionar o botão vermelho, parar a imagem e restaurar o tamanho do vídeo. Como reduzimos ele para 50%, para voltar ao normal precisamos alterar suas dimensões para 200%. Segue código do link:

```xml
<link xconnector="onKeySelectionStopSet">
	<bind role="onSelection" component="botao">
		<bindParam name="key" value="RED"/>
	</bind>

	<bind role="set" component="video" interface="bounds">
		<bindParam name="var" value="0,0,200%,200%"/>
	</bind>
	<bind role="stop" component="botao" />
 </link>
```

Bem, agora é rodar e testar. Ao iniciar a aplicação, depois de 5 segundos o vídeo é redimensionando e o botão vermelho aparece. Quando você pressionar o botão, o vídeo volta ao tamanho anterior.

O código é bem simples, no entanto, estático. Se você resolver alterar os valores de redimensionamento do vídeo, precisará usar a regra de 3 mostrada no início do artigo para descobrir qual o valor percentual que precisará aplicar para voltar o vídeo ao tamanho original.

Na segunda parte do artigo, mostrarei como tornar isto dinâmico, usando apenas NCL. Até lá. 
