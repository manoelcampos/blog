---
author: admin
comments: true
layout: post
slug: rastreamento-de-encomendas-no-site-dos-correios
title: Rastreamento de encomendas no site dos correios
wordpress_id: 37
categories:
- Internet
tags:
- Alerta
- Automatização
- Correios
- Encomendas
- Entrega
- Notificação
- PAC
- Rastreamento
- SEDEX
- Sistema
---

Quem faz compra de produtos pela internet, sendo entregue pelos Correios, normalmente pode rastrear o produto pelo site do mesmo.





Para agilizar esse processo de rastreamento, podemos acessar uma página dos Correios, passando parâmetros para exibir diretamente as informações do produto que desejamos rastrear. Você pode usar o endereço http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI=CODIGO_DE_RASTREAMENTO para rastrear um produto.





Deve-se trocar o CODIGO_DE_RASTREAMENTO pelo código do produto que deseja-se rastrear (código de 13 caracteres, iniciando com 2 letras e, para encomendas nacionais, terminando com BR). Veja este exemplo funcional [http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI=PB100715549BR](http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI=PB100715549BR) , onde o código de rastreamento é PB100715549BR.





Desta forma, pode-se abrir a página, com o endereço para rastrear o produto desejado, e incluí-la na lista de favoritos para facilitar a consulta posterior até o produto ser entregue.





## Sistema Automatizado de Rastreamento de Encomendas





Para automatizar o acompanhamento da encomenda, sendo alertado quando a mesma mudar de situação, veja este [outro artigo](http://manoelcampos.com/sistemas/rastreador/) sobre o [Sistema Automatizado de Rastreamento de Encomenda](http://manoelcampos.com/sistemas/rastreador/), simples e gratuito.
