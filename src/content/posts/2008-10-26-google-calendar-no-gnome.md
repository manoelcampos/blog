---
author: admin
comments: true
layout: post
slug: google-calendar-no-gnome
title: Google Calendar no Gnome
wordpress_id: 110
categories:
- Internet
- Linux
- Software Livre
tags:
- Evolution Mail
- Gnome
- Google Calendar
- Linux
---

Os serviços do Google como [Gmail](http://gmail.com) e [Google Calendar](http://calendar.google.com) são excelentes. Um recurso muito útil é permitir acessar seus eventos do Google Calendar a partir do seu Desktop no Gnome. No Ubuntu, a aplicação Evolution, um cliente de email, rss e agenda já vem instalada por padrão. Para permitir que você possa acessar sua agenda a partir dele, e visualizar a partir do relógio no System Tray do Gnome, você pode pegar o link para o seu calendário e adicionar no Evolution. Assim, acesse sua agenda em calendar.google.com, em minhas agendas, cliquem em Configurações. Na aba agendas, clique em uma agenda (normalmente tem apenas uma agenda com seu nome). Mais embaixo você tem as opções Endereços da Agenda e Endereço privado. Clique no botão ICAL para pegar o link para uma das agendas. O primeira é para a sua agenda pública, que você pode não ter definido nenhuma nas configurações do Google. O segunda é para a sua agenda privada.

Para mais informações sobre o formato ICAL, clique no link [Saiba Mais](http://www.google.com/support/calendar/bin/answer.py?answer=34578&hl=pt-BR).

Agora, abra um terminal e digite:

$ /usr/lib/evolution-webcal/evolution-webcal SUA_URL_ICAL

Com isto você adiciona sua agenda do Google ao Evolution. Você pode fazer o mesmo a partir da interface do Evolution, clicando no botão Novo  e escolhendo a opção Calendário, bastando apenas escolher a opção Gmail no campo Tipo e informar seu login e depois a senha do Gmail, simples assim.

Veja imagem da agenda no Ubuntu.

[caption id="attachment_113" align="alignnone" width="300" caption="Google Calendar no Gnome com Evolution Mail"][![Google Calendar no Gnome com Evolution Mail](http://manoelcampos.files.wordpress.com/2008/10/googlecalendar.png?w=300)](http://manoelcampos.files.wordpress.com/2008/10/googlecalendar.png)[/caption]

Provavelmente o [Mozilla Thunderbird](http://pt-br.www.mozilla.com/pt-BR/thunderbird/) e o Outlook/Outlook Express devem possuir este recurso.

Referência: [http://altinkaya.org/wp/linux/google-calendar-gnome/](http://altinkaya.org/wp/linux/google-calendar-gnome/)
