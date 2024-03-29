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

O acesso à internet vai depender de assinatura de um serviço, assim como acontece com internet ADSL ou 3G ou usando uma rede local, com ou sem fio, existente na sua residência.

## Transmissão e Recepção

Para recepção de sinal de TV Digital na sua casa, você precisará de um equipamento chamado [Set-Top-Box (STB)](http://pt.wikipedia.org/wiki/Set-top_box), o conhecido Conversor Digital, um aparelho com formato e tamanho semelhante ao de um DVD Player. Ele é responsável por receber e decodificar o sinal digital. Esses sinais são recebidos na faixa de frequência UHF (Ultra High Frequence), assim você precisará de uma antena UHF também. Os canais digitais são diferentes dos canais analógicos. As emissoras transmitirão dois sinais. Logo, existirá, por exemplo, um canal para receber a Globo em formato analógico, e outro canal para receber em formato digital. Isto é chamado de transmissão [Simulcast (Simultaneos Broadcast)](http://en.wikipedia.org/wiki/Simulcast).

A capacidade da transmissão digital de ser muito menos sujeita a interferência é devida ao fato do uso de modulação digital no sinal de TV. Os dados dos canais (imagem, som, programas aplicativos) são enviados em forma binária (zeros e uns) por meio de ondas de rádio, por um processo denominado modulação digital. Esse processo transforma os bits (zeros e uns), que representam um vídeo de um canal de TV, em uma onda para ser transmitida pelo ar. Se a onda sofrer pequenas alterações, isso não vai interferir na interpretação do sinal, permitindo demodulá-lo e recuperar o vídeo que ela transporta.

> Exemplo de uma onda de rádio, usada para transmitir sinal de TV, tanto digital quanto analógico.

![](http://upload.wikimedia.org/wikipedia/commons/8/8c/Standing_wave.gif)

A onda de rádio, como pode ser observado na figura a seguir, tem amplitudes positivas e negativas.

> Exemplo de onda de rádio - Sinais positivos e negativos ao longo do comprimento da onda

![](https://upload.wikimedia.org/wikipedia/commons/1/13/Sine_Cosine_Graph.png)

A onda pode sofrer distorções, pois como ela é transportada pelo ar, está sujeita,  por exemplo, a interferências climáticas. Porém um sinal digital transmitido por essa onda, sofre menos com essas interferências, que deformam a mesma. A figura anterior mostra um modelo teórico de um formato de onda perfeito. 

Com um vídeo modulado de forma digital para transmissão, essas deformações não interferem, pois o sinal acima do eixo X (positivo) pode representar um bit 1, e o sinal abaixo do eixo x (negativo) pode representar um bit zero. Isso depende da técnica de modulação usada. Esse foi um exemplo básico para entender porque a onda modulada digitalmente não é normalmente prejudicada por interferências. Além do mais, em sistemas digitais, podem existir algoritmos de Forward Error Correction - FEC, ou seja, correção de erro no destino, onde bits corrompidos são corrigidos ao chegarem no conversor digital. Uma forma de detectar erros é com a utilização de [checksum](http://pt.wikipedia.org/wiki/Checksum) com algoritmos de [hash](http://pt.wikipedia.org/wiki/Hash) como [MD5](http://pt.wikipedia.org/wiki/MD5). No caso da transmissão analógica, são transmitidos muito mais dados numa onda de rádio, num trecho como mostrado nas figuras acima. Assim, se a onda sofre deformação, muito mais informações são perdidas, acarretando chuviscos e fantasmas na imagem.

## Sistema Brasileiro de TV Digital

O [Sistema Brasileiro de TV Digital - SBTVD](http://forumsbtvd.org.br) foi baseado no sistema japonês [ISDB](http://pt.wikipedia.org/wiki/ISDB), um dos poucos existentes pelo mundo. O padrão mais conhecido e utilizado é o padrão europeu [Digital Video Broadcast - DVB](http://pt.wikipedia.org/wiki/DVB).

## O Ginga

A interatividade depende da inclusão de um [middleware](http://pt.wikipedia.org/wiki/Middleware) nos STBs. Este é um software que faz interface entre o sistema operacional dos [Set-Top-Boxes - STB](http://pt.wikipedia.org/wiki/Set-top_box) (os aparelhos para recepção de sinal digital, como já comentado), e as aplicações, abstraindo o tipo de hardware e sistema operacional do equipamento, o que permite que as aplicações geradas se tornem independentes destes, que podem variar de fabricante para fabricante.

O middleware do Sistema Brasileiro é denominado [Ginga](http://www.ginga.org.br/), tendo grande parte sido desenvolvida no Brasil, com muitas inovações na área de interatividade, em relação a outros middlewares. Ele possui a capacidade de comunicação com diversos dispositivos usando tecnologia Bluetooth, Wi-Fi, Infravermelho e outras, como pode ser visto no [artigo Ginga-J: The Procedural Middleware for the Brazilian Digital TV System](https://doi.org/10.1007/BF03192401), o que é um grande diferencial no Sistema Brasileiro. Isso permite a comunicação com aparelhos como celulares, smartphones e [PDAs](http://pt.wikipedia.org/wiki/PDA) para funcionarem como dispositivos de entrada, trocar informações ou receber conteúdo de TV nesses dispositivos.

Cada um dos padrões de TVD pelo mundo possui seu próprio middleware para execução de aplicações. No caso do sistema europeu DVB, o middleware se chama [Multimedia Home Plataform - MHP](http://en.wikipedia.org/wiki/Multimedia_Home_Platform) e a maioria dos middlewares existentes possuem certa compatibilidade com esse sistema. O Ginga  também possui certa compatibilidade com o sistema europeu.

O sistema operacional embarcado nos STBs com Ginga são baseados em Linux. Um sub-sistema do Ginga, chamado [Ginga-NCL](http://www.gingancl.org.br/), permite a utilização da linguagem [NCL](http://www.ncl.org.br/), criada no Brasil, para desenvolvimento de aplicações interativas. Ela é baseada na linguagem XML e permite a construção de aplicações interativas com sincronismo de mídias, como por exemplo, sincronismo entre um vídeo e uma legenda, ideal para profissionais da área de [edição de vídeo não linear](http://www.cybercollege.com/port/tvp056.htm), que não tem conhecimento de programação. Como a linguagem [NCL](http://www.ncl.org.br/) permite somente a construção de aplicações estáticas, o [Ginga-NCL](http://www.gingancl.org.br/) inclui também a linguagem 
[Lua](http://www.lua.org), desenvolvida pela [PUC-Rio](http://www.puc-rio.br/), que trabalha em conjunto com a linguagem [NCL](http://www.ncl.org.br/), para permitir a construção de aplicações procedurais com a possibilidade de exibir conteúdos dinâmicos.

A linguagem Lua se tornou muito conhecida e utilizada mundialmente, principalmente para o desenvolvimento de jogos como o [World of Warcraft](http://pt.wikipedia.org/wiki/World_of_Warcraft) e [SimCity](http://pt.wikipedia.org/wiki/SimCity). A [Lucas Arts](http://www.lucasarts.com), uma das grandes empresas da área de entretenimento, utiliza a linguagem Lua para a construção de jogos. O motivo do grande sucesso da linguagem é que á mesma é uma linguagem interpretada, extremamente leve e poderosa. Em Linux, o interpretador Lua tem apenas 153KB,  [como informado no site oficial](http://www.lua.org/about.html). Um tutorial sobre programação de jogos em Lua pode ser encontrado nesse [link da PUC-Rio](http://www.tecgraf.puc-rio.br/~lhf/ftp/doc/wjogos04.pdf).

Os programas (scripts interpretados) desenvolvidos usando NCL e Lua são denominados scripts [NCLua](http://www.telemidia.puc-rio.br/~francisco/nclua/).

Além das linguagem [NCL](http://www.ncl.org.br/) e Lua, é possível construir aplicações em Java, utilizando um sub-sistema do [Ginga](http://www.ginga.org.br/), chamado [Ginga-J](http://www.ginga.org.br/), que incorpora algumas bibliotecas da linguagem Java. Inicialmente pretendia-se utilizar a biblioteca [JavaTV](https://www.oracle.com/java/technologies/javameoverview.html), para haver compatibilidade do SBTVD com outros padrões de TV Digital, como o europeu DVB. No entanto, devido à problemas com pagamento de royalties para a antiga Sun (hoje Oracle), detentora dos direitos do [Java](http://www.java.com) e JavaTV, decidiu-se, em acordo entre o [Fórum do SBTVD](http://www.forumsbtvd.org.br/) e a empresa, pelo desenvolvimento de uma nova biblioteca chamada JavaDTV.

## Desenvolvimento de Aplicações

Os desenvolvedores podem utilizar algumas ferramentas livres. Para desenvolvimento com a linguagem NCL, existe a ferramenta [Composer](http://composer.telemidia.puc-rio.br), que está completamente obsoleta, mas uma nova versão está em desenvolvimento. A ferramenta é mais voltada para iniciantes em NCL ou pessoas que não possuem conhecimento em linguagens de programação, pois NCL é uma linguagem de marcação,  como a XML. O Composer permite a construção de aplicações interativas utilizando um editor [WYSIWYG](http://pt.wikipedia.org/wiki/WYSIWYG), da mesma forma como os famosos editores HTML.

Já para quem é programador e tem um conhecimento maior na linguagem NCL, é recomendável o uso do [NCLEclipse](http://www.telemidia.puc-rio.br/~roberto/ncleclipse/pt-br/start), um plugin para o ambiente de desenvolvimento Eclipse. Este é um excelente plugin e está atualizado com as normas ABNT do Ginga-NCL.

Para desenvolvimento em Lua, existe o plugin [LuaEclipse](https://github.com/jasonsantos/LuaEclipse) ou mais recentemente o [Lua Development Tools (LDT)](https://www.eclipse.org/ldt/).

Para testar as aplicações NCL/Lua desenvolvidas existem alguns opções como o Ginga Virtual STB, Ginga4Linux e Ginga4Windows, [disponíveis aqui](http://www.gingancl.org.br/pt-br/ferramentas). O primeiro é uma máquina virtual (VM) para VMWare, que necessita que as aplicações a serem testadas, sejam transferidas via SSH para a VM, mas é o ambiente mais utilizado para testes. Os dois últimos são implementações nativas do Ginga para Linux e Windows, não necessitando uma máquina virtual.

Para aplicações em JavaDTV, existia o [OpenGinga](http://www.openginga.org), uma implementação do sub-sistema Ginga-J. Os desenvolvedores não liberaram uma versão compilada do projeto (pelo menos não até a data em que foi elaborado este artigo). Assim, é necessário compilar os fontes do mesmo em um sistema operacional Linux.

## Padrão de codificação de vídeo

O formato de codificação dos vídeos transmitidos no [SBTVD](http://sbtvd.cpqd.com.br) é o [MPEG-4](http://pt.wikipedia.org/wiki/MPEG4), também conhecido como MPEG-4 Part 10, MPEG-4 AVC (Advanced Video Coding) ou H.264, que permite uma maior compressão de dados em relação ao [MPEG-2](http://pt.wikipedia.org/wiki/MPEG-2).

O Sistema Brasileiro permite transmissão de diversos formatos de vídeo, sendo eles o Low Definition-LD, Standard Definition-SD e High Definition-HD.

O formato LD permite vídeos de resolução de 320x180, por exemplo. O SD é a definição padrão, cuja resolução pode ser de 720 x 480 ou 640 x 480, dependendo da emissora. Esta é a resolução semelhante a de um DVD. O HD já é a tão falada alta definição, tendo resolução a partir de 1280x720.

O formato HD tem o aspecto de 16x9, ou seja, widescreen. O formato SD, apenas na resolução de 720x480 tem aspecto 16x9. No formato 640x480 o aspecto é 4x3.

## TV's com conversor digital (Set-Top-Box) embutido

Atualmente já estão sendo vendidos aparelhos de TV com conversor digital (Set-Top-Box) embutido. Uma grande desvantagem que vejo nisso é quanto a atualização do middleware nesse conversor. Se não houver uma forma de isso ser feito, para você poder ficar em dia com os novos recursos de interatividade desenvolvidos para o Ginga, terá que trocar a TV inteira. Algumas opções de atualização do middleware podem ser disponibilizadas. Por exemplo, o usuário pode baixar a atualização do site do fabricante, salvar num pendrive e conectar por uma porta USB no seu conversor digital, caso ele tenha uma porta USB, obviamente.

## Conversores Digitais (Set-Top-Boxes, STB)

A [Proview](http://www.proviewbr.com.br/) já está vendendo seu conversor digital XPS-1000. Algumas empresas como a TQTVD e a RCASoft desenvolveram uma implementação do Ginga. A RCASoft já está vendendo seu middleware, que é compatível, por enquanto, apenas com o Conversor Digital da Proview.

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

Porém, você pode comprar um dispositivo USB Full Seg, que utiliza os 12 segmentos para transmissão de conteúdo, e receber o sinal SD ou HD, como já explicado. Encontrei apenas dois dispositivos destes. O PixelView PlayTV USB SBTVD (Full-Seg) e o [Evolute TV Way+](http://www.evolutepc.com.br/produtos_tv-way.aspx), este último criado pela Evolute, uma empresa brasileira.

Esses dispositivos vem com um software, somente para Windows :(, com algumas funções de [Digital Video Record - DVR](http://pt.wikipedia.org/wiki/DVR), que podem permitir ao usuário gravar, agendar gravação, pausar e retroceder um programa de TV, mesmo transmitido ao vivo. A gravação de vídeo pode ser em um formato proprietário, que não permite a distribuição do mesmo. Alguns programas protegidos por direitos autorais, por meio de sistema de [Digital Rights Management- DRM](http://pt.wikipedia.org/wiki/Drm), não poderão ser gravados. O recurso de pausa usa o disco rígido do computador para armazenar localmente o programa transmitido, permitindo que o usuário não perca nenhuma parte do seu programa, e possa com isso, ter o recurso de retroceder o vídeo.

Os dois dispositivos citados possuem controle remoto, uma antena retrátil de baixa sensibilidade, e uma antena externa de alta sensibilidade. Esta última pode ser utilizada em locais onde o sinal de TV é fraco. Eles já possuem recurso de exibição do [Eletronic Program Guide - EPG](http://en.wikipedia.org/wiki/Electronic_program_guide), o guia de programação eletrônica, que permite ao usuário ver, a partir do controle remoto, qual a programação de um determinado canal, para a semana toda, por exemplo, além de escolha do idioma e legenda (recurso depende de disponibilização da operadora de TV).

A taxa de frames (quadros de imagem) por segundo que o dispositivo suporta é algo importante a ser observado. No caso dos citados, eles suportam a taxa de 30fps, o padrão do Sistema Brasileiro.

Outro ponto muito importante a ser observado antes da compra de um dispositivo USB destes, é a configuração de hardware necessária para executar bem o programa de exibição dos canais de TVD. Quanto maior a resolução de exibição, um computador mais potente será necessário. É importante observar isso, para depois você não ter uma decepção em descobrir que o dispositivo não funciona bem no seu antigo Pentium 2 com 128MB de RAM, onde o vídeo engasga a todo momento. Somente os computadores e notebook mais modernos permitem imagens em alta definição de até 1920x1080.

Infelizmente, os drivers e softwares desses dispositivos USB são apenas para Windows. Não fiz uma busca para saber qual a compatibilidade deles com Linux. Os fabricantes nunca se preocupam com os usuários do Linux, no máximo com os do Mac OS, mas a comunidade de software livre sempre desenvolve alternativas.

ATUALIZADO: A Placa de Captura Externa Visus USB TV Stick Extreme, promete TV Digital em alta definição, no PC ou Notebook.

## O Sistema Brasileiro em outros Países

O Sistema Brasileiro trouxe muitas inovações, que só lendo as normas ABNT para detalhar. A transmissão em Low Definition para dispositivos móveis já incorporado no sistema foi uma delas. Essas inovações fizeram com que o middleware do Sistema Brasileiro, o Ginga, recebesse respeito pelos países do Mercosul. O Peru já decidiu pela utilização do Sistema Brasileiro. A Argentina, Venezuela e o Chile já estão em processo de negociação com o Brasil para a adoção do Ginga.

## Inclusão Digital

Uma das propostas do Sistema Brasileiro de TV Digital é propiciar a inclusão digital. Com a TVD, podemos ter aplicações de [e-learning](http://pt.wikipedia.org/wiki/E-learning) a partir da TV, aparelho existente em 92% das casas dos brasileiros, como mostrou pesquisa do IBGE de 2007, informada [nessa matéria](http://www1.folha.uol.com.br/folha/dinheiro/ult91u355724.shtml). Porém, essa proposta do governo é muito bonita e louvável, se não permanecer apenas no papel. Como já mencionado, o acesso à internet a partir da TV só será possível com o pagamento de uma mensalidade, como em qualquer outro serviço de internet como [ADSL](http://pt.wikipedia.org/wiki/ADSL) e [3G](http://pt.wikipedia.org/wiki/3G).

## Término das Transmissões Analógicas

Como foi previsto pelo governo, as transmissões analógicas serão finalizadas em 2016, ano em que toda a área do Brasil deve ter acesso ao sinal de TV Digital. Depois dessa data, quem não tiver adquirido um conversor digital ou TV com conversor embutido, não terá mais como assistir TV. Porém, nos Estados Unidos, que já possuem transmissão de TV Digital há muitos anos, o término das transmissões analógicas estava previsto para esse ano (2009). O presidente Barack Obama sugeriu a extensão desse prazo, pois percebeu-se que a TVD não chegou à casa de todos os norte-americanos. O calendário de implantação da TVD, elaborado pelo Ministério das Comunicações, está acelerado. Vamos torcer para em 2016 todos as TVs do Brasil já estejam recebendo o sinal digital.

## Links

* [Blog for Digital TV (Em português)](http://b4dtv.blogspot.com/)
* [Ginga DF](http://gingadf.com.br/)
* [Fórum SBTVD](http://www.forumsbtvd.org.br/)
* [Middleware Ginga](http://www.ginga.org.br)

## Livros sobre o Assunto
	
* [Programando em NCL 3.0: Desenvolvimento de Aplicações para Middleware Ginga, TV Digital e Web. Luiz Fernando Gomes Soares, Simone Diniz Junqueira Barbosa](http://comissoes.sbc.org.br/ce-ihc/livro/programando-em-ncl-3-0/?lang=en)
* [TV Digital.Br: Conceitos e Estudos sobre o ISDB-Tb. Valdecir Becker, S. Squirra](https://www.amazon.com.br/Digital-Br-Conceitos-Estudos-Sobre-ISDB-Tb/dp/857480455X)
* [TV Digital Interativa: Conceitos, desafios e perspectivas para o Brasil. Valdecir Becker e Carlos Montez.](https://www.gingadf.com.br/blogGinga/ebook-gratis-tv-digital-interativa-conceitos-desafios-e-perspectivas-para-o-brasil/)
* Televisão Digital Interativa: reflexões, sistemas e padrões, Guido Lemos e Edna Brennand.
* Interactive TV Standards. Steven Morris & Anthony Smith-Chaigneau.
* ITV Handbook - Technologies and Standards. Edward M. Schwalb.

## Iniciando no Desenvolvimento de Aplicações para TVD

Quer começar a desenvolver aplicações para TV Digital? Veja o artigo [Como estruturar o ambiente de desenvolvimento Ginga NCL](https://rafaelcarvalho.tv/como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl/) no blog do Rafael Carvalho. 

Alguns projetos estão disponíveis aqui no meu blog, no menu [Projetos TVD](http://manoelcampos.com.br/tvd/). Pequenas aplicações de exemplo podem ser encontradas na [Categoria TV Digital](http://manoelcampos.com.br/category/tv-digital/).

--
por Manoel Campos da Silva Filho
Professor do [Instituto Federal de Educação, Ciência e Tecnologia do Tocantins - IFTO](http://www.ifto.edu.br)
[Mestre em Engenharia Elétrica](http://www.ene.unb.br/) pela [Universidade de Brasília](http://www.unb.br), na área de TV Digital.
