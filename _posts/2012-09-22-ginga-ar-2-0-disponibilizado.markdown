---
author: admin
comments: true
layout: post
slug: ginga-ar-2-0-disponibilizado
title: '#Ginga.ar 2.0 disponibilizado. #TVD #GingaNCL'
wordpress_id: 2707
categories:
- TV Digital
tags:
- Ginga
- Ginga.ar
- Ginga.ar 2.0
- GingaNCL
- Lua
- NCL
- VM
---

[![](http://manoelcampos.com/wp-content/uploads/gingaar.jpg)](http://manoelcampos.com/wp-content/uploads/gingaar.jpg)A comunidade Ginga argentina liberou a versão 2.0 da sua implementação de Ginga-NCL (único subsistema adotado pelo país).

O Ginga.ar é baseado na implementação de referência da PUC-Rio mas a versão 2.0 foi quase totalmente reescrita, tendo apenas 17% do código original da PUC, assim, temos realmente uma implementação diferente.

Além disto, a comunidade argentina desenvolveu uma suite de testes para verificar as funcionalidades da implementação, reduzindo o total de bugs.<!-- more -->

Um dos grandes benefícios desta versão é a completa implementação do módulo canvas de NCLua e a adição de um player HTML melhor, até com suporte a HTML5 (não sei qual browser usaram).

Informações muito úteis podem ser obtidas em [http://tvd.lifia.info.unlp.edu.ar/ginga.ar/index.php/noticias/29-anunciogingaar20](http://tvd.lifia.info.unlp.edu.ar/ginga.ar/index.php/noticias/29-anunciogingaar20)

O Ginga.ar pode ser baixado em [http://tvd.lifia.info.unlp.edu.ar/ginga.ar/index.php/download](http://tvd.lifia.info.unlp.edu.ar/ginga.ar/index.php/download), onde pode-se obter o código fonte e um arquivo vmdk para ser usado em uma máquina virtual. Tal arquivo representa o disco rígido para ser usado em uma VM.

É preciso criar a VM, usando o Virtual Box por exemplo, com as configurações que desejar.
Recomendo colocar bastante memória RAM (a partir de 512MB) e aumentar a memória de vídeo (para 128MB, por exemplo).
O arquivo vmdk deve ser anexado à VM para permitir que seja dado boot na VM por ele.

O usuário da VM é ginga e a senha ginga. Aplicações de exemplo são disponibilizadas no diretório ~/ginga.ar_2.0/apps
Para executar uma aplicação NCL, basta executar o comando a seguir no terminal:

[bash]$ ginga --ncl path/to/document.ncl[/bash]

Fiz poucos testes na VM, executando os exemplos disponibilizados (bem legais, diga-se de passagem).
Tem um joguinho bem legal, chamado sokoban, em NCL e Lua.

Um bug que detectei, existente também na implementação de referência (já relatado para as duas implementações) é que, ao separar as regiões e descritores em arquivos separados do documento NCL principal, as propriedades das regiões são ignoradas quando as mídias são adicionadas na aplicação.

Nos testes das aplicações disponibilizadas e de outras, a execução das mesmas foi bastante estável, não tendo travado em nenhum momento.

Não fiz testes com aplicações que usem o canal de interatividade (retorno). Tendo novidades, atualizo o post.
