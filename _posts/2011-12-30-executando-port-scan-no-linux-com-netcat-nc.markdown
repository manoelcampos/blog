---
author: admin
comments: true
layout: post
slug: executando-port-scan-no-linux-com-netcat-nc
title: Executando Port Scan no Linux com netcat (nc)
wordpress_id: 2576
categories:
- Linux
- Software
- Software Livre
tags:
- Command Line
- Linux
- nc
- netcat
- Port Scan
---

Um post rápido hoje, pra não dizerem que o blog morreu :)
Vou mostrar rapidamente como realizar um port scan no Linux usando o comando netcat (nc). Veja comando abaixo:

[bash]
nc -z -v IpOuHostname PortaInicial-PortaFinal
[/bash]

<!-- more -->

Ao executar o comando nc passando o parâmetro -z, solicitamos a execução de um port scanning.
O parâmetro -v é para mostrar a saída no terminal.
No lugar de IpOuHostname informe o IP ou nome da máquina onde deseja fazer o port scanning.
E no lugar de PortaInicial e PortaFinal indique a faixa de portas desejadas para realizar o escaneamento.
Bem simples né? :)

Se desejar exibir apenas as mensagens que indiquem portas abertas, use o comando como mostrado abaixo:

[bash]
nc -z -v IpOuHostname PortaInicial-PortaFinal 2>&1 | grep succeeded
[/bash]

Veja o exemplo a seguir, que procura portas abertas no host de IP 10.1.1.1, desde a porta 1 até a 65535, exibindo apenas as mensagens de conexão bem sucedida (ou seja, porta aberta):

[bash]
nc -z -v 10.1.1.1 1-65535 2>&1 | grep succeeded
[/bash]

O 2>&1 no comando acima indica que a saída de erro (2) deve ser direcionada pra saída padrão (1).
Usando o grep, filtramos então as mensagens que contenham a palavra succeeded e pronto.


### Referências:


[Manual do netcat](http://linux.die.net/man/1/nc)
[Prompt do Linux: stdin, stdout, stderr e seus truques](http://www.guiadopc.com.br/artigos/693/prompt-do-linux-stdin-stdout-stderr-e-seus-truques-parte-i.html)
