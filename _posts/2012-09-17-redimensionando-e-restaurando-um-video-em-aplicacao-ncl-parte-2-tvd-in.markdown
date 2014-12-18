---
author: admin
comments: true
layout: post
slug: redimensionando-e-restaurando-um-video-em-aplicacao-ncl-parte-2-tvd-in
title: 'Redimensionando e restaurando um vídeo em aplicação #NCL - Parte 2. #TVD #in'
wordpress_id: 2673
categories:
- Dicas NCL e Lua
- TV Digital
tags:
- get
- Ginga
- GingaNCL
- NCL
- onBeginSet
- Redimensionar
- set
- Vídeo
---

[![](http://manoelcampos.com/wp-content/uploads/resize1.png)](http://manoelcampos.com/wp-content/uploads/resize1.png)No [artigo anterior](http://manoelcampos.com/2012/09/13/redimensionando-e-restaurando-um-video-em-aplicacao-ncl-parte-1-tvd-in/), mostrei como redimensionar um vídeo e restaurar seu tamanho original usando apenas NCL. Como foi mostrado lá, a forma como tal recurso foi implementado é um pouco estático. Se você reduzir um vídeo para 50%, para restaurá-lo para o tamanho original, precisará alterar suas dimensões para 200% (de acordo com a regra de 3 apresentada no artigo anterior). No entanto, se resolver colocar um percentual diferente para reduzir o vídeo, precisará recalcular o percentual utilizado para restaurar seu tamanho original e alterar o documento NCL inserindo os novos valores.

Vou mostrar neste artigo como tornar a restauração do vídeo dinâmica, usando novamente apenas NCL.<!-- more -->

Vamos usar a mesma lógica da [aplicação anterior](http://manoelcampos.com/2012/09/13/redimensionando-e-restaurando-um-video-em-aplicacao-ncl-parte-1-tvd-in/), contendo um vídeo que, após 5 segundos de iniciado, será redimensionado e apresentará uma imagem de um botão vermelho. Quando o usuário acionar o respectivo botão no controle remoto, o vídeo volta ao tamanho original. Desta forma, você pode utilizar o código da aplicação anterior como base. Utilizaremos os mesmos conectores, sem alterar, adicionar nem remover nenhum. O que mudará será nos links.

Bem, a lógica para tornar a restauração do vídeo dinâmica será a seguinte: quando o vídeo iniciar, vamos obter suas dimensões e guardá-las em uma variável. Após o vídeo ser redimensionado, quando o usuário acionar o botão vermelho para restaurar o vídeo, as dimensões serão obtidas desta variável e setadas para a propriedade bounds do vídeo.

Para isto, vamos inserir uma nova mídia do tipo "application/x-ginga-settings", que, segundo a norma ABNT NBR 15606-2:


<blockquote>suas propriedades são variáveis globais definidas pelo autor do documento ou variáveis de ambiente reservadas, que podem ser manipuladas pelo processamento do documento NCL.</blockquote>


Desta forma, vamos criar uma variável chamada bounds, em uma mídia deste tipo, para poder guardar as dimensões originais do vídeo. Assim, declare a mídia como mostrado a seguir:

[xml]
<media id="settings" type="application/x-ginga-settings">
  <property name="bounds" />
</media>
[/xml]

Agora, precisaremos incluir um novo link onBeginSet para, quando o vídeo iniciar, guardar o valor da sua propriedade bounds na propriedade bounds da mídia settings (adicionada anteriormente). Com isto, quando desejarmos restaurar o vídeo, podemos pegar suas dimensões originais na propriedade bounds da mídia settings. Segue o código do link:

[xml]
<link xconnector="onBeginSet">
  <bind role="onBegin" component="video" />
  <bind role="get" component="video" interface="bounds"/>
  <bind role="set" component="settings" interface="bounds">
    <bindParam name="var" value="$get"/>
  </bind>
</link>
[/xml]

Note que estamos utilizando um papel "get" (no atributo role da tag bind) que não foi declarado no conector (já existente na aplicação anterior). O papel get é implicito em conectores que tenham o papel set.

A linha <bind role="get" component="video" interface="bounds"/> utiliza o papel get para obter o valor da propriedade bounds do vídeo. Tal valor é armazenado em uma variável com o mesmo nome do papel (variável $get). Na tag bind seguinte, o valor desta variável é obtido e atribuído à propriedade bounds da mídia settings.

Na verdade, para conectores que possuem o papel set, este papel que permite obter o valor de uma propriedade pode ter qualquer nome, por exemplo, "ler". O nome do papel é que vai definir o nome da variável que armazenará o valor lido.

Com o uso dos papéis get e set, podemos obter o valor de uma propriedade de uma mídia e atribuir tal valor a outra propriedade de qualquer mídia. Esta atribuição não é direta, como podem ver no código. A variável $get é utilizada como uma variável intermediária. Logo, tal link poderia ser representado, de forma procedural, utilizando o seguinte pseudo-código:

[php]
$get = video.bounds;
 settings.bounds = $get;
[/php]

Bem, pra finalizar, falta permitirmos que o vídeo volte ao tamanho original quando o usuário pressionar o botão vermelho (o link onBeginSet para reduzir o vídeo já existia na aplicação anterior). Para isto, precisaremos alterar o link onKeySelectionStopSet para o código seguinte:

[xml]
<link xconnector="onKeySelectionStopSet">
  <bind role="onSelection" component="botao">
    <bindParam name="key" value="RED"/>
  </bind>
  <bind role="get" component="settings" interface="bounds"/>
  <bind role="set" component="video" interface="bounds">
    <bindParam name="var" value="$get"/>
  </bind>
  <bind role="stop" component="botao" />
</link>
[/xml]

Tal link utiliza a mesma lógica do anterior: utiliza os papéis get e set para pegar o valor da propriedade bounds da mídia settings (contendo as dimensões originais do vídeo) e atribuir de volta à propriedade bounds do vídeo.

Então é isso. Finalizamos as 2 partes do artigo, deixando dinâmico a restauração das dimensões do vídeo usando apenas NCL.
No link a seguir você pode baixar o código completo da aplicação. Até o próximo.

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]
