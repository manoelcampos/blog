---
author: admin
comments: true
layout: post
slug: adicionando-regras-ao-firewall-do-windows-via-programacao
title: Adicionando regras ao Firewall do Windows, via programação
wordpress_id: 1356
categories:
- Delphi
- Programação
- Software
- Windows
tags:
- Adicionar Regras
- Delphi
- Liberar Aplicativo
- Liberar Portas
- Liberar Portas Programaticamente
- Linha de Comando
- Programação
- Windows API
- Windows Firewall
- Windows Firewall Manager
- Windows XP
---

[![Windows Firewall Manager](http://manoelcampos.com/wp-content/uploads/windows-firewall-manager-300x127.png)](http://manoelcampos.com/wp-content/uploads/windows-firewall-manager.png)[![](http://manoelcampos.com/wp-content/uploads/windows7_firewall.png)](http://manoelcampos.com/wp-content/uploads/windows7_firewall.png)Devido meu Sistema de [Pesquisa de Opinião e Mercado-SIPOM](http://sipom.manoelcampos.com) utilizar um banco de dados Microsoft SQL Server, e este, para ser usado em rede, necessitar da liberação de algumas portas no firewall do computador onde o banco estiver instalado, resolvi implementar uma aplicação que permite automatizar tal tarefa.

Como o Windows XP incorporou o já conhecido Windows Firewall, resolvi desenvolver o Windows Firewall Manager, que adicione regras a tal firewall.

As regras podem ser a liberação de uma porta ou de um aplicativo. O programa foi desenvolvido em Delphi, baseado no artigo disponível no site [Delphi 3000](http://www.delphi3000.com/articles/article_5021.asp). O mesmo possui uma interface gráfica e também aceita parâmetros via linha de comando. A interface gráfica possui um botão que exibe a lista de parâmetros permitidos. Com o uso de parâmetros é possível criar regras no firewall do Windows a partir do programa de instalação do seu aplicativo.

O programa, com código, fonte pode ser baixado no link a seguir.

teja em tal idioma, apesar do help apresentar tais palavras em inglês (o que não funciona para SO em português).


## Requisitos


Biblioteca [JVCL](http://jvcl.sourceforge.net) para abrir e compilar o projeto.

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]
