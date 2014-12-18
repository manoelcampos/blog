---
author: admin
comments: true
date: 2010-01-28 00:17:54+00:00
layout: page
slug: nclua-tweet
title: NCLua Tweet
wordpress_id: 792
categories:
- Misc
---

DEVIDO À MUDANÇAS NA API DO TWITTER, AUTENTICAÇÃO BÁSICA VIA HTTP NÃO ESTÁ MAIS SENDO SUPORTADA. ASSIM, A VERSÃO ATUAL DO APLICATIVO NÃO FUNCIONA. SERÁ VERIFICADA A POSSIBILIDADE DE IMPLEMENTAÇÃO DO PROTOCOLO DE AUTENTICAÇÃO OAUTH PARA PERMITIR ESTA NOVA FORMA DE AUTENTICAÇÃO REQUERIDA PELO TWITTER.


## Introdução


[![](http://manoelcampos.com/wp-content/uploads/2010/02/nclua-tweet.png)](http://manoelcampos.com/wp-content/uploads/2010/02/nclua-tweet.png)O NCLua Tweet é o primeiro cliente de Twitter para o Sistema Brasileiro de TV Digital (SBTVD), desenvolvido com as linguagens NCL e Lua, disponibilizado livremente. <del>A aplicação está em fase beta, e ainda há muito o que desenvolver. Mas a interface atual dá uma idéia de tudo o que será possível.</del> Pretendo atualizar a aplicação sempre que tiver um tempinho. Assim, fique de olha nesta página.

A aplicação atualmente <del>apenas</del> exibe as mensagens do timeline do usuário no Twitter, permite fazer retweets, ver as mensagens de um usuário específico e enviar tweets. O login e senha devem ser informados dentro do arquivo twitter.config.lua. Não se preocupou em criptografar os dados nesse arquivo. Assim, o usuário e a senha estarão em claro nesse arquivo (pelo menos por enquanto :)).



É utilizado o módulo [NCLua HTTP](http://ncluahttp.manoelcampos.com), que possui funções para envio de requisições HTTP, com a possibilidade de uso de [autenticação básica](http://en.wikipedia.org/wiki/Basic_access_authentication).

Como a [API do Twitter](http://apiwiki.twitter.com/) é baseada em HTTP ([REST](http://en.wikipedia.org/wiki/REST)) e retorna respostas em XML, foi necessário o uso do módulo LuaXML para trabalhar com arquivos XML, convertendo estes para tabelas lua, o que facilita imensamente a manipulação dos dados. A versão disponibilizada, atualizada para Lua 5.x, foi baseada em uma [implementação antiga do módulo LuaXML](http://lua-users.org/wiki/LuaXml), não compatível com tal versão de lua.

Outra necessidade foi a utilização da [biblioteca Entities2AccentedChars para converter códigos HTML de caracteres acentuados e especiais, para seus respectivos caracteres](http://lua-users.org/wiki/PhilippeLhoste), para que aparecesse na tela, os caracteres acentuados, e não seus códigos HTML. A biblioteca foi estendida para incluir [códigos HTML de caracteres para o charset ISO-8859-1](http://htmlguide.drgrog.com/alpha/isocodes.html), em formato como** &#195;** que representa **Ã** (sendo **&Atilde;** em código HTML). As mensagens do Twitter são todas codificadas em HTML no padrão ISO-8859-1.

Outro módulo implementado foi o config. Ele facilita o uso de arquivos lua como arquivos de configuração (uma das finalidades da linguagem lua). O módulo criado automatiza o processo de carregamento e salvamento de dados de configuração em arquivos lua.

Existe apenas um método implementado para acesso à [API REST do Twitter](http://apiwiki.twitter.com/), apesar de já ter um esqueleto para quase todos os métodos da mesma. O que há implementado da API foi feito de forma orientada a objetos. Assim, é necessário instanciar um objeto da classe Twitter para poder usar, como pode ser visto em main.lua.

Todo o código da aplicação, incluindo quase todos os módulos de terceiros e todos os módulos implementados, estão documentados. Toda a documentação está disponível na pasta doc, gerados com o [LuaDoc](http://luadoc.luaforge.net/).


## Pré-Requisitos


É recomendado a utilização do [Ginga Virtual STB 0.11.2 rev 23 ou superior](http://www.softwarepublico.gov.br/ver-comunidade?community_id=1101545). A versão anterior do Ginga VSTB possuia algumas dificuldades para acesso à rede a partir da VM, normalmente necessitando de configurações na interface de rede da mesma.

Antes de usar o NCLua Tweet na VM, verifique se a mesma está acessando a rede local/internet (usando ping, telnet, wget, curl ou qualquer comando similar). Para isto, fundamentalmente, na tela inicial da VM deve ser exibido o IP da mesma. Caso não esteja conseguindo acesso à rede, tente alterar o modo da interface de rede da VM de bridge para NAT ou vice-versa (é necessário reiniciar a VM após tal alteração).


## ARTIGO NO BLOG DA AOC


[Veja artigo sobre o NCLua Tweet no Blog da AOC.](http://www.ofuturoedigital.com.br/blog/2010/02/cliente-de-twitter-para-tv-digita-nclua-tweet/)


## BUGS CONHECIDOS


Na Ginga VM, dentro de um script NCLua, não estão sendo reconhecidas as teclas de função para simular os botões coloridas do controle remoto, é necessário associar outras teclas a estes botões. Assim, o seguinte mapeamento para eles é como segue:

Botão Vermelho (F1):   R, r
Botão Verde (F2): G, g
Botão Amarelo (F3): Y, y
Botão Azul (F4): B, b

Assim, executando a aplicação na Ginga VM, nas telas que permitem digitar texto, o uso das teclas **R**, **r**, **G**, **g**, **Y**, **y**, **B** e **b** pode fazer com que a aplicação exerça comportamento estranho. Por exemplo, se você tentar escrever a palavra _Yahoo_ na tela de envio de Tweet, verá que a aplicação se comportará de forma incorreta, pois o pressionamento da tecla **Y** representa o mesmo que o acionamento do botão amarelo (_Yellow_), para voltar à tela anterior. No entanto, não era esse o objetivo quando você pressionou **Y** para escrever a palavra _Yahoo_.

Em Set-top Boxes reais não há esse efeito colateral, no entanto, é necessário remover do código, dentro da função handler no arquivo main.lua, o tratamento destas letras.
[attachments size=custom orderby="id desc" title="Downloads" force_saveas="1" logged_users="0"]


## Licença


[ ](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)

[![](/files/by-nc-sa.png)](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)


## Doações


Suporte o desenvolvimento e melhorias no projeto. Faça uma doação.

![](https://www.paypal.com/pt_BR/i/scr/pixel.gif)



## Outros Projetos


Veja outros [projetos de TV Digital](http://manoelcampos.com/tvd/) aqui.

[catlist=259]
