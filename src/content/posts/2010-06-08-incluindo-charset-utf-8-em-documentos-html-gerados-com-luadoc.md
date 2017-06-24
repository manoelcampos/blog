---
author: admin
comments: true
layout: post
slug: incluindo-charset-utf-8-em-documentos-html-gerados-com-luadoc
title: Incluindo charset UTF-8 em documentos HTML gerados com LuaDoc
wordpress_id: 1540
categories:
- Dicas NCL e Lua
- Linux
- Programação
- TV Digital
tags:
- Acentos
- Documentação
- HTML
- Lua
- LuaDoc
- TV Digital
- UTF-8
---

[![](http://manoelcampos.com.br/wp-content/uploads/luadoc.png)](http://manoelcampos.com.br/wp-content/uploads/luadoc.png)Hoje vou mostrar uma dica rápida para usuários do [LuaDoc](http://luadoc.luaforge.net/), a ferramenta de geração de documentação de códigos fontes em [lua](http://www.lua.org), que tenho usado para documentar minhas aplicações em Lua para TV Digital.

Quem utiliza Lua no Linux, principalmente com o Gedit, provavelmente deve salvar todos os arquivos Lua em codificação UTF-8, já que esta é a codificação padrão deste editor de texto (muito bom por sinal). Com tal codificação você não terá problemas de exibição incorreta de caracteres acentuados. Além do mais, as aplicações de TV Digital só reconhecem caracteres acentuados nesta codificação (acredito que seja uma particularidade da linguagem Lua).

O problema é que, ao gerar a documentação HTML de um projeto Lua em UTF-8, os caracteres acentuados podem ser exibidos incorretamente. Pois no HTML gerado não é definido o charset usado no arquivo. Se você exibir o código fonte de um dos arquivos HTML de documentação, verá que há uma tag como abaixo:

```html
<!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8" --!>
```

Mas como pode ver, a mesma está comentada. Assim, para que o LuaDoc não gere a mesma desta forma, precisaremos alterar alguns arquivos. Se você instalou o runtime do Lua e o LuaDoc via apt-get, o diretório contendo os templates que precisam ser alterados é o /usr/share/lua/5.1/luadoc/doclet/html. Assim, abra os arquivos \*.lp neste diretório no Gedit e descomente a linha mostrada acima.

Pronto, basta salvar, fechar tudo e executar o LuaDoc novamente para atualizar a documentação, agora identificando os caracteres em UTF-8.
