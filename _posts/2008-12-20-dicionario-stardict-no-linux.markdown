---
author: admin
comments: true
layout: post
slug: dicionario-stardict-no-linux
title: Dicionário StarDict no Linux
wordpress_id: 135
categories:
- Internet
- Linux
- Software
- Software Livre
---

O [StarDict](http://stardict.sourceforge.net) é um dicionário opensource semelhante ao famoso [Babylon](http://www.babylon.com/), que é comercial.

Assim como o Babylon, o StarDict possui versões para Windows e para Linux. A aplicacão, ao ser baixada, não vem com dicionários instalados (se não me engano, apenas dicionário de chinês). Na página [http://stardict.sourceforge.net/Dictionaries.php](http://stardict.sourceforge.net/Dictionaries.php) podem ser baixados alguns dicionários, mas nada muito útil. O bom de tudo é que o StarDict pode usar os dicionários do Babylon.

01) Bem, para instalar o StarDict no linux, via apt-get, basta abrir um Terminal e digitar:

<pre>
<code class="bash">apt-get update</code>
</pre>


Isto atualiza a lista de pacotes disponíveis para download. Todos os comandos não possuem quebra de linha, apesar de poderem estar sendo exibidos em mais de uma linha.

02) Depois, digite o comando a seguir para baixar o StarDict e as ferramentas dele que serão usadas para converter dicionários do Babylon para o formato dele:

<pre>
<code class="bash">apt-get install stardict stardict-tools</code>
</pre>


03) O comando a seguir baixa uma biblioteca, que pelo nome, só pode ser para manipular arquivos XML que serão usadas pelas ferramentas do StarDict

<pre>
<code class="bash">apt-get install build-essential libxml2-dev</code>
</pre>


04) Agora que o StarDict está instalado, vamos baixar a ferramenta para converter o dicionário do Babylon para o StarDict. No terminal digite:

<pre>
<code class="bash">wget http://optusnet.dl.sourceforge.net/sourceforge/ktranslator/dictconv-0.2.tar.bz2</code>
</pre>


05) Agora digite o comando a seguir para extrair o pacote e entrar na pasta criada:

<pre>
<code class="bash">tar -jxvf dictconv-0.2.tar.bz2 ; cd dictconv-0.2</code>
</pre>


06) Digite os comandos abaixo para configurar e compilar o pacote:

<pre>
<code class="bash">./configure; make</code>
</pre>


07) Para instalar digite:

<pre>
<code class="bash">checkinstall</code>
</pre>


08) Se o programa checkinstall não estiver instalado, digite o comando abaixo para baixar e instalar:

<pre>
<code class="bash">sudo apt-get install checkinstall</code>
</pre>


09) Para baixar o dicionário do Babylon de Inglês-Português digite:

<pre>
<code class="bash">wget http://info.babylon.com/glossaries/38C/Babylon_English_Portuguese.BGL</code>
</pre>


10) Com o comando abaixo você converte o dicionário para o formato do Babylon, gerando um arquivo com o nome Babylon_English_Portuguese1.dic:

<pre>
<code class="bash">dictconv -o Babylon_English_Portuguese1.dic Babylon_English_Portuguese.BGL</code>
</pre>


11) Após a conversão alguns caracteres desnecessários são gerados no arquivo do dicionário. Remova-os com o comando abaixo:

<pre>
<code class="bash">cat Babylon_English_Portuguese1.dic | sed 's/$[0-9][0-9]*$t/t/' > Babylon_English_Portuguese.dic</code>
</pre>


12) Para finalizar a conversão, digite o comando abaixo:

<pre>
<code class="bash">/usr/lib/stardict-tools/tabfile Babylon_English_Portuguese.dic</code>
</pre>


13) Mova os arquivos gerados para a pasta de dicionários do Stardict:

<pre>
<code class="bash">sudo mv Babylon_English_Portuguese.dict.dz /usr/share/stardict/dic/</code>
</pre>


Se quiser baixar o dicionário Português-Inglês, execute o comando a seguir:

<pre>
<code class="bash">wget http://info.babylon.com/glossaries/4EA/Babylon_Portuguese_English_dic.BGL</code>
</pre>


Depois, repita os passos a partir do 10, observando os nomes de arquivo que devem ser trocados
para os nomes corretos.

Agora, para abrir o programa, vá no menu Aplicativos >> Acessórios e acesso o StarDict.
O StarDict funciona como o Babylon. Selecione uma palavra em algum programa e ele automaticamente exibe a traducão. No linux, usando o Acrobat Reader, ele não funciona corretamente, pelo menos comigo, mas em qualquer outro programa, funciona tudo bem.
