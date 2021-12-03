---
author: admin
comments: true
layout: post
slug: carregando-bibliotecas-adicionais-no-scilab-o-matlab-opensource
title: Carregando bibliotecas adicionais no SciLab, o "MatLab" OpenSource
wordpress_id: 282
categories:
- Linux
- Software
- Software Livre
tags:
- Linux
- MatLab
- OpenCV
- Processamento de Imagens
- SciLab
- SIP ToolBox
- SIVP ToolBox
- Ubuntu
---

Já tinha citado no post [Ferramentas MatLab no Linux](http://manoelcampos.wordpress.com/2009/03/26/ferramentas-para-matlab-no-linux/), sobre o programa [SciLab](http://www.scilab.org/), uma ferramenta
OpenSource, semelhante ao MatLab, para operações com matriz, com versões para Linux, Mac e Windows.
Eu baixei a mesma via apt-get e estou usando para trabalhar com processamento de imagens. Porém, ao tentar usar algumas funções para essa finalidade, descobri que ele não vem com bibliotecas padrões para isso.
Desta forma, precisei procurar no Google, até que encontrei as bibliotecas [SIP ToolBox (SciLab Image Processing)](http://siptoolbox.sourceforge.net/) e [SIVP (SciLab Image and Video Processing) ToolBox](http://sivp.sourceforge.net/). A diferença do SIVP pro SIP é que o primeiro permite fazer processamento também em arquivos de vídeo. Encontrei essas bibliotecas também a partir da página [ToolBox Center do SciLab](http://www.scilab.org/contrib/index_contrib.php?page=download).

As duas ToolBox precisam da [biblioteca OpenCV](http://sourceforge.net/projects/opencvlibrary/). Tentei baixar o arquivo opencv-linux lá no site oficial, mas o mesmo não existia, então tive que procurar no google por opencv-linux1.1, que encontrei [nesse site](http://www.sfr-fresh.com/unix/privat/opencv-1.1pre1.tar.gz/).
Você precisará compilar o pacote e fazer todo o processo manual de instalação, assim, abra um terminal na pasta onde baixar o arquivo e digite os comandos abaixo:
    
## Descompactar o arquivo
`tar -zxvf opencv-1.1pre1.tar.gz`

## Configurar o OpenCV para compilação

Para configurar o OpenCV digite:

`./configure --enable-apps --with-ffmpeg --with-gnu-ld --with-x --without-quicktime CXXFLAGS=-fno-strict-aliasing`

Os parâmetros passados para o configure são:

* --enable-apps - compilar aplicações de exemplo
* --with-ffmpeg - habilitar suporte para manipulação de vídeos com a biblioteca ffmpeg, como explicado antes
* --without-quicktime - não usar bibliotecas do QuickTime, acredito que só seja é necessário se você não tiver o QuickTime

Para ajudar digite ./configure --help


Agora é só compilar e instalar:

```
make
sudo make install
```

Os parâmetros de instalação retirei [desse site](http://dircweb.king.ac.uk/reason/opencv_cvs.php). Mas lá são informados mais passos que não foram necessários para mim.

A biblioteca SIVP tem disponível no Sypnatic do Ubuntu 8.10, mas ocorre um erro na instalação que não consegui resolver.
E pra priorar, nem deixou remover e causau um problemão, pois toda vez que tentava baixar um programa via apt-get, ele dava erro tentando terminar a instalação do SIPV. Tentei fazer o download a partir do [SourceForge](http://sivp.sourceforge.net/), mas o arquivo para a versão 0.5 não existia. Encontrei em um site, que não lembro mais, os fontes dessa versão, mas ao tentar compilar, ocorria também um erro. [No repositório LauchPad tem a versão 0.5 para Ubuntu 9.04](https://launchpad.net/ubuntu/jaunty/i386/sivp/0.5.0-1ubuntu1), mas funcionou no 8.10 sem problemas. Existem alguns pré-requisitos que são listados na página e que existem pacotes deb deles também, mas no meu caso, todos já estavam instalados no meu sistema. Se você desejar trabalhar com vídeo, precisará instalar antes a [biblioteca ffmpeg](http://ffmpeg.sourceforge.net/), para manipulação desse tipo de arquivo. Você pode baixá-la via apt-get.

No caso dessa versão 0.5.0 do SIVP, a biblioteca é instalada em /usr/lib/sivp-0.5.0. Para carregar bibliotecas externas no SciLab você precisar carregar um arquivo .sce, normalmente de nome loader.sce. Para a biblioteca SIVP, você deve digitar o comando load no SciLab, seguido do nome do arquivo .sce a ser carregarado. Assim, digite exec("/usr/lib/sivp-0.5.0/loader.sce") que as funções estarão prontas para uso. Você encontra documentação das funções da biblioteca em [http://sivp.sourceforge.net/doc.php](http://sivp.sourceforge.net/doc.php).

O [SIP](http://siptoolbox.sourceforge.net/), a outra biblioteca para processamento de imagens, na versão atual 0.4, não compila no SciLab 5.1, a versão atual, e não há um pacote deb para ela. Encontrei um [pacote deb para a versão 0.3.99rc2 no repositório do Ubuntu](http://packages.ubuntu.com/dapper/siptoolbox), não tão menor que a versão 0.4 disponibilizada no site oficial. Já tendo instalado o OpenCV, como mostrado anteriormente, todos os outros pré-requisitos são encontrados na página para download do pacote deb do SIP, mostrada logo acima.

Esta versão é instalada no diretório /usr/lib/scilab/contrib/sip, diferente do diretório do SIVP. Assim, para carregar a biblioteca no SciLab, digite nele o comando exec("/usr/lib/scilab/contrib/sip/loader.sce"). Você encontra documentação, inclusive em portugês, na [página inicial do site oficial](http://siptoolbox.sourceforge.net/). Encontrei um tutorial [nesse link](http://genie-optique.chez-alice.fr/SIP/A_SIP_UM/pre-doc.pdf).

Testei a biblioteca SIP e fiz algumas brincadeiras iniciais. O mais legal é que as funções tem a mesma assinatura das do MatLab (nome e parâmetros são iguais), assim, fica fácil pegar exercícios propostos para MatLab e executar no SciLab facilmente.

Para carregar as bibliotecas dinamicamente, [veja esse outro post](http://manoelcampos.com.br/2009/04/08/instalando-bibliotecas-no-scilab-e-carregando-a-partir-do-menu-toolboxes/).

Para finalizar, todos sabem que essas ferramentas OpenSouce não são tão completas e poderosas quanto o MatLab. Elas tem suas deficiências. Uma análise comparativa entre o SciLab e o MatLab pode ser vista [aqui](http://jeofizik.comu.edu.tr/sayfalar/egitim/egitim/ders_notlari/jfm204/comparative-study-of-Matlab-and-Scilab.pdf).
