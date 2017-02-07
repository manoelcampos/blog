---
author: admin
comments: true
layout: post
slug: criando-letreiros-em-aplicacoes-nclua-para-tvd
title: 'Criando Letreiros em Aplicações #NCLua para #TVD'
wordpress_id: 1711
categories:
- Dicas NCL e Lua
- Software
- Software Livre
- TV Digital
---

Na seção de Dicas NCL/Lua de hoje, vou mostrar como criar letreiros, como aqueles criados com a tag _marquee_ da linguagem HTML.

## Pré-requisitos

Para acompanhar este artigo, são necessários conhecimentos básicos de NCL, Lua e NCLua (como os módulos event e canvas). Você pode utilizar o [Eclipse](http://www.eclipse.org/) com o plugin [NCLEclipse](http://www.laws.deinf.ufma.br/~ncleclipse/). Recomenda-se utilizar a última versão do [Ginga Virtual Set-top Box](http://www.gingancl.org/ferramentas.html).

Um [tutorial de como estruturar o ambiente de desenvolvimento](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl) está disponível [aqui](http://www.peta5.com.br/br/tutoriais/88-como-estruturar-seu-ambiente-de-desenvolvimento-para-o-ginga-ncl).

## Iniciando

Primeiro, crie um diretório para a aplicação. Depois crie os arquivos main.ncl, main.lua, marquee.lua e rotinas.lua. Não vou explicar o código NCL, pois o mesmo não traz nada além do básico. Assim, pode ver todo o código abaixo. O código está comentado para melhor entendimento. É necessário apenas alterar o src da mídia video1, para o nome de um arquivo de vídeo a ser colocado no diretório da aplicação.

```xml
<?xml version="1.0" encoding="ISO-8859-1"?>
<ncl id="main" xmlns="http://www.ncl.org.br/NCL3.0/EDTVProfile">
    <head>
        <regionBase>
            <region id="rgLua" width="100%" height="24%" left="0" top="76%" zIndex="1" />
            <region id="rgVideo" width="100%" height="100%" zIndex="0" />
        </regionBase>

        <descriptorBase>
            <descriptor id="dLua" region="rgLua" focusIndex="luaIdx" />
            <descriptor id="dVideo" region="rgVideo" />
        </descriptorBase>

        <!-- Quando uma mídia terminar, inicia outra -->
        <connectorBase>
            <causalConnector id="onEndStart">
              <simpleCondition role="onEnd" />
              <simpleAction role="start" />
            </causalConnector>
        </connectorBase>
    </head>

    <body>
        <port id="pVideo" component="video1"/>
        <port id="pLua" component="lua"/>

        <!-- Define o controle de foco para o nó Lua -->
        <media id="settings" type="application/x-ginga-settings">
            <property name="service.currentKeyMaster" value="luaIdx"/>
        </media>

        <!--Vídeo sob licença Creative Commons,
        obtido em http://creativecommons.org/video -->
        <media id="video1" src="media/video.avi" descriptor="dVideo" />

        <media id="lua" src="main.lua" descriptor="dLua" />

        <!-- Quando o video1 terminar, reinicia o mesmo -->
        <link xconnector = "onEndStart">
	    <bind component="video1" role="onEnd" />
	    <bind component="video1" role="start" />
        </link>
    </body>
</ncl>
```

## Criando a classe Marquee

Vamos implementar o código Lua seguindo uma abordagem orientada a objetos. Existem várias formas diferentes de trabalhar com OO em Lua. A forma que utilizarei está entre uma das mais simples e fácil de entender, não permitindo herança e nem outros recursos mais avançados. Somente é utilizado o recurso de atributos, métodos e construtores.

Então, abra o arquivo marquee.lua. Vamos iniciar adicionando o módulo rotinas (cujo arquivo ainda está vazio) com o código abaixo:

```lua
require "rotinas"
```

Classes em Lua nada mais são que tabelas. Assim, precisamos definir uma tabela para a nossa classe Marque, contendo os atributos da mesma, como pode ser visto abaixo. Todos os atributos estão comentados.

```lua
---Classe para exibição de letreiros em aplicações de TVD,
--como o marquee da HTML
--@author Manoel Campos da Silva Filho - http://manoelcampos.com
--@license http://creativecommons.org/licenses/by-nc-sa/2.5/br/
Marquee = {
    --Texto a ser exibido
    text = "",
    --Posição vertical do letreiro
    top = 0,
    --Posição horizontal do letreiro
    left = 0,
    --Largura do letreiro, em quantidade de caracteres
    charWidth = 50,
    --Tipo de fonte a ser usado
    fontFace = 'vera',
    --Tamanho da fonte
    fontSize = 36,
    --Cor da fonte
    fontColor = "blue",
    --Se true, indica que o letreiro será movido
    --da direita para a esquerda.
    --Se igual a false, será movido ao contrário.
    moveToLeft = true,
    --Define a velocidade de animação do letreiro.
    --Deve-se informar o intervalo,
    --em milissegundos, com o qual o letreiro deve ser atualizado.
    interval = 200,
    --Tempo em segundos que o letreiro ficará em exibição.
    --Se atribuído um número menor ou igual a zero,
    --o letreiro fica visível o tempo todo.
    seconds = -1,
    --Se igual a true, automaticamente redesenha a tela
    --para exibir o letreiro,
    --quando o método drawText for chamado.
    --Com false, o método canvas:flush() deve ser
    --chamado quando o desenvolvedor desejar que a tela seja redesenhada,
    --para exibir o letreiro.
    autoFlush = true,
    --Indica se a animação do letreiro está ativa. @see cancel
    active = true,
    --Acumula o tempo decorrido (em milissegundos),
    --entre cada chamada do método animate.
    timeElapsed = 0
}
```

Vamos definir uma função para limpar a área ocupada pelo letreiro, utilizando o código abaixo. A função é bem simples, desenhando um retângulo para cobrir a área do letreiro.

```lua
---Limpa a área do letreiro
function Marquee:clear()
  --Define a fonte do canvas. Mesmo não sendo desenhado nenhum texto na tela,
  --como usamos a função canvas:measureText para descobrir a área do letreiro,
  --se nenhuma fonte tiver sido definida antes,
  --é gerado erro ao chamar a função citada.
  canvas:attrFont(self.fontFace, self.fontSize)

  --Cria um fundo transparente
  canvas:attrColor(255, 255, 255, 0)

  --Obtém a largura e altura do texto passado por parâmetro.
  local tw, th = canvas:measureText("A")

  --Desenha um retângulo para cobrir a área do letreiro,
  --limpando o conteúdo da mesma
  canvas:drawRect("fill", self.left, self.top, self.charWidth*tw, th)
end
```

Vamos agora definir uma função para interromper a animação do letreiro, usando o código abaixo. A função apenas altera o atributo active para false (para indicar, pro método animate que criaremos, que o letreiro não deve ser mais animado) e limpa a área do letreiro, chamando o método clear.

```lua
---Interrompe a animação do letreiro
function Marquee:cancel()
  self.active = false
  self:clear()
end
```

Agora vamos definir o método drawText, que desenhará o texto na tela. O método também é bem simples, apenas fazendo uso da classe canvas. O texto só é automaticamente exibido se o atributo autoFlush for igual a true (este é o valor default). Veja código do método drawText abaixo:

```lua

---Exibe um texto na tela. O mesmo só é desenhado imediatamente,
--se o atributo autoFlush for true
--@param txt Texto a ser exibido
function Marquee:drawText(txt)
  self:clear()
  canvas:attrFont(self.fontFace, self.fontSize)
  canvas:attrColor(self.fontColor)
  canvas:drawText(self.left, self.top, txt)
  if self.autoFlush then
     canvas:flush()
  end
end
```

Vamos definir o construtor da classe. Mas antes disto, precisamos criar uma função dentro do módulo rotinas.lua, que será responsável por criar uma cópia da tabela Marquee, que representará uma instância da classe. Assim, a instância nada mais é que outra tabela, contendo tudo que a tabela Marquee possui. Logo, abra o arquivo rotinas.lua e insira as linhas abaixo:

```lua
local print, pairs = print, pairs
module "rotinas"
```

A primeira linha armazena as funções globais, que serão utilizadas dentro do módulo, como funções locais. Isto é necessário pois, ao definir um arquivo Lua como módulo, não sem tem mais acesso às variáveis e funções globais. A segunda linha define o arquivo rotinas.lua como um módulo de nome rotinas.

Agora vamos adicionar o código da função que clonará uma tabela:

```lua
---Clona uma tabela
--@param tb Tabela ser clonada
--@return Retorna a nova tabela
function cloneTable(tb)
  local clone = {} --Cria uma tabela vazia
  --Percorre os elementos da tabela tb, recriando os mesmos na tabela clone,
  --que é retornada pela função
  for k, v in pairs(tb) do
    clone[k] = v
  end
  return clone
end
```

Volte agora ao arquivo marquee.lua e vamos definir o construtor da classe Marquee, usando o código abaixo.

```lua
---Construtor da classe
--@param text Texto a ser exibido
--@param top Posição vertical do letreiro
--@param left Posição horizontal do letreiro
--@param charWidth Largura do letreiro, em quantidade de caracteres
--@return Retorna uma instância de Marquee
function Marquee:new(text, top, left, charWidth)
  --Cria uma instância (cópia) da classe (tabela) Marquee
  local obj = rotinas.cloneTable(self)

  obj.text = text or Marquee.text
  obj.top = top or Marque.top
  obj.left = left or Marque.left
  obj.charWidth = charWidth or Marque.charWidth

  --Retorna a instância criada
  return obj
end
```

Como pôde ver, o código é bem simples. Os parâmetros text, top, left, charWidth são atribuídos aos respectivos campos da instância. Caso algum destes atributos seja omitido, é utilizado o respectivo valor default definido na classe Marquee.

Agora vamos definir a função principal, que realiza toda a "mágica" de fazer o texto ser movimentado. Veja o código abaixo:

```lua
---Executa a animação do letreiro
function Marquee:animate()
  --Função local para animar o texto. Todo o código está dentro desta
  --função, que é executada repetidamente, de acordo com o intervalor
  --de tempo definido do atributo interval.
  --Para tal agendamento de execução, é utilizada a função timer do módulo
  --event, que deve receber uma função sem nenhum parâmetro para ser executada
  --após o intervalo de tempo definido no seu primeiro parâmetro.
  --Como a função animate está dentro da classe Marquee
  --e é usado o operador :,
  --existe um parâmetro implícito self, que representa o
  --objeto (tabela) que chamou o método animate.
  --Assim, não é possível passar a função animate da classe Marquee
  --para a event.timer, pois esta requer uma função que não possua parâmetros.
  local function animateLocal()
    if self.active then
         local parcialText = ""
         --Só movimenta o texto se o mesmo tiver mais de 3 caracteres
         if (#self.text > 3) then
           --Exibe apenas o total de caracteres referente
           --a largura (em caracteres) do letreiro
           parcialText = string.sub(self.text, 1, self.charWidth)
           if self.moveToLeft then
             --Altera o texto para simular o efeito de movimento,
             --recortando o primeiro caractere
             --e adicionando ao final, fazendo o texto mover para a esquerda.
             self.text =
                 string.sub(self.text, 2) ..
                 string.sub(self.text, 1, 1)
           else
             --Altera o texto para simular o efeito de movimento,
             --recortando o último caractere
             --e adicionando ao início, fazendo o texto mover para a direita.
             self.text =
                 string.sub(self.text, #self.text) ..
                 string.sub(self.text, 1, #self.text-1)
           end
         else
           parcialText = self.text
         end
         self:drawText(parcialText)

         --Agenda a execução da função animateLocal, após o
         --intervalo (em milisegundos), definido em self.interval
         event.timer(self.interval, animateLocal)
    end

    --Se seconds for maior que zero, o letreiro tem
    --tempo definido para ficar em exibição
    if (self.seconds > 0) then
      --Conta o tempo decorrido. Se for maior que o tempo
      --de exibição, interrompe o letreiro.
      self.timeElapsed = self.timeElapsed + self.interval
      if (self.timeElapsed/1000 >= self.seconds) then
          self:cancel()
      end
    end
  end

  animateLocal()
end
```

Esta função é mais complexa, apenas pelo uso da função event.timer. Como o texto pode ser movimentado da direita para a esquerda (caso o atributo moveToLeft seja true, o valor default) ou o inverso, precisamos fazer com que o método animate da classe Marquee seja executado em um intervalo de tempo determinado. Para isso é que utilizamos a função event.timer, cujo primeiro parâmetro define o intervalo de tempo que será aguardado para ser executada a função informada no segundo parâmetro.

Como a função passada para event.timer não pode ter nenhum parâmetro, não podemos passar a ela o método animate da classe Marquee, pois este, como foi definido utilizando-se dois-pontos ( _function Marquee**:**animate()_ ), a mesma possui um parâmetro implícito de nome self, que representa à instância (tabela) que chamou o método, permitindo o acesso a seus atributos e métodos.

Assim, para contornar tal "problema", criou-se uma função local de nome animateLocal, que contém todo o código responsável pela movimentação do texto. Como a função animateLocal é uma função interna de Marquee:animate, ela tem acesso a todas os parâmetros passados ao método animate da classe Marquee. Este conceito é conhecido em Lua como [clousure](http://www.lua.org/pil/6.1.html). Desta forma, dentro do método animate, chamados a função local animateLocal (que não possui parâmetros) e esta é passada ao método timer da classe event.

Como pode ser visto na última linha da função animateLocal, ela será chamada, de forma recursiva, após o intervalo de tempo definido no atributo interval, por meio da chamada event.timer.

O truque para fazer o letreiro ser movimentado, é apenas uma manipulação de strings. Para fazer o texto mover para a esquerda, recorta-se o primeiro caractere e adiciona-o ao final da string. Para mover para a direita, basta recortar o último caractere e adicioná-lo ao início da string.

Nossa classe Marquee está pronta. Agora basta desenvolver o código do arquivo main.lua.

## Criando o arquivo Lua da aplicação

Agora precisamos apenas incluir o código do arquivo main.lua. Assim, abra tal arquivo. Vamos iniciar incluindo o arquivo marquee.lua, usando o código abaixo:

```lua
dofile("marquee.lua")
```

Como tal arquivo não é um módulo (ele é um arquivo lua comum que contém apenas a definição da classe Marquee), precisamos usar dofile no lugar de require.

Vamos incluir dois letreiros na aplicação, então, vamos ao primeiro. Você verá com o código abaixo que isto é muito simples.

```lua
local text = "    Letreiro Digital em Aplicações NCLua para o SBTVD.    "
--Cria um letreiro      (text, top, left, charWidth)
local let1 = Marquee:new(text, 0,   10,   50)
let1:animate()
```

Observe que foi definida uma variável com o texto a ser exibido, e chamamos o construtor da classe (Marquee:new) para criar a instância let1. Em seguida, o método animate é chamado e pronto. O letreiro se movimentará indefinidamente, da direta para a esquerda (o comportamento padrão).

O uso de espaços antes e depois do texto foi intencional. Execute a aplicação, depois retire tais espaços para notar a diferença. Sem os espaços, quem tá lendo não sabe exatamente quando o texto termina, pois quando uma ponta desaparece, a outra já aparece do outro lado. Com os espaços, o texto do outro lado demora mais a aparecer.

Agora vamos ao segundo letreiro, usando o código abaixo:

```lua
text = "          Manoel Campos - http://manoelcampos.com           "
local let2 = Marquee:new(text, 50,  10,   50)
let2.moveToLeft = false
--Após 20 segundos, o letreiro para
let2.seconds = 20
let2:animate()
```

Note que agora, depois que chamamos o construtor, alteramos algumas propriedades do latreiro. Com moveToLeft igual a false, o letreiro é movido da esquerda para a direita. Com seconds igual a 20, o letreiro desaparece depois de 20 segundos.

## Conclusão

A abordagem orientada a objetos facilita a organização e reutilização de código, permitindo a criação de várias instâncias da classe e tornando o código bastante legível. No final, o código da aplicação principal é bastante reduzido.

Gostou do artigo? Contribua: comente, avalie, retweet.

Toda a documentação HTML, gerada com [LuaDoc](http://luadoc.luaforge.net/), está disponível no diretório doc.

## Licença

[](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)

[](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)

[![](/files/by-nc-sa.png)](http://creativecommons.org/licenses/by-nc-sa/2.5/br/)

[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]
