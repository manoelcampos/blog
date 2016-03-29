---
author: admin
comments: true
layout: post
slug: virtualbox-vm-gingancl-0112-openginga-beta-1
title: 'VirtualBox VM: GingaNCL 0.11.2 + OpenGinga Beta 1'
wordpress_id: 795
categories:
- Software Livre
- TV Digital
tags:
- Ginga
- GingaNCL
- OpenGinga
- Virtual Machine
- Virtual Set-top Box
- VirtualBox
- VM
---

Estou disponibilizando uma máquina virtual para VirtualBox, que possui tanto a última versão do GingaNCL (0.11.2 rev 23) quanto a versão beta 1 do OpenGinga ([devido não ter sido recomendado o uso da Beta 2](http://groups.google.com/group/gingajava/msg/ce98290954158185)).





Recomendo a utilização da última versão do VirtualBox, a 3.1.2. 


--more Leia Mais--


O arquivo disponibilizado é apenas a imagem do HD da máquina virtual. Assim, é necessário criar a máquina. Para isto, use os comandos abaixo em um terminal (testados apenas em Linux). Leia os comentários, pois em uma das linhas é necessário informar o caminho onde descompactou o arquivo vdi baixado.





[Se preferir, pode baixar um script com os comandos aqui.](http://manoelcampos.com/wp-content/uploads/2010/01/createvboxvm.sh) Depois de alterá-lo, informando o caminho do arquivo vdi, basta executar com sh createvboxvm.sh e pronto.




    
    #Fonte: http://www.linux-mag.com/id/7673
    
    #Cria uma VM de nome Ginga cujo SO será Ubuntu
    VBoxManage createvm --name Ginga --ostype Ubuntu -register
    
    #Define 384MB de RAM e 32MB de vídeo, com servidor de áudio pulse e driver ac97
    #habilita suporte a USB e USB2.0
    #habilita suporte a ACPI
    VBoxManage modifyvm Ginga --memory 384 --vram 32 --audio pulse --audiocontroller ac97 --usb on --usbehci on --acpi on
    
    #Só necessário se, ao dar boot na VM, reclamar de não ter suporte a PAE.
    #PAE: http://www.guiadohardware.net/termos/pae
    #VBoxManage modifyvm Ginga --pae on
    
    #Adiciona controlador IDE
    VBoxManage storagectl Ginga --name "IDE Controller" --add ide --controller PIIX4
    
    #Define ordem de boot (tenta boot apenas pelo HD da VM)
    VBoxManage modifyvm Ginga --boot1 disk --boot2 none --boot3 none --boot4 none
    
    #Anexa a imagem do disco à VM. Mude /path pelo caminho onde você salvou o arquivo Ginga.vdi
    VBoxManage storageattach Ginga --storagectl "IDE Controller" --port 0 --device 0 --type hdd --medium /path/Ginga.vdi
    
    #Define a interface de rede eth0 como Bridge
    VBoxManage modifyvm Ginga --nic1 bridged --cableconnected1 on --bridgeadapter1 eth0
    
    #Inicia a VM
    VBoxManage startvm Ginga





A VM possui servidor SSH. Quando ele termina o boot, é mostrado o IP na tela inicial, antes do login. O usuário é root e a senha root. Para execução do Ginga-NCL, utilize:  

 /misc/launcher.sh /caminho/do/seu/arquivo.ncl  

 ou  

 ginga --ncl /caminho/do/seu/arquivo.ncl





No diretório /misc/ncl30 existem algumas aplicações NCLua de exemplo. O único problema é que não consegui habilitar o suporte do GingaNCL para vídeos em formato dvix e H.264. Aplicações como o Avidemux mostram o formato do vídeo. Assim, vídeos como os disponibilizados no ClubeNCL não rodarão. Mas basta usar outro. Os exemplos disponibilizados usam um vídeo em formato que funciona.





No caso do OpenGinga, o mesmo está instalado em /misc/openginga-beta. Para executá-lo faça:  

 cd /misc/openginga-beta/gingacc-beta  

 ./start





Para simular canais no OpenGinga, basta copiar vídeos para o diretório /misc/openginga-beta/gingacc-beta e renomeá-los como channel0, channel1, ... channeln





Aplicações de exemplo estão disponíveis em /misc/openginga-beta/gingacc-beta/xlets. Lá existea aplicação bbbxlet. Para fazer com que a aplicação inicie automaticamente após iniciar o OpenGinga, copie o arquivo  

 /misc/openginga-beta/gingacc-beta/xlets/bbbxlet/config.xml para /tmp. Sempre que reiniciar a máquina, precisará copiar o arquivo novamente, se quiser que a aplicação seja iniciada automaticamente com o OpenGinga.





## Downloads





[Máquina Virtual Link 1](http://manoelcampos.xpg.com.br/files/GingaNCL0.11.2-OpenGingaBeta1-VBox.vdi.7z)  

 [Máquina Virutal Link 2](http://www.megaupload.com/?d=PZ5WHSNP)





[Script Linux para criação da Máquina Virtual](http://manoelcampos.com/wp-content/uploads/2010/01/createvboxvm.sh)





O arquivo está compactado em formato 7zip e pode ser baixado. Para instalar o suporte para abrir arquivos 7zip no Ubuntu, por exemplo, pode-se baixar o pacote p7zip via apt-get com o comando abaixo:





sudo apt-get install p7zip





[No Windows, basta baixar o programa aqui](http://www.7-zip.org/).





Se desejarem hospedar a máquina virtual disponibilizada, por favor, me repasse o link para eu adicionar aqui.
