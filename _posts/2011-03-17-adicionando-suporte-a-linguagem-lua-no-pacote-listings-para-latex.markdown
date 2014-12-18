---
author: admin
comments: true
layout: post
slug: adicionando-suporte-a-linguagem-lua-no-pacote-listings-para-latex
title: Destacando sintaxe de códigos Lua em Latex
wordpress_id: 2281
categories:
- Linux
- Software
- Software Livre
- TV Digital
tags:
- Destacar sintaxe
- Latex
- Linux
- Listings
- Lua
- Syntax Highlight
---

[![](http://manoelcampos.com/wp-content/uploads/lua-latex-150x150.png)](http://manoelcampos.com/wp-content/uploads/lua-latex.png)Bem, nunca falei de [![A document preparation system](http://manoelcampos.com/arquivos/latex.png)](http://www.latex-project.org/) antes aqui no blog, principalmente por falta de tempo e porque não sou um profundo conhecedor da ferramenta.

Mas como tenho usado muito a mesma, resolvi falar dela hoje. Vou mostrar uma dica bastante útil para programadores Lua que estejam no meio acadêmico e também usem [![A document preparation system](http://manoelcampos.com/arquivos/latex.png)](http://www.latex-project.org/) em trabalhos desta categoria.

O [![A document preparation system](http://manoelcampos.com/arquivos/latex.png)](http://www.latex-project.org/) possui um pacote denominado **listings** que permite destaquer a sintaxe de trechos de códigos fonte em diferentes linguagens. No entanto, o suporte à Linguagem Lua parece ainda não ser oficial<!-- more -->. Buscando na Web encontrei uma implementação de [Roland Smith](http://www.xs4all.nl/~rsmith/). Para usá-la, precisaremos baixar os fontes do pacote listings e adicionar tal suporte. Então vamos lá. Vou mostrar como fazer isso em linux. Estou utilizando o Ubuntu 10.10 já com [![A document preparation system](http://manoelcampos.com/arquivos/latex.png)](http://www.latex-project.org/) instalado.


## Instalação


Obs.: Se desejar baixar o pacote listings já com as modificações (inclusão de suporte à linguagem Lua e adição de 3 estilos), baixe o mesmo no final do post e siga os passos a partir do número 5.



	
  1. Primeiro baixe o arquivo [listings.zip](http://www.ctan.org/tex-archive/macros/latex/contrib/listings/) e descompacte em algum diretório.

	
  2. Baixe o arquivo [lua.def](http://www.xs4all.nl/~rsmith/software/lua.def) e salve no mesmo diretório onde descompactou o listings.zip. O arquivo é para o módulo listings 1.3 ou anterior.

	
  3. Abra o arquivo lua.def. Como o pacote listings baixado no link informado é a versão 1.4, precisaremos fazer uma pequena alteração neste arquivo. Procure o texto **lstdefinelanguage** e altere para **lst@definelanguage **(deixe a \ que existe no início da linha)
Copie todo o conteúdo deste arquivo.

	
  4. Abra o arquivo lstdrvrs.dtx. Este arquivo contém o código da definição do estilo de de destaque para cada linguagem suportada. Procure pelo texto **lst@definelanguage**.  Antes da linha onde ele for encontrado, cole o conteúdo copiado do arquivo lua.def e salve

	
  5. Agora, abra um terminal no diretório onde estão os arquivos do pacote descompactado e execute o comando **make **para compilar o mesmo

	
  6. Por fim, basta copiar os arquivo *.cfg e *.sty para o diretório /usr/share/texmf-texlive/tex/latex/listings (se o diretório não existir, crie).


Pode ser necessário executar o comando **texhash** para que o novo módulo seja reconhecido (não sei, mas por via das dúvidas, execute o mesmo).

Pronto, módulo instalado. Para usar é bem simples, no seu arquivo tex, inclua o pacote com o comando **\usepackage{listings}**.

Com o comando \lstset, que precisa ser chamado apenas uma vez (antes de você incluir um trecho de código fonte para ser destacado pelo módulo) você deve configurar o estilo da listagem de código. Veja exemplo abaixo:

[tex]
\lstset{
%Numeração de linhas à esquerda
numbers=left,

%Incrementa o número de linhas de 1 em 1
stepnumber=1,

%Número da primeira linha
firstnumber=1,

%Tamanho da numeração das linhas
numberstyle=\tiny,

extendedchars=true,
frame=none,
basicstyle=\footnotesize,
stringstyle=\ttfamily,
showstringspaces=false,
breaklines=true,
breakautoindent=true,

%Estilos de comentários de Lua para uma e várias linhas
morecomment=[l]{--},
morecomment=[s]{--[[}{--]]}}
[/tex]

Para destacar a sintaxe de um trecho de código Lua (nosso objetivo final), é bem simples, como mostrado a seguir:

[tex]
\begin{lstlisting}[[caption=Título do trecho de código, label=list:meu-codigo-lua, language=lua]]
--Inclua seu código Lua aqui
\end{lstlisting}
[/tex]

O atributo caption é para você definir um título para o seu trecho de código. Label define um rótulo que você pode usar para fazer referências a tal trecho de código com o comando \ref{nome-do-rotulo}, onde no exemplo, definimos como list:meu-codigo-lua.
Por fim, language=lua define que o código é em linguagem Lua (poderia ser Java, C e várias outras que já são padrões no módulo listings).

A imagem a seguir mostra um exemplo de como o código Lua ficará no PDF gerado a partir do tex.

[![](http://manoelcampos.com/wp-content/uploads/exemplo-codigo-lua-tex.png)](http://manoelcampos.com/wp-content/uploads/exemplo-codigo-lua-tex.png)
O pacote listings também suporta estilos de formatação (que funciona com qualquer linguagem). O colega [Renato Maia](http://www.inf.puc-rio.br/~maia/) deu uma grande contribuição disponibilizando três estilos que adicionei ao pacote: monochrome, colorful e numbered. No final deste artigo existe um arquivo zip com o pacote listings já com suporte à linguagem Lua e com tais temas incorporados, bastando instalar o mesmo.

Para usar algum tema é bem simples. Basta alterar a linha \begin{listings} do exemplo anterior para a linha mostrada abaixo:

[tex]
\begin{lstlisting}[[caption=Título do trecho de código, label=list:meu-codigo-lua, language=lua, style=colorful,style=numbered]]
[/tex]

Para usar o estilo colorful, é preciso adicionar o pacote color no seu documento tex. A figura a seguir mostra como o código ficará no PDF gerado a partir do documento tex.

[![](http://manoelcampos.com/wp-content/uploads/exemplo-codigo-lua-tex2.png)](http://manoelcampos.com/wp-content/uploads/exemplo-codigo-lua-tex2.png)

Então é isso, espero que seja útil.

[attachments size=custom title="Download" force_saveas="1" logged_users="0"]
