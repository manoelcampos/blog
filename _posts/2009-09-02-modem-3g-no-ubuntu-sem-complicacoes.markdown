---
author: admin
comments: true
layout: post
slug: modem-3g-no-ubuntu-sem-complicacoes
title: Modem 3G no Ubuntu sem complicações
wordpress_id: 620
categories:
- Internet
- Linux
- Software Livre
tags:
- Brasil Telecom
- Claro
- ejectdisk.exe
- Linux
- Modem 3G
- Oi
- Tim
- Ubuntu
- ZTE MF622
---

[![](http://manoelcampos.com/wp-content/uploads/modem3g.png)](http://manoelcampos.com/wp-content/uploads/modem3g.png)Muitas pessoas que usam Linux e tem um modem 3g já devem ter passado por problemas para fazer este tipo de dispositivo funcionar.

Já escrevi uns 2 artigos aqui falando do assunto e mostrando alternativas para fazer o modem funcionar no Linux. Nas versões mais recentes do Ubuntu, como a 10.04, nenhuma configuração é necessária (a não ser a da escolha do provedor, feita por meio de um assistente). Se você não utiliza uma versão recente do Ubuntu, recomendo que atualize e tenha seus problemas com modem resolvidos, não precisando deste tutorial. Se não tem uma versão mais nova, continue lendo.




--more Leia Mais--


Infelizmente, no meu notebook, nenhuma das alternativas havia funcionado para nenhum dos modens que já tive (Huawei e266 e agora um ZTE MF622). Assim, estou disponibilizando este tutorial como uma alternativa a outros métodos existentes, que dispensa o uso de programas como o usb_modeswitch (que nunca funcionou comigo e já vi relatos de outros usuários que também não tiveram sucesso).

Graças ao lançamento do kernel 2.6.30, "seus problemas com modens 3g no linux acabaram-se"  (eu acho).
Esse novo kernel tem melhor suporte aos modens 3g. Desta forma, você não precisa mais usar aqueles programas para configurar seu modem e usar o tal do usb-modeswitch para desmontar a unidade de disco e montar o modem, nem ter que fazer configurações chatas e usar discadores como o gnome-ppp e wvdial, você poderá fazer a conexão usando o próprio Network Manager que é padrão no Ubuntu.

Estou utilizando Ubuntu 9.04 e conexão Brasil Telecom (Oi) com modem ZTE MF622.

Então, vamos lá. Para tudo funcionar você precisará antes instalar seu modem em um computador com Windows, pois com o discador instalado é incluído o programa ejectdisk.exe que desmonta a unidade de disco e faz o modem ser reconhecido no sistema. O programa ejectdisk.exe fica dentro da pasta de instalação do discador, dentro de Arquivos de Programas.
[Disponibilizei o programa neste link](http://manoelcampos.com/wp-content/uploads/2009/09/ejectdisk.tar.gz), porém, só testei esse com o modem ZTE MF622. Pode ser que cada modelo de modem tenha uma implementação diferente deste programa (ou até não tenha o mesmo). Mas já vi discadores dos programas que vem com modens da Tim e Brasil Telecom e eram o mesmo.

Agora que já tem o programa ejectdisk.exe, para executá-lo no Linux precisará do Wine, você pode baixar ele via apt-get com o comando abaixo:

    
    sudo apt-get install wine


Baixe o kernel 2.6.30, para Ubuntu, seguindo instruções [deste tutorial](http://www.vivaolinux.com.br/dica/Atualizando-o-kernel-no-Ubuntu-para-o-2.6.30).
Depois de instalar o kernel e reiniciar seu computador, conecte o modem. Ele deve ser automaticamente reconhecido como uma unidade de disco. Agora basta executar o programa ejectdisk.exe. Para que ele abra diretamente com o Wine ao dar dois cliques no arquivo, basta pressionar ALT+ENTER em cima do arquivo para abrir a janela de propriedades e selecionar o Wine na aba "Abrir Com" (Open With)

[![ejectdisk-properties](http://manoelcampos.com/wp-content/uploads/2009/09/ejectdisk-properties-300x229.png)](http://manoelcampos.com/wp-content/uploads/2009/09/ejectdisk-properties.png)

Quase instantaneamente o CD Rom será desmontado (você verá que o ícone do mesmo desaparecerá do Desktop) e alguns segundos depois (demora um pouco) o Network Manager reconhecerá o modem conectado e, caso você não não tenha criado nenhuma conexão 3G no mesmo, ele abrirá um assistente para configurar a conexão, que permite criar conexões para várias operadoras. Não existe Brasil Telecom na lista, mas você pode escolher a operadora Oi e tentar conectar, ou alterar depois as configurações. Para isto, você deve clicar com o botão direito no Network-Manager, na área de notificação no Painel do Gnome.

[![network-manager](http://manoelcampos.com/wp-content/uploads/2009/09/network-manager-300x49.png)](http://manoelcampos.com/wp-content/uploads/2009/09/network-manager.png)

Depois escolha "Editar Conexões" (Edit Connections). Na janela que abre, escolha a terceira aba, selecione a conexão criada e clique no botão Editar (Edit) para alterar as configurações.

[![mobile-broadband-nm](http://manoelcampos.com/wp-content/uploads/2009/09/mobile-broadband-nm-300x213.png)](http://manoelcampos.com/wp-content/uploads/2009/09/mobile-broadband-nm.png)

As configurações para Brasil Telecom são:

Número: ***99***1#**
APN: **brt.br**
Usuário: **brt**
Senha: **brt**

Porém, a conexão não funcionou usando todas essas configurações. Assim, insira apenas o número a ser discado e pronto. Nas configurações da conexão há uma opção "Conectar Automaticamente". Marque ela para, quando o modem for detectado, o Network Manager estabelecer a conexão automaticamente.

[![conexao-3g-nm](http://manoelcampos.com/wp-content/uploads/2009/09/conexao-3g-nm-227x299.png)](http://manoelcampos.com/wp-content/uploads/2009/09/conexao-3g-nm.png)

Após ter configurado tudo, da próxima vez que conectar o modem e que o ícone do CD Rom aparecer no desktop, basta executar o ejectdisk.exe e aguardar (caso você tenha configurado a conexão para ser estabelecida automaticamente). Após alguns segundos você pode ver uma janela de notificação, próxima ao Network Manager, indicando que a conexão não pode ser estabelecida. Normalmente, basta clicar com o botão esquerdo no NetworkManager e depois na conexão criada que funciona.

Outro problema que pode ocorrer é de o modem não ser detectado depois da execução do ejectdisk.exe. Se isto ocorrer, basta remover o modem da USB e conectar novamente que normalmente funciona sem problemas.

Bem, espero que o tutorial seja útil pra muitos, pois penso ser muito mais cômodo do que outros procedimentos já relatados pela comunidade.

Veja o comentário do Luiz, logo abaixo, que é um complemento para este artigo, e mostra como usar o programa eject do próprio Linux. O comentário mostra também como fazer com que o CD-Rom, montado pelo modem, seja desmontado automaticamente e que o modem seja então reconhecido no sistema.
