---
author: admin
comments: true
layout: post
slug: botoes-multimidia-dos-notebooks-hp-no-linux-ubuntu
title: Botões Multimídia dos Notebooks HP no Linux Ubuntu
wordpress_id: 91
categories:
- Computadores
- Linux
- Software Livre
---

Outros recursos bem legal dos notebooks HP, da série dv6000, como o meu [dv6345](http://h10025.www1.hp.com/ewfrf/wc/document?cc=us&docname=c00892729&dlc=en&lc=en&jumpid=reg_R1002_USEN), além do [controle remoto](http://manoelcampos.wordpress.com/2008/10/25/controle-remoto-de-notebooks-hp-pavilion-dv6000-series-no-linux-ubuntu/), são os botões de multimídia acima do teclado, que facilitam o controle de aplicações Media Players como o [Amarok](http://amarok.kde.org/), permitindo aumentar e reduzir o volume, avançar ou voltar uma trilha de aúdio/vídeo e outras funções relacionadas. O [Rhythmbox](http://www.gnome.org/projects/rhythmbox/), um player de música do Gnome, que já vem instalado com o Ubuntu, já habilita automaticamente as funções dos botões multimídia, porém, outras aplicações como o Amarok, que acho bem mais legal, não.

Primeiro o Amarok é para KDE, não vindo instalado por padrão no Ubuntu, qué usa Gnome por padrão.
Para baixá-lo via apt-get faça:

$ sudo apt-get install amarok

Após instalá-lo. Abra-o e acesso seu menu Tools >> Script Manager e depois clique no botão "Get More Scripts" e procure por "Gnome Multimedia Keys" e depois clique no botão Install para iniciar a instalação. Ao terminar feche esta janela. Na janela anterior, do lado esquerdo, em General, você verá o script instalado.  Selecione-o e clique no botão Run para iniciá-lo. Pronto, pode ser necessário fechar o Amarok e abrir novamente. Coloque alguns arquivos no playlist e utilize os botões multimídia do seu notebook HP para controlar o player.
