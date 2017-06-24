---
author: admin
comments: true
layout: post
slug: tv-digital-do-basico-ao-avancado-caracteristicas-aparelhos-transmissao-linguagens-e-muito-mais
title: 'TV Digital - Do básico ao avançado: Características, aparelhos, transmissão, linguagens e muito mais'
wordpress_id: 406
categories:
- TV Digital
tags:
- Características
- Conversor Digital
- DRM
- EPG
- Gigna NCL Emulator
- Ginga
- Ginga Live CD
- Ginga Mercosul
- Ginga Virtual STB
- Ginga-J
- Ginga-NCL
- HD
- High Definition
- ISDB
- JavaDTV
- JavaTV
- LCD
- Lua
- MHP
- Middleware
- MPEG-4
- NCL
- OLED
- OpenGinga
- Plasma
- Recepção
- Receptor TV Digital USB
- Receptor TV Digital USB Full Seg
- SBTVD
- Set-Top-Box
- Transmissão
- Transmissão Analógica
- Transmissão Digital
- TV Digital
---

## Introdução 
Semana passada iniciaram as transmissões de TV Digital aqui em Brasília, depois de muita enrolação, pois estavam pretendendo [criar uma nova torre de TV, a partir de um projeto do Oscar Niemeyer](http://www.telesintese.ig.com.br/index.php?option=com_content&task=view&id=11654&Itemid=105). Só sei que a Globo foi a primeira a transmitir, com sinal digital de [alta definição (HD)](http://pt.wikipedia.org/wiki/Alta_defini%C3%A7%C3%A3o), alguns programas como jogos de futebol e a novela das oito (ou seria das nove ??? :-) ).

Um dos grandes benefícios da TV Digital (TVD) , além de alta qualidade de imagem e som e inexistência de interferências como fantasmas e chuviscos, é a tão falada interatividade, que permitirá que você tenha programas, jogos e até mesmo acesso à internet a partir da sua TV. 

--more--

Para se ter uma idéia das possibilidades, até mesmo o [sistema de compartilhamento de arquivos via torrent está sendo implementando para TVD, por uma universidade holandesa](http://info.abril.com.br/noticias/tecnologia-pessoal/torrent-na-tv-promete-matar-mininova-15042009-35.shl).

O acesso à internet vai depender de assinatura de um serviço, assim como acontece com internet ADSL ou 3G ou usando uma rede local, com ou sem fio, existente na sua residência.

## Transmissão e Recepção

Para recepção de sinal de TV Digital na sua casa, você precisará de um equipamento chamado [Set-Top-Box (STB)](http://pt.wikipedia.org/wiki/Set-top_box), o conhecido Conversor Digital, um aparelho com formato e tamanho semelhante ao de um DVD Player. Ele é responsável por receber e decodificar o sinal digital. Esses sinais são recebidos na faixa de frequência UHF (Ultra High Frequence), assim você precisará de uma antena UHF também. Os canais digitais são diferentes dos canais analógicos. As emissoras transmitirão dois sinais. Logo, existirá, por exemplo, um canal para receber a Globo em formato analógico, e outro canal para receber em formato digital. Isto é chamado de transmissão [Simulcast (Simultaneos Broadcast)](http://en.wikipedia.org/wiki/Simulcast).

A capacidade da transmissão digital de ser muito menos sujeita a interferência é devida ao fato do uso de modulação digital no sinal de TV. Os dados dos canais (imagem, som, programas aplicativos) são enviados em forma binária (zeros e uns) por meio de ondas de rádio, por um processo denominado modulação digital. Esse processo transforma os bits (zeros e uns), que representam um vídeo de um canal de TV, em uma onda para ser transmitida pelo ar. Se a onda sofrer pequenas alterações, isso não vai interferir na interpretação do sinal, permitindo demodulá-lo e recuperar o vídeo que ela transporta.

[Exemplo de uma onda de rádio, usada para transmitir sinal de TV, tanto digital quanto analógico](http://upload.wikimedia.org/wikipedia/commons/8/8c/Standing_wave.gif)

A onda de rádio, como pode ser observado na figura a seguir, tem amplitudes positivas e negativas.

[Exemplo de onda de rádio - Sinais positivos e negativos ao longo do comprimento da onda](http://puredata.files.wordpress.com/2007/07/sinoidal.png)

A onda pode sofrer distorções, pois como ela é transportada pelo ar, está sujeita,  por exemplo, a interferências climáticas. Porém um sinal digital transmitido por essa onda, sofre menos com essas interferências, que deformam a mesma. A figura anterior mostra um modelo teórico de um formato de onda perfeito. Na figura a seguir, podemos ver um exemplo de uma onda deformada.

[Onda de rádio deformada](http://www.phdrep.com.br/images/senoide4.jpg)

Com um vídeo modulado de forma digital para transmissão, essas deformações não interferem, pois o sinal acima do eixo X (positivo) pode representar um bit 1, e o sinal abaixo do eixo x (negativo) pode representar um bit zero. Isso depende da técnica de modulação usada. Esse foi um exemplo básico para entender porque a onda modulada digitalmente não é normalmente prejudicada por interferências. Além do mais, em sistemas digitais, podem existir algoritmos de Forward Error Correction - FEC, ou seja, correção de erro no destino, onde bits corrompidos são corrigidos ao chegarem no conversor digital. Uma forma de detectar erros é com a utilização de [checksum](http://pt.wikipedia.org/wiki/Checksum) com algoritmos de [hash](http://pt.wikipedia.org/wiki/Hash) como [MD5](http://pt.wikipedia.org/wiki/MD5). No caso da transmissão analógica, são transmitidos muito mais dados numa onda de rádio, num trecho como mostrado nas figuras acima. Assim, se a onda sofre deformação, muito mais informações são perdidas, acarretando chuviscos e fantasmas na imagem.

## Sistema Brasileiro de TV Digital

O [Sistema Brasileiro de TV Digital - SBTVD](http://sbtvd.cpqd.com.br) foi baseado no sistema japonês [ISDB](http://pt.wikipedia.org/wiki/ISDB), um dos poucos existentes pelo mundo. O padrão mais conhecido e utilizado é o padrão europeu [Digital Video Broadcast - DVB](http://pt.wikipedia.org/wiki/DVB).

## O Ginga

A interatividade depende da inclusão de um [middleware](http://pt.wikipedia.org/wiki/Middleware) nos STBs. Este é um software que faz interface entre o sistema operacional dos [Set-Top-Boxes - STB](http://pt.wikipedia.org/wiki/Set-top_box) (os aparelhos para recepção de sinal digital, como já comentado), e as aplicações, abstraindo o tipo de hardware e sistema operacional do equipamento, o que permite que as aplicações geradas se tornem independentes destes, que podem variar de fabricante para fabricante.

O middleware do Sistema Brasileiro é denominado [Ginga](http://www.ginga.org.br/), tendo grande parte sido desenvolvida no Brasil, com muitas inovações na área de interatividade, em relação a outros middlewares. Ele possui a capacidade de comunicação com diversos dispositivos usando tecnologia Bluetooth, Wi-Fi, Infravermelho e outras, como pode ser visto no [artigo Ginga-J: The Procedural Middleware for the Brazilian Digital TV System](https://www.sbc.org.br/bibliotecadigital/?module=Public&action=PublicationObject&subject=306&publicationobjectid=67), o que é um grande diferencial no Sistema Brasileiro. Isso permite a comunicação com aparelhos como celulares, smartphones e [PDAs](http://pt.wikipedia.org/wiki/PDA) para funcionarem como dispositivos de entrada, trocar informações ou receber conteúdo de TV nesses dispositivos.

Cada um dos padrões de TVD pelo mundo possui seu próprio middleware para execução de aplicações. No caso do sistema europeu DVB, o middleware se chama [Multimedia Home Plataform - MHP](http://en.wikipedia.org/wiki/Multimedia_Home_Platform) e a maioria dos middlewares existentes possuem certa compatibilidade com esse sistema. O Ginga  também possui certa compatibilidade com o sistema europeu.

O sistema operacional embarcado nos STBs com Ginga são baseados em Linux. Um sub-sistema do Ginga, chamado [Ginga-NCL](http://www.gingancl.org.br/), permite a utilização da linguagem [NCL](http://www.ncl.org.br/), criada no Brasil, para desenvolvimento de aplicações interativas. Ela é baseada na linguagem XML e permite a construção de aplicações interativas com sincronismo de mídias, como por exemplo, sincronismo entre um vídeo e uma legenda, ideal para profissionais da área de [edição de vídeo não linear](http://www.cybercollege.com/port/tvp056.htm), que não tem conhecimento de programação. Como a linguagem [NCL](http://www.ncl.org.br/) permite somente a construção de aplicações estáticas, o [Ginga-NCL](http://www.gingancl.org.br/) inclui também a linguagem 
[Lua](http://www.lua.org), desenvolvida pela [PUC-Rio](http://www.puc-rio.br/), que trabalha em conjunto com a linguagem [NCL](http://www.ncl.org.br/), para permitir a construção de aplicações procedurais com a possibilidade de exibir conteúdos dinâmicos.

A linguagem Lua se tornou muito conhecida e utilizada mundialmente, principalmente para o desenvolvimento de jogos como o [World of Warcraft](http://pt.wikipedia.org/wiki/World_of_Warcraft) e [SimCity](http://pt.wikipedia.org/wiki/SimCity). A [Lucas Arts](http://www.lucasarts.com), [uma das grandes empresas da área de entretenimento, utiliza a linguagem Lua para a construção de jogos, como pode ser visto nessa matéria aqui](http://www.inovacao.unicamp.br/report/news-lua.shtml). O motivo do grande sucesso da linguagem é que á mesma é uma linguagem interpretada, extremamente leve e poderosa. Em Linux, o interpretador Lua tem apenas 153KB,  [como informado no site oficial](http://www.lua.org/about.html). Um tutorial sobre programação de jogos em Lua pode ser encontrado nesse [link da PUC-Rio](http://www.tecgraf.puc-rio.br/~lhf/ftp/doc/wjogos04.pdf).

Os programas (scripts interpretados) desenvolvidos usando NCL e Lua são denominados scripts [NCLua](http://www.telemidia.puc-rio.br/~francisco/nclua/).

Além das linguagem [NCL](http://www.ncl.org.br/) e Lua, é possível construir aplicações em Java, utilizando um sub-sistema do [Ginga](http://www.ginga.org.br/), chamado [Ginga-J](http://www.ginga.org.br/), que incorpora algumas bibliotecas da linguagem Java. Inicialmente pretendia-se utilizar a biblioteca [JavaTV](http://java.sun.com/javame/technology/javatv/), para haver compatibilidade do SBTVD com outros padrões de TV Digital, como o europeu DVB. No entanto, devido à problemas com pagamento de [royalties](http://pt.wikipedia.org/wiki/Royalties) para a [Sun Microsystems](http://www.sun.com/), detentora dos direitos do [Java](http://www.java.com) e [JavaTV](http://java.sun.com/javame/technology/javatv/), decidiu-se, em acordo entre o [Fórum do SBTVD](http://www.forumsbtvd.org.br/) e a [Sun](http://www.sun.com),  pelo desenvolvimento de uma nova biblioteca chamada JavaDTV ([matéria na Sun](http://br.sun.com/sunnews/press/2009/20090417.jsp) e no [Fórum SBTVD](http://www.forumsbtvd.org.br/materias.asp?id=75)).

Foram veiculadas na mídia algumas notícias incorretas sobre a definição do [Ginga-J](http://www.ginga.org.br/) (o Ginga com a parte de [JavaTV](http://java.sun.com/products/javatv/)/[JavaDTV](http://www.forumsbtvd.org.br/materias.asp?id=75)), onde os jornalistas não tinham muito conhecimento técnico da área, e acabaram confundindo alguns termos, chamando, por exemplo, o Ginga-J de middleware do Sistema Brasileiro, sendo que este é apenas uma parte do Ginga.

[Uma matéria mais técnica sobre o JavaDTV pode ser vista aqui](http://www.overmedianetworks.com.br/noticia-overmedia-liberacao-java-dtv.html).
[Outra sobre Ginga-NCL e Ginga-J pode ser vista aqui.](http://www.convergenciadigital.com.br/cgi/cgilua.exe/sys/start.htm?infoid=18353&query=simple&search_by_authorname=all&search_by_field=tax&search_by_keywords=any&search_by_priority=all&search_by_section=&search_by_state=all&search_text_options=all&sid=54&text=pai+ginga)

## Desenvolvimento de Aplicações

Os desenvolvedores podem utilizar algumas ferramentas livres. Para desenvolvimento com a linguagem NCL, existe a ferramenta [Composer](http://www.ncl.org.br/ferramentas.html), que está completamente obsoleta, mas uma nova versão está em desenvolvimento. A ferramenta é mais voltada para iniciantes em NCL ou pessoas que não possuem conhecimento em linguagens de programação, pois NCL é uma linguagem de marcação,  como a XML. O Composer permite a construção de aplicações interativas utilizando um editor [WYSIWYG](http://pt.wikipedia.org/wiki/WYSIWYG), da mesma forma como os famosos editores HTML.

Já para quem é programador e tem um conhecimento maior na linguagem NCL, é recomendável o uso do [NCLEclipse](http://laws.deinf.ufma.br/~ncleclipse), um plugin para o ambiente de desenvolvimento Eclipse. Este é um excelente plugin e está atualizado com as normas ABNT do Ginga-NCL.

Para desenvolvimento em Lua, existe também um excelente plugin para Eclipse, o [LuaEclipse](http://luaeclipse.luaforge.net/).

Para testar as aplicações desenvolvidas existem alguns emuladores, como o [Ginga NCL Emulator](http://www.gingancl.org.br/ferramentas.html), o [Ginga Virtual STB](http://www.gingancl.org.br/ferramentas.html) e o [Ginga Live CD](http://www.gingancl.org.br/ferramentas.html), para aplicações em NCL e Lua. O primeiro é um pequeno programa que permite a execução direta de aplicações em NCL, em ambiente Windows, Mac e Linux, mas também está completamente obsoleto. O segundo é uma máquina virtual (VM) para VMWare, que necessita que as aplicações a serem testadas, sejam transferidas via SSH para a VM, mas é o ambiente mais utilizado para testes. O terceiro é um distribuição em CD, que não necessita de instalação, e pode ser executada em qualquer PC, dando boot no sistema direto do CD. É um ambiente com interface mais amigável, possuindo funcionalidades bastante úteis para usuários finais, como o carregamento de aplicações NCL/Lua a partir de PenDrives.

O laboratório de TV Digital Interativa da [Universidade de Brasília](http://www.unb.br) foi o primeiro a desenvolver um Ginga NCL Live CD, mas que não chegou a ser disponibilizado. O mesmo foi apresentado no evento [I2TS](http://www.i2ts.org/) 2009, na Universidade Federal de Santa Catarina, em [Florianópolis](http://www.ufsc.br/).

Para aplicações em JavaDTV, existe o [OpenGinga](http://www.openginga.org), uma implementação do sub-sistema Ginga-J. Os desenvolvedores não liberaram uma versão compilada do projeto (pelo menos não até a data em que foi elaborado este artigo). Assim, é necessário compilar os fontes do mesmo em um sistema operacional Linux. Como este processo de compilação é extremamente extenso e complicado, liberei uma [máquina virtual para VirtualBox, contendo, tanto a implementação do OpenGinga quanto do Ginga-NCL](http://manoelcampos.com.br/2010/01/28/virtualbox-vm-gingancl-0112-openginga-beta-1/).

[Alguns projetos que desenvolvi podem ser acessados aqui.](/tvd)

## Padrão de codificação de vídeo

O formato de codificação dos vídeos transmitidos no [SBTVD](http://sbtvd.cpqd.com.br) é o [MPEG-4](http://pt.wikipedia.org/wiki/MPEG4), também conhecido como MPEG-4 Part 10, MPEG-4 AVC (Advanced Video Coding) ou H.264, que permite uma maior compressão de dados em relação ao [MPEG-2](http://pt.wikipedia.org/wiki/MPEG-2).

O Sistema Brasileiro permite transmissão de diversos formatos de vídeo, sendo eles o Low Definition-LD, Standard Definition-SD e High Definition-HD.

O formato LD permite vídeos de resolução de 320x180, por exemplo. O SD é a definição padrão, cuja resolução pode ser de 720 x 480 ou 640 x 480, dependendo da emissora. Esta é a resolução semelhante a de um DVD. O HD já é a tão falada alta definição, tendo resolução a partir de 1280x720.

O formato HD tem o aspecto de 16x9, ou seja, widescreen. O formato SD, apenas na resolução de 720x480 tem aspecto 16x9. No formato 640x480 o aspecto é 4x3.

## TV's LCD/Plasma com conversor digital (Set-Top-Box) embutido

Atualmente já estão sendo vendidos aparelhos de TV LCD ou plasma com conversor digital (Set-Top-Box) embutido. Uma grande desvantagem que vejo nisso é quanto a atualização do middleware nesse conversor. Se não houver uma forma de isso ser feito, para você poder ficar em dia com os novos recursos de interatividade desenvolvidos para o Ginga, terá que trocar a TV inteira. Algumas opções de atualização do middleware podem ser disponibilizadas. Por exemplo, o usuário pode baixar a atualização do site do fabricante, salvar num pendrive e conectar por uma porta USB no seu conversor digital, caso ele tenha uma porta USB, obviamente.

Discussões sobre quem é melhor: LCD ou Plasma, estão fora do escopo deste artigo. Já li algumas matérias a respeito bem interessantes. Mas recentemente li uma que informava que não existem mais grandes diferenças, não lembro mais onde li esse artigo. Mas pelo que me consta, a TV de plasma ainda consome mais energia que a LCD. O problema de [Dead Pixel (Pixel Morto)](http://pt.wikipedia.org/wiki/Pixel_morto) existente nessas TVs também parece ter sido superado. Mas para quem não sabe, já aviso que há uma nova tecnologia disponível no mercado, ainda cara, chamada [OLED - Organic Light-Emitting Diode (Diodo Orgânico de Emissão de Luz)](http://pt.wikipedia.org/wiki/Oled), além das já um tanto conhecidas TVs de LED.

Mais informações sobre LCD x Plasma podem ser encontradas no [blog da TV Globo Digital](http://www.tvglobodigital.com/blog/2009/10/15/plasma-ou-lcd-ou-led-ou-oled-ou-tv-de-tubo-qual-a-melhor-opca-do-momento/) e [nesse blog](http://gingadf.blogspot.com/2009/02/como-escolher-uma-hdtv.html). Excelentes vídeos e artigos também podem ser vistos no olhar digital, [neste link](http://olhardigital.uol.com.br/links/video_wide.php?id_conteudo=8065) e [neste](http://olhardigital.uol.com.br/central_de_videos/video_wide.php?id_conteudo=7119).

## Conversores Digitais (Set-Top-Boxes, STB)

A [Proview](http://www.proviewbr.com.br/) já está vendendo seu conversor digital XPS-1000. <del>O mesmo não possui nenhuma implementação do Ginga, o middleware (software) necessário para permitir interatividade na TV Digital.</del> Algumas empresas como a [TQTVD](http://www.tqtvd.com.br/) e a [RCASoft](http://www.rcasoft.com.br/) desenvolveram uma implementação do Ginga. [A RCASoft já está vendendo seu middleware, que é compatível, por enquanto, apenas com o Conversor Digital da Proview](http://www.rcasoft.com.br/midd_instal.php)<del>, e precisa ser instalado manualmente</del>.

O conversor Proview XPS-1000 possui uma porta USB 2.0, para conexão de dispositivos como teclado e mouse. Como tem-se apenas uma porta, será necessário um Hub USB para poder conectar os dois dispositivos. Possui ainda uma RJ 45 para conexão a uma rede local cabeada, do tipo Ethernet, permitindo que as aplicações interativas de TVD possam fazer acesso à internet. Infelizmente o conversor não permite conexão com redes Wireless.

Abaixo algumas especificações do conversor:

- Recepção com resolução máxima de 1920x1080
- Saída HDMI 1080i para conexão com outros dispositivos digitais como um leitor/gravador de DVD/Blu Ray
- Interface ethernet de 100Mbs para conexão a uma rede local cabeada, permitindo acesso à internet
- Porta USB 2.0 para conexão de dispositivos como mouse, teclado, pendrive e outros
- Atualização do software (middleware) via USB
- EPG (Guia de Programação Eletrônica) para você poder ver a programação do dia, semana ou mês inteiro do canal
- Controle remoto
- Proteção parental (controle de conteúdo) para broquear canais desejados
- Navegação na internet com mini browser e acesso remoto a cliente/servidor via VNC

## Dispositivos USB para Recepção de TV Digital

Depois da notícia do início das transmissões de TV Digital aqui em Brasília, como falei no início do artigo, fui logo procurar um dispositivo USB para receber sinal de TV Digital no meu notebook. Assim, se você pretende comprar um destes adaptadores, é bom conhecer antes as especificações, para não comprar gato por lebre.

Primeiramente, se você espera receber TV de alta definição no seu notebook ou desktop, usando um desses dispositivos, é preciso tomar cuidado, pois a grande maioria, na faixa de preço entre R$100,00 e R$150,00, permitem transmissão apenas em formato Low Definition-LD, que é o formato apropriado para dispositivos móveis como celulares, de telas reduzidas e baixo poder de processamento. Esses dispositivos exibem imagens de resolução em torno de 320x180 pixels, semelhante ao tamanho de um vídeo do YouTube, sem ter como redimensionar nem pôr em tela cheia. Estes são classificados como dispositivos [One Seg (1-Seg)](http://en.wikipedia.org/wiki/1seg), ou seja, utilizam apenas 1 segmento dos 13 disponibilizados para cada canal de TV para transmissão de conteúdo. Os canais de TV fixa utilizam 12 desses 13 segmentos, deixando um disponível para transmissão para dispositivos móveis. Assim, a [largura de banda](http://pt.wikipedia.org/wiki/Largura_de_banda) disponibilizada para transmissão de conteúdo para dispositivos móveis é bem restrita, devido a isto, a qualidade é extremamente inferior a dos outros formatos de vídeo como SD e HD.

Porém, você pode comprar um dispositivo USB Full Seg, que utiliza os 12 segmentos para transmissão de conteúdo, e receber o sinal SD ou HD, como já explicado. Encontrei apenas dois dispositivos destes. O [PixelView PlayTV USB SBTVD (Full-Seg)](http://www.pixelview.com.br/play_tv_usb_sbtvd_fullseg.asp) e o [Evolute TV Way+](http://www.evolutepc.com.br/produtos_tv-way.aspx), este último criado pela Evolute, uma empresa brasileira.

O artigo [Pixelview - TV Digital USB em ALTA DEFINIÇÃO](http://www.forumpcs.com.br/coluna.php?b=246862) mostra mais detalhes do receptor da Pixelview.

Esses dispositivos vem com um software, somente para Windows :(, com algumas funções de [Digital Video Record - DVR](http://pt.wikipedia.org/wiki/DVR), que podem permitir ao usuário gravar, agendar gravação, pausar e retroceder um programa de TV, mesmo transmitido ao vivo. A gravação de vídeo pode ser em um formato proprietário, que não permite a distribuição do mesmo. Alguns programas protegidos por direitos autorais, por meio de sistema de [Digital Rights Management- DRM](http://pt.wikipedia.org/wiki/Drm), não poderão ser gravados. O recurso de pausa usa o disco rígido do computador para armazenar localmente o programa transmitido, permitindo que o usuário não perca nenhuma parte do seu programa, e possa com isso, ter o recurso de retroceder o vídeo.

Os dois dispositivos citados possuem controle remoto, uma antena retrátil de baixa sensibilidade, e uma antena externa de alta sensibilidade. Esta última pode ser utilizada em locais onde o sinal de TV é fraco. Eles já possuem recurso de exibição do [Eletronic Program Guide - EPG](http://en.wikipedia.org/wiki/Electronic_program_guide), o guia de programação eletrônica, que permite ao usuário ver, a partir do controle remoto, qual a programação de um determinado canal, para a semana toda, por exemplo, além de escolha do idioma e legenda (recurso depende de disponibilização da operadora de TV).

A taxa de frames (quadros de imagem) por segundo que o dispositivo suporta é algo importante a ser observado. No caso dos citados, eles suportam a taxa de 30fps, o padrão do Sistema Brasileiro.

Outro ponto muito importante a ser observado antes da compra de um dispositivo USB destes, é a configuração de hardware necessária para executar bem o programa de exibição dos canais de TVD. Quanto maior a resolução de exibição, um computador mais potente será necessário. É importante observar isso, para depois você não ter uma decepção em descobrir que o dispositivo não funciona bem no seu antigo Pentium 2 com 128MB de RAM, onde o vídeo engasga a todo momento. Somente os computadores e notebook mais modernos permitem imagens em alta definição de até 1920x1080.

Infelizmente, os [drivers](http://en.wikipedia.org/wiki/Device_driver) e softwares desses dispositivos USB são apenas para Windows. Não fiz uma busca para saber qual a compatibilidade deles com Linux. Os fabricantes nunca se preocupam com os usuários do Linux, no máximo com os do Mac OS, mas a comunidade de software livre sempre desenvolve alternativas.

ATUALIZADO: A [Placa de Captura Externa Visus USB TV Stick Extreme](http://www.visustv.com/images/PRD/prd01.html), promete TV Digital em alta definição, no PC ou Notebook.

Mais informações sobre receptores USB de TV Digital podem ser encontrados no [Blog da TV Globo Digital](http://www.tvglobodigital.com/noticias/ler/geral/guia_do_one_seg_conheca_os_receptores_moveis_e_portateis_de_t_v_digital/59).

## O Sistema Brasileiro em outros Países

O Sistema Brasileiro trouxe muitas inovações, que só lendo as normas ABNT para detalhar. A transmissão em Low Definition para dispositivos móveis já incorporado no sistema foi uma delas. Essas inovações fizeram com que o middleware do Sistema Brasileiro, o Ginga, recebesse respeito pelos países do Mercosul. [O Peru já decidiu pela utilização do Sistema Brasileiro. A Argentina, Venezuela e o Chile já estão em processo de negociação com o Brasil para a adoção do Ginga](http://www.telesintese.ig.com.br/index.php?option=com_content&task=view&id=11684&Itemid=105).

## Inclusão Digital

Uma das propostas do Sistema Brasileiro de TV Digital é propiciar a inclusão digital. Com a TVD, podemos ter aplicações de [e-learning](http://pt.wikipedia.org/wiki/E-learning) a partir da TV, aparelho existente em 92% das casas dos brasileiros, como mostrou pesquisa do IBGE de 2007, informada [nessa matéria](http://www1.folha.uol.com.br/folha/dinheiro/ult91u355724.shtml). Porém, essa proposta do governo é muito bonita e louvável, se não permanecer apenas no papel. Como já mencionado, o acesso à internet a partir da TV só será possível com o pagamento de uma mensalidade, como em qualquer outro serviço de internet como [ADSL](http://pt.wikipedia.org/wiki/ADSL) e [3G](http://pt.wikipedia.org/wiki/3G). <del>Desta forma, se o governo não subsidiar o acesso à internet para essas pessoas, a inclusão digital ficará apenas no discurso.</del>

Mas esta realidade está prestes a mudar, pelo menos um pouco, se aprovado o Plano Nacional de Banda Larga (PNBL).
Mais informações nos links abaixo:

[ http://www.planejamento.gov.br/secretarias/upload/Arquivos/noticias/gerais/100505_banda_Larga.pps](http://www.planejamento.gov.br/secretarias/upload/Arquivos/noticias/gerais/100505_banda_Larga.pps)
[http://www.mc.gov.br/images/pnbl/o-brasil-em-alta-velocidade1.pdf](http://www.mc.gov.br/images/pnbl/o-brasil-em-alta-velocidade1.pdf)

## Término das Transmissões Analógicas

Como foi previsto pelo governo, as [transmissões analógicas serão finalizadas em 2016](http://www.abert.org.br/n_clipping_2.cfm?noticia=110046), ano em que toda a área do Brasil deve ter acesso ao sinal de TV Digital. Depois dessa data, quem não tiver adquirido um conversor digital ou TV com conversor embutido, não terá mais como assistir TV. Porém, nos Estados Unidos, que já possuem transmissão de TV Digital há muitos anos, o término das transmissões analógicas estava previsto para esse ano (2009). O presidente Barack Obama [sugeriu a extensão desse prazo](http://www.convergenciadigital.com.br/cgi/cgilua.exe/sys/start.htm?infoid=17351&sid=8), pois percebeu-se que a TVD não chegou à casa de todos os norte-americanos. O calendário de implantação da TVD, elaborado pelo Ministério das Comunicações, está acelerado. Vamos torcer para em 2016 todos as TVs do Brasil já estejam recebendo o sinal digital. Neste [link do site oficial da TV Digital Brasileira](http://www.dtv.org.br/materias.asp?menuid=3&id=11), é possível ver as cidades que já possuem o sinal digital e o calendário de implantação.

## Links

* [Artigo super interessante sobre TV Digital, com informações técnicas, mas também básicas para qualquer usuário](http://webinsider.uol.com.br/index.php/2009/03/18/tv-digital-no-ar-recepcao-ou-decepcao/)
* [Dez coisas que você precisa saber sobre TVD (Antigo, mas útil, apenas algumas previsões já se tornaram realidade)](http://www.tvdigital.blog.br/2007/12/05/10-coisas-que-voce-precisa-saber-sobre-a-tv-digital/)
* [Blog for Digital TV (Em português)](http://b4dtv.blogspot.com/)
* [Ginga DF](http://gingadf.com.br/)
* [Grupo de Pesquisa em TV Digital Interativa da UCPel](http://www.tvdi.inf.br/)
* [Sistema Brasileiro de TV Digital - SBTVD](http://sbtvd.cpqd.com.br)
* [Fórum SBTVD](http://www.forumsbtvd.org.br/)
* [Middleware Ginga](http://www.ginga.org.br)
* [TV Digital Detalhada Lançamento do SBTVD](http://www.hxd.com.br/site/index.php?option=com_content&task=view&id=18&Itemid=69t)

## Livros sobre o Assunto
	
* [Desenvolvimento de Aplicações para Middleware Ginga, TV Digital e Web. Luiz Fernando Gomes Soares, Simone Diniz Junqueira Barbosa](http://www.elsevier.com.br/site/produtos/Detalhe-produto.aspx?tid=3826&seg=6&isbn=9788535234572&cat=269&origem=)
* [TV Digital.Br: Conceitos e Estudos sobre o ISDB-Tb. Valdecir Becker, S. Squirra](http://www.atelie.com.br/shop/detalhe.php?id=484)
* [TV Digital Interativa: Conceitos, desafios e perspectivas para o Brasil. Valdecir Becker e Carlos Montez. ](http://www.tvdigitalinterativa.ufsc.br/sumario.htm)
* Televisão Digital Interativa: reflexões, sistemas e padrões, Guido Lemos e Edna Brennand.
* Interactive TV Standards. Steven Morris & Anthony Smith-Chaigneau.
* ITV Handbook - Technologies and Standards. Edward M. Schwalb.

## Iniciando no Desenvolvimento de Aplicações para TVD

Quer começar a desenvolver aplicações para TV Digital? Veja o artigo [Como estruturar o ambiente de desenvolvimento Ginga NCL](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl) no blog da empresa [Peta5](http://www.peta5.com.br). 

Alguns projetos estão disponíveis aqui no meu blog, no menu [Projetos TVD](http://manoelcampos.com.br/tvd/). Pequenas aplicações de exemplo podem ser encontradas na [Categoria TV Digital](http://manoelcampos.com.br/category/tv-digital/).

--
por Manoel Campos da Silva Filho
Professor do [Instituto Federal de Educação, Ciência e Tecnologia do Tocantins - IFTO](http://www.ifto.edu.br)
[Mestre em Engenharia Elétrica](http://www.ene.unb.br/) pela [Universidade de Brasília](http://www.unb.br), na área de TV Digital.
