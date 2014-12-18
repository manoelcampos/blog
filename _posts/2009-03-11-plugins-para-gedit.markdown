---
author: admin
comments: true
layout: post
slug: plugins-para-gedit
title: Plugins para GEdit
wordpress_id: 190
categories:
- Linux
- Software Livre
tags:
- diretório instalação plugins gedit
- gedit
- gedit plugins
- plugins
- sessino save
- synaptic
- terminal
- Ubuntu
---

O GEdit permite a instalação de diversos plugins. Você pode baixar plugins a partir do site [http://live.gnome.org/Gedit/Plugins](http://live.gnome.org/Gedit/Plugins).

A instalação dos plugins deve ser feita dentro do diretório ~/.gnome2/gedit/plugins. Se o sub diretório plugins não existir, crie-o.
Os plugins normalmente vem em arquivos .tar.gz, que devem ser descompactados na raiz da pasta plugins, sem um subdiretório.

Após isso, basta fechar o GEdit e abrir novamente, entrar no menu Edit >> Preferences e habilitar o plugin na aba Plugins.

No Synaptic do Ubuntu, acessado pelo menu do Gnome System >> Administration >> Synaptic Package Manager,
você pode digitar gedit plugins e instalar o pacote que baixa e instala um pacote com vários plugins interessantes, principalmente para desenvolvedores, como um terminal embutido na parte inferior da janela, acessível depois de habilitar o plugin e ir no menu View >> Bottom Pane do GEdit. Outro plugin interessante instalado nesse pacote é o Session Saver, que salva a sessão com os documentos atualmente abertos, para, ao fechar e reabrir o GEdit, os últimos documentos serem automaticamente abertos.
