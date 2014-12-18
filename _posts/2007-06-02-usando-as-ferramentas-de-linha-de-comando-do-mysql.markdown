---
author: admin
comments: true
layout: post
slug: usando-as-ferramentas-de-linha-de-comando-do-mysql
title: Usando as ferramentas de linha de comando do MySQL
wordpress_id: 10
categories:
- BD
- Software Livre
tags:
- BD
- Ferramentas
- Linha de Comando
- MySQL
---

Quando o mysql é instalado, são instaladas ferramentas de linha de comando. No Windows estas ferramentas são instaladas dentro da pasta bin do mysql, que normalmente fica em Arquivos de ProgramasMySQL.

Se você não tiver um servidor MySQL local, precisará copiar estas ferramentas a partir de um servidor MySQL. Instalando o MySQL no seu PC, o instalador disponibiliza uma opção para adicionar a pasta bin no path do sistema operacional, para permitir que executemos as aplicações, existentes nesta pasta, a partir de qualquer pasta, somente digitando o nome do executável.

Se a pasta bin não foi adicionada no path do SO, você precisará entrar na pasta onde estão as ferramentas para poder executar os comandos a seguir.

**Conectar no MySQL:**

mysql -h ip_ou_nome_dns_do_servidor -u usuario -p
#em seguida o programa pede a senha do servidor
#depois basta digitar comandos como:

show databases; #mostra os bancos de dados existentes;
use meu_banco; #usar o banco meu_banco

show tables; #mostrar as tabels do banco selecionado
#mostrar os campos da tabela minha_tabela
show fields from minha_tabela;

** Para gerar um backup do banco usando o mysqldump no prompt:
**
#gera um script sql do banco meu_banco
#no servidor ip_meu_servidor
#e grava em um arquivo meu_banco.backup.sql
mysqldump -h ip_meu_servidor -u usuario -p meu_banco > meu_banco.backup.sql

** Para rodar um arquivo de script a partir do mysql no prompt:**

#conectar ao servidor, sem seguida é solicitada a senha
mysql -h ip_ou_nome_dns_do_servidor -u usuario -p meu_banco < /caminho/do/arquivo.sql
