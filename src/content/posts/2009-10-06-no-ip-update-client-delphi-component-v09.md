---
author: admin
comments: true
layout: post
slug: no-ip-update-client-delphi-component-v09
title: No-IP Update Client Delphi Component v0.9
wordpress_id: 669
categories:
- Delphi
tags:
- Delphi Component
- Dynamic DNS
- Get Real IP
- IP Update
- No-IP
- No-IP API
- No-IP Update Client
---

[![](http://manoelcampos.com.br/wp-content/uploads/no-ip.png)](http://manoelcampos.com.br/wp-content/uploads/no-ip.png)O No-IP Update Client Compoent é um componente para Delphi que implementa  a [API](http://www.no-ip.com/integrate/) do [No-IP](http://www.noip.com), um serviço de DNS  dinâmico.

Quem utiliza o serviço de DNS dinâmico do No-IP sabe da necessidade de instalação  do programa cliente No-IP no computador, 

um pequeno programa que fica executando em background  e detecta alterações no IP real da máquina, enviando o novo IP para os servidores  do No-IP, e assim fazendo com que o nome DNS que o usuário registrou no No-IP  (por exemplo manoelcampos.no-ip.org) seja redirecionado automaticamente  para o novo IP registrado.

Este recurso de DNS dinâmico pode ser útil para o desenvolvedor que possui  aplicações cliente/servidor como chat, administração remota, aplicações comerciais  com acesso a banco de dados remoto, ou qualquer sistema que ecessite fazer acesso  a um servidor remoto cujo o IP real não é fixo. As aplicações clientes precisam conhecer o IP ou nome DNS do servidor. Considerando que o IP do mesmo pode mudar, não é nada prático configurar o IP do servidor nas aplicações clientes. Nestes casos, o usuário deverá utilizar um nome de DNS para abstrair o número do IP.
Mas mesmo um DNS convencional está vinculado a um ou alguns números de IP específicos. Desta forma, os serviços de DNS dinâmicos, como o No-IP, resolvem este problema, vinculando dinamicamente o IP real de um servidor, a cada vez que o ele muda, a um nome DNS específico. Desta forma, as aplicações clientes podem utilizar um nome DNS
no lugar do endereço IP para se conectarem a um servidor.

Na [edição 13 da Revista Active Delphi](http://www.activedelphi.com.br/mostra_edicao.php?ed=13), por exemplo, foi demostrado como criar uma aplicação e configurar um modem ADSL para fazer acesso remoto a um banco Firebird. Logo, se você não possui um IP real fixo, pode utilizar os recursos do componente No-IP Update Client Component para automatizar o processo de atualização de IP no servidor do No-IP, sem necessitar instalar o programa cliente do No-IP.

Com o componente os desenvolvedores podem incluir esse recurso de atualização de IP, para os servidores de DNS dinâmico do No-IP, a partir de suas próprias aplicações.

O componente é OpenSource e foi testado apenas no Delphi 2007, mas pode funcionar sem problemas nas versões anteriores. O código do componente está comentado, possuindo documentação em HTML (apenas em inglês) e um diagrama de classes. Um projeto de exemplo também é provido juntamente com os fontes do componente.

Veja o arquivo readme.txt (somente em inglês) para mais algumas informações.
