---
author: admin
comments: true
layout: post
slug: instalador-de-driver-oledb-para-postgresql
title: Instalador de Driver OleDB para PostgreSQL
wordpress_id: 1959
categories:
- BD
tags:
- ADO
- BD
- Delphi
- Installer
- OleDB
- PgOleDB
- PostgreSQL
- PostgreSQL OLE DB Provider
---

[![PostgreSQL](http://manoelcampos.com/wp-content/uploads/postgresql.png)](http://manoelcampos.com/wp-content/uploads/postgresql.png)Recentemente precisei conectar a um banco de dados PostgreSQL utilizando os componentes ADO do Delphi (pois estou ministrando disciplina de Delphi e inicialmente vou utilizar tais componentes por serem mais fáceis).

Como não existe driver OleDB nativo, mesmo no Delphi 2010, para o PotgreSQL (nem mesmo para DBExpress), precisei ir à caça de um. Então encontrei rapidamente o [PgOleDB: PostgreSQL OLE DB Provider](http://pgfoundry.org/projects/oledb/).

De início tive um problema pois o driver não contava com um instalador, e seria preciso instalá-lo em várias máquinas em um laboratório. Assim, resolvi criar um, utilizando as ferramentas gratuitas [Inno Setup](http://www.innosetup.com) e [IS Tool](http://www.istool.org).

O instalador para a versão 1.0.0.20 do PgOleDB pode ser baixado no link a seguir.

[attachments size=custom title="Download" force_saveas="1" logged_users="0"]
