---
author: admin
comments: true
layout: post
slug: reduzindo-mensagens-geradas-no-terminal-ao-executar-aplicacoes-ncllua-no-ginga-virtual-stb
title: 'Reduzindo mensagens geradas no terminal ao executar aplicações #NCL/#Lua no #Ginga Virtual STB. #TVD'
wordpress_id: 2755
categories:
- TV Digital
---

[![](http://manoelcampos.com/wp-content/uploads/tvd-error.png)](http://manoelcampos.com/wp-content/uploads/tvd-error.png)Quem utiliza o Ginga Virtual Set-top Box para desenvolvimento de aplicações NCL/Lua para a TV Digital, sabe que o trabalho de depurar uma aplicação Lua é algo um pouco chato. Primeiro porque, pelo menos até a versão 0.12.4 da máquina virtual (VM), os [erros gerados por scripts NCLua não são corretamente exibidos no terminal](http://manoelcampos.com/2012/07/25/exibindo-erros-em-scripts-nclua/), como já relatei [neste post](http://manoelcampos.com/2012/07/25/exibindo-erros-em-scripts-nclua/).

Outro problema é que não temos um depurador por padrão na VM. <!-- more -->Existem alguns depuradores para Lua, mas como a execução do script lua é controlada pelo Ginga, a integração de um depurador pode não ser algo tão simples assim. Com isto, a depuração que normalmente fazemos é na base da função print de Lua.

No entanto, ao executar a aplicação NCL contendo o script NCLua, o DirectFB (API gráfica leve para uso em sistemas sem um servidor X, como no caso dos sistemas embarcados nos Set-top Boxes com Ginga) gera uma quantidade imensa de mensagens que, pra mim, não tem utilidade nenhuma e apenas atrapalham. Isto devido ao fato de que as mensagens que realmente interessam (que usamos para depuração), geradas pelos nossos scripts Lua, ficam perdidas no meio das mensagens do DirectFB.

Para resolver isto, basta incluir a palavra _**quiet**_ no final do arquivo **/usr/local/etc/directfbrc** no Ginga Virtual STB. Nem precisa reiniciar a VM. A configuração será lida automaticamente ao executar uma aplicação NCL.

[Quem sabe nas próximas versões da VM isto já venha por padrão](http://www.softwarepublico.gov.br/dotlrn/clubs/ginga/forums/message-view?message_id=59464592).
