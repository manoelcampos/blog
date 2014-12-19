---
author: admin
comments: true
layout: post
slug: interrompendo-uma-aplicacao-ncl-por-meio-de-um-botao-do-controle-remoto
title: Interrompendo uma aplicação NCL por meio de um botão do controle remoto
wordpress_id: 1480
categories:
- Dicas NCL e Lua
- TV Digital
tags:
- Dicas
- Ginga-NCL
- Interromper Aplicação
- NCL
---

[caption id="attachment_1496" align="alignright" width="180" caption="Aplicação NCL com botão vermelho para interrompê-la"][![](http://manoelcampos.com/wp-content/uploads/stop-ncl-app-300x225.png)](http://manoelcampos.com/wp-content/uploads/stop-ncl-app.png)[/caption]

[![](http://manoelcampos.com/wp-content/uploads/stop.png)](http://manoelcampos.com/wp-content/uploads/stop.png)Hoje estou iniciando uma nova seção no Blog, onde mostrarei algumas dicas de desenvolvimento de aplicações de TV Digital utilizando as linguagens NCL e Lua. Como vejo muitas dúvidas recorrentes nos fóruns que participo, resolvi registrar aqui estas dicas, de uma forma didática e em exemplos completos.

Nesta primeira dica, vou mostrar como incluir um botão para interromper uma aplicação NCL após o usuário/telespectador pressionar um botão no controle remoto. Isto é algo simples de ser feito e tem sido uma dúvida recorrente.


--more Leia Mais--


## Pré-requisitos


Para acompanhar este artigo, é necessário conhecimento básico de NCL, como contextos, mídias, conectores, elos e portas. Você pode utilizar o [Eclipse](http://www.eclipse.org/) com o plugin [NCLEclipse](http://www.laws.deinf.ufma.br/~ncleclipse/). Recomenda-se utilizar a última versão do [Ginga Virtual Set-top Box](http://www.gingancl.org/ferramentas.html).

Um [tutorial de como estruturar o ambiente de desenvolvimento](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl) está disponível [aqui](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl).


## Iniciando


Vamos criar uma aplicação que apenas exibe um vídeo em loop e um botão vermelho para indicar que, ao pressionar o respectivo botão no controle remoto, a aplicação será finalizada.

Então vamos lá. No Eclipse, crie um novo projeto usando File &gt;&gt; New &gt;&gt; Other &gt;&gt; General &gt;&gt; Project. Dê o nome de **stop_app** ao projeto.
Dentro dele crie um diretório media. Baixe [este arquivo](http://manoelcampos.com/wp-content/uploads/media.zip) e descompacte dentro deste diretório. O mesmo contém um vídeo (sob licença [Creative Commons](http://creativecommons.org/videos/wanna-work-together)) e uma imagem de um botão vermelho.

Agora crie um novo documento NCL usando File &gt;&gt; New &gt;&gt; Other &gt;&gt; NCL &gt;&gt; NCL Document.


## Criando as Regiões para exibição dos elementos da aplicação interativa


Na seção head, insira o código abaixo que definirá duas regiões: uma para o vídeo e outra para a imagem do botão vermelho.

<pre>
<code class="xml">

&lt;regionBase&gt;
  &lt;region id="rgVideo" width="100%" height="100%" zIndex="0"/&gt;
  &lt;region id="rgBotao" top="10" left="10" width="48" height="48" zIndex="1"/&gt;
&lt;/regionBase&gt;
</code>
</pre>



O vídeo ocupará toda a tela. A image do botão ficará no topo esquerdo e sobre o vídeo (zIndex = "1").




## Definindo os descritores para as mídias


Os descritores definem a aparência das mídias a serem inseridas no documento. Mesmo não definindo nenhuma característica, cada mídia deve estar associada a um descritor, sendo possível a reutilização de um descritor em diferentes mídias. Assim, dentro da tag head, insira o trecho de código abaixo, que define os descritores, vinculando os mesmos às suas respectivas regiões.

<pre>
<code class="xml">

&lt;descriptorBase&gt;
  &lt;descriptor id="dVideo" region="rgVideo" /&gt;
  &lt;descriptor id="dBotao" region="rgBotao" /&gt;
&lt;/descriptorBase&gt;
</code>
</pre>



## Inserindo as mídias


Dentro da tag body, vamos incluir as mídias para exibir o vídeo e a imagem do botão vermelho. Assim, insira o trecho de código abaixo:

<pre>
<code class="xml">

&lt;media id="video" src="media/video.avi" descriptor="dVideo"/&gt;
&lt;media id="botao" src="media/red.png" descriptor="dBotao"/&gt;
</code>
</pre>


Agora, para iniciar o vídeo quando a aplicação for iniciada, vamos adicionar uma porta, dentro da tag body:

<pre>
<code class="xml">

 &lt;port id="pInicio" component="video"/&gt;
</code>
</pre>



## Conectores e Elos


Para exibir o botão, vamos inserir um elo (link) que indicará que o botão deve ser iniciado quando o vídeo iniciar. Antes disto, precisaremos incluir os conectores que definem o comportamento dos elos. Como você já deve saber, é possível usar um arquivo pronto de conectados. Por meio do menu File &gt;&gt; New &gt;&gt; Other &gt;&gt; NCL do Eclipse é possível criar um arquivo com os conectores mais utilizados, já prontinho, sem precisar digitar uma linha de código. Mas aqui, para exercitar, vamos criar os conectores que precisamos manualmente. Como são poucos, vamos criar dentro do documento NCL principal mesmo.

Assim, dentro da tag head, adicione uma tag &lt;connectorBase&gt;&lt;/connectorBase&gt;. Dentro dela, vamos inserir os conectores a seguir:

<pre>
<code class="xml">

   &lt;!-- @doc Quando iniciar uma mídia (onBegin), inicia outra (start) --&gt;
   &lt;causalConnector id="onBeginStart"&gt;
      &lt;simpleCondition role="onBegin"/&gt;
      &lt;simpleAction role="start"/&gt;
   &lt;/causalConnector&gt;

   &lt;!-- @doc Quando for pressionada uma tecla (onSelection),
   aborta uma mídia (abort) --&gt;
   &lt;causalConnector id="onKeySelectionAbort"&gt;
   	  &lt;connectorParam name="keyParam"/&gt;

      &lt;simpleCondition role="onSelection" key="$keyParam"/&gt;
      &lt;simpleAction role="abort"/&gt;
   &lt;/causalConnector&gt;

   &lt;!-- @doc Quando uma mídia terminar (onEnd),
   inicia outra (start) --&gt;
   &lt;causalConnector id="onEndStart"&gt;
      &lt;simpleCondition role="onEnd"/&gt;
      &lt;simpleAction role="start"/&gt;
   &lt;/causalConnector&gt;
</code>
</pre>



Observe que, no caso do segundo conector (onKeySelectionAbort), é definido um parâmetro (connectorParam) de nome keyParam, que será usado no elo para especificar qual tecla disparará a ação (simpleAction) definida no conector. A condição (simpleCondition) para disparo da ação é o pressionamento de uma tecla (onSelection). A tecla que disparará a ação não é pré-definida, desta forma, o elo a ser adicionado para usar o conector é que especificará a tecla. Assim, usa-se o parâmetro keyParam criado como valor para o atributo key a tag simpleCondition. Note o uso do $, que define que não está sendo especificado o código de uma tecla específica, e sim um parâmetro, funcionando como uma variável.




Agora que criamos os conectores, vamos inserir os links. Estes associam mídias aos papéis definidos pelos conectores, especificando o comportamento das mídias quando ocorrerem os eventos definidos pelos papéis.




O primeiro link que incluiremos será para iniciar a imagem do botão vermelho quando o vídeo iniciar, usando o conector onBeginStart, criado anteriormente. Os links devem ser incluídos dentro da tag body. Assim, insira o trecho de código abaixo:


<pre>
<code class="xml">

&lt;!-- Quando o vídeo iniciar, inicia o botão --&gt;
&lt;link xconnector="onBeginStart"&gt;
   &lt;bind role="onBegin" component="video" /&gt;
   &lt;bind role="start" component="botao" /&gt;
&lt;/link&gt;
</code>
</pre>



Para permitir que o vídeo fique em loop, insira o link abaixo, que usa o conector onEndStart. Com ele, quando o vídeo terminar, o mesmo é reiniciado.


<pre>
<code class="xml">

&lt;!-- Quando o vídeo terminar, reinicia o mesmo, deixando
ele em loop, até ser a app ser abortado com o pressionamento
do botão vermelho (ver link a seguir) --&gt;
&lt;link xconnector="onEndStart"&gt;
   &lt;bind role="onEnd" component="video" /&gt;
   &lt;bind role="start" component="video" /&gt;
&lt;/link&gt;
</code>
</pre>



E pra finalizar, chegando ao resultado que queríamos (fechar a aplicação NCL ao pressionar o botão vermelho), vamos atribuir um id a tag body. A body é um contexto, que agrupa elementos como mídias e links. Quando definimos um id para a body, podemos controlá-la por meio de links. E aqui está todo o segredo para finalizar a aplicação NCL. Dentro da tag body, define o id como "corpo_ncl", conforme mostrado abaixo:


<pre>
<code class="xml">

 &lt;body id="corpo_ncl"&gt;
</code>
</pre>



Como criamos o conector onKeySelectionAbort, vamos definir um link que usa este conector. Assim, vamos definir que, ao pressionar o botão vermelho, o contexto principal (o body) será abortado, finalizando a aplicação NCL. Poderíamos ter usado no lugar do abort, um stop, no entanto, como o vídeo está em loop (quando finaliza é reiniciado), se dermos um stop no body, é dado um stop no vídeo, e o link criado para ele fará com que o mesmo seja reiniciado. Assim, neste caso, precisamos dar um abort no lugar do stop. Então, insira o link abaixo:


<pre>
<code class="xml">

&lt;!--Quando o botão vermelho for pressionado (F1 na GingaVM),
termina a app--&gt;
&lt;link xconnector="onKeySelectionAbort"&gt;
  &lt;bind role="onSelection" component="botao"&gt;
    &lt;bindParam name="keyParam" value="RED"/&gt;
  &lt;/bind&gt;
  &lt;bind role="abort" component="corpo_ncl" /&gt;
&lt;/link&gt;
</code>
</pre>



Note que é definido um parâmetro, com a adição da tag bindParam, para o papel onSelection. O atributo name da tag bindParam deve ser o nome do parâmetro definido no conector onSelectionAbort, usado pelo link. E veja que somente aqui é que definimos qual tecla (RED) disparará a ação abort, finalizando o contexto principal (body) de nome corpo_ncl, consequentemente finalizando a aplicação NCL.




## Conclusão


Como podem ver, para quem já conhece os conceitos básicos da NCL, a aplicação é bem simples, e muito do código mostrado pode ser inserido usando o auto-complete do eclipse. Assim, no final de tudo, o que o desenvolvedor realmente digita é pouca coisa.

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]
