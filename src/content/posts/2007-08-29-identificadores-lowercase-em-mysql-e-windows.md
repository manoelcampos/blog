---
author: admin
comments: true
layout: post
slug: identificadores-lowercase-em-mysql-e-windows
title: Identificadores lowercase em MySql no Windows
wordpress_id: 23
categories:
- BD
- Windows
tags:
- Configuração
- MySQL
- Windows
---

O MySql, por ser um banco muito ágil, leve e bastante popular, está  disponível  em diversos planos de hospedagem de sites por aí. Eu particularmente prefiro o PostgreSQL e o Firebird, pois possuem recursos de views, stored procedures e triggers a bastante tempo, coisas que o MySql só veio ter na versão 5.

Pelo fato de o MySql ser incluído sem custo nos planos de hospedage, tive que utilizá-lo num sistema web de gerenciamento financeiro que estou desenvolvendo para um cliente, utilizando Borland Developer Studio 2006, com linguagem ASP.NET e Delphi.

O  MySql no Windows é case insensitive, porém, em um servidor Linux é case sensitive. Aí começam os problemas. No Windows, o padrão do MySql é criar os identificadores (tabelas, nomes de campos e tudo mais) em minúsculas (lower case). Mesmo que você coloque o nome de uma tabela, por exemplo, entre apóstrofos, o MySql no Windows cria a tabela com nome em minúsculas. Assim, mesmo fazendo create table Cliente .... ou create table `Cliente`..., ele criará a tabela como cliente (tudo minúsculo). Ao fazer a sincronização da estrutura do banco de dados de desenvolvimento, no servidor Windows, para um servidor Linux de produção serão descobertos os problemas. Como no Linux o MySql, por padrão, obedece o case dos nomes dos objetos, se você tem uma tabela **Cliente **e gerar um script sql a partir do seu banco no servidor Windows com uma instrução como drop table cliente a mesma não será executada, pois no banco no servidor Linux não existe uma tabela **cliente **e sim uma tabela **Cliente**.

Desta forma, o script sql gerado no seu banco no servidor Windows deverá ser todo modificado manualmente para poder rodar no servidor MySql no Linux.

Depois de estar de saco cheio de ter que ficar ajustando script na mão, resolvi procurar na net como resolver isto, até que encontrei algumas perguntas em fóruns que me levaram a [este link](http://dev.mysql.com/doc/refman/5.1/en/identifier-case-sensitivity.html) no site do MySql. Lá mostra que existe um parâmetro que você pode usar no MySql para definir este comportamento. Assim, resumindo, você precisa adicionar a linha a seguir no arquivo my.ini, localizado na pasta de instalação do mysql, que sendo a versão 5, normalmente está em c:\arquivos de programas\mysql\mysql server 5\

set-variable = lower_case_table_names=0

Onde o parâmetro lower_case_table_names define se os identificadores ficarão todos em minúsculas ou não. Assim, defini 0 para indicar que não.

Em Windows, por ter um sistema de arquivos case insensitive, segundo o site do MySQL, forçar os identificadores a serem case sensitive, mudando lower_case_table_names para zero, pode corremper índices ao acessar tabelas MyISAM com o case diferente do que foi definido. Mas como não uso tabelas MyISAM, não tenho com o que me preocupar.

Mais informações em [http://dev.mysql.com/doc/refman/5.0/en/identifier-case-sensitivity.html](http://dev.mysql.com/doc/refman/5.0/en/identifier-case-sensitivity.html)

Isto foi o que aprendi de novo hoje.
Espero que ajude muita gente.
T+
