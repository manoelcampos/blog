---
author: admin
comments: true
layout: post
slug: converter-texto-acentuado-para-codigo-html-usando-php
title: Converter texto acentuado para código HTML usando PHP
wordpress_id: 592
categories:
- Internet
- Programação
- Software Livre
tags:
- Acentos
- Acentos HTML
- Acentuação
- Caracteres acentuados
- Código HTML
- Conversão
- Converter
- PHP
- Texto acentuado
---

[![](http://manoelcampos.com/wp-content/uploads/2-latin-accents-150x150.png)](http://manoelcampos.com/wp-content/uploads/2-latin-accents.png)Recentemente fui atualizar um sistema web que tenho e tive problemas com os caracteres acentuados. O sistema foi feito em PHP, e todo o texto que digitei nas páginas, por preguiça e falta de uma ferramenta mais apropriada, não utilizava a codificação HTML para caracteres acentuados (uma [tabela dos códigos HTML para os caracteres acentuados e especiais](http://www.lsi.usp.br/~help/html/iso.html) pode ser vista [nesse link](http://www.lsi.usp.br/~help/html/iso.html)).

Devido a isto, quando fui executar o sistema no Linux, que antes eu rodava em Windows, todos os caracteres acentuados apareceram incorretamente.  Definindo o charset como UTF8 na tag meta resolveu o problema, mas eu queria colocar todos os caracteres acentuados com seus devidos códigos HTML. Assim, para não ter que substituir todos esses caracteres, resolvi fazer um script php que resolvesse isso pra mim, onde eu colava o texto com acentos, e ele exibia o mesmo com os códigos HTML no lugar dos caracteres acentuados e especiais, trocando até mesmo quebras de linha (n) por <br/>.

Você pode acessar a página de [conversão de caracteres acentuados para código HTML aqui](http://acentoshtml.manoelcampos.com/). Lá você pode ver o código PHP usado para fazer a conversão e baixar o mesmo.
