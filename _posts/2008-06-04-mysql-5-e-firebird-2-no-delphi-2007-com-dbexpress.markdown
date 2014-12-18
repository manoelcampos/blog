---
author: admin
comments: true
layout: post
slug: mysql-5-e-firebird-2-no-delphi-2007-com-dbexpress
title: MySQL 5 e Firebird 2 no Delphi 2007 com DBExpress
wordpress_id: 36
categories:
- BD
- Delphi
---

Para os amantes do MySQL e do Delphi, até que enfim a Borland/CodeGear criou um driver DBExpress que funcione no MySQL 5.  Pelo que soube, em um dos Borland Conference que participei, o grande problema é que os desenvolvedores do MySQL faziam muitas alterações significativas no núcleo do mysql, o que tornava os drivers da Borland incompatíveis com as novas versões deste banco de dados.

O Delphi 2007 veio com uma nova versão do DBExpress, a versão 4, o que tornou os antigos drivers de terceiros, para diversos bancos de dados, incompatíveis com esta nova versão. Drivers como o UIB para Firebird não funcionam mais no Delphi 2007.

O driver DBExpress oficial da Borland/CodeGerar para o Delphi 2007, de nome MySQL funciona, mas somente com versões do MySQL 5.0.27 a 4.1.22*, como informa no arquivo readme.htm na pasta do Delphi 2007, normalmente localizado em C:\Arquivos de programas\CodeGear\RAD Studio\5.0\readme.htm. Este driver funciona com a dll DBExpress de nome dbxMYS30.dll e a libmysql.dll (dll cliente do mysql). Logo, se você tiver um MySQL superior a versão 5.0.27, poderá ter problemas.

Para você saber qual a versão do seu mysql, abra o prompt de comando e digite **mysql -h localhost -u root -p -v **onde -h é para indicar o ip/nome dns do servidor mysql, -u é para indicar o nome de um usuário, -p é para informar a senha (a mesma será solicitada após pressionar enter) e -v para mostrar a versão do servidor.

Esta versão do driver DBExpress para MySQL funciona com caracteres unicode (um padrão internacional para representação de caracteres de diversos idiomas, que permite que um caractere acentuado, por exemplo, seja representado da mesma forma, independente do idioma da aplicação/sistema operacional).

A versão antiga do driver foi renomeada para dbxmysA30.dll, pois os drivers DBExpress nativos da Borland/CodeGear permitem trabalhar em modo de compatibilidade com o DBExpress 3. A letra "A" contida no nome do driver indica que o mesmo só aceita caracteres ASCII.

No meu caso, estou utilizando o MySQl 5.0.41 e a aplicação funciona normalmente, mas em tempo de projeto (design time), ocorre um erro informando que a biblioteca libmysql.dll não foi encontrada, e não adianta sair colando ela em tudo que é pasta que lhe vier a cabeça que o Delphi não a encontra.

Como podemos não encontrar para baixar a versão 5.0.27 do MySQL, ou outra compatível com o driver DBExpress do Delphi, uma solução seria utilizar uma versão anterior da biblioteca libmysql.dll que pode ser encontrada nos pacotes de instalação do PHP, por exemplo. Você pode baixar a versão 5.0.22 da libmysql.dll, que funciona no Delphi 2007, [nesse link](http://manoelcampos.com/wp-content/uploads/2008/06/libmysql-5022dll.zip),  [nesse](http://lab.etfto.gov.br/~mcampos/downloads/delphi/libmysql-5.0.22.dll.zip),  [ou nesse](http://edin.dk/archives/29-PHP-4.4.5-win32-with-MySQL-5.0.22.html).

Basta descompactar esta dll na pasta bin de instalação do Delphi 2007, normalmente em C:\Arquivos de programas\CodeGear\RAD Studio\5.0\bin, que o driver vai funcionar em tempo de projeto no Delphi.

Quanto ao Firebird 2, ainda bem que o colega [Thiago Borges de Oliveira](http://www.tbosystems.bluehosting.com.br/dbx4/) desenvolveu um Driver DBExpress 4 gratuito para o Delphi 2007, que está em versão Release Candidate, mas testei e tá funcionando direitinho, porém, podem ocorrer problemas por não ser uma versão final. O driver possui um setup que automatiza o processo de instalação, porém, requer o December Update do Delphi 2007 para funcionar, sem ele, até o processo de instalação pode falhar.
