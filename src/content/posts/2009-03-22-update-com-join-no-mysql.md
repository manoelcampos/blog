---
author: admin
comments: true
layout: post
slug: update-com-join-no-mysql
title: Update com Join no MySQL
wordpress_id: 233
categories:
- BD
- Software Livre
tags:
- Join
- MySQL
- Update
- Update com Join
---

Como fazer um update em uma tabela do MySQL, com base no valor de um campo de outra tabela com a qual essa se relaciona? Veja o modelo a seguir:

```
update TabelaQueDesejaAtualizar, TabelaComAQualVaiRelacionar
set TabelaQueDesejaAtualizar.CampoParaAtualizar = TabelaComAQualVaiRelacionar.CampoComValorDesejado
where TabelaQueDesejaAtualizar.CampoParaRelacionar = TabelaComAQualVaiRelacionar.CampoParaRelacionar;
```

 Exemplo:

```
update Funcionario, PessoaFisica
set Funcionario.codPessoa = PessoaFisica.codPessoa
where Funcionario.codPessoaFisica = PessoaFisica.codPessoaFisica;
```

Considerando as tabelas Funcionario e PessoaFisica, atribui ao campo codPessoa na tabela Funcionario o valor do campo codPessoa da tabela PessoaFisica, levando em conta que as tabelas Funcionario e PessoaFisica possuem um relacionamento por meio do campo codPessoaFisica existente nas duas tabelas. Desta forma, na tabela Funcionario, no campo codPessoa, teremos o mesmo valor deste campo no registro correspondente na tabela PessoaFisica.

Claro que esse campo codPessoa na tabela Funcionario não faz nenhum sentido e é totalmente redundante, sendo que o mesmo existe na tabela PessoaFisica. O exemplo foi apenas para mostrar como funciona um update com "join" no MySQL, e que deve funcionar em outros bancos. Eu lembro que no SQL Server havia uma forma diferente de se fazer isso, mas não lembro exatamente como.
