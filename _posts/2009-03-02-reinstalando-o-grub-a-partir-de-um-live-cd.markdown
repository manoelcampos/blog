---
author: admin
comments: true
layout: post
slug: reinstalando-o-grub-a-partir-de-um-live-cd
title: Reinstalando o Grub a partir de um Live CD
wordpress_id: 174
categories:
- Linux
- SO
- Software Livre
tags:
- Grub
- Linux
- Live CD
- Reinstalar
---

Eu sempre utilizei sistemas Linux com o Lilo (Linux Loader) como gerenciador de boot. Depois que começei a usar o Ubuntu, que tem o grub como gerenciador de boot, não sabia como fazer para reinstalar o grub, necessário, por exemplo, quando se instala o Windows após ter instalado um Linux. Então, segue os passos abaixo a partir de um Live CD como o do Ubuntu:

1) Rode o live CD e deixe iniciar o sistema normalmente
2) Abra um terminal e execute os comandos a seguir
3) grub //para iniciar o aplicativo grub para configurar o gerenciador de boot
4) root (hd0,0) //indica que a imagem de boot está no hd 0 e na partição 0
5) setup (hd0) //instala o grub na mbr do hd 0
6) quit //sai do grub

Se desejar alterar as opcões de boot, basta alterar o
arquivo /boot/grub/menu.lst

Pronto, agora basta reiniciar o PC e o grub aparecerá na inicialização.

Referência: [http://raulpereira.wordpress.com/2006/05/12/tutorial-re-instalando-o-grub/](http://raulpereira.wordpress.com/2006/05/12/tutorial-re-instalando-o-grub/)
