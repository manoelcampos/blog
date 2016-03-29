---
author: admin
comments: true
layout: page
slug: enquete-para-tv-digital
title: Enquete para TVD
wordpress_id: 889
categories:
- Misc
---

## Introdução


Aplicação de enquete para TV Digital, desenvolvida em NCLua, com acesso a canal de interatividade, permite que o telespectador responda a uma enquete simples, enviando o voto para um servidor Web e obtendo o resultado da votação.


## Justificativa


Uma das grandes dificuldades relatadas pelos desenvolvedores NCL/Lua é a utilização da classe tcp de NCLua, que permite fazer conexões TCP. Assim, estou disponibilizando uma aplicação de enquete, que utiliza tal módulo, por intermédio da biblioteca tcp implementada pelo [Francisco da PUC-Rio](http://www.telemidia.puc-rio.br/~francisco/nclua/).


## Detalhes de implementação




(O vídeo disponibilizado possui licença Creative Commons e foi obtido [neste endereço](http://creativecommons.org/videos/wanna-work-together))

A aplicação envia uma requisição HTTP a uma página PHP em um servidor Web (por meio da biblioteca TCP disponibilizada no [tutorial de NCLua](http://www.telemidia.puc-rio.br/~francisco/nclua/tutorial/index.html)). Os votos são registrados em um arquivo de texto no servidor web. A página PHP retorna os dados da apuração dos votos como uma table Lua. Assim, os dados são retornados de forma estruturada, sendo lidos pela aplicação e exibidos na tela da TV.

A página PHP também está disponível no pacote zip para download.

**Pré-Requisitos**

É recomendado a utilização do [Ginga Virtual STB 0.11.2 rev 23 ou superior](http://www.softwarepublico.gov.br/ver-comunidade?community_id=1101545). A versão anterior do Ginga VSTB possuia algumas dificuldades para acesso à rede a partir da VM, normalmente necessitando de configurações na interface de rede da mesma.

Antes de usar a aplicação na VM, verifique se a mesma está acessando a rede local/internet (usando ping, telnet, wget, curl ou qualquer comando similar). Para isto, fundamentalmente, na tela inicial da VM deve ser exibido o IP da mesma. Caso não esteja conseguindo acesso à rede, tente alterar o modo da interface de rede da VM de bridge para NAT ou vice-versa (é necessário reiniciar a VM após tal alteração).


## Download


[Acesse a página do projeto no GitHub para fazer o download](http://github.com/manoelcampos/EnqueteTVD).


## Licença


[ ![](/files/by-nc-sa.png)
](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)


## Outros Projetos


Veja outros [projetos de TV Digital](http://manoelcampos.com/tvd/) aqui.

[catlist=259]
