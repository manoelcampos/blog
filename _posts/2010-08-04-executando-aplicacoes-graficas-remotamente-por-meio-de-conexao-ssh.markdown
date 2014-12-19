---
author: admin
comments: true
layout: post
slug: executando-aplicacoes-graficas-remotamente-por-meio-de-conexao-ssh
title: 'Executando aplicações gráficas remotamente, por meio de conexão SSH: X11 Forwarding'
wordpress_id: 1842
categories:
- Linux
- Software
- Software Livre
tags:
- Graphical Interface
- Linux
- Remote Shell
- ssh
- X11
- X11 Forwarding
---

[![](http://manoelcampos.com/wp-content/uploads/ssh.jpg)](http://manoelcampos.com/wp-content/uploads/ssh.jpg)Profissionais de TI usuários de distribuições Linux, provavelmente utilizam bastante o comando ssh para realizar conexões remotas a outras máquinas Linux.

Convencionalmente utiliza-se o comando da seguinte forma:

[bash]ssh usuario-remoto@ip-ou-nome-dns-servidor-remoto[/bash]

Tal comando abre um shell para o servidor remoto, permitindo a execução de comandos no servidor, via terminal. A partir de uma sessão ssh, pode ser possível a realização de qualquer tarefa que o usuário faria a partir da interface gráfica do servidor (dependendo obviamente das permissões e conhecimento do usuário). Pode-se executar editores de texto como pico


--more Leia Mais--


 e [nano](http://www.nano-editor.org/), e assim alterar configurações de programas, editando os famosos arquivos .conf. Pode-se navegar na internet usando browsers textuais como o [links](http://links.sourceforge.net/), baixar arquivos com [wget](http://www.gnu.org/software/wget/), instalar e remover programas com apt-get, dentre outras possibilidades.

No entanto, algumas vezes podemos precisar acessar uma aplicação gráfica existente no servidor e poder operá-la remotamente, semelhante ao que ocorre no uso de programas como o [VNC](http://www.realvnc.com) (para Windows e Linux) ou o [Terminal Server Client](http://tsclient.sourceforge.net/) (para acessar máquinas Windows a partir do Linux).

Como exemplo, você poderia desejar conectar via SSH em um servidor Linux, e abrir o Firefox para navegar na internet e encontrar algum arquivo para baixar, o que é bem mais fácil de ser feito do que usando um browser textual como  o [links](http://links.sourceforge.net/). Se o arquivo fosse baixado na máquina local, depois o mesmo ainda precisaria ser transferido para o servidor, o que, dependendo do tamanho do arquivo e da conexão entre sua máquina e o servidor, pode levar ainda bastante tempo.

Pois bem, o aplicativo SSH para Linux (OpenSSH SSH client) permite isso, apenas utilizando-se o parâmetro -X (maiúsculo). Logo, o comando anteriormente mostrado ficaria como abaixo:

[bash]ssh -X usuario-remoto@ip-ou-nome-dns-servidor-remoto[/bash]

Com isto, é aberto um shell textual para a máquina remota. No entanto, se você executar alguma aplicação gráfica, como o Firefox (apenas digitando firefox), a mesma abrirá na interface gráfica da sua máquina local. Tal recurso é denominado **X11 Forwarding**. Isto permite que você opere a aplicação gráfica remota, como se fosse uma aplicação local.

Como estamos em um shell textual, por padrão, não conseguimos trabalhar com várias aplicações simultaneamente, não tendo o recurso de multi-tarefa (a menos que abramos várias sessões de shell). Assim, se executarmos um aplicativo qualquer (gráfico ou não), não conseguiremos digitar outros comandos no terminal enquanto não fecharmos o aplicativo. Como desejamos abrir um aplicativo gráfico, que não operaremos por meio do terminal, podemos utilizar um & após o nome do aplicativo, para que o terminal seja liberado para digitação de outros comandos. Assim, para executar o Firefox, digite o comando abaixo:

[bash]firefox &[/bash]

Isto fará com que a aplicação seja executada, liberando o terminal para que outros comandos possam ser digitados.

Bem, mas o mérito disso não é meu, é do professor Cláudio de Castro Monteiro, colega do [IFTO](http://www.ifto.edu.br), que descobriu tal fantástico parâmetro -X, no manual do comando ssh.

[bash]man ssh[/bash]

Veja o artigo "[Bê-á-bá do SSH, parte 6: X remoto](https://www.ibm.com/developerworks/mydeveloperworks/blogs/752a690f-8e93-4948-b7a3-c060117e8665/entry/b_C3_AA__C3_A1_b_C3_A1_do_ssh_parte_6_x_remoto10?lang=pt_br)" no site da IBM.

That's all folks!
