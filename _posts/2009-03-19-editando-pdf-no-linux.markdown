---
author: admin
comments: true
layout: post
slug: editando-pdf-no-linux
title: Editando PDF no Linux
wordpress_id: 192
categories:
- Linux
- Software
- Software Livre
tags:
- editor de pdf
- editor de pdf no linux
- Linux
---

Recentemente, assistindo as aulas do meu curso de mestrado, tive a idéia de procurar um editor de PDF para que eu pudesse adicionar os meus comentários durante as aulas, diretamente no arquivo PDF das apresentações disponibilizadas pelos professores. Como vou pra aula sempre com o notebook, posso fazer isso em tempo real enquanto o professor fala.
Assim, fui buscar por um editor de PDF para linux. Achei um chamado [pdfedit](http://pdfedit.sourceforge.net), que pode ser baixado via apt-get no ubuntu. Instalei mas não consegui fazer nem o básico como queria, adicionar texto em um PDF. Até achei a ferramenta pra isso, mas o texto saia na vertical e não consegui mudar isso. Encontrei uma explicação para isso no [manual de usuário da ferramenta](http://pdfedit.petricek.net/user_doc.html), mas nenhuma solução de como resolver. Quando tentava usar uma opção de visualização das propriedades do texto adicionado, o programa dava pau e fechava.

Achei [neste site](http://www.cyberciti.biz/tips/open-source-linux-pdf-writer.html) outras opções. Vale a pena testar.

Encontrei também a ferramenta [PDF X-Change Viewer](http://www.docu-track.com/home/prod_user/PDF-XChange_Tools/pdfx_viewer/?act[69). É uma ferramenta gratuita para Windows. Das ferramentas desktop para Windows que testei, esta foi a com a melhor usabilidade. Existe na página uma versão portable que não necessita de instalação, basta descompactar e usar. Consegui rodar no Ubuntu com o [Wine](http://www.winehq.org/) instalado. Ele tem um recurso para digitar texto livremente no PDF e outro para criar uma caixa de texto que permite colocar textos em múltiplas linhas de forma fácil, em um único objeto. Estava tudo indo muito bem, até eu salvar o PDF, fechar e abrir novamente. Ao reabrir o PDF, os textos adicionados ficavam invisíveis. Só depois de clicar duas vezes no texto que ele aparecia em preto (e o fundo era branco mesmo), mas ao sair, o texto voltava pra branco. Outro problema foi quando tentei abrir o PDF alterado em leitores de PDF padrão como o Acrobat e o Document Viewer no Ubuntu, deu erro na abertura.

A ferramenta [Okular](http://okular.kde.org/) (para KDE) promete fazer isso, mas no Ubuntu (que usa Gnome), pelo menos comigo, os menus não apareciam. Muito tempo depois descobri que o problema é que ele abria em tela cheia (pressionei ctrl+shift+f para voltar ao normal). O mesmo problema ocorria com o editor kate rodando no Gnome. Bem, depois de ter encontrado a barra de ferramentas para edição, tudo funcionou bem, mas o pdf alterado não abria mais em nenhum visualizador de pdf padrão (tentei no acrobat e no Document Viewer do Gnome), o que pra mim foi um grande ponto negativo.

Por fim, depois de muita busca, encontrei uma ferramenta que realmente funcionou. O [Xournal](http://xournal.sourceforge.net/), uma ferramenta para Gnome que permitiu realmente adicionar anotações em um PDF, porém, as alterações são salvas num arquivo separado, com extensão xoj, que abre com o Xournal, e assim, resolveu todos os problemas. Se depois você quiser gerar um novo PDF, ele tem uma opção para exportar o arquivo xoj para PDF. Um amigo instalou e não conseguiu adicionar notas em nenhum PDF. Eu estava editando os PDF's normalmente, até que, do nada, ao reabrir o arquivo xoj gerado por ele, os comandos de edição não funcionavam. Apenas depois de reiniciar o x server com ctrl+alt+backspace voltou a funcionar. Mas o problema persistiu posteriormente. Encontrei uma possível solução [nesse post aqui](https://bugs.launchpad.net/ubuntu/+source/wacom-tools/+bug/195953). Eu baixei o arquivo [wacom-tools_0.7.9.8.orig.tar.gz](http://launchpadlibrarian.net/12959835/wacom-tools_0.7.9.8.orig.tar.gz) ([ou pode baixar aqui](http://manoelcampos.xpg.com.br/wacom-tools_0.7.9.8.orig.tar.gz)), descompactei, configurei, compilei e instalei, com os comandos abaixo executados num terminal (estando na pasta onde baixou o arquivo):
_tar -zxvf wacom-tools_0.7.9.8.orig.tar.gz
cd wacom-tools-0.7.9.8/
./configure
make
sudo make install
_
Reiniciei o servidor x e voltou a funcionar, temporariamente. Acho que foi no [post citado acima](https://bugs.launchpad.net/ubuntu/+source/wacom-tools/+bug/195953), que comentaram sobre uma opção XInput que deveria ser desabilitada, mas não tinha entendido como desabilitar isso. Fuçando no programa encontrei a bendita opção que no menu Options do Xournal. Desabilitei a opção "Use XInput" e instantaneamente consegui voltar a editar o PDF.

Achei o site [www.pdfescape.com](http://www.pdfescape.com) que possui uma aplicação Web para edição de PDF's online, com menus e barras de ferramentas, bem legal, e funciona mesmo.
