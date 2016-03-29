---
author: admin
comments: true
layout: post
slug: pausando-e-resumindo-video-em-aplicacoes-ncl-para-tvd
title: 'Pausando e Resumindo Vídeo em Aplicações #NCL para #TVD'
wordpress_id: 1738
categories:
- Dicas NCL e Lua
- Software
- Software Livre
- TV Digital
tags:
- Ginga-NCL
- NCL
- Pause
- Play
- SBTVD
- TVD
- Vídeo
---

Estes dias estava fazendo uma pequena aplicação NCL para permitir pausar e resumir um vídeo e acabei tendo que recorrer ao fórum do Ginga, pois o vídeo pausava mas não resumia ao ser dado o comando para isto. Então fui informado de um pequeno detalhe, que não é intuitivo, necessário para que tal comportamento funcionasse.

Com isto, vou mostrar aqui como criar tal simples aplicação NCL.


--more Leia Mais--





## Pré-requisitos


Para acompanhar este artigo, é necessário conhecimento básico de NCL (como regiões, descritores, mídias, conectores, elos e portas). Você pode utilizar o [Eclipse](http://www.eclipse.org/) com o plugin [NCLEclipse](http://www.laws.deinf.ufma.br/~ncleclipse/). Recomenda-se utilizar a última versão do [Ginga Virtual Set-top Box](http://www.gingancl.org/ferramentas.html).

Um [tutorial de como estruturar o ambiente de desenvolvimento](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl) está disponível [aqui](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl).


## Iniciando


Vamos primeiro criar um diretório de nome pause-resume para a aplicação. Dentro dele crie um diretório media. Neste, coloque imagens com os nomes de play.png e pause.png. Imagens deste tipo podem ser encontradas em [http://www.flvplayer4free.com/flvplayer4free-features.htm](http://www.flvplayer4free.com/flvplayer4free-features.htm). Coloque um vídeo qualquer no diretório media.


## Criando o NCL


Agora crie um documento main.ncl no diretório pause-resume. Vamos inserir duas regiões, uma para o vídeo e outra para exibir os botões de pause e play, usando o código abaixo dentro da tag &lt;head&gt;.

<pre>
<code class="xml">

&lt;regionBase
    &lt;region id="rgVideo" width="100%" height="100%" zIndex="0" /&gt;
    &lt;region id="rgBtn" width="48" height="48" zIndex="1" left="0" top="85%" /&gt;
&lt;/regionBase&gt;
</code>
</pre>


Observe que foi definido o atributo zIndex para a região dos botões (rgBtn), para que a mesma fique sobre a região do vídeo.

A região do vídeo ocupará toda a tela e a dos botões ficarão no canto inferior esquerdo. Precisamos agora definir os descritos para apresentar as mídias (o vídeo e os botões), também dentro da tag &lt;head&gt;, como mostrado abaixo:

<pre>
<code class="xml">

&lt;descriptorBase&gt;
    &lt;descriptor id="dVideo" region="rgVideo" /&gt;
    &lt;descriptor id="dBtn" region="rgBtn" /&gt;
&lt;/descriptorBase&gt;
</code>
</pre>


Nossos descritos não vão definir nenhum comportamento adicional às mídias, mas são obrigatórios para que as mesmas possam ser apresentadas.


## Definindo as Mídias


Agora vamos incluir nossas mídias na aplicação. Dentro da tag &lt;body&gt; adicione o codigo abaixo:

<pre>
<code class="xml">

&lt;media id="video"       src="media/video.avi"   descriptor="dVideo"/&gt;
&lt;media id="btnPause"    src="media/pause.png"   descriptor="dBtn"/&gt;
&lt;media id="btnPlay"     src="media/play.png"    descriptor="dBtn"/&gt;
</code>
</pre>


Observe o nome do seu arquivo de vídeo para inserir corretamente no atributo src da mídia video.

Precisamos agora definir as mídias que serão iniciadas quando a aplicação for executada. Para isto, vamos incluir uma porta para iniciar o vídeo e outra para iniciar o botão pause (poderíamos definir um elo para, quando iniciar o vídeo, iniciar o botão pause, mas prefiro definir duas portas), usando o código a seguir:

<pre>
<code class="xml">

&lt;port id="pInicio" component="video"/&gt;
&lt;port id="pBotao"  component="btnPause"/&gt;
</code>
</pre>


Se você executar a aplicação agora, aparecerá o vídeo, com o botão pause no canto inferior esquerdo.


## Definindo os conectores


Para possibilitar o comportamento de pausar e resumir o vídeo, precisamos definir alguns conectores. Assim, dentro da tag &lt;head&gt;, insira uma tag &lt;connectorBase&gt;. Dentro desta, incluiremos os conectores.

Precisamos definir um conector para quando uma tecla for pressionada, dar pausa em uma mídia, iniciar e parar determinadas mídias. Assim, inclua o conector abaixo:

<pre>
<code class="xml">

&lt;!--Quando uma tecla for pressionada, 
pausa, inicia e para determinadas mídias--&gt;
&lt;causalConnector id="onKeySelecionPauseStartStop"&gt;
		&lt;connectorParam name="keyCode"/&gt;

		&lt;simpleCondition role="onSelection" key="$keyCode"/&gt;
		&lt;compoundAction operator="par"&gt;
                          &lt;simpleAction role="pause" /&gt;
                          &lt;simpleAction role="start" /&gt;
                          &lt;simpleAction role="stop" /&gt;
		&lt;/compoundAction&gt;
&lt;/causalConnector&gt;
</code>
</pre>


Observe que é definida um condição simples  para o conector, do tipo onSelection (quando uma tecla for pressionada). Tal condição precisa do atributo key para indicar qual tecla acionará a(s) ação(ões) do conector.

Poderíamos definir uma tecla fixa para este atributo, como o valor GREEN, para especificar que a(s) ação(ões) será(ão) executada(s) quando a tecla verde for pressionada. Mas o ideal é definir um parâmetro, para que especifiquemos a tecla apenas ao definir o elo que usará o conector, tornando o mesmo mais flexível. Por este motivo é que temos a tag &lt;connectorParam name="keyCode"/&gt;, que define um parâmetro a ser usado no atributo key da tag &lt;simpleCondition&gt;.

O parâmetro, definido com a tag  &lt;connectorParam&gt;, pode ter qualquer nome. Ao referenciá-lo na tag &lt;simpleCondition&gt;, é preciso informar seu nome precedido de um $.

Nosso conector ainda possui uma tag &lt;compoundAction&gt;, que define um conjunto de ações a serem executadas quando a condição, definida em &lt;simpleCondition&gt; for satisfeita. O atributo operator da tag &lt;compoundAction&gt; especifica se as ações serão executadas em paralelo (par) ou sequencialmente (seq). Dentro desta tag foram definidas as ações pause, start e stop.

Agora precisamos definir outro conector para, quando uma tecla for pressionada, resumir, iniciar e parar determinadas mídias. Tal conector é apresentado abaixo, possuindo a mesma estrutura do anterior, dispensando explicações:

<pre>
<code class="xml">

&lt;!--Quando uma tecla for pressionada, 
resume, inicia e para determinadas mídias--&gt;
&lt;causalConnector id="onKeySelecionResumeStartStop"&gt;
	&lt;connectorParam name="keyCode"/&gt;

	&lt;simpleCondition role="onSelection" key="$keyCode"/&gt;
          &lt;compoundAction operator="par"&gt;
                  &lt;simpleAction role="resume" /&gt;
                  &lt;simpleAction role="start" /&gt;
                  &lt;simpleAction role="stop" /&gt;
          &lt;/compoundAction&gt;
&lt;/causalConnector&gt;
</code>
</pre>



## Definindo os Elos para Habilitar os Comportamentos da Aplicação


Agora que criamos os conectores para possibilitar pausar e resumir o vídeo, precisamos incluir elos para estes conectores, que especificam quais mídias devem ser manipuladas (paradas, iniciadas e/ou resumidas).

Como o Ginga Virtual STB não possui teclas de função associadas aos botões PLAY e PAUSE do controle remoto (pelo menos não na versão 0.11.2), associaremos outras teclas para dar play e pausa. Assim, quando  o usuário pressionar o botão azul (F4 no Ginga VSTB), será dado pausa no vídeo, quando pressionar o botão verde (F2 no Ginga VSTB), o mesmo será resumido.

Para controlar a exibição das imagens de play e pause, quando o botão azul for pressionado, será dado pausa no vídeo, a imagem do botão pause será parada e a do botão play será iniciada. Quando for pressionado o botão verde, o vídeo será resumido, a imagem do botão play será parada e a do botão pause será iniciada.

Então, vamos definir os elos. O primeiro elo controlará a função de pausa, usando o código abaixo dentro da tag &lt;body&gt;:

<pre>
<code class="xml">

&lt;!--Quando a tecla azul for pressionada, pausa o vídeo,
inicia a imagem play e para a imagem pause--&gt;
&lt;link xconnector="onKeySelecionPauseStartStop"&gt;
	&lt;bind component="btnPause" role="onSelection"&gt;
		&lt;bindParam name="keyCode" value="BLUE"/&gt;
	&lt;/bind&gt;
	&lt;bind component="video" role="pause" /&gt;
     &lt;bind role="start" component="btnPlay" /&gt;
     &lt;bind role="stop" component="btnPause" /&gt;
&lt;/link&gt;
</code>
</pre>


Observando o código acima, para o papel onSelecion (usado na primeira tag &lt;bind&gt;), que define que uma tecla deve ser pressionada para executar a(s) ação(ões) definida(s) em seguida, é incluída uma sub-tag &lt;bindParam&gt;. Esta especifica qual tecla deve ser pressionada para acionar as ações de parar, iniciar e pausar determinadas mídias. Dentro dela, é incluído um atributo name, onde devemos especificar o nome do parâmetro definido dentro do conector utilizado pelo elo (neste caso, o conector onKeySelecionPauseStartStop). O atributo value define qual tecla deve ser pressionada para executar as ações definidas no conector. Nele foi especificada que a tecla azul (BLUE) deve ser pressionada para executar as ações.

Agora precisamos definir o outro elo, que controlará a função de resumir o vídeo. O mesmo é apresentado no código abaixo e tem a mesma estrutura do anterior, dispensando explicações:

<pre>
<code class="xml">

&lt;!--Quando pressionada a tecla verde, resume o vídeo,
inicia a imagem pause e para a imagem play--&gt;
&lt;link xconnector="onKeySelecionResumeStartStop"&gt;
	&lt;bind component="btnPlay" role="onSelection"&gt;
		&lt;bindParam name="keyCode" value="GREEN"/&gt;
	&lt;/bind&gt;
	&lt;bind component="video" role="resume" /&gt;
     &lt;bind role="start" component="btnPause" /&gt;
     &lt;bind role="stop"  component="btnPlay" /&gt;
&lt;/link&gt;
</code>
</pre>



## Conclusão


Pronto, aplicação finalizada. Agora é só rodar e fazer o teste, pausando o vídeo com o botão azul e resumindo com o botão verde.

O detalhe a ser observado, que pode fazer com que a aplicação não funcione como esperado, é que, caso façamos a verificação se uma determinada tecla foi pressionada no vídeo, e o mesmo estiver pausado, as ações associadas não serão executadas. Se observarmos a quarta linha do código do elo mostrado acima, podemos ver que é especificado que, quando uma tecla for pressionada na mídia btnPlay, as ações das linhas seguintes serão executadas, resumindo o vídeo que estava pausado. Se trocarmos esta condição por: quando uma tecla for pressionada na mídia video, as ações não serão executadas, pois o vídeo estará pausado e o pressionamento de teclas não é detectado em uma mídia neste estado.

Com isto, precisamos capturar o pressionamento da tecla verde (que resume o vídeo) na mída btnPlay, como foi feito, e não na mídia video.

Nem todos os vídeos que testei a função resume funcionou. Assim, se não funcionar com você, teste com outros vídeos, e com formatos diferentes.

Agora uma pergunta: É possível pausar o vídeo recebido da emissora, via broadcast?

Não sei, infelizmente não tenho como testar. Se alguém tiver como, avisa aí.
Mas mesmo sendo possível, qual seria a utilidade? A aplicação NCL continuaria o vídeo a partir do ponto que pausou, assim como fazem as TVs Time Machine da LG? Fica a dúvida no ar............

T+


## Licença


[](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)

[![](/files/by-nc-sa.png)](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]
