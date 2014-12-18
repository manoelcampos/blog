---
author: admin
comments: true
layout: post
slug: controle-remoto-de-notebooks-hp-pavilion-dv6000-series-no-linux-ubuntu
title: Controle Remoto de Notebooks HP Pavilion dv6000 Series no Linux Ubuntu
wordpress_id: 89
categories:
- Computadores
- Linux
- Software Livre
---

O notebook [HP Pavilion dv6345](http://h10025.www1.hp.com/ewfrf/wc/document?cc=us&docname=c00892729&dlc=en&lc=en&jumpid=reg_R1002_USEN) e outros modelos da série Pavilion dv6000 vem com controle remoto para operar aplicações multimídia e controle de apresentações. Porém, no caso do meu dv6345, que veio com Windows Vista, o controle remoto só funcionava neste SO. Depois que desisti do Vista e instalei novamente o Windows XP, o controle não funcionou mais. Liguei no suporte da HP e informaram que não funcionaria no XP. Bem, mas vc deve estar se perguntando: O título do post trata de Linux não? Pois é, depois que instalei o Ubuntu e descobri o porquê do grande sucesso dele (a facilidade que ele dá em tudo, como instalação de impressoras, scanners e outros dispositivos, e várias facilidades para o usuário comum que em outras distribuições não há), resolvi pesquisar pra ver se tinha um software para fazer o controle funcionar no Linux. Então em pouco tempo encontrei a solução, o [Linux Infra-Red Remote Control - LIRC](http://www.lirc.org/).

Bem, então vamos à instalação. Estou usando Ubuntu 8.04.
Para baixar o LIRC via apt-get faça:
$ sudo apt-get install lirc

Durante a instalação serão solicitadas algumas informações de configuração.
A primeira informação a ser fornecida é o tipo do controle remoto. No caso desses da HP você deve informar "**Windows Media Center Remotes ( new version Philips et al. )**". Acredito que esta opção deve ser selecionada pois o controle remoto da HP é específico para o Windows Media Center, tem até a bandeira do Windows nele.
Na segunda tela informe **None**.

Depois da instalação finalizar, o daemon do LIRC deve ser iniciado automaticamente. Se não, digite:
$ sudo /etc/init.d/lirc start

Para testar o controle remoto digite:
$ irw

Agora, ao pressionar um botão no controle remoto você deverá ver no terminal a saída, indicando o botão pressionado.

Se o seu controle remoto estava parado a um bom tempo, pois você já tinha perdido as esperanças de fazê-lo funcionar, é possível que o mesmo esteja com a bateria descarregada, o que foi o meu caso. Mas mesmo com o controle de outro modelo de notebook HP, deve funcionar sem problemas, como funcionou pra mim.

O controle remoto é muito útil no Windows para você controlar suas mídias como áudio, vídeo e fotos, permitindo abrir o Windows Media Center ou o DVD a partir do controle. No Linux você tem uma aplicação de Media Center que é o [Elisa](http://elisa.fluendo.com/), que permite usar o controle remoto. Para instalá-la execute:
$ sudo apt-get install elisa

A aplicação é bem legal, porém, ela só deixa você abrir as mídias que estão nos diretórios específicos no home do seu usuário, como Pictures, Videos e Music, pelo menos não conseguir abrir outro diretório. Como, no meu caso, estes diretórios estão em outra partição, o que fiz foi apagá-los do meu home, pois lá estavam vazios, e criar links simbólicos para os diretórios na outra partição, por exemplo, executando os comandos abaixo:

$ cd ~
$ ln -s /media/Dados/Filmes

Com este comando é criado um link simbólico para o diretório Filmes, dentro do meu home. Você pode depois renomear o link depois para Videos, que é o nome padrão adotado pelo Ubuntu (como o meu está em Inglês, é sem acento)
Você pode precisar configurar o controle remoto para funcionar com o Elisa, mas eu não cheguei a fazer isso. Você pode encontrar mais informações neste blog [aqui](http://sidrit.wordpress.com/2008/08/09/configuring-windows-media-center-remote-control-for-elisa-on-ubuntu-804/), o qual usei como referência para este post.

O melhor de tudo, é que existe um projeto LIRC para para Windows, o [WinLIRC](http://winlirc.sourceforge.net/), assim, quem tinha o Windows Vista e instalou o XP e o controle remoto não funcionou mais, pois não tem driver da HP para o XP, com o WinLIRC pode funcionar, mas não é garantido, devido o Windows ser um SO fechado, como todos sabem, dificultando a implementação do software para suportá-lo.
