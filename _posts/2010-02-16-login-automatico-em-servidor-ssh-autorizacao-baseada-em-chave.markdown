---
author: admin
comments: true
layout: post
slug: login-automatico-em-servidor-ssh-autorizacao-baseada-em-chave
title: Login automático em servidor SSH (Autorização baseada em chave)
wordpress_id: 916
categories:
- Linux
- Software
- Software Livre
- TV Digital
tags:
- Based-key Authorization
- Ginga Virtual Set-top Box
- Login automático
---

[![](http://manoelcampos.com/wp-content/uploads/user-login-icon.png)](http://www.iconarchive.com/show/cms-icons-by-iconshock/user-login-icon.html)Este artigo mostra como conectar em um servidor SSH, sem necessidade de informar senha.

Existem alguns tutoriais explicando este processo, porém, muitos não deixam claro em qual computador cada passo deve ser executado, causando confusão. Assim, isto me motivou a escrever este pequeno tutorial, que é basicamente uma tradução do [tutorial disponível aqui](http://philippe-millet.blogspot.com/2008/07/automatic-ssh-login-key-based.html).<!-- more -->

Uma necessidade que tive de usar autorização SSH automática foi no uso do Ginga Virtual Set-top Box, para teste de aplicações para o Sistema Brasileiro de TV Digital (SBTVD), pois sempre achei uma chatice ter que informar senha para logar numa máquina virtual, algo que faço com bastante frequência.

Seguem os passos necessários:

1. Abra um terminal no cliente para criar uma chave pública. Existem dois tipos: DSA e RSA.

Quase todos os tutoriais usam DSA (não sei e não estou muito interessado em saber a diferença entre os dois, mas são apenas algoritmos criptográficos diferentes).
Então, use o comando abaixo para criar a chave pública no cliente (apenas pressione Enter em todas
as perguntas, deixando as respostas padrões. Execute um man ssh-keygen para mais detalhes):
[bash]ssh-keygen -t dsa[/bash]
2. Adicione o conteúdo da chave pública, gerada no cliente, ao final do arquivo de chaves autorizadas no servidor. Assim, no terminal no cliente, execute o comando abaixo. Ele vai conectar ao servidor e já concatenar o conteúdo da chave gerada no cliente, ao final do arquivo de chaves autorizadas no servidor. A senha do usuário remoto será solicitada em sequência.
[bash]cat ~/.ssh/id_dsa.pub | ssh usuario_remoto@servidor_remoto 'cat >> ~/.ssh/authorized_keys'[/bash]
Se o comando a seguir informar que o arquivo ~/.ssh/authorized_keys não existe, conecte no servidor e execute o comando apresentado em 1 para criar o arquivo.

3. Agora realize uma conexão ao servidor.
Se tudo foi feito corretamente, não será solicitada a senha do usuario_remoto:
[bash]ssh usuario_remoto@servidor_remoto[/bash]
Se o seu servidor SSH for uma máquina virtual, cujo IP pode mudar, é provável que o processo deva ser refeito. Mas pelo menos o Ginga Virtual Set-top Box para VMWare, comigo, em modo NAT, o IP não altera, mesmo a máquina sendo reiniciada ou desligada.

Bem, isto agilizou bastante o meu dia-a-dia no desenvolvimento de aplicações para TV Digital. Espero que seja útil para vocês também. T+
