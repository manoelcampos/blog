---
author: admin
comments: true
layout: post
slug: processamento-de-arquivo-de-retorno-de-boleto-bancario-php
title: Processamento de Arquivo de Retorno de Boleto Bancário em PHP
wordpress_id: 1347
categories:
- Internet
- Programação
- Software Livre
tags:
- Arquivo de Retorno
- Bancos Brasileiros
- Boleto Bancário
- CNAB240
- CNAB400
- Design Patterns
- FEBRABAN
- Importação
- OO
- Padrões de Projetos
- PHP
- Título de Cobrança
---

[![](http://manoelcampos.com/wp-content/uploads/txt-150x150.png)](http://manoelcampos.com/wp-content/uploads/txt.png)Recentemente precisei implementar o processamento de arquivos de retorno de boleto bancário para o meu [Sistema de Inscrições On-Line](http://inscricoes.manoelcampos.com/). Assim, resolvi criar um projeto para disponibilizar os fontes para a comunidade e também receber contribuições no desenvolvimento do mesmo, como ocorre com o projeto [BoletoPHP](http://www.boletophp.com.br).

Desta forma nasce o [Retorno-BoletoPHP](http://github.com/manoelcampos/Retorno-BoletoPHP), um projeto em PHP 5+ que conta com um conjunto de classes para processamento de arquivos de retorno de títulos de cobrança (boleto bancário) de bancos brasileiros. O projeto utiliza Design Patters para permitir sua fácil extensão, sem modificar as classes que já estão funcionando, no conceito "Fechado para alteração e aberto para extensão".

Atualmente estão implementados os padrões FEBRABAN/CNAB400 E FEBRABAN/CNAB240.

Acessem o projeto em [http://github.com/manoelcampos/Retorno-BoletoPHP](http://github.com/manoelcampos/Retorno-BoletoPHP)

**Exemplos online:**


[http://sistemainscricoes.net/concursos/admin/retorno/exemplo_cnab240.php](http://sistemainscricoes.net/concursos/admin/retorno/exemplo_cnab240.php)
[http://sistemainscricoes.net/concursos/admin/retorno/exemplo_cnab400conv6.php](http://sistemainscricoes.net/concursos/admin/retorno/exemplo_cnab400conv6.php)
[http://sistemainscricoes.net/concursos/admin/retorno/exemplo_cnab400conv7.php](http://sistemainscricoes.net/concursos/admin/retorno/exemplo_cnab400conv7.php)





### Se inscreve no grupo de discussão do projeto para tirar dúvidas.


<table style="background-color: #fff; padding: 5px;" cellspacing="0" >
<tbody >
<tr >

<td >![Grupos do Google](http://groups.google.com/intl/pt-BR/images/logos/groups_logo_sm.gif)
</td>
</tr>
<tr >

<td style="padding-left: 5px; font-size: 125%;" >**retorno-boletophp**
</td>
</tr>
<tr >

<td style="padding-left: 5px;" >[Visitar este grupo](http://groups.google.com/group/retorno-boletophp)
</td>
</tr>
</tbody>
</table>
