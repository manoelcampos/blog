---
author: admin
comments: true
layout: post
slug: validando-cpf-cnpj-em-lua
title: 'Validando #CPF, #CNPJ e outros dados em #Lua. #TVD #GingaNCL #NCLua'
wordpress_id: 2187
categories:
- Dicas NCL e Lua
- TV Digital
tags:
- CPF
- GingaNCL
- Lua
- NCLua
- TVD
---

[![](http://manoelcampos.com/wp-content/uploads/validar.jpg)](http://pt.fotolia.com/id/13746204)Validação de CPF e CNPJ é algo que se encontra exemplos na Web em tudo quanto é linguagem que se imaginar. No entanto, não encontrei nenhuma implementação disponível em Lua.

Como estou construindo uma aplicação de TV Digital utilizando NCL e Lua, onde o usuário informa seu CPF, precisei de tal rotina e não encontrei nada pronto. 


--more Leia Mais--


Assim, criei um módulo em lua, chamado **valid** para validação de dados, como CPF, CNPJ, data, hora e outros dados.

Para usar em suas aplicações Lua (de TV Digital ou não), basta colocar o arquivo disponível no final do post no mesmo diretório do seu script lua que chamará a rotina (ou em um diretório do path de pacotes de Lua).

Para usar o módulo veja o exemplo de validação de CPF a seguir:

<pre>
<code class="lua">

require "valid"
local cpf = "11111111111"
if valid.cpf(cpf) then
   print("CPF válido")
else
   print("CPF inválido")
end
</code>
</pre>


Fiz poucos testes mas todos deram o resultado esperado. Usem por sua conta e risco.

Para aqueles que desejam fazer um trabalho de conversão semelhante, valem alguns lembretes a respeito de Lua:



	
  * o primeiro elemento de um vetor (table) ou string é 1 e não 0.

	
  * a comparação 1 == "1" é sempre falsa, apesar de só ter diferença nos tipos dos valores sendo comparados (1 é inteiro e "1" é string). Assim, é preciso converter o valor inteiro para string com tostring ou o valor string para inteiro com tonumber.


Contribuições de novas funções são bem vindas. Se tiver alguma, basta entrar em [contato aqui](contato).
Gostou do artigo? Contribua também. Dê um retweet usando o botão no início da página.

[attachments size=custom title="Download" force_saveas="1" logged_users="0"]
