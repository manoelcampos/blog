---
author: admin
comments: true
layout: post
slug: criar-e-excluir-diretorios-virtuais-e-registrar-aspnet-20-no-iis-com-delphi
title: Criar e excluir diretórios virtuais e registrar ASP.NET 2.0 no IIS com Delphi
wordpress_id: 690
categories:
- Delphi
- Programação
tags:
- ASP.NET 2.0 IIS Registration
- Creation
- Delphi
- IIS
- Internet Information Services
- Programatically Create Virtual Directory
- Registration
- Virtual Directory
---

Devido a versão mobile do meu [Sistema de Pesquisa de Opinião e Mercado - SIPOM](http://manoelcampos.com/sipom/) utilizar um WebService ASP.NET para transferência de dados entre o servidor e os Pocket PC's, e para automatizar a instalação desse WebService no servidor Web IIS (Internet Information Services), desenvolvi uma pequena aplicação


--more Leia Mais--


 que permite criar e excluir diretórios virtuais no IIS, além de registrar o ASP.NET 2.[![IIS Virtual Directory Registration](http://manoelcampos.com/wp-content/uploads/2009/10/iisvirtualdirreg.png)](http://manoelcampos.com/wp-content/uploads/2009/10/iisvirtualdirreg.png)0 no mesmo.

A aplicação foi desenvolvida no Delphi 2007 Win32. Para abrir o código fonte do projeto você precisará da biblioteca [JVCL](http://jvcl.sourceforge.net). A criação de diretórios virtuais e registro do ASP.NET 2.0 podem ser feitos via linha de comando da seguinte forma:

IISVirtualDirReg PhysicalDirectoryPath [VirtualName]

Onde PhysicalDirectoryPath é o caminho real do diretório a ser adicionado no IIS.
VirtualName é o nome do diretório virtual a ser criado. Se for omitido, seu nome será o do último diretório do caminho físico informado.

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]


## Créditos:


[http://community.devexpress.com/forums/t/36251.aspx](http://community.devexpress.com/forums/t/36251.aspx)
[http://www.agnisoft.com/white_papers/active_directory.asp](http://www.agnisoft.com/white_papers/active_directory.asp)
