---
author: admin
comments: true
date: 2011-03-28 22:09:15+00:00
layout: page
slug: boletophp-ultimate
title: BoletoPHP Ultimate
wordpress_id: 2319
categories:
- Internet
- Programação
- Software
- Software Livre
tags:
- Boleto Bancário
- BoletoPHP
- BoletoPHP Ultimate
- PHP
---

[![](http://manoelcampos.com/wp-content/uploads/php.png)](http://manoelcampos.com/wp-content/uploads/php.png)O BoletoPHP Ultimate é um fork do [BoletoPHP](http://www.boletophp.com.br), baseado na versão 0.17 do mesmo, que permite a geração de boletos bancários em PHP para diversos bancos nacionais.
A atual implementação permite a definição dos parâmetros a serem passados aos boletos em um arquivo centralizador (boleto.php). Desta forma, o projeto está adaptado para gerar boletos para diversos bancos sem que o desenvolvedor tenha um grande trabalho de adequar o código da sua aplicação para isto. Basta ele alterar o arquivo boleto.php para inserir os dados do boleto.

O exemplo disponibilizado gera um boleto para o Banco do Brasil. Assim, os parâmetros informados no arquivo boleto.php são para este banco. Outros bancos podem requerer parâmetros diferentes, no entanto, basta atribuir tais parâmetros ao vetor $dadosboleto dentro deste arquivo, que tais parâmetros serão reconhecidos pelo boleto específico do banco especificado.

No arquivo boleto.php, para definir o banco a ser usado, basta atribuir o sufixo existente no nome do arquivo do boleto
do banco à variável $sufixo_arquivo_boleto. Por exemplo, a geração de boletos para o Banco do Brasil é feita pelo arquivo boleto_bb.php, logo, o sufixo a ser informado na variável indicada é bb. Veja exemplo:

[php]$sufixo_arquivo_boleto = "bb";[/php]

Logo, o sufixo é o valor depois do _ e antes do .php no nome do arquivo do boleto do banco.

Desta forma, a partir do exemplo disponibilizado em boleto.php, basta alterar o valor da variável $sufixo_arquivo_boleto para
gerar o boleto para outro banco. Por exemplo, altere o valor para "unibanco" para gerar boletos para tal banco.

A simples alteração do valor desta variável pode causar erros na geração do boleto, pois como o banco foi alterado, pode ser necessário informar algum valor adicional no vetor $dadosboleto para gerar boletos para tal banco.

A intenção inicial era unir tal implementação com o BoletoPHP, no entanto, apesar de ter enviado o projeto para análise pelo responsável do BoletoPHP, não recebi um retorno se iria ou não utilizar as alterações. Assim, resolvi disponibilizar os fontes como um projeto separado.

O projeto é bastante útil em sistemas vendidos para diferentes clientes, onde cada um utiliza boletos de um banco diferente. Com tal implementação, você pode adequar sua aplicação facilmente para o próprio cliente escolher para qual banco deseja gerar o boleto. Um exemplo disto é minha aplicação de gerenciamento de inscrições, disponível para testes em [http://concursos.manoelcampos.com/admin/](http://concursos.manoelcampos.com/admin/). Como pode ser visto lá, na página de [cadastro de convênios](http://concursos.manoelcampos.com/admin/cad_convenio.php?acao=listar) o usuário informa o banco com o qual deseja trabalhar.


## Download


O projeto está hospedado no [GitHub](http://github.com/manoelcampos/BoletoPHP-Ultimate), sob a mesma licença do BoletoPHP. Os fontes podem ser baixados via git ou diretamente pela página [http://github.com/manoelcampos/BoletoPHP-Ultimate/archives/master](http://github.com/manoelcampos/BoletoPHP-Ultimate/archives/master)

Então, é isto. Espero que seja útil. Em caso de dúvidas ou críticas, deixem um comentário.
