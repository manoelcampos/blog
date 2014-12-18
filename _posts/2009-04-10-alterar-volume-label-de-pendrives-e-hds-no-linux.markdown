---
author: admin
comments: true
layout: post
slug: alterar-volume-label-de-pendrives-e-hds-no-linux
title: Alterar Volume Label de PenDrives e HDs no Linux
wordpress_id: 315
categories:
- Linux
- SO
- Software
- Software Livre
tags:
- e2label
- fat32
- HD
- Linux
- mkfs.vfat
- Partições
- PenDrive
- Rótulo
- Volume Label
---

Para alterar o rótulo (label) do sistema de arquivos do seu pendrive, no linux, basta usar o comando mkfs. Se o seu pendrive tem sistema de arquivos fat32 (o padrão, pois assim ele é reconhecido em quase todos os sistemas operacionais), execute o comando mkfs.vfat assim:  **sudo mkfs.vfat -n NovoRotuloParaSeuPenDrive NomeDoDispositivo**.

**ANTES DE EXECUTAR, FAÇA BACKUP DOS ARQUIVOS DO SEU PENDRIVE, POIS O COMANDO APAGOU TUDO QUE TINHA NO MEU**. Felizmente, eu não guardo nada somente no pendrive, uso ele apenas para transportar algo de um computador para outro.

Veja abaixo um exemplo de comando, que usei para mudar o rótulo do meu pendrive:

    
    sudo mkfs.vfat -n mcampos /dev/sdb1


Diretamente pela interface do Gerenciador de Arquivos no Ubuntu não foi possível fazer, acredito que é pelo fato do sistema de arquivos ser fat32.

Para alterar o label de uma partição de um HD, basta usar o comando e2label assim: **sudo e2label NomeDoDispositivo NovoRotuloParaSeuPenDrive **. Neste caso, você não corre o risco de perder nenhum dado, mas ele não funciona com PenDrives, acredito ser devido ao sistema de arquivos fat32.

Veja exemplo:

    
    sudo e2label /dev/sda1 dados
