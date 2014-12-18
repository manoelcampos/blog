---
author: admin
comments: true
layout: post
slug: gerador-de-setup-gratuito-para-aplicacoes-em-net-compact-framework-net-cf
title: Gerador de setup gratuito para aplicações em .NET Compact Framework (.NET CF)
wordpress_id: 697
categories:
- Mobile
tags:
- .NET Compact Framework
- Free
- Pocket PC Installation Creator
- Setup generator
- Windows Mobile
---

[![](http://manoelcampos.com/wp-content/uploads/dotnet1.jpg)](http://manoelcampos.com/wp-content/uploads/dotnet1.jpg)Se você precisa gerar programas de instalação para suas aplicações em .NET Compact Framework e não possui o Visual Studio, você pode utilizar o [Pocket PC Installation Creator](http://www.aperitto.com/products/ppcic) (PPCIC).<!-- more --> Ele pode ser utilizado gratuitamente e é muito semelhante a programas como o famoso [Inno Setup](http://www.jrsoftware.org/isinfo.php). O PPCIC é uma aplicação Win32 que gera instaladores também Win32. Assim, os instaladores gerados devem ser executados em um desktop/laptop, e ele fará a instalação da sua aplicação no Pocket PC que esteja conectado ao desktop/laptop por meio do Microsoft ActiveSync.

[![Pocket PC Installation Creator](http://manoelcampos.com/wp-content/uploads/2009/10/ppcic.png)](http://manoelcampos.com/wp-content/uploads/2009/10/ppcic.png)Na sub-pasta Languages, da pasta de instalação do PPCIC você encontra o arquivo BrazilianPortuguese.isl, para alterar para o português as mensagens do instalador gerado. A forma mais simples de deixar seus instaladores em português é alterar o nome desse arquivo para Default.isl e copiá-lo para a pasta anterior, substituindo o arquivo de mesmo nome.

Testei a aplicação e funcionou perfeitamente, atendendo todas as minhas necessidades. No entanto, a versão gratuita exibe um Message Box informando que é uma versão gratuita, antes de iniciar a instalação do aplicativo no Pocket PC.

Abaixo você pode ver imagem do instalador que gerei, rodando em um computador com Windows XP e instalando a minha aplicação em um Windows Mobile rodando no Microsoft Device Emulator. Na terceira imagem você vê, circulado, o atalho criado pelo instalado no Menu Iniciar do Pocket PC.

[caption id="attachment_699" align="alignleft" width="300" caption="Instalador gerado executando em Windows XP"][![Instalador gerado executando em Windows XP](http://manoelcampos.com/wp-content/uploads/2009/10/instaladorwin32gerado-300x233.png)](http://manoelcampos.com/wp-content/uploads/2009/10/instaladorwin32gerado.png)[/caption]

[caption id="attachment_700" align="alignnone" width="194" caption="Instalando Aplicação no Pocket PC "][![Instalando Aplicação no Pocket PC](http://manoelcampos.com/wp-content/uploads/2009/10/instalandoapppocketpc-194x300.png)](http://manoelcampos.com/wp-content/uploads/2009/10/instalandoapppocketpc.png)[/caption]

[caption id="attachment_703" align="alignnone" width="190" caption="Aplicação Instalada no Pocket PC"][![Aplicação Instalada no Pocket PC](http://manoelcampos.com/wp-content/uploads/2009/10/aplicacaoinstalada-190x300.png)](http://manoelcampos.com/wp-content/uploads/2009/10/aplicacaoinstalada.png)[/caption]
