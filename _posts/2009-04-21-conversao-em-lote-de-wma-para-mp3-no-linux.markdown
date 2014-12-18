---
author: admin
comments: true
layout: post
slug: conversao-em-lote-de-wma-para-mp3-no-linux
title: Conversão em lote de WMA para MP3 no Linux
wordpress_id: 380
categories:
- Linux
- Programação
- Software
- Software Livre
- Windows
tags:
- Batch conversion
- Conversão em lote
- Converter wma para mp3
- Lame
- Linux
- MPlayer
- Shell Script
- wma2mp3
- wma2mp3.sh
---

[![](http://manoelcampos.com/wp-content/uploads/wma.png)](http://manoelcampos.com/wp-content/uploads/wma.png)Você, assim como eu, detesta arquivos de música em formato WMA? Não que eles sejam problema para tocar, mas sim pelo fato de todas os programas que já usei, tanto no Windows quanto no Linux, que permitem editar as tags de arquivos de música, não trabalharem com WMA. Isso inclui players como [Rhythmbox](http://projects.gnome.org/rhythmbox/), padrão no [Ubuntu](http://www.ubuntu.com), e as ferramentas para edição de tags como o [EasyTag](http://easytag.sourceforge.net/) e [Audio Tag Tool](http://pwp.netcabo.pt/paol/tagtool/), estas duas disponíveis via apt-get.

Então, com [este script aqui](http://voidmain.is-a-geek.net/files/scripts/wma2mp3) (cujos autores se intitulam Calum e Void Main) que encontrei [nesse fórum](http://voidmain.is-a-geek.net/forums/viewtopic.php?t=407), você pode fazer conversão em lote de vários arquivos wma para mp3, bem facilmente. Você precisará do [MPlayer](http://www.mplayerhq.hu/) e do [Encoder Lame](http://lame.sourceforge.net/), os dois disponíveis via apt-get.

O script continha 2 erros e não funcionou, assim, tive que corrigir e você pode baixar a [versão corrigida neste link](http://manoelcampos.com/wp-content/uploads/2009/04/wma2mp3.sh).

Veja abaixo alguns exemplos de como usar o script.

    
    sh wma2mp3 arquivo.wma
    sh wma2mp3 arquivo1.wma arquivo2.wma arquivo3.wma
    sh wma2mp3 "meu arquivo 1.wma" "meu arquivo 2.wma" "meu arquivo 3.wma"
    sh wma2mp3 *.wma
    sh wma2mp3 /diretório/contendo/arquivos/wma
    sh wma2mp3 .


Os comandos principais, dentro do script, que realmente fazem a conversão, são apenas dois: um que usa o mplayer para converter o arquvio wma para wav e outro que usa o lame para converter de wav para mp3, como mostrado abaixo:

    
    mplayer -ao pcm:file="${1%%.[Ww][Mm][Aa]}.wav" "$1" &&
    lame -h -b 192 "${1%%.[Ww][Mm][Aa]}.wav" "${1%%.[Ww][Mm][Aa]}.mp3"


O arquivo wav é gerado com o mesmo nome do arquivo wma, substituindo-se as extensão wma (independente do case das letras) por wav. Em seguida, na conversão final, é gerado um arquivo mp3 com o mesmo nome do arquivo wma, substituindo-se a extensão wma por mp3. O arquivo wma permanece intacto.

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]
