---
author: admin
comments: true
layout: post
slug: exibindo-erros-em-scripts-nclua
title: 'Exibindo erros em scripts #NCLua. #TVD #Ginga #NCL #Lua'
wordpress_id: 2639
categories:
- Dicas NCL e Lua
- TV Digital
---

[![](http://manoelcampos.com/wp-content/uploads/tvd-error.png)](http://manoelcampos.com/wp-content/uploads/tvd-error.png)Como muitos desenvolvedores NCLua já devem ter notado, em algumas situações no Ginga Virtual Set-top Box (pelo menos até a versão  0.12.4), quando algo está errado no código Lua, o Ginga não mostra nada no terminal, simplesmente parando a execução da aplicação.
Isto é um "Gingantesco" problema, pois ficamos no escuro sem saber o que está errado e é muito trabalhoso encontrar o erro, só na base da depuração usando print :(.


--more Leia Mais--


Erros comuns são a tentativa de acessar um campo em uma tabela que não existe (por ter digitado o nome da tabela incorretamente, por exemplo), chamar funções sem passar todos os parâmetros requeridos, etc.

Assim, estudando o problema, encontrei uma solução paleativa para o mesmo, pois o correto seria que a mensagem de erro aparecesse no terminal.

Desta forma, considerem o seguinte código, que deveria apenas mostrar um texto centralizado na tela, usando o módulo canvas de NCLua:

[lua]
  canvas:attrFont("vera",32)
  canvas:attrColor(255,255,255,255)
  local w, h = canvas:attrSize()
  canvas:drawRect("fill", 0,0, w, h)
  canvas:attrColor(0,0,0,0,255)
  local text = "Desenhando com NCLua canvas"

  local wText, hText = canvas:meansureText(text) --ERRO: nome da função está errada
  local x, y = math.floor((w-wText)/2) --ERRO: faltou definir valor para y

  --Sem um valor para y, ocorrerá erro aqui
  canvas:drawText(x,y,text)
  canvas:flush()
[/lua]

Observe que há erros nas linhas 8 e 9. Na linha 8 o nome da função está errada (não deve ter a letra n) e na linha 9 faltou definir um valor para a variável y (que dará erro ao ser usada na linha seguinte).

No entanto, se você incluir este script como uma mídia numa aplicação NCL e rodar no Ginga Virtual STB, provavelmente nenhum erro será apresentado e a aplicação apenas para de executar, dificultando saber onde o problema ocorreu.
Para fazer as mensagens de erro aparecerem, uma solução paleativa simples é a seguinte, considerando que você tem um arquivo main.lua, coloque todo o código dele dentro de uma função chamada main, como mostrado abaixo:

[lua]
function main()
  --insira aqui todo o código da listagem acima
end
[/lua]

Agora, no lugar de chamar a função main diretamente, vamos usar a função pcall para chamar ela em modo protegido. Desta forma, a função pcall é que chamará a função main, não propagando nenhum erro ocorrido dentro dela. Como a função main não possui nenhum parâmetro, para fazer a função pcall chamá-la, basta usar o código a seguir:

[lua]
local ok, res = pcall(main)
[/lua]

A função pcall retorna pelo menos um valor:



	
  * o primeiro (armazenado na variável ok) indica se a função executada pelo pcall (no caso a main) foi executada com sucesso

	
  * em caso de sucesso da execução da função chamada pelo pcall, os valores seguintes serão os valores retornados por tal função (caso esta retorne algo)


Caso a função chamada pelo pcall gere algum erro, o segundo valor retornado pelo pcall será a mensagem de erro. Desta forma, após a linha de código mostrada acima, podemos verificar se ocorreu erro usando o código abaixo:

[lua]
if not ok then
   print("\n\nError: "..res, "\n\n")
   return -1
end
[/lua]

É importante frisar que isto não está fazendo um tratamento de erros adequado, pois quando se captura um erro não fatal, é porque deseja-se contorná-lo (por exemplo, mostrando uma mensagem na interface gráfica para o usuário) e continuar a execução da aplicação normalmente. Neste caso, qualquer erro ocorrido fará com que a aplicação seja finalizada (como já acontecia caso você não tome nenhuma iniciativa para tratar o erro).

Pronto, é isso. Espero que seja útil enquanto não sai uma [correção](http://www.softwarepublico.gov.br/dotlrn/clubs/ginga/forums/message-view?message_id=56535768). Comentários e outras soluções são bem vindas.
A aplicação completa está em anexo.

[attachments size=custom title="Download" force_saveas="1" logged_users="0" orderby=ID]
