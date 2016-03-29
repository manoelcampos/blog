---
author: admin
comments: true
layout: post
slug: juntando-pdf-no-linux
title: Juntando PDF no Linux
wordpress_id: 203
categories:
- Linux
- Software
- Software Livre
tags:
- Ghostscript
- Join PDF
- Juntar
- Linha de Comando
- Linux
- PDF
- Ubuntu
---

Você sabia que a [Biblioteca Virtual da USP](http://www.bibvirt.futuro.usp.br/) [disponibiliza arquivos PDF](http://www.bibvirt.futuro.usp.br/textos/telecurso_2000) do [Telecurso 2000](http://www.telecurso2000.org.br)?

Pois é, mas o que isso tem a ver com juntar PDF no linux? Bem, é que eu passando por lá para baixar o curso de matemática do ensino médio para dar uma revisada em muitos conceitos, descobri que para cada capítulo havia um PDF separado e eu gostaria de ter isso num PDF só. Então aí vai a dica. No terminal de uma distribuição linux como o Ubuntu, digite o comando abaixo:

gs -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=finished.pdf file1.pdf file2.pdf

Veja o significado de cada parâmetro informado:

    * gs -- Nome do programa a ser executado, o Ghostscript
    * -dBATCH -- Fechar o Ghostscript ao terminar o processo
    * -dNOPAUSE -- Não pausar o processo solicitando interação do usuário
    * -q -- Não mostrar nenhuma mensagem durante o processo
    * -sDEVICE=pdfwrite -- Usar o gerador de PDF do Ghostscript para realizar o processo
    * -sOutputFile=finished.pdf -- Nome do arquivo final com o conteúdo de todos os outros PDF's informados

Você pode usar caracteres curingas para juntar todos os PDF's de um diretório para um único arquivo, como
mostrado no comando abaixo:

gs -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=finished.pdf *.pdf

Se você não tiver o Ghostscript instalado, baixe-o por apt-get, executando os comandos abaixo no terminal:

apt-get install gs
apt-get install pdftk

Referências: [Decio Blog](http://decio.blogspot.com/2009/01/join-merge-pdf-files-in-linux.html) e  [Every Joe](http://www.everyjoe.com/newlinuxuser/merge-multiple-pdfs-into-one-file/).
