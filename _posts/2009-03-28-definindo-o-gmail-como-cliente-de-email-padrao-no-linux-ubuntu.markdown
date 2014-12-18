---
author: admin
comments: true
layout: post
slug: definindo-o-gmail-como-cliente-de-email-padrao-no-linux-ubuntu
title: Definindo o GMail como cliente de email padrão no Linux Ubuntu
wordpress_id: 256
categories:
- Internet
- Linux
- Software
- Software Livre
- Windows
tags:
- Cliente de email
- Firefox
- GMail
- Linux
- mailto
- Padrão
- Ubuntu
---

Todo mundo que tem Gmail adora ele, quem ainda não tem, não sabe o que tá perdendo. Assim, para aqueles que, como eu, abandonaram os clientes de email como Outlook Express e [Mozilla Thunderbird](http://pt-br.www.mozilla.com/pt-BR/thunderbird/) há anos, é muito chato você clicar num link de email em uma página e abrir um programa cliente de email. No Windows você pode resolver isso instalando o [GMail Notifier](http://superdownloads.uol.com.br/download/163/gmail-notifier/) e tornar o GMail o cliente de email padrão.

Para quem usa alguma distribuição linux como o [Ubuntu](http://www.ubuntu.com/), não precisa nem se quer de um programa para isso, basta usar [este script aqui](http://manoelcampos.com.br/wp-content/uploads/open_mailto.sh) e seguir os passos abaixo:



	
  1. Salve o arquivo no seu diretório home. Depois, no Ubuntu, vá no menu System >> Preferences >> Preferred Applications.

	
  2. No primeiro campo abaixo de Mail Reader escolha Custom

	
  3. No campo Command logo abaixo digite **/home/nomeDoSeuUsuario/open_mailto.sh %s**
por exemplo **/home/manoel/open_mailto.sh %s**

[caption id="attachment_257" align="alignnone" width="450" caption="Preferred Applications no Ubuntu"]![Preferred Applications no Ubuntu](http://manoelcampos.com/wp-content/uploads/2009/03/preferredapplications.png)[/caption]

Agora pode fechar a janela

	
  4. Abra um terminal para adicionar permissão de execução no seu script, digitando o comando **chmod u+x ~/open_mailto.sh**


Pronto, agora, ao clicar em um link maito:, será aberta a página de envio de email do GMail no Firefox.

Os comandos no script sh são mostrados abaixo:

**#!/bin/sh**

** **

**firefox "https://mail.google.com/mail?view=cm&tf=0&to=
`echo $1 | sed 's/mailto://'`"**

O segundo comando não possui quebra, deve ser digitado numa linha só.

Observe que é chamado o firefox, na página de envio de email do gmail, passando o email recebido do mailto: como parâmetro para o script. Se você usar outro navegador, basta alterar nesse arquivo. Mais detalhes são dados dentro do arquivo disponibilizado acima.

Para mim, ao clicar num link maito:, ele sempre abre uma nova aba no firefox. Se não abrir, troque o comando
no script pelo exibido abaixo (digite numa única linha):
**firefox -remote "openurl(https://mail.google.com/mail?view=cm&tf=0&to=`echo $1 | sed 's/mailto://'`,new-tab)"**

Fonte: [http://www.howtogeek.com/howto/ubuntu/set-gmail-as-default-mail-client-in-ubuntu/](http://www.howtogeek.com/howto/ubuntu/set-gmail-as-default-mail-client-in-ubuntu/)
