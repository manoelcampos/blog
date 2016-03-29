---
author: admin
comments: true
layout: post
slug: alternativas-para-matlab-no-linux
title: Alternativas para MatLab no Linux
wordpress_id: 249
categories:
- Linux
- Programação
- Software
- Software Livre
- Windows
tags:
- AlternativeTo.net
- Linux
- Mac
- MatLab
- Matrizes
- Octave
- QtOctave
- SciLab
- Windows
---

Bem, mais um semestre começa no mestrado em Engenharia Elétrica na [UnB](http://www.unb.br). Esse semestre estou cursando as disciplinas de Sistemas Multiagentes (agentes inteligentes, agentes móveis, multi agentes, programação distribuída, inteligência artificial), Introdução a Sistemas Inteligentes (inteligência artificial, redes neurais, lógica fuzzy, algoritmos genéticos) e Processamento de Imagens.

Sem querer, todas as disciplinas envolvem álgebra relacional, que estou tendo que estudar novamente, pois vi isso a muito tempo na faculdade e não apliquei pra nada no meu curso de tecnologia (infelizmente). Por isso, o título do post, sobre MatLab. Inicialmente eu não estava querendo trabalhar com [MatLab](http://www.mathworks.com/products/matlab/), eu queria implementar tudo em C ou Java. Até que um amigo me falou que algo que você faz em [MatLab](http://www.mathworks.com/products/matlab/) em segundos, você vai gastar muito mais tempo fazendo em outra linguagem. Depois disso, vi a necessidade e importância de se aprender [MatLab](http://www.mathworks.com/products/matlab/), que no fim das contas não é nada difícil e agiliza muito o desenvolvimento dos trabalhos.

Para quem não sabe (como eu não sabia), o [MatLab](http://www.mathworks.com/products/matlab/) é ideal para trabalhar operações sobre matrizes, como somas, multiplicações, inversão e tudo o mais. Porém, esta é uma ferramenta proprietária e para Windows. No Linux temos duas ferramentas semelhantes: o [Octave](http://www.gnu.org/software/octave/) e o [SciLab](http://www.scilab.org/).

Inicialmente testei o octave, que baixei via apt-get. Ele é uma ferramenta de linha de comando (o [MatLab](http://www.mathworks.com/products/matlab/) nunca vi). O Octave tem uma interface gráfica chamada [QtOctave](http://qtoctave.wordpress.com/) (que usa a biblioteca gráfica Qt4). Acho que baixei ele também pelo apt-get. O [SciLab](http://www.scilab.org/) possui uma interface gráfica simples, mas as principais tarefas nessas ferramentas são feitas a partir de comandos em uma tela semelhante a um terminal. No caso do SciLab, ele lhe permite executar comandos do sistema operacional de dentro dele. Os comandos linux que testei e funcionaram foram pws, cd e ls. Outros como rm não funcionaram. Ele permite também, depois que você digitou o inicio de algum comando, pressionar tab para exibir o recurso de autocompletar, válido também para completar nomes de arquivos e diretórios do sistema operacional.

Bem, a grande finalidade dessas ferramentas é facilitar a realização de operações com matrizes, como já citei. Para iniciar o Octave basta digitar num terminal a palavra octave e para o SciLab, digitar scilab. Testei inicialmente o Octave. Conseguir facilmente criar duas matrizes a e b (por exemplo, a = [1 2 3; 4 5 6], matriz de 2 linhas e 3 colunas), mas ao tentar multiplicar duas matrizes compatíveis (ou seja, a quantidade de linhas da segunda tem que ser igual a quantidade de colunas da primeira) não consegui. Tentei o operador padrão de multiplicação *, fazendo a*b, mas não funcionou. Tentei o help via linha de comando e nada. Obviamente se eu pegasse qualquer manual básico iria conseguir. Porém, parti logo para o SciLab pois não achei o octave intuitivo.

No SciLab, meu primeiro teste, a multiplicação de duas matrizes, funcionou de primeira. Assim, achei a ferramenta mais intuitiva, pois nunca tive contato com MatLab e sua linguagem, apenas instalei o programa e sem nenhuma consulta a manual algum, consegui fazer uma operação básica. Assim, recomendo o [SciLab](http://www.scilab.org/), que funciona em Windows, Linux e Mac.

Outras alternativas podem ser encontradas no site [AlternativeTo](http://alternativeto.net), nesse [link](http://alternativeto.net/AlternativesToItem.aspx?profile=linux&itemid=f913321c-7176-443c-b74e-1f2b1b2343f3&license=any&platform=linux). O site AlternativeTo tem um visual bem legal e sugere alternativas para uma infinidade de softwares Windows, Linux ou Mac. Vale a pena dar uma olhada nele.
