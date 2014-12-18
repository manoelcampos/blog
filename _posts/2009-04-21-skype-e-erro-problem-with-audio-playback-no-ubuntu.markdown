---
author: admin
comments: true
layout: post
slug: skype-e-erro-problem-with-audio-playback-no-ubuntu
title: Skype e erro "Problem with audio playback" no Ubuntu
wordpress_id: 369
categories:
- Linux
- SO
- Software
- Software Livre
tags:
- Alsa
- Linux
- Problem with audio playback
- PulseAudio
- Reprodução de som
- Servidor de áudio
- Skype
- Ubuntu
---

[![](http://manoelcampos.com/wp-content/uploads/skype-linux-150x90.jpg)](http://manoelcampos.com/wp-content/uploads/skype-linux.jpg)Sabe aqueles problemas que você convive com eles e só depois de muito tempo resolve dar um jeito? Pois é, foi assim com a mensagem de erro  "Problem with audio playback" que aparecia no Skype rodando no Ubuntu, quando estava usando outra aplicação de audio como um player, ou mesmo conectado ao bate papo no GMail. Para poder fazer uma ligação no Skype, tinha que fechar meu player e o Firefox que estava com o GMail aberto.

Rapidamente, procurando no google, encontrei uma solução [neste link](http://www.pulseaudio.org/wiki/PerfectSetup#Skype). O problema é relacionado aos drivers de som [Alsa](http://www.alsa-project.org), que mandam o fluxo de áudio diretamente para a placa de som, e a grande maioria dos chipsets de áudio atuais não suporta a reprodução de mais de um fluxo simultaneamente. Para isso é que surgiram os servidores de audio como o [PulseAudio](http://www.pulseaudio.org).

A seguir, mostro a tradução do [tutorial do site do PulseAudio](http://www.pulseaudio.org/wiki/PerfectSetup#Skype) para resolver o problema com o Skype:

Primeiro, adicione as linhas a seguir ao final do arquivo **/etc/pulse/daemon.conf**:

    
    default-fragments = 8
    default-fragment-size-msec = 5


No meu caso, as linhas já existiam, porém, o valor na última linha era 10 e eu apenas alterei para 5, mas não sei pra que isso serve, só sei que resolve.

Em seguida, edite o arquivo **~/.asoundrc** e adiciona as linhas a seguir, caso não existam:

    
    pcm.pulse { type pulse }
    ctl.pulse { type pulse }


No meu caso, o arquivo não existia, assim, tive que criá-lo.

Instale o pacote libasound2-plugins. Você pode fazer isso via apt-get. Meu Ubuntu 8.10 já tinha esse pacote instalado.

Não precisei reiniciar meu notebook, mas talvez seja necessário. Acredito que não foi preciso pois o pacote já estava instalado.

Finalmente, abra o Skype. Vá no menu de configurações, no item "Sound Devices", altere as opções "Ringing" e "Sound Out" para "pulse", e a opção "Sound In" para plughw (o dispositivo do seu microfone).

Mais informações e métodos alternativos, caso este não funcione pra você, são encontradas no [tutorial original](http://www.pulseaudio.org/wiki/PerfectSetup#Skype).

Para entender melhor sobre o [Alsa](http://www.alsa-project.org) e o [PulseAudio](http://www.pulseaudio.org), veja [este artigo do Guia do Hardware](http://www.gdhpress.com.br/blog/servidores-de-som/).
