---
author: admin
comments: true
layout: post
slug: winsquid-proxy
title: WinSquid - Servidor Proxy para Windows
wordpress_id: 32
categories:
- Internet
- Software
- Windows
tags:
- Proxy
- Squid
- Windows
- WinSquid
---

O [Squid](http://www.squid-cache.org) é um [servidor proxy](http://pt.wikipedia.org/wiki/Proxy) para sistemas Linux/BSD bastante conhecido e utilizado. Não sou especialista em redes de computadores, mas entendo um pouco dessa área, até porque tenho a filosofia de que é preciso saber um pouco de tudo e muito de um pouco. Algumas das funções de um servidor proxy são: filtrar o conteúdo que chega da internet a uma rede local, fazer cache das páginas visitadas para aumentar a velocidade e otimizar a utilização da banda. A filtragem do conteúdo que chega da internet aos computadores de uma rede é utilizada para impedir o acesso à páginas indevidas, que não são permitidas pelas políticas de uma empresa, como páginas pornográficas, de vídeos ou pirataria. O [Squid](http://www.squid-cache.org) realiza este trabalho muito bem. Como não trabalho na área de redes, nunca tive a necessidade de utilizar tal tipo de software para as finalidades citadas.

Já tinha utilizado um servidor proxy freeware, bem simples, para Windows, o [AnalogX Proxy](http://www.analogx.com/CONTENTS/download/network/proxy.htm), apenas para compartilhar a conexão de internet de um modem ADSL bright (um modem roteador já possui um software nele que permite o compartilhamento da conexão).

O Squid possui versão para Windows. Ele conta com um instalador que automatiza a instalação, porém, apesar de ele permitir alterar o caminho de instalação, a versão que utilizei (não lembro qual o número) não funcionou em uma pasta diferente da padrão, pois os arquivos de configuração não foram alterados para o caminho que escolhi durante a instalação. Sorte que detectei o problema rápido e reinstalei usando a pasta padrão. Nunca tinha trabalhado com Squid na vida, mas rapidamente encontrei documentação mostrando [como configurar o servidor](http://www.visolve.com/squid/squid26/contents.php), especificamente na seção de [configuração do controle de acesso](http://www.visolve.com/squid/squid26/accesscontrols.php). Pelo jeito a configuração deve ser semelhante a do Squid no Linux/BSD. Em pouco tempo estava com o servidor proxy filtrando o conteúdo vindo da internet. De forma simples inclui-se as regras negando o acesso a páginas com conteúdo indesejado.

O problema que encontrei foi a necessidade de reiniciar o computador para que as novas regras passassem a ter efeito, pois pelos serviços do windows não é possível reiniciar o Squid (até para evitar que os usuários espertinhos façam isso). Não me preocupei em resolver isto pois estava com pressa, mas deve ter uma forma, e simples, de fazer isso. Testei e recomendo.
