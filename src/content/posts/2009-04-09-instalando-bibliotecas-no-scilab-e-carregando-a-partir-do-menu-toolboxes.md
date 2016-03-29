---
author: admin
comments: true
layout: post
slug: instalando-bibliotecas-no-scilab-e-carregando-a-partir-do-menu-toolboxes
title: Instalando bibliotecas no SciLab e carregando a partir do menu ToolBoxes
wordpress_id: 300
categories:
- Linux
- Software
- Software Livre
tags:
- Carregamento automático ToolBox
- Diretório instalação ToolBox
- Menu Toolboxes
- SciLab
- SIP
- SIVP
- ToolBox
---

Se você instalou alguma biblioteca (ToolBox) no SciLab, como por exemplo a SIP - SciLab Image Processing ToolBox, como exemplificado no [post anterior](http://manoelcampos.com/2009/04/03/carregando-bibliotecas-adicionais-no-scilab-o-matlab-opensource/), e está tendo quer carregar a bibilioteca digitando o comando exec, seguido do caminho do arquivo loader.sce da biblioteca, então seus problemas acabaram :).

No caso da instalação da biblioteca SIP 0.3.99 que mostrei no outro post, ela era um pacote deb mais antigo, mas que funcionou sem problemas no Ubuntu 8.10 com SciLab 5.0, porém, sua instalação era feita em /usr/lib/scilab/contrib/sip. Nesta local, o SciLab não reconhece a biblioteca, e não adiciona uma opção para carregá-la por meio do menu Toolboxes. Depois que instalei a outra biblioteca SIVP (que deu um trabalhão, como comentado no outro post), percebi a existência desse menu. Assim, fui procurar no disco para ver onde é que esses arquivos deveriam estar para que a biblioteca fosse reconhecida pelo SciLab.

Percebi que a biblioteca SIVP 0.5.0 era instalada no diretório /usr/lib/sivp-0.5.0, local totalmente diferente da SIP. Procurando mais um pouco, descobri que no diretório **/usr/share/scilab/contrib** existia um link simbólico para o diretório real de instalação do SIVP. Observe que esse diretório é parecido com o diretório onde o SIP é instalado, em /usr/_lib_/scilab/contrib/. Assim, para que o SciLab adicionasse a biblioteca SIP no menu ToolBoxes, para que você possa carregá-la apenas usando este menu, e não tendo mais que digitar o comando exec("/usr/lib/scilab/contrib/sip/loader.sce"), você deve criar um link simbólico para o diretório do SIP, dentro do diretório  **/usr/share/scilab/contrib**, executando os comandos abaixo:


    
    
    cd /usr/share/scilab/contrib
    sudo ln -s /usr/lib/scilab/contrib/sip
    



Pronto, agora basta fechar o SciLab e reabrir, que no menu Toolboxes terá um link para carregar o SIP. Pode ser que isto foi necessário apenas pelo fato de estarmos usando uma versão mais antiga da biblioteca SIP, instalada a partir de um pacote compilado .deb.
