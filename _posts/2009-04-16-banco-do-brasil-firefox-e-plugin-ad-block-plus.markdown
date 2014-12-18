---
author: admin
comments: true
layout: post
slug: banco-do-brasil-firefox-e-plugin-ad-block-plus
title: Banco do Brasil, Firefox e Plugin Ad Block Plus
wordpress_id: 347
categories:
- Internet
- Software
tags:
- Ad Block Plus
- Banco do Brasil
- Firefox
- Firefox Secure Mode
- NoScript
- plugins
---

[![](http://manoelcampos.com/wp-content/uploads/bb1-150x150.jpg)](http://manoelcampos.com/wp-content/uploads/bb1.jpg)Há alguns meses eu instalei o [Browser Opera](http://www.opera.com), simplesmente pelo fato de o meu Firefox no Ubuntu 8.10 travar sempre depois que eu digitava minha senha no teclado virtual do site do [Banco do Brasil](http://www.bb.com.br), e então entrada na página da minha conta, onde eram verificadas as configurações do computador, para saber se o eu estava acessando a partir de um computador cadastrado.

Bem, mas a experiência valeu para eu testar o Opera. No final das contas não gostei nada dele. O Firefox me pareceu bem mais rápido e legal devido à infinidade de plugins existentes e pela familiaridade que tenho com o mesmo. Só houveram duas coisas que gostei no Opera. A primeira foi a opção de links rápidos que aparece quando você abre uma nova aba, sendo mostrados vários quadrados, onde você pode configurar em cada um, uma das página que mais acessa. Assim, ao abrir uma nova aba, você terá um preview das páginas configuradas, pondendo acessar qualquer uma com apenas um clique. É um recurso de bookmarks com um acesso mais prático. A segunda opção que gostei foi a de navegação privada, já existente na versão beta do Firefox 3.1 (demorou), que vocês podem ver na notícia [deste link](http://oglobo.globo.com/tecnologia/mat/2008/09/12/firefox_3_1_tera_modo_de_navegacao_privada-548193518.asp), que apesar de ser do ano passado, ainda não temos este recurso na versão atual estável do Firefox (3.0.8).

Mas, como é de praxe, enrolei, enrolei e até agora o artigo não tem nada a ver com o título :). Mas isso tudo tem como motivo, o de contextualizar o leitor na história, até chegar no objetivo final.

Assim, depois de ter cansado de usar o Opera apenas para acessar o site do Banco do Brasil, resolvi procurar o motivo de o Firefox estar travando após eu digitar minha senha no teclado virtual. Inicialmente pensei que o problema era o Java, até baixei a versão mais nova, e criei um link simbólico para o plugin do mesmo para o Firefox, entrando no diretório /usr/lib/mozilla-firefox/plugins/ e executando o comando  ln -fs /usr/java/jre1.6.0_13/plugin/i386/ns7/libjavaplugin_oji.so libjavaplugin.so, que apaga o link anteriormente existente e cria um novo para a nova versão do JRE instalado.

A nova versão da JRE não mudou nada, logo, o problema não era o plugin do Java para o Firefox. Então pensei que o  poderia ser com algum os plugins adicionais que tinha instalado, assim, executei o Firefox pelo terminal, em modo seguro, executando o comando firefox -safe-mode, que desabilita todos os plugins. Em seguida, tentei acessar o site do [BB](http://www.bb.com.br), e não travou mais.

Assim, logo imaginei que o problema só poderia ser com o plugin [Ad Block Plus](http://adblockplus.org) ou o [NoScript](http://noscript.net/).
O Ad Block Plus é usado para bloquear prograganda, imagens indesejáveis, flash e outros elementos em páginas. O NoScript é usado para bloquear JavaScript, Java, Flash e outros. Os dois pra mim são indispensáveis, tornando a navegação mais segura e permitindo reduzir a poluição visual de alguns sites carregados de imagens e flash. Eles permitem que você habilite estes recursos somente para os sites que desejar.

Depois de ter filtrado os possíveis plugins que estavam causando problema, rodei o Firefox no modo normal e desabilitei o Ad Block Plus, e assim, ao reiniciar o Firefox e tentar acessar o site do BB, descobri que o problema estava neste plugin.
O grande porém, é que tanto no NoScript quanto no Ad Block Plus, os domínios do BB estavam habilitado para permitir tudo. Então, acessei as regras do Ad Block Plus e virifique que nas exceções (os sites liberados), o endereço principal do BB estava como https://www2.bancobrasil.com.br. Esta exceção foi criada quando tinha habilitado o site do BB, clicando no botão ABP do plugin, ao lado da barra de pesquisa, e escolhendo a opção "Disable on https://www2.bancobrasil.com.br", que era pra permitir o domínio inteiro, como funciona para outros sites, porém, para o BB não funcionou. Assim, a solução foi criar manualmente uma nova regra de exceção no plugin, adicionando o endereço https://www2.bancobrasil.com.br/*. Note o * no final, que indica que a regra deve valer para todas as páginas do domínio.

Assim, problema resolvido. Fica a dica aí.
