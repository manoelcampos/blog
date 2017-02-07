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

### Download
Acessem o projeto em [http://github.com/manoelcampos/Retorno-BoletoPHP](http://github.com/manoelcampos/Retorno-BoletoPHP)

### Se inscreve no grupo de discussão do projeto para tirar dúvidas.

[Fórum do Google Groups](http://groups.google.com/group/retorno-boletophp)
