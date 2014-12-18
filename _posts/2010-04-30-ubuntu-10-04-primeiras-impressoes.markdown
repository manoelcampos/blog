---
author: admin
comments: true
layout: post
slug: ubuntu-10-04-primeiras-impressoes
title: Ubuntu 10.04 - Primeiras Impressões
wordpress_id: 1440
categories:
- Linux
- SO
tags:
- Impressões
- Linux
- Ubuntu 10.04
---

[![](http://manoelcampos.com/wp-content/uploads/ubuntu-10.04.png)](http://manoelcampos.com/wp-content/uploads/ubuntu-10.04.png)Estava só esperando o Ubuntu 10.04 para trocar o HD do meu note, que estava me avisando que daria problemas em um futuro breve. Daí, como teria que instalar tudo novamente, que fosse com as versões mais novas dos softwares. Baixei o Ubuntu via Torrent rapidinho na UnB.<!-- more -->


### Problemas Encontrados


Como sempre, problemas surgiram. Primeiro não encontrei o JRE nem o JDK da Sun, apenas o Open JDK (nem no synaptic aparece).

O plugin do Java para os navegadores não funcionou :(. Só tinha problemas com ele na versão anterior usando o Firefox. No Chrome nem precisava configurar. O plugin da Sun está disponível no Ubuntu Software Center, mas não permite ser instalado.

Após instalar o Ubuntu Restricted Extras, o Java funcionou no Firefox. Nesta versão o problema se inverteu. Antes o Java da Sun travava o Firefox e funciona de primeira no Google Chrome. Agora não funciona no Chrome e funciona no Firefox. Parece que o Chrome só funciona com o Java da Sun. Não há nem como configurar.

Neste [link](http://tiagohillebrandt.wordpress.com/2010/03/25/instalando-o-sun-java-6-no-ubuntu-lucid-lynx/) encontrei um artigo mostrando que o [Java da Sun foi colocado em outro repositório](http://tiagohillebrandt.wordpress.com/2010/03/25/instalando-o-sun-java-6-no-ubuntu-lucid-lynx/), bastando habilitá-lo. Depois disto, pude instalar o JDK, JRE e Plugin da Sun. Agora o Java funciona no Firefox e no Chrome.

Os botões no lado esquerdo da barra de título das janelas é estranho, para quem já tá acostumado com eles do lado direito. Mas já tinha visto um script em python para corrigir isto e funcionou perfeitamente. Baixe o mesmo [aqui](http://manoelcampos.com/wp-content/uploads/ChangeTitleBarButtonsPosition.py_.zip) (informações do autor estão dentro do script. Fonte: [br-linux](http://br-linux.org/2010/como-mudar-a-posicao-dos-botoes-nas-janelas-do-ubuntu-10-04/)). [Este artigo](http://hamacker.wordpress.com/2010/04/09/ordem-dos-botoes-na-janela-do-ubuntu-10-04/) mostra como fazer isso via shell, tornando padrão para todos os usuários. O aplicativo [Ubuntu Tweak](http://ubuntu-tweak.com/) também possui uma aba para configurar os botões da barra de título, dentre muitas outras configurações que se tornaram indispensáveis para mim.

Outra coisa que achei muito chato foi terem removido o botão do Nautilus para alteração da barra de endereços para modo texto, que ao invés de mostrar os botões com os diretórios até o caminho atual, mostrava um campo de texto para você inserir o endereço livremente. Parece que o botão se foi de vez :(. Mas você pode pressioanar CTRL+L ou digitar / para inserir um endereço manualmente. [Este artigo mostra também como deixar a barra em modo texto por padrão](https://help.ubuntu.com/community/RestoreNautilusLocationBar).


### O que tem de legal


Vamos ao que funcionou e que está bem legal.

O plugin do Flash também funcionou perfeitamente no Firefox e Chrome, como na versão anterior do Ubuntu.

O Gwibber (cliente de Twitter e outros) ficou com um visual super legal e agora é um aplicativo padrão. Agora o mesmo encurta os links automaticamente, além de permitir visualizar um número bem maior de mensagens. Antes acho que era limitado a 20 (quantidade imposta pela API REST do Twitter). Parece que agora o Gwibber guarda localmente o histórico de Tweets.

O Empathy agora aceita conexões via HTTP com o MSN, funcionando de primeira em redes que bloqueiam as portas utilizadas pelo mesmo. O visual dele ficou super legal também.

O meu modem ZTE MF622 funcionou melhor que na versão anterior. Agora nem é mais preciso adicionar regra no UDEV para desmontar o disco e fazer o modem ser reconhecido. O mesmo é reconhecido automaticamente. Muito bom.

Outra melhoria excelente quanto aos modens 3G é que agora, se você remover o modem não precisa reiniciar a máquina para o mesmo voltar a ser reconhecido. Se a conexão cair, também não precisa reiniciar. Quando o sinal do 3G reestabelecer você conseguirá conectar novamente. Esse negócio de ter que reiniciar só porque a conexão caiu era frustrante.

O visual ficou bem legal. Já tinha visto antes, mas só em fotos. A barra de título foi mesclada com a barra de menus nos aplicativos, tendo uma cor só. Inicialmente achei estranho, pois você não via mais a divisão entre as duas coisas. Mas depois acabei descobrindo que você consegue arrastar a janela mesmo pela barra de menus. Por fim achei bem legal o recurso, pois você não precisa ficar mirando na estreita barra de título para arrastar a janela. A barra de menus dos aplicativos funciona como uma extensão da barra de título. Só não sei se isso já funcionava na versão anterior.

Como fiz meu HD antigo de backup, acabei precisando usar o Disk Utility e vi que o mesmo ficou com um visual super legal também. Bem informativo.

Não é mais preciso fazer qualquer configuração de áudio para o Skype. Depois que o Ubuntu passou a usar o Pulse como servidor de áudio, [já comentado em outro artigo](http://manoelcampos.com/2009/04/20/skype-e-erro-problem-with-audio-playback-no-ubuntu/), geralmente ocorria o erro "Problem with audio playback" quando você tentava usar o Skype e outro aplicativo como um player qualquer. No Ubuntu 9.10 o problema tinha sido melhorado mas ainda encontrei dificuldades com o uso do Skype. Neste caso, o volume do microfone era automaticamente ajustado, no início de uma chamada, para um valor muito baixo. Agora esses problemas não ocorreram mais.

Um aplicativo que não faz parte do Ubuntu, mas que uso e baixei uma versão mais nova foi o VMWare Player 3.0. Ficou super bacana, e agora dá pra criar novas VMs com ele (não cheguei a testar mas tem o botão lá).

Outro aplicativo que é fundamental para mim é o cliente de FTP FileZilla, que agora permite várias conexões simultâneas a diferentes servidores FTP, organizando as conexões em abas.

O cadastro de usuários agora permite que a senha não seja solicitada, algo que sentia falta demais, pois sempre coloco senha no meu usuário e gostaria que os outros (como da minha esposa) não tivessem senha.

Eu li que tinham trocado a página inicial do Firefox para o Yahoo mas voltaram atrás, ou a notícia era falsa.

O boot usando partições EXT4 está incrivelmente rápido, mais do que na versão anterior.

Bem, por enquanto é isso. Qualquer novidade posto aqui.
