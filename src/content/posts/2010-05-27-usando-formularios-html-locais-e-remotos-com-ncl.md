---
author: admin
comments: true
layout: post
slug: usando-formularios-html-locais-e-remotos-com-ncl
title: Usando formulários HTML locais e remotos com NCL
wordpress_id: 1488
categories:
- Dicas NCL e Lua
- TV Digital
tags:
- Formulário
- Formulário HTML
- Ginga-NCL
- HTML
- HTML Local
- HTML Remoto
- HTTP
- NCL
---

[![](http://manoelcampos.com/wp-content/uploads/html.png)](http://www.iconarchive.com/show/adobe-cs4-icons-by-deleket/File-Adobe-Dreamweaver-HTML-01-icon.html)Neste artigo vou mostrar como é simples utilizar um formulário HTML, local ou remoto, dentro de uma aplicação NCL para TV Digital.

## Pré-requisitos

Para acompanhar este artigo, é necessário conhecimento básico de HTML e NCL (como regiões, descritores, mídias e portas). Você pode utilizar o [Eclipse](http://www.eclipse.org/) com o plugin [NCLEclipse](http://www.laws.deinf.ufma.br/~ncleclipse/). Recomenda-se utilizar a última versão do [Ginga Virtual Set-top Box](http://www.gingancl.org/ferramentas.html).

Um [tutorial de como estruturar o ambiente de desenvolvimento](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl) está disponível [aqui](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl).

## Iniciando

Você pode criar um novo projeto no Eclipse, ou usar um projeto de aplicações NCL existente. Depois de selecionado o projeto desejado (ou criado um novo), crie uma página HTML, de nome form.html, com o código abaixo:

```html
<html>
<head>
<title>Formulário</title>
</head>
<body>
	<form id="frm" method="get">
		Nome: <input type="text" id="nome" name="nome" size="30" /><br/>
		Email: <input type="text" id="email" name="email" size="30" /><br/>
		<input type="submit" value="ok" name="Enviar"  />
	</form>
	<hr/>
	<p/>
	<a href="form2.html">Ir para página 2</a>
</body>
</html>
```

Esta página apenas contém um formulário HTML comum. Crie uma nova página de nome form2.html, e coloque o conteúdo que desejar, apenas para mostrar um link entre as duas páginas.
A figura a seguir mostra o formulário criado.

[caption id="attachment_1491" align="alignleft" width="300" caption="Página HTML, local ou remota, em aplicação NCL"][![](http://manoelcampos.com/wp-content/uploads/html-ncl-300x101.png)](http://manoelcampos.com/wp-content/uploads/html-ncl.png)[/caption]

## Criando o documento NCL

Agora crie um novo documento NCL usando File >> New >> Other >> NCL >> NCL Document, com o nome de main.ncl (ou o nome que desejar). Vamos definir a região e o descritor para exibição da página HTML na aplicação NCL. Assim, dentro da tag head, insira o trecho de código abaixo:

```xml
<regionBase>
	<region id="rgHtml" width="100%" height="100%" />
</regionBase>

<descriptorBase>
	<descriptor id="dHtml" region="rgHtml" focusIndex="ixHtml" />
</descriptorBase>
```

A única novidade aqui pode ser a propriedade focusIndex do descritor de nome dHtml. Esta propriedade é usada para definir o controle de foco à mídia que será associada a este descritor, no caso, a página HTML. No entanto, esta propriedade deve apontar para um elemento a ser definido, que chamamos de ixHtml (ix de index).

Para definir o controle de foco para uma determinada mídia, devemos incluir uma mídia do tipo application/x-ginga-settings. Esta mídia possui uma propriedade do tipo service.currentKeyMaster, que define o controle de foco para a mídia a ela associada. No nosso caso, definirá o controle de foco para a página HTML, permitindo que possamos digitar dados nos campos do formulário. Assim, insira o trecho de código a seguir, dentro da tag body:

```xml
<media id="nodeSettings" type="application/x-ginga-settings">
	<property name="service.currentKeyMaster" value="ixHtml" />
</media>
```

O valor do atributo value define o nome do elemento de controle de foco que foi associado ao descritor dHtml, que por sua vez será associado à página HTML a ser inserida a seguir.

## Adicionando a página HTML à aplicação NCL

Agora, vamos exibir a página HTML na aplicação. Para isto, insira o trecho de código a seguir, dentro da tag body:

```xml
<media id="html" src="form.html" descriptor="dHtml" type="text/html" />
```

Veja que a mídia, de nome html, aponta para o arquivo form.html, que deve estar no mesmo diretório do nosso documento NCL. A mesma está vinculada ao descritor dHtml, que por sua vez está vinculado ao controlador de foco ixHtml, que permitirá que possamos digitar dados nos campos do formulário HTML.

Infelizmente a aparência de páginas HTML em aplicações NCL, pelo menos no Ginga VSTB, é pouco, digamos, refinada. Acredito que seja pelo fato da implementação do Ginga VSTB usar o links como browser HTML, que é bem restrito. Alguns recursos de HTML e de JavaScript também não estão disponíveis no Ginga, como definido na norma ABNT NBR 15606-2, e alguns recursos definidos na norma podem não funcionar no Ginga VSTB.

Bem, agora precisamos apenas incluir uma porta para iniciar a mídia html e fazê-la ser exibida na tela, inserindo o código abaixo dentro da tag body:

```xml
<port id="pInicio" component="html"/>
```

## Conclusão

Bem, agora é só executar a aplicação NCL para ver o resultado. Você pode navegar entre os elementos da página usando as setas do controle remoto, ou o botão OK/Enter (também usado para acionar botões e links na página).

Se desejar acessar uma página remota, basta alterar o src da mídia para o endereço http da página, como por exemplo, [http://manoelcampos.com/form.html](http://manoelcampos.com/form.html).

Obviamente, uma página convencional, projetada para a Web, precisará ser adaptada para ser exibida na tela da TV, por questões de usabilidade como tamanho de fonte e cores. O ideal pode ser recriar a interface HTML utilizando apenas NCL e/ou Lua, e fazendo acesso a regras de negócio por meio de Web Services REST ou SOAP. Para este último tipo de Web Services, pode-se utilizar o projeto [NCLua SOAP](http://ncluasoap.manoelcampos.com) que disponibilizei [aqui](http://ncluasoap.manoelcampos.com). Lembre-se que, neste caso, é necessário acesso a internet a partir da TV/STB, onde atualmente, apenas uma minoria da população possui tal recurso, como pode ser visto na pesquisa [CETIC.br](http://cetic.br/usuarios/tic/index.htm).
