---
author: admin
comments: true
layout: post
slug: clientes-instant-messaging-msn-e-yahoo-no-linux
title: 'Clientes de Instant Messaging: MSN e Yahoo no Linux'
wordpress_id: 69
categories:
- Internet
- Linux
- Software Livre
---

Bem, se você utiliza Linux e está procurando um cliente de Instant Messaging como MSN e Yahoo, uma alternativa é o [Pidgin](www.pidgin.im), que é um cliente multi protocolo, suportando várias redes como MSN e Yahoo, porém, não gosto da interface dele por possuir poucos recursos. Não desmerecendo o projeto, pois sei que é algo complicado de ser desenvolvido.

Se você deseja apenas um cliente para MSN, o melhor é o [aMSN](www.amsn-project.net/). Você pode baixá-lo por apt-get:
$ sudo apt-get install amsn

Você pode ter problemas ao tentar conectar e não conseguir. Normalmente isso vai ocorrer pois o sMSN por padrão (pelo menos as últimas versões) utiliza uma porta que normalmente é bloqueada dependendo da rede onde você estiver. Para resolver isso vá no menu Conta >> Preferências, clica na aba Ligação e marque a opção "Ligar usando método HTTP ("usa o protocolo HTTP na porta 80)".

O problema com o aMSN pra mim, é que quando você entrar aparecendo off line, cada mensagem que  envia ele pede confirmação antes de enviar. Pode até ser que tenha alguma opção de configuração para isso, mas não encontrei.

Outra opção é o [Kopete](http://kopete.kde.org/). Você também pode baixá-lo via apt-get:
$ sudo apt-get install kopete

Eu não cheguei a usá-lo muito, mas pelas pouquíssimas vezes que usei, vi que tem interface melhor que do Pidgin, mas ele não deixa enviar mensagens quando você estiver aparecendo off line. O [WebMessenger](http://webmessenger.msn.com/) do MSN também não.

Existe a opção do Yahoo Messenger para Linux. Você pode encontrar informações de como instalar [aqui](http://ubuntuforums.org/archive/index.php/t-81895.html). Mas pelo que vi, esta parece ser uma versão alternativa e está bastante obsoleta. Tentei instalar no Ubuntu 8.04 mas não funcionou. O Yahoo Messenger e o MSN Messenger oficiais, cada um suporta a rede do outro, assim, usando o Yahoo Messenger você pode conversar com contatos do MSN, e usando o MSN Messenger (a algum tempo chamado de Windows Live Messenger) você pode conversar com contatos do Yahoo. Os dois clientes oficiais são excelentes, mas em Windows.

Então, qual a alternativa no Linux. Bem, uma ótima alternativa que encontrei foi usar o [WebMessenger do Yahoo](http://webmessenger.yahoo.com/). Assim você pode conversar com contatos Yahoo e MSN, usando um cliente Web que funciona perfeitamete no Firefox, e permite que você envie mensagens mesmo estando aparecendo off line/invisível. A interface é bem legal e o acesso é muito mais rápido do que o WebMessenger do MSN. Sem falar que a interface utiliza Ajax, o que torna a aplicação bem mais rápida e atrativa. O problema é que você não tem recursos de voz no cliente Web. Assim, teria que recorrer mesmo a uma aplicação desktop. Mas pra vídeo e voz, sinceramente, nada se compara com o [Skype](www.skype.com) :).

Com apt-get não consegui instalar o Skype no Ubuntu, mas você pode baixá-lo um pacote deb no site oficial e instalar com:
$ sudo dpkg -i nome_do_pacote.deb
