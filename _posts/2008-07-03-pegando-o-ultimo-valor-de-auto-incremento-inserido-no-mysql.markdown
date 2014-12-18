---
author: admin
comments: true
layout: post
slug: pegando-o-ultimo-valor-de-auto-incremento-inserido-no-mysql
title: Pegando o último valor de auto incremento inserido no mysql
wordpress_id: 40
categories:
- BD
- Delphi
- Programação
- Software Livre
---

Bem, vamos ao post rápido de hoje.

No MySQL e em muitos bancos existe um recurso de auto incremento que é usado para campos chave primária das tabelas, impedindo que existam dois registros com o mesmo código.

No MySQL o usuário não tem como saber previamente, de uma maneira segura, qual o próximo valor que será gerado para o campo auto incremento de uma tabela. Apenas após inserir um registro na tabela é que podemos saber. Na linguagem PHP, por exemplo, existe a função mysql_insert_id que retorna o valor gerado para o campo auto incremento no último comando insert executado. Isto é útil quando precisamos incluir registros em outra tabela que serão relacionados com o registro que foi inserido, como por exemplo, quando temos uma tabela venda e outra item_venda. A tabela venda normalmente terá um campo cod_venda auto incremento. E ao registrar uma venda, precisamos incluir pelo menos um item de venda, que estará relacionado com a venda que foi inserida. Para fazer esse relacionamento, a tabela item_venda normalmente terá um campo cod_venda para fazer essa associação, assim, o cod_venda da tabela item_venda deve ter o valor do campo auto incremento cod_venda da tabela venda. Assim, para isso que usamos, em PHP, a função mysql_insert_id.

Porém, em outras linguagem como o Delphi, não existe uma função semelhante a mysql_insert_id do PHP, logo, como fazer para retornar o valor auto incremento gerado pelo último insert? Simples, use a instrução sql **select LAST_INSERT_ID();** . Independente da linguagem de programação que você usa, isto vai funcionar. Você pode até criar uma função de nome mysql_insert_id na linguagem de programação que desejar, para executar a sql mostrada acima e assim, apenas chamar a função quando desejar. Veja exemplo em Delphi utilizando os componentes DBExpress:

[delphi]
function mysql_insert_id(SQLConnection: TSQLConnection): Integer;
var SqlDataSet: TSqlDataSet;
begin
result:= 0;
SqlDataSet:= TSqlDataSet.Create(nil);
try
SqlDataSet.SQLConnection:= SQLConnection;
SqlDataSet.CommandText:= 'select LAST_INSERT_ID()';
SqlDataSet.Open;
result:= SqlDataSet.Fields[0].AsInteger;
SqlDataSet.Close;
finally
SqlDataSet.Free;
end;
end;
[/delphi]

Para chamar a função deve-se passar um objeto da classe TSQLConnection por parâmetro, que representa a conexão com o banco de dados.

Espero que seja útil, como foi pra mim.

T+
