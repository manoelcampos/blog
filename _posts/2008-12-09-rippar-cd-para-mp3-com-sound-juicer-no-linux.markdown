---
author: admin
comments: true
layout: post
slug: rippar-cd-para-mp3-com-sound-juicer-no-linux
title: Rippar CD para MP3 com Sound Juicer no Linux
wordpress_id: 127
categories:
- Linux
- Software
- Software Livre
tags:
- CD Rip
- Linux
- MP3
- Sound Juicer
- Ubuntu
---

O Sound Juicer é um aplicativo, que já vem instalado no Ubuntu, para ripar CDs de áudio. Porém, por questões legais, o mesmo não vem com suporte para rippar CDs para MP3, apenas para Ogg e outros formatos, que não rodarão na maioria dos aparelhos de som caseiros e automotivos.

Para habilitar o suporte para mp3, instale a biblioteca [lame](http://lame.sourceforge.net) via apt-get com o comando:
$ sudo apt-get install liblame0

Depois instale o plugin do lame para o [GStreamer](http://www.gstreamer.net), uma biblioteca usada para construção de componentes de gerenciamento de mídias como áudio e vídeo, utilizada pelo Sound Juicer:
$ sudo apt-get install gstreamer0.10-lame

Você pode verificar se existe uma versão mais recente executando o comando sudo apt-get install gstreamer* e vendo os resultados para escolher a versão mais atual para instalar, e depois digitar o comando novamente com a versão desejada.

Pronto, agora basta abrir o Sound Juicer (no terminal, digite sound-juicer &), ir no menu Edit >> Preferences, e no campo "Output format" escolher "CD Quality, MP3 (MP3 audio)"

Fonte: [http://ubuntuforums.org/archive/index.php/t-957.html](http://ubuntuforums.org/archive/index.php/t-957.html)
