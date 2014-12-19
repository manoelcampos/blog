---
author: admin
comments: true
layout: post
slug: configurando-um-servidor-para-envio-de-email-no-moodle
title: Configurando um servidor para envio de email no Moodle
wordpress_id: 2731
categories:
- Linux
- Moodle
- Software
- Software Livre
tags:
- Email
- GMail
- Mail Server
- Moodle
- Postfix
---

Atualmente muitas instituições têm utilizado servidores de email externos (como do Google) no lugar de instalar, configurar e manter um servidor na sua rede.

No entanto, muitos destes servidores impõem um limite diário para envio de emails. Usando o Moodle, facilmente este limite é atingido (que no caso do Gmail é de 500 emails/dia).

Além disto, o envio de emails usando uma conta do Google tem outras [restrições](http://docs.moodle.org/23/en/Email_setup_gmail) como não aceitar que seja utilizado o email do usuário que acessou o Moodle como remetente da mensagem. Isto pode ser resolvido, mas requer [alterações no código fonte do Moodle](http://tracker.moodle.org/browse/MDL-26283) (pelo menos até a versão 2.2).


--more Leia Mais--


Assim, para resolver estes problemas, segue um breve tutorial mostrando como configurar um servidor de email postfix, em um servidor Linux Ubuntu, para realizar o envio de emails a partir do Moodle.


## Instalação e Configuração


Instale o postfix. Utilize as opções padrões durante a instalação.

[bash]sudo apt-get install postfix[/bash]

Configure o php para indicar que temos um servidor de email local.
Substitua o remetente@meudomio.com pelo email que utilizará como remetente das mensagens.

[bash]
cd /etc/php5/conf.d/
sudo echo "sendmail_from = remetente@meudomio.com" > mailconfig.ini
sudo echo "sendmail_path = /usr/sbin/sendmail -t -i -f remetente@meudomio.com" >> mailconfig.ini
[/bash]

Observe que nos comandos acima, é incluído o caminho do sendmail, no entanto,
tal aplicativo é apenas um wrapper do postfix para fazê-lo funcionar como o sendmail, 
aceitando os mesmos parâmetros que o sendmail.

Agora vamos alterar algumas configurações do postfix.
Para isto, abra o arquivo com o comando abaixo:

[bash]sudo pico /etc/postfix/main.cf[/bash]

Em myhostname, coloque o domínio pelo qual o servidor de email responderá.
Em mydestination, não deve haver o nome do seu domínio na lista.

Se o seu domínio estiver nesta lista, ao tentar enviar um email, o postfix verificará se o destinatário possui uma conta de usuário
no sistema local. Como este servidor não hospeda as contas de email de fato (ele apenas despachará os emails desejados), isto causará erro e os email's não serão enviados, retornando a mensagem "Recipient address rejected: User unknown in local recipient table". Desta forma, deixe tal variável da seguinte forma:

[bash]mydestination = localhost.localdomain, localhost[/bash]


## Configurações no Moodle


Nas configurações de email do Moodle, basta deixar tudo vazio que ele utilizará o servidor de email local.


## Testando o envio de email pelo terminal


Para testar o envio de email pelo terminal, execute o comando de exemplo abaixo:

[bash]echo "Corpo da mensagem." | mail -s "Assunto" email@destino.com[/bash]

Se ao tentar enviar o email você receber o erro "postdrop: warning: unable to look up public/pickup: No suck file or directory", isto indica que você está com o sendmail rodando. Então, será preciso finalizar o mesmo e realizar alguns comandos, como mostrado a seguir:

[bash]
sudo mkfifo /var/spool/postfix/public/pickup
sudo killall -9 sendmail
sudo /etc/init.d/postfix restart
[/bash]

Se o email de teste, usando o comando mostrado anteriormente, não chegar na sua caixa de entrada,
verifique se não foi para o Spam.
Caso a mensagem não chegue, mesmo não ocorrendo o erro relatado acima, o sendmail
pode estar executando no lugar do postfix. Assim, execute os 3 comandos anteriores
para matar o sendmail e iniciar o postfix.



## Referências


[Kyle Goslin's Blog ](http://kylegoslin.wordpress.com/2012/06/05/116/)
[Server Fault ](http://serverfault.com/questions/179419/postfix-recipient-address-rejected-user-unknown-in-local-recipient-table)
[Data Basically](http://databasically.com/2009/12/02/ubuntu-postfix-error-postdrop-warning-unable-to-look-up-publicpickup-no-such-file-or-directory/)
