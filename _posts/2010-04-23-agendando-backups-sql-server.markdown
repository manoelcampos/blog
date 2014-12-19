---
author: admin
comments: true
layout: post
slug: agendando-backups-sql-server
title: Agendando Backups de Bancos Microsoft SQL Server
wordpress_id: 1369
categories:
- BD
- Delphi
- Programação
- Software
- Windows
tags:
- Agendador de Tarefas
- Agendamento
- Backup
- Backup Automatizado
- BD
- Delphi
- Linha de Comando
- Microsoft SQL Server
- MS-SQL
- Restore
---

[![SQL Server Backup](http://manoelcampos.com/wp-content/uploads/SqlServerBackup-300x270.png)](http://manoelcampos.com/wp-content/uploads/SqlServerBackup.png)Se você possui uma versão do banco de dados Microsoft SQL Server que não conta com o recurso de agendamento de backups, seus problemas acabaram-se.

O SQL Server Backup é uma ferramenta gráfica, desenvolvida em Delphi, que permite a realização de backups e restores de um banco de dados do SQL Server. A aplicação ainda aceita parâmetros via linha de comando, permitindo que tais operações sejam automatizadas por meio de arquivos bat ou pela criação de tarefas agendadas no Windows.

As configurações para acesso ao banco de dados e o caminho e nome padrão para geração do arquivo de backup devem ser informados no arquivo SipomSQLServer.ini existente dentro da pasta do projeto (o nome do arquivo ini a ser carregado está definido dentro do código fonte da aplicação, podendo ser alterado lá para o nome que desejar e em seguida renomeando o ini para o nome lá indicado).


--more Leia Mais--




A interface da aplicação possui um botão que exibe os parâmetros permitidos via linha de comando.

Para agendar os backups, pode-se utilizar o Agendador de Tarefas do Windows, acessível a partir do painel de controle. É possível ainda criar uma tarefa agendada via linha de comando, utilizando o aplicativo schtasks existente no Windows. Desta forma, é possível criar a tarefa agendada a partir do instalador do seu aplicativo.

Veja abaixo um exemplo de comando para adição da tarefa no Agendador do Windows:

    
    schtasks /create /sc diariamente /mo 1 /st 11:30:00 /tn "Backup Banco" /ru system /tr "d:\temp\bin\SqlServerBackup.exe -b"





	
  * **/create** indica para criar uma nova tarefa agendada

	
  * **/sc diariamente** indica para que a tarefa seja executada diariamente

	
  * **/mo 1** indica para que seja executada a cada 1 dia (ou seja, todo dia)

	
  * **/st 11:30:00** indica para que a tarefa seja iniciada as 11:30:00 da manhã (o formato obrigatoriamente deve incluir os segundos)

	
  * **/tn "Backup Banco"** indica para criar a tarefa com o nome de "Backup Banco"

	
  * **/ru system** indica para executar a tarefa com o usuário system, existente em todo Windows. Desta forma, não é preciso indicar um usuário específico, que pode possuir uma senha que deve ser informada, e pode ainda não ter permissões suficientes para executar o backup

	
  * **/tr "d:\temp\bin\SqlServerBackup.exe -b"** indica para executar o programa SqlServerBackup, passando o parâmetro -b para ele (que indica para ele executar um backup)


É preciso ter permissões de administrador para executar o programa schtasks.  Mais opções de agendamento podem ser facilmente encontradas no help, executando schtasks /?

Lembre que as palavras que definem a periodicidade do agendamento devem estar em português, caso seu Windows esteja em tal idioma, apesar do help apresentar tais palavras em inglês (o que não funciona para SO em português).


## Requisitos


Biblioteca [JVCL](http://jvcl.sourceforge.net) para abrir e compilar o projeto.

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]
