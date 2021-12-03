---
author: admin
comments: true
layout: post
slug: excluindo-constraints-foreign-key-no-mysql-drop-constraint
title: Excluindo Constraints Foreign Key no MySQL (drop constraint)
wordpress_id: 148
categories:
- BD
- Software Livre
tags:
- Constraint
- Foreign Key
- MySQL
---

O MySQL as vezes nos surpreende, devido ao fato de alguns comandos SQL ANSI não funcionarem nele, como é o caso do drop constraint para exclusão de chaves estrangeiras, as foreign keys.

O comando padrão, que funciona em vários bancos (Firebird, SQL Server e outros) é _**alter  table NomeDaTabela drop constraint NomeDaConstraint;**_

Porém, não funciona no MySQL. O comando que deve ser executado é **_alter  table NomeDaTabela drop foreign key NomeDaConstraint;_**

Se você criou uma constaint sem um nome, o sistema InnoDB do MySQL gera um automaticamente. Para saber qual o nome gerado execute _**show create table NomeDaTabela**_; Este comando mostra a estrutura da tabela, com as constraints existentes e seus respectivos nomes. Daí, basta executar **_alter  table NomeDaTabela drop foreign key NomeDaConstraint;_** para apagar a foreign key desejada.

Referência: [MySQL 5.1 Reference Manual](http://dev.mysql.com/doc/refman/5.1/en/innodb-foreign-key-constraints.html)**_
_**
