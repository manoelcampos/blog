---
author: admin
comments: true
layout: post
slug: free-shell-account-contas-de-shell-linuxfreebsd-gratuitas
title: 'Free Shell Account: Contas de Shell Linux/FreeBSD Gratuitas'
wordpress_id: 331
categories:
- Internet
- Linux
- Software Livre
tags:
- Alterar nome de usuário
- Conta de Shell Gratuitas
- Free Shell Account
- FreeBDS
- Linux
- ssh
- Unix
- usermod
- www.cjb.net
- www.rg3.net
---

Há muitos anos atrás, quando estava aprendendo a desenvolver pra web, utilizei alguns serviços gratuitos como [Hospedagem no Brinkster](http://www.brinkster.com) (veja no final da página do Brinkster sobre a hospedagem gratuita), que não tem mais prograganda e disponibiliza ASP.NET (e o antigo asp que usei no meu tempo) e "banco de dados" Microsoft Access. O problema era sempre passar o endereço do site pra alguém, por exemplo mcampos4831.brinkster.com era meio complicado, ainda mais por causa do brinkster (só soletrando). Assim, usei na época serviços de redirecionamento como o [www.cjb.net](http://www.cjb.net) e o [www.rg3.net](http://www.cjb.net). Estes serviços lhe permitem criar um endereço mais amigável que, ao ser acessado, redirecionam para um site real. O serviço não hospeda nada (apesar de o cjb atualmente permitir hospedagem gratuita), apenas redireciona para um outro endereço normalmente não amigável.

Onde quero chegar com isso é nas contas de shell baseado em Unix (Linux/FreeBDS) gratuitas. O motivo do rodeio é que recebi ontem um email do cjb.net informando sobre seu novo serviço de [Free Shell Account](http://www.cjb.net/shell.html). Você se cadastra e cria um usuário e senha para o servidor unix **shell.cjb.net**, que você acessa via ssh a partir de qualquer computador.

Como na própria página do serviço informa, "Uma conta de shell provê acesso para um shell unix baseado em texto que pode ser usado para muitos propósitos. Nossas contas de shell são ideais para aprender UNIX, programação, compilando e rodando programas, administração de redes e servidores e diagnósticos, acesso IRC e muito mais".

No Linux, você pode acessar o serviço a partir de um terminal, usando o comando ssh como: 
**ssh UrlOuIpDoServidor <-l NomeUsuario>**

Onde o nome do usuário é opcional. Se você não informar, será considerado que o nome do seu usuário no servidor é o mesmo do seu usuário local.

Por exemplo: 

    
    
    ssh shell.cjb.net -l manoelcampos
    



Se o seu nome de usuário local não for o mesmo do usuário remoto, o que lhe obriga a digitar -l NomeUsuario, você pode alterar seu nome de usuário local (ou mesmo alterar ou criar um usuário remoto com o nome do seu usuário local, o que nem sempre será possível, pois pode já ter outro usuário com o nome que você deseja) usando o comando usermod como: **usermod -l NovoNomeUsuario AntigoNomeUsuario**

Por exemplo:

    
    
    sudo usermod -l manoelcampos manoel
    



Agora, como meu nome de usuário local é manoelcampos, o mesmo do usuário remoto no shell.cjb.net,
basta eu digitar **ssh shell.cjb.net**, em um terminal, para acessar o serviço. Obviamente, a senha será solicitada em seguida.

Acredito que é um ambiente legal para testes e ideal para pessoas que estão aprendendo comandos unix ou programação em c, por exemplo, e que não tem acesso todo o tempo a um sistema UNIX para estudar. Desta forma, a partir do Windows, por exemplo, você pode acessar o serviço. Mas para isso, precisa baixar um cliente ssh como o [putty](http://www.chiark.greenend.org.uk/~sgtatham/putty/) (que é apenas um executável, sem instalador, super pequeno e bem simples) para poder acessar o serviço.

Mais informações sobre o serviço de shell account do cjb.net você encontra na [página de informações do serviço](http://www.cjb.net/shell.html). Para ver os outros serviços disponibilizados, acesse a [página inicial do site](http://www.cjb.net).
