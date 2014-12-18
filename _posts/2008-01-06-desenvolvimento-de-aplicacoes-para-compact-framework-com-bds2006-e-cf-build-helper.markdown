---
author: admin
comments: true
layout: post
slug: desenvolvimento-de-aplicacoes-para-compact-framework-com-bds2006-e-cf-build-helper
title: Desenvolvimento de aplicações para Compact Framework com BDS2006 e CF Build Helper
wordpress_id: 29
categories:
- Delphi
- Programação
tags:
- .NET Compact Framework
- BDS2006
- Borland Developer Studio
- CF Build Helper
---

Quem está desenvolvendo aplicações para dispositivos móveis Pocket PC ou Smartphones com o Borland Developer Studio 2006 utilizando o plugin Compact Framework Build Helper pode se deparar com o erro ILLK3860 no momento da compilação da aplicação. Procurando na internet encontrei apenas uma resposta indicando que este erro poderia ser do compilador do Delphi ou do Plugin. Já comecei a me desesperar. Porém, meu projeto estava compilando antes, então, tentei lembrar o que tinha feito de diferente para ele deixar de compilar. Aí lembrei que tinha incluído um arquivo AssemblyInfo no projeto, para adicionar informações sobre a versão da aplicação. Assim, descobri que isto foi a causa do erro quando removi o arquivo do projeto. Em projeto para .NET Compact Framework (deve valer para aplicacações Windows  Forms com o.NET Framework), as informações de versão devem ser incluídas diretamente no arquivo dpr.
