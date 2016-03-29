---
author: admin
comments: true
layout: post
slug: google-chrome-os-para-virtualbox
title: Google Chrome OS para VirtualBox
wordpress_id: 764
categories:
- Linux
- SO
- Software Livre
tags:
- Google Chrome OS
- Linux
- Ubuntu
- Virtual Machine
- VirtualBox
---

[![](http://manoelcampos.com/wp-content/uploads/chrome-os.jpg)](http://tremarinti.blogspot.com/2010/11/chrome-os-nao-chegara-este-ano-e-culpa.html)Para quem deseja testar o Google Chrome OS, sem alterar as configurações do seu computador, [neste link do Superdownloads você pode baixar uma imagem de disco rígido para o VMWare](http://superdownloads.uol.com.br/download/174/google-chrome-%2873373%29/), e criar uma máquina virtual para testar o novo sistema operacional do Google. O problema é que, para criar novas máquinas virtuais no VMWare, você precisa adquirir a versão completa do mesmo.


--more Leia Mais--




[![Google Chrome OS rodando no VirtualBox no Ubuntu](http://manoelcampos.com/wp-content/uploads/2010/01/google-chrome-os-no-virtualbox-1.png)](http://manoelcampos.com/wp-content/uploads/2010/01/google-chrome-os-no-virtualbox-1.png)

O arquivo disponibilizado no superdownloads é apenas o disco rígido da máquina virtual, e não todos os arquivos da máquina em si. O [VMWare Player](http://www.vmware.com/products/player/), que é gratuito, não permite criar novas máquinas virtuais, apenas executar máquinas criadas pela versão completa do VMWare. Desta forma, baixei o arquivo vmdk do disco rígido para VMWare, disponibilizado no superdownloads, e converti para o formato vdi do [VirtualBox](http://www.virtualbox.org), que é OpenSource e permite criar novas máquinas virtuais.


## Download


O arquivo vdi (formato de disco rígido do VirtualBox) está compactado em formato 7zip e pode ser baixado em [http://www.4shared.com/archive/e0P_VI0w/chrome-os-04228-gdgtvdi.html](http://www.4shared.com/archive/e0P_VI0w/chrome-os-04228-gdgtvdi.html).

Para instalar o suporte para abrir arquivos 7zip no Ubuntu, por exemplo, pode-se baixar o pacote p7zip via apt-get com o comando abaixo:

sudo apt-get install p7zip

[No Windows, basta baixar o programa aqui](http://www.7-zip.org/).

A criação da máquina virtual no VirtualBox está fora do escopo deste artigo, por ser algo bem simples e intuitivo de ser feito, e existirem diversos tutoriais na web.

Após criar a máquina virtual e dar boot na mesma, o login e senha são os da sua conta do Google.


## Como converter um disco vmdk para vdi


Para quem deseja saber como foi feita a conversão do formato vmdk do VMWare para o formato vdi do VirtualBox, no Ubvuntu, seguem informações.

Baixe o qemu via apt-get com o comando abaixo:

sudo apt-get install qemu

**Para quem possui VirtualBox 2.x**

qemu-img convert vmware-hd.vmdk temp.bin
vboxmanage convertdd temp.bin vbox-hd.vdi

**Para quem possui VirtualBox 3.x**

qemu-img convert vmware-hd.vmdk temp.bin
VBoxManage convertdd temp.bin vbox-hd.vdi

[A versão atual para Windows do VirtualBox permite importar uma imagem de disco do VMWare](http://itknowledgeexchange.techtarget.com/server-virtualization/importing-vmdk-disk-files-into-sun-xvm-virtualbox/), assim, não é necessário fazer a conversão para o formato vdi.

Então é isso. Espero que seja útil. Quem desejar hospedar o arquivo disponibilizado, por favor, me envie o link para que eu informe para os leitores aqui. Desta forma, existirão várias servidores para download.

