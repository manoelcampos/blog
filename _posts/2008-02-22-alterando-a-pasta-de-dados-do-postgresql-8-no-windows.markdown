---
author: admin
comments: true
layout: post
slug: alterando-a-pasta-de-dados-do-postgresql-8-no-windows
title: Alterando a pasta de dados do PostgreSQL 8 no Windows
wordpress_id: 35
categories:
- BD
- Windows
---

Bem, hoje vou postar algo sobre uma necessidade que tive no PostgreSQL no Windows, e que porém, deu bem mais trabalho de resolver do que com o MySQL, por exemplo. Eu tenho o costume de colocar todos meus dados em uma unidade_** D:**_ , para evitar de precisar formatar o Windows ( o que não é raro :( ) e perder arquivos importantes. Assim, sempre altero a pasta padrão onde os servidores de bancos de dados que uso (Firebird, SQL Server, MySQL e PostgreSQL) para esta unidade para evitar de perder meus bancos de dados.

Para realizar esta tarefa no PostgreSQL, logo procurei um arquivo postgresql.conf. Logo encontrei o arquivo na pasta data de instalação do PostgreSQL. Porém, ao encontrar, descomentar e alterar a chave _data_directory_ no arquivo, o servidor não iniciou mais. Alterei as permissões da pasta, tentei colocar barra no final do endereço da pasta, tentei usando as barras **\** e **/** e nada.

Na luta em tentar descobrir como resolver o problema, olhando no serviço do PostgreSQL na janela de administração dos serviços do Windows, verifiquei que o endereço da pasta de dados era passado por parâmetro para o serviço. Logo, pensei em reinstalar o serviço. Para isto, depois de buscar no google e encontrar apenas pistas de como resolver, encontrei na pasta bin do PostgreSQL o utilitário _pg_ctl_, utilizado para  configurar e controlar o serviço do PostgreSQL. Vendo os parâmetros disponíveis, chamando _pg_ctl --help_, logo descobri como remover e reinstalar o serviço, que deve ser feito com um usuário administrador.

Assim, abra o prompt de comando na pasta bin de instalação do PostgreSQL.
Para  remover o serviço digite:
**  pg_ctl unregister -N "nome_serviço_pgsql" -U WinUser  -P SenhaWin**

**nome_serviço_pgsql** é o nome do serviço do PostgreSQL nos serviços do Windows. Para saber qual é esse nome, na janela de adminsitração de serviços do Windows, encontre o PostgreSQL e pressione ALT+ENTER para abrir as propriedades do serviço. Na janela que abre, na primeira aba, existe um campo "Nome do serviço" contendo o nome que deve ser utilizado para remover o serviço.  Veja exemplo da utilização do comando:

**    pg_ctl unregister -N "pgsql-8.2" -U postgres -P postgres**

**WinUser** deve ser o nome do usuário do Windows, criado para rodar o PostgreSQL. Este usuário foi definido durante a instalação do PostgreSQL e o nome padrão é _postgres_. **SenhaWinUser **é a senha deste usuário, também definida durante a instalação do PostgreSQL.

Para  registrar o serviço digite:
**   pg_ctl register -N "nome_serviço_pgsql" -U WinUser  -P SenhaWinUser -D "diretorio_desejado"**

**diretorio_desejado** deve ser o diretório onde deseja que os bancos do PostgreSQL sejam salvos. Não esqueça de dar permissão total para o usuário postgres neste diretório.

**nome_serviço_pgsql** é o nome que você deseja dar para o serviço a ser registrado.
Veja exemplo de utilização do comando abaixo:

**  pg_ctl register -N "pgsql8" -U postgres -P postgres -D "D:\PostgreSqlData\"**

Agora, você precisa copiar (ou recortar) todos os arquivos da pasta _Data _de instalação do PostgreSQL para a pasta que você especificou no parâmetro _-D ._

Depois reinicie o servidor PostgreSQL e é isso. T+
