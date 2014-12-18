---
author: admin
comments: true
layout: post
slug: internet-explorer-no-linux
title: Internet Explorer no Linux
wordpress_id: 93
categories:
- BD
- Computadores
- Internet
- Linux
- Programação
- SO
tags:
- IE View Firefox Plugin
- IEs4Linux
- Internet Explorer Linux
- Ubuntu
- Wine
---

**Introdução**

Bem, como eu abandonei o Windows praticamente de vez, utilizo ele apenas pra desenvolver em Delphi, e a partir de uma máquina virtual usando o [Virtual Box](http://www.virtualbox.org/), por isso estou postando muitas coisas sobre Linux.

Tá, mas tem coisas do Windows que você não tem como se livrar. Por exemplo, eu estou fazendo um curso de inglês online na [English Town](http://www.englishtown.com) (excelente, diga-se de passagem, melhor que qualquer curso presencial que já tenha feito) e o site só funciona no Internet Explorer. A seguir, mostrarei algumas alternativas para ter o Internet Explorer rodando no Linux.

**O Wine**

Ao instalar o [Wine](http://www.winehq.org/), que permite executar aplicações Windows a partir do Linux, ele já instala uma versão do Internet Explorer. Porém, essa versão não exibe os menus nem a barra de endereços. Você pode instalar o Wine via apt-get. Se estiver usando a versão 9.04 do Ubuntu, pode executar os comandos abaixo para baixar a versão mais atual:


    
    
    #Abrir o GEdit para adicionar uma nova fonte para download de pacotes
    sudo gedit /etc/apt/sources.list
    
    #Adicionar as linhas abaixo no arquivo, salvar e fechar o mesmo
    deb http://us.archive.ubuntu.com/ubuntu jaunty universe
    deb http://wine.budgetdedicated.com/apt jaunty main
    



Com o comando a seguir você instala o Wine:


    
    
    sudo apt-get install wine
    



O Internet Explorer é instalado em **~/.wine/drive_c/Program Files/Internet Explorer**
Para executá-lo você pode abrir o diretório acima. Lá terá um arquivo iexplore.exe. Você pode abrir as propriedades do arquivo (CTRL+ENTER) e marcar para que os arquivos .exe abram com o Wine. Talvez esteja configurado para ele abrir com o Archive Manager. Outra alternativa é, num terminal, digitar  wine "c:/Program Files/Internet Explorer/iexplore.exe"

Como não terá barra de endereços para você digitar o site para onde deseja ir, você pode fazer isso via linha de comando, num terminal, digitando, por exemplo, **wine "c:/Program Files/Internet Explorer/iexplore.exe" www.google.com**
para abrir o google.

**IEs4Linux**

Outra alternativa é o projeto [IEs4Linux](http://www.tatanka.com.br), que está no plural não por acaso. Este projeto que usa o Wine e permite que você instale algumas versões do Internet Explorer que você desejar no seu linux, como o 5.5, 6 ou 7. Neste [link](http://www.tatanka.com.br/ies4linux/page/Installation) do site você encontra informações de como instalar. Existe uma [versão em português da página, podendo ser acessada neste link](http://www.tatanka.com.br/ies4linux/page/Pt/Instala%C3%A7%C3%A3o). Eu estou usando no Ubuntu e funciona muito bem. Estou tendo um pequeno incoveniente com flash, que fica piscando ininterruptamente, mas dá pra viver com isso, melhor que ter que iniciar o Windows somente para abrir um site que só funciona no IE[ca!!!! :(  ]. Outra finalidade do IEs4Linux é permitir que WebDesigners que usam Linux, possam testar seus sites no Internet Explorer, sem ter o Windows Instalado, como fala no próprio site do projeto.

Para instalar o Ubuntu 9.04, os passos são os mesmos mostrados no [tutorial de instalação](http://www.tatanka.com.br/ies4linux/page/Installation), basta substituir a palavra edge por jaunty (o nome da versão 9.04 do Ubuntu). Nessa versão do Ubuntu, pelo menos comigo, a instalação do Flash Player dava erro e não deixava o setup prosseguir. Assim, na tela de instalação, tive que desmarcar a opção do Flash.

**Plugin IE View para Firefox**

Outra alternativa é instalar o [plugin IE View para o Firefox](https://addons.mozilla.org/en-US/firefox/addon/35). Ele é um plugin que adiciona uma opção, quando se clica com o botão direito na aba ou no conteúdo da página no Firefox.
[Nesta página há um tutorial explicando como configurar ele pra carregar o Internet Explorer do Wine no Linux](http://ieview.mozdev.org/ieview-linux.html). O único detalhe é que ele cita um diretório /usr/libexec que pode não existir no seu sistema (como não existia no meu). Assim, se for seguir o tutorial, apenas mude para o diretório /usr/lib. Porém, como o Internet Explorer do projeto IEs4Linux exibe os menus e a barra de endereços, mostrarei como configurar o plugin para abrir esta vesão e não o IE do Wine. Abaixo coloquei todos os passos necessários, a partir de um terminal:

1. Depois de ter instalado o IEs4Linux, a executável do IE pode ser encontrado no diretório ~/.ies4linux/bin. No meu caso, só consegui instalar no Ubuntu 9.04 o IE 5.0. Assim, no diretório ~/.ies4linux/bin tem um arquivo ie5. Então, crie um link para este arquivo, com o nome de iexplore, no diretório **/usr/bin**:

    
    
    sudo ln -s ~/.ies4linux/bin/ie5 /usr/bin/iexplore
    



2. Inclua o caminho para o link **/usr/bin/iexplore** nas configurações do IE View e pronto. Agora, quando abrir uma página no Firefox, clique com o botão direito na aba ou no conteúdo dela e mande abrir com o Internet Explorer.

**Pra terminar**

Infelizmente tenho outro problema com o curso do English Town, pois para as aulas ao vivo, você precisa de uma aplicação que cria uma sala virtual, muito boa também, mas não consegui fazé-la funcionar, nem cokm o [Wine](http://www.winehq.org/). A aplicação é o [Saba Centra](http://www.centra.com). Nas notícias do site, até prometeram uma versão para Linux, mas isto já tem uns anos e não fizeram foi nada. Ao assinar o English Town, você tem acesso ao download do software.
