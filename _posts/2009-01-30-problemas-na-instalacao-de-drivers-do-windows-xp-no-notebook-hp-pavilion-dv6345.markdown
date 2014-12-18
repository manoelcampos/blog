---
author: admin
comments: true
layout: post
slug: problemas-na-instalacao-de-drivers-do-windows-xp-no-notebook-hp-pavilion-dv6345
title: Problemas na instalação de drivers do Windows XP no Notebook HP Pavilion dv6345
wordpress_id: 142
categories:
- Computadores
- Software
- Windows
tags:
- Notebook HP Pavilion dv6345
- Placa de Som
- Windows XP
---

Depois de resolver reinstalar o Windows XP no meu notebook HP Pavilion dv6345, tive uma grande surpresa. Alguns drivers como o da placa de som não instalavam de maneira alguma. Eu tenho os drivers do Windows XP que baixei no próprio [site da HP](http://h10025.www1.hp.com/ewfrf/wc/softwareList?os=228&lc=en&dlc=en&cc=us&lang=en&product=3376896) para o modelo que citei. Para instalação do driver no Windows XP SP2, é necessário a instalação do pacote "Microsoft Universal Audio Architecture (UAA) Bus Driver for High Definition Audio". Pelo que cita na descrição do instalador, é um pacote de melhorias e correções para o XP SP2. Porém, mesmo após instalar esse pacote, o driver da placa de som (Conexant Intel 82801GBM ICH7-M High Definition Audio Controller) não instalava, o instalador gerava exibia a mensagem de erro "Falha na instalação do driver: Impossível localizar o dispositivo para este driver", como se eu estivesse instalando o driver errado.

Fiz várias buscas no google e algumas davam a entender que o problema era do SP3 do Windows XP, porém, mesmo com o SP2 o erro ocorria.

No Gerenciador de Dispositivos do Windows, a placa de som aparecia em "Outros dispositivos" com uma exclamação e uma interrogação, indicando que havia algum problema com o driver.

Depois de muita pesquisa e nenhuma solução, me deu uma luz. Ao executar o instalador do driver (Conexant Intel 82801GBM ICH7-M High Definition Audio Controller), os arquivos são descompactados em "c:\swsetup\SP33443". Daí, fui ao "Painel de Controle", "Adicionar Hardware". Na primeira tela cliquei em avançar, na segunda informei que já havia conectado o hardware, na terceira escolhi "Adicionar novo dispositivo de hardware", ignorando o dispositivo que aparecia com uma interrogação e exclamação no início da lista. Na próxima tela escolhi "Instalar o hardware que eu selecionar manualmente em uma lista". Escolhi "Controlador de som vídeo e jogo" e na próxima tela cliquei no botão "Com disco" e selecionei a pasta "c:\swsetup\SP33443". Pronto, aí apareceu o nome da placa de som e bastou avançar para concluir a instalação e a placa funcionar imediatamente.

Para o modem teve o mesmo problema, mas como não o uso, não me preocupei em instalar, mas deve funcionar seguindo a mesma lógica.
