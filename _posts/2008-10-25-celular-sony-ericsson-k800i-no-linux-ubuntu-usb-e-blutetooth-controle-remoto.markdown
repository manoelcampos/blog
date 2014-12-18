---
author: admin
comments: true
layout: post
slug: celular-sony-ericsson-k800i-no-linux-ubuntu-usb-e-blutetooth-controle-remoto
title: Celular Sony Ericsson K800i no Linux Ubuntu - USB e Blutetooth + Controle Remoto
wordpress_id: 95
categories:
- Linux
tags:
- Blutetooth
- Human Interface Device
- Linux
- Remote Control
- Sony Ericsson K800i
- Ubuntu
- USB
---

É, depois dessa, vi que no Linux tudo é possível. Nunca imaginei que meu celular [Sony Ericsson K800i](http://www.sonyericsson.com/cws/products/mobilephones/overview/k800i?cc=pt&lc=pt), que possui muitas funções legais como controle remoto para ser utilizado em aplicações de apresentação como Microsoft Office e Open Office, funcionaria no Linux.

Bem, vamos começar pelo básico. Você pode acessar o cartão de memória adicional e o interno do celular via Bluetooth. Se não me engano, no Ubuntu, os recursos de bluetooth já são instalados por padrão. Caso não esteja instalado, no terminal digite:

[bash]sudo apt-get install gnome-bluetooth bluez-utils bluez-gnome bluetooth[/bash]

**Existe um espaço entre as duas opções finais, o bluez-gnome e bluetooth. Devendo ser digitado tudo em uma mesma linha
**

Para iniciar o daemon bluetooth digite:
[bash]sudo /etc/init.d/bluetooth start[/bash]

No meu caso ele já está iniciando automaticamente no boot.
Após iniciar o daemon, aparecerá o ícone no System Tray do Gnome automaticamente. No meu caso, como meu Bluetooth é USB, não é onboard na placa-mãe, somente após conectá-lo na USB é que aparece o ícone.

Após o término da instalação clique no menu do Gnome em Sistemas >> Preferências >> Bluetooth e modifique as configurações caso deseje. Algumas abas só aparecerão se o já houver algum dispositivo blutetooh ligado. O ícone do Blutetooth deve aparecer no System Tray do Gnome.

Habilite o bluetooth no menu do celular, em Definições >> Conectividade >> Bluetooth, habilitando e deixando vísivel o celular. Agora clique com o botão direito no ícone do bluetooth no System Tray do Gnome e mande localizar dispositivos. A senha padrão dos dispositivos Bluetooth é 1234, que será solicitado pra você digitar no celular. Após ser exibido o dispositivo, clique em Conectar e será aberto um diretório automaticamente para você acessar os dados no seu celular.

No Ubuntu você pode usar a aplicação [gMobileMedia](http://gmobilebrowser.sourceforge.net/), que fica no menu Aplicações >> Acessórios do Gnome para acessar os dados no celular a partir da USB, mas usando o outro método é mais prático. Para testar, conecte o celular na USB, abra a aplicação e clique no botão Preferências. No campo porta você deve informar qual a porta para acesso o dispositivo, no caso, o Celular. Não lembro como descobri qual era a porta, mas basta ir escolhendo uma da lista e testar. A que estou usando é /dev/ttyACM0.

Após clicar em OK, clique no botão Conectar na janela principal. Você poderia imaginar que deveria clicar em Atualizar antes, imaginando que apareceria o nome do celular na lista, mas não é. Eu cometi o mesmo erro. Após conectar, o nome do celular é mostrado e você pode acessar os arquivos na memória interna ou no cartão de memória dele.

Você pode também acessar os arquivos no K800i, a partir da USB, sem precisar usar o gMobileMedia, porém, só quando o celular for conectado a USB no modo "Transferência de arquivos", opção que aparece no celular, após você conectá-lo via USB. No Modo Telefone, que permite que você receba e faça ligações, esta técnica não funciona, apenas as anteriores. As informações deste tutorial obtive em [neste link](http://www.linux.it/~malattia/wiki/index.php/Sony_Ericsson_K800i_and_Linux).
**Estes passos só são necessários para Ubuntu 8.04 ou anterior. No Ubuntu 8.10, a memória interna e o cartão de memória já são automaticamente reconhecidos quando você conecta o celular via USB e o coloca em modo "Transferência de arquivos"**. Bem, se você estiver usando uma versão do Ubuntu anterior a 8.10, então vamos lá. Você precisa criar uma regra para o [udev](http://en.wikipedia.org/wiki/Udev) (o deamon que detecta dispositivos plug and play, que substituiu o [hot plug](http://linux-hotplug.sourceforge.net/)). Estas regras devem ser criadas no diretório /etc/udev/rules.d/. O nome dos arquivos deve seguir um padrão, iniciando com um número que categoriza as regras. Veja o arquivo README no diretório para mais detalhes. Eu criei um arquivo chamado 60-sony-ericsson-k800i.rules, onde o 60 indica uma regra para adicionar links simbólicos para dispositivos.

Então, adicione o conteúdo abaixo no arquivo criado para permitir acessar a memória interna do celular:

[text]
# sony ericsson k800i phone
SUBSYSTEMS=="usb", ATTRS{manufacturer}=="Sony Ericsson", ATTRS{idVendor}=="0fce" \
ATTRS{idProduct}=="e039", KERNEL=="sd*", SYMLINK+="sonye%n", GROUP="users"
[/text]

A opção GROUP="users" é pra definir que os usuários do grupo users poderão montar o dispositivo.

Para acessar o SD Card do celular adicione o conteúdo a seguir no arquivo criado:

[text]
#k800i sd card
SUBSYSTEMS=="usb", ATTRS{manufacturer}=="Sony Ericsson" \
ATTRS{idVendor}=="0fce", ATTRS{idProduct}=="e039", ATTR{size}=="3995273" \
KERNEL=="sd*1", SYMLINK+="sonye-sd%n", GROUP="users" OPTIONS="last_rule"

SUBSYSTEMS=="usb", ATTRS{manufacturer}=="Sony Ericsson" \
ATTRS{idVendor}=="0fce", ATTRS{idProduct}=="e039" \
KERNEL=="sd*1", SYMLINK+="sonye-int%n", GROUP="users"
[/text]

O valor 3995273 na terceira linha indica a capacidade de memória do cartão. Este é o valor para um cartão de 2GB, o máximo suportado por este celular. Não sei qual ligação tem esse valor com os 2GB, não faz sentido pra mim. Se você usa um cartão de capacidade diferente, veja [este link](http://forums.gentoo.org/viewtopic-t-540515.html). Após alterar ou criar novos arquivos no diretório do udev, você deve reiniciá-lo com o comando a seguir:

[bash]sudo /etc/init.d/udev restart[/bash]

Depois disso, basta conectar o celular na USB, escolher nele o Modo de Transferência de Arquivos e pronto, será aberto um diretório para você navegar nos arquivos da memória interna e do cartão de memória do celular, além de serem adicionados ícones para eles no Desktop. Deve ser aberto automaticamente a aplicação [F-Spot](http://f-spot.org), para gerenciar as fotos no celular. Eu não gostei, ainda mais que ela dava uns erros ao abrir. Aí removi ela. Você pode fazer isso pelo menu Aplicações >> Adicionar/Remover  do Gnome, ou deve funcionar como sudo apt-get remove f-spot

E agora, o mais interessante: permitir usar os recursos de controle remoto do celular Sony Ericsson K800i no Linux, via Bluetooth. Estas informações obtive a partir [deste link também](http://www.linux.it/~malattia/wiki/index.php/Sony_Ericsson_K800i_and_Linux). Com este tutorial, você poderá usar estes recursos de controle remoto bluetooth do seu K800i. Logo, o bluetooth deve ser configurado e conectado como mostrei anteriormente.

Primeiro você precisa conectar no celular com este comando:
[bash]rfcomm connect 0 aa:bb:cc:dd:ee:ff[/bash]

onde aa:bb:cc:dd:ee:ff é o MAC do seu celular. Para descobrir qual é o do seu faça:

[bash]hcitool scan[/bash]

Após conectar com o comando rfcomm, o celular pedirá permissão de acesso e talvez a senha
(padrão é 1234). Conceda a permissão. Em seguida, o celular exibe a tela "Controle Remoto"
onde você pode escolher, por exemplo a opção Presenter, para controlar uma apresentação
do Open Office, escolher MediaPlayer para controlar um player que esteja rodando, ou Desktop
para usar o celular como mouse. Eu não testei o MediaPlayer, mas os outros recursos funcionaram
perfeitamente. Assim, você usa os botões do celular para controlar o computador
(os botões laterais também funcionam).

Este celular funciona como modem 3g e você pode usufruir deste recurso também.
Mas não testei isso. Você pode testar lendo o post original que citei, [neste link](http://www.linux.it/~malattia/wiki/index.php/Sony_Ericsson_K800i_and_Linux).

Testei o recurso Presenter e funcionou muito bem, mas se a bateria do celular tiver
com carga baixa, você vai precisar estar mais próximo do computador para conseguir controlar.
