---
author: admin
comments: true
layout: post
slug: criando-instaladores-para-aplicacoes-net-compact-framework-com-ferramentas-gratuitas
title: Criando Instaladores para Aplicações .NET Compact Framework com Ferramentas Gratuitas
wordpress_id: 1401
categories:
- Mobile
- Software
- Windows
tags:
- .NET CF
- .NET Compact Framework
- Cab
- CabWiz
- CabWizard
- EzSetup
- Gerador de Instalador
- Instalador
- PocketPC Cab Tools
- Setup
- Windows CE
- Windows Mobile
---

## [![](http://manoelcampos.com/wp-content/uploads/dotnet.jpg)](http://manoelcampos.com/wp-content/uploads/dotnet.jpg)Introdução


No artigo [Gerador de setup gratuito para aplicações em .NET Compact Framework](http://manoelcampos.com/2009/10/25/gerador-de-setup-gratuito-para-aplicacoes-em-net-compact-framework-net-cf/) apresentei a ferramenta [Pocket PC Installation Creator (PPCIC)](http://www.aperitto.com/products/ppcic). Tal ferramenta é um IDE muito prático para a geração de instaladores para aplicações .NET Compact Framework, cuja versão gratuita tem o incoveniente de exibir um Message Box na inicialização do instalador no Pocket PC/Smartphone. Desta forma, vou apresentar neste artigo outras ferramentas gratuitas para geração de tais instaladores.

Infelizmente tais ferramentas não possuem um IDE como o PPCIC, mas devido os instaladores de aplicações .NET CF serem geralmente bastante simples, o IDE não faz tanta falta, mas com certeza ajuda demais :).


--more Leia Mais--





## Ferramentas Necessárias


Para iniciar você precisará do [EzSetup](http://www.spbsoftwarehouse.com/products/ezsetup) ([link alternativo](http://manoelcampos.com/wp-content/uploads/ezsetup21.zip)) e do pacote [PocketPC Cab Tools](http://www.trajectorylabs.com/pocket_pc_cab_file.html) ([link alternativo](http://manoelcampos.com/wp-content/uploads/pocketpc-cab-tools.zip)). No entanto, só é necessário baixar o PocketPC Cab Tools, pois o mesmo já inclui o EzSetup 2. Os links para o EzSetup são apenas para conhecimento.

Como explicado no artigo anteriormente citado, o instalador a ser gerado é composto por uma aplicação desktop, que deve ser instalada em um PC convencional com Windows, que iniciará o processo de instalação do aplicativo .NET CF no PocketPC/Smartphone.

Assim, o EzSetup é o responsável por gerar o instalador para Windows. O pacote PocketPC Cab Tools contém ferramentas para a geração de um arquivo cab, que conterá os arquivos a serem instalados no PocketPC/Smartphone, e o programa para criar os devidos atalhos no menu Iniciar do Windows Mobile/Windows CE.





## Gerador de setup gratuito para aplicações em .NET Compact Framework







## Mão na Massa


Vamos considerar que você tenha uma aplicação .NET CF de nome MyApp.exe. Assim, crie uma pasta para o projeto do instalador, com o nome de MyAppSetup. Dentro desta pasta, crie uma sub-pasta de nome ezsetup e descompacte o pacote PocketPC Cab Tools dentro dela. Lembrando que ele já inclui o EzSetup.

Salve os arquivos que deseja incluir no seu instalador, dentro da pasta MyAppSetup. No caso do nosso exemplo, os arquivos serão o MyApp.exe e usuario.xml. Tais arquivos de exemplo estão disponíveis no arquivo zip para [download](http://manoelcampos.com/wp-content/uploads/myapp-setup.zip), contendo todos os arquivos apresentados ao longo do artigo, inclusive as ferramentas necessárias.


### Criando o arquivo cab


Vamos agora criar um arquivo de projeto para geração do pacote cab que conterá os arquivos a serem instalados no dispositivo móvel. Este é um arquivo texto, com extensão inf, que pode ter o nome que desejar. Vamos criá-lo com o nome de MyApp.inf, dentro da pasta MyAppSetup. Este arquivo inf é como um arquivo ini, que armazena valores dentro de seções (os nomes entre chaves: [Secao1]), no formato chave=valor.

A listagem a seguir mostra o conteúdo que deve haver no arquivo MyApp.inf. Logo abaixo é explicado a finalidade das principais linhas. O uso de ponto-e-vírgula adiciona um comentário de uma linha, a partir do ponto onde foi adicionado.

    
    ;Arquivo de configuração utilizado pela aplicação cabwiz.exe para geração de arquivo .cab contendo os arquivos para instalação do sistema no PocketPC
    [Version]
    Signature = "$Windows NT$" ; requerido como está
    Provider = "Manoel Campos.com" ; máximo de 30 caracteres
    CESignature = "$Windows CE$" ; requerido como está
    
    [CEStrings]
    AppName = "MyApp" ; máximo de 40 caracteres
    InstallDir = %CE1%\%AppName% ; Program Files\%AppName%
    
    [SourceDisksNames] ; diretório que contém os arquivos da aplicação
    ;1 = ,"Managed",,
    1 = .\
    
    [SourceDisksFiles] ; lista de arquivos a serem incluídos no .cab, sem o caminho
    MyApp.exe = 1
    usuario.xml = 1
    
    [DefaultInstall] ; operações a serem realizadas na instalação
    CopyFiles = CopyToProgramFiles
    AddReg = RegData
    CEShortcuts = Shortcuts.Menu
    
    [DestinationDirs] ; diretório de destino para cada operação realizada
    CopyToProgramFiles = 0, %InstallDir%
    Shortcuts.Menu = 0, %CE11% ; \Windows\Start Menu\Programs\MyApp
    
    [CopyToProgramFiles] ; lista de arquivos da operação de cópia
    "MyApp.exe", MyApp.exe
    "usuario.xml", usuario.xml
    
    [RegData] ; lista de chaves a serem cadastradas no registro do Windows
    HKCU,Software\%AppName%,MajorVersion,0x00010001,1
    HKCU,Software\%AppName%,MinorVersion,0x00010001,0
    
    [Shortcuts.Menu]
    MyApp,0,"MyApp.exe",%CE11% ; Install into \windows\Programs





	
  * Na linha 4, em Provider, você deve informar o nome da sua empresa ou seu nome.

	
  * Na linha 8, em AppName, informe o nome do seu aplicativo, neste caso MyApp.

	
  * Na linha 9, em InstallDir, deve-se informar o caminho para instalação do aplicativo no dispositivo móvel. Neste caso, utilizou-se a constante %CE1%\%AppName%, que indica que o aplicativo será instalado dentro de uma pasta com o nome do aplicativo (neste caso MyApp), dentro de Arquivos de Programas.

	
  * Na linha 13, a frente do 1, deve-se indicar o diretório onde os arquivos da aplicação estão. O ideal seria colocar tais arquivos em uma sub-pasta, mas não consegui fazer isso funcionar, mesmo indicando o caminho da sub-pasta aqui.

	
  * Os itens dentro da seção [SourceDisksFiles] (a partir da linha 15) indicam os os arquivos a serem incluídos no arquivo cab, que será transferido para o dispositivo móvel para instalar o aplicativo. Coloque o nome dos arquivos, um por linha, sem o caminho, como mostrado na listagem acima. Lá foram incluídos os arquivos MyApp.exe e usuario.xml

	
  * Os itens na seção [DefaultInstall] (linha 19) definem as operações que serão realizadas pelo arquivo cab durante o processo de instalação. CopyFiles define o que será feito durante o processo de cópia dos arquivos. O valor desta chave deve ser o nome de uma seção que será definida logo abaixo. No caso de CopyFiles, o mesmo aponta para a seção CopyToProgramFiles, que explicarei logo a seguir. O item AddReg define o que será feito durante o processo de gravação de valores no registro do Windows, para registro do aplicativo no sistema operacional. Tal item aponta para a seção RegData. O item CEShortcuts define o que será feito durante o processo de criação de atalhos no dispositivo móvel. Tal item aponta para a seção Shortcuts.Menu.

	
  * Na seção [DestinationDirs], a partir da linha 24, são definidos os diretórios de destino de algumas das operações definidas anteriormente. Neste caso, a operação de cópia de arquivos, que definimos com o nome de CopyToProgramFiles, copiará os arquivos para o diretório do aplicativo (InstallDir), definido anteriormente. A operação de criação de atalhos, que demos o nome de Shortcuts.Menu, criará atalhos no menu Iniciar do Windows Mobile/Windows CE, dentro do grupo de programas criado para a aplicação. Isto é definido pelo uso da constante %CE11%

	
  * A seção [CopyToProgramFiles], na linha 28, especifica os arquivos que serão copiados para o diretório definido para a operação CopyToProgramFiles, especificado na seção [DestinationDirs]. Deve-se informar o nome de origem e o nome de destino para cada arquivo.

	
  * A seção [RegData], na linha 32, especifica quais chaves serão geradas no registro do Windows. As chaves adicionadas no exemplo apenas registram a versão do software a ser instalado, dentro da chave de registro HKEY_CURRENT_USER (HKCU), dentro de uma sub-chave com o nome do aplicativo (neste caso MyApp) e que terá dois identificadores: MajorVersion do software (1) e MinorVersion (0). Logo, identificando a versão do software como 1.0.

	
  * A seção [Shortcuts.Menu], na linha 36, especifica os atalhos a serem criados na operação de criação de atalhos.  A linha 37 especifica que será criado um atalho de nome MyApp, que aponta para o aplicativo MyApp.exe e o atalho será criado dentro do grupo Programas no menu iniciar (isto é definido pelo uso da constante %CE11%).


Pronto, nosso arquivo do projeto para geração do cab está pronto. Agora precisamos usar a aplicação cabwiz para gerar o cab. O cab é um arquivo compactado, que também contém instruções de programa, e que pode ser aberto com a maioria dos utilitários de compactação de arquivos como WinZip e WinRar.

Considerando que você descompactou o PocketPC Cab Tools dentro da sub-pasta ezsetup, vamos criar um arquivo bat para automatizar o processo de compilação do cab. Assim, crie um arquivo de nome 1-CreateCab.bat, dentro da pasta MyAppSetup. Note que coloquei o prefixo 1 no nome do arquivo para indicar a ordem que o mesmo deve ser executado. Logo, este deve ser o primeiro.

O conteúdo do arquivo deve ser como apresentado na listagem abaixo, comentada logo em seguida. Dentro de arquivos bat, o comando REM pode ser usado para definir um comentário de uma linha.

    
    REM Executar cabwiz.exe para gerar pacotes .cab contendo os arquivos de instalação
    ezsetup\Cabwiz.exe MyApp.inf


A linha 1 define um comentário e a 2 executa o cabwiz, passando nosso arquivo de projeto MyApp.inf. Agora pode dar dois cliques no arquivo bat criado. Se tudo correr bem, na pasta raiz será criado um arquivo de nome MyApp.cab e outro MyApp.dat. O nome dos arquivos gerados será o nome dado à aplicação no arquivo MyApp.inf. Se o arquivo cab não for gerado, abra um prompt de comando e execute o bat de lá, para ver possíveis mensagens de erro.


### Criando o instalador com EzSetup


O passo mais difícil já foi superado. Agora precisamos criar outro arquivo de projeto para gerar o nosso instalador, que será usado em um PC comum, com Windows XP por exemplo, a partir do qual o aplicativo será instalado no dispositivo móvel.

Bem, agora vamos criar um arquivo de nome MyApp-ezsetup.ini, dentro da pasta MyAppSetup. O conteúdo do arquivo é mostrado abaixo, e os comentários logo em seguida.

    
    [CEAppManager]
    Version = 1.0
    Component = MyApp
    
    [MyApp]
    Description = MyApp
    Uninstall = MyApp
    ;CabFiles = MyApp.arm.cab,MyApp.mips.cab,MyApp.sh3.cab ;pode-se definir diferentes arquivos cab, um para cada arquitetura de processador
    CabFiles = MyApp.cab





	
  * Na linha 2, em Version,  informe a versão do seu aplicativo.

	
  * Na linha3, em Component, informe o nome da seção que conterá as definições do instalador, a ser definida a seguir.  Normalmente utiliza-se o nome da aplicação para o nome da seção, neste caso, MyApp.

	
  * A linha 5 inicia a seção [MyApp], que define as configurações para o instalador a ser criado.

	
  * Na linha 6, em Description, deve-se definir uma descrição para o seu aplicativo, que aparecerá no programa de instalação.

	
  * Na linha 7, em Uninstall, deve-se informar o texto que aparecerá no desinstalador do programa.

	
  * Na linha 9, em CabFiles, deve-se definir os nomes dos arquivos cab a serem anexados ao instalador. No nosso caso temos apenas um cab. Na linha 8 (que está comentada) veja que podemos utilizar diferentes cab's, um para cada tipo de processador, pois nosso aplicativo pode precisar ser compilado para cada uma das diferentes plataformas, assim, gerando diferentes cab (o que não é o caso do .NET Compact Framework).


Agora crie um arquivo de nome eula.txt e outro de nome leiame.txt, dentro da pasta MyAppSetup. O primeiro deverá conter o texto dos termos de uso da aplicação. O segundo deverá conter o texto com informações sobre o aplicativo, que o usuário deve ler antes de instalá-lo.

E pra finalizar, vamos compilar nosso instalador com o EzSetup. Para automatizar o processo, vamos criar outro arquivo bat, este com o nome de 2-compile-ezsetup.bat, dentro da pasta MyAppSetup (veja que ele é o segundo a ser executado no processo de compilação). O conteúdo do arquivo é mostrado a abaixo, e os comentários logo em seguida.

    
    REM Deve-se chamar o bat para geração dos arquivos .cab e em seguida executar este bat para gerar o instalador da aplicação
    ezsetup\ezsetup.exe -l portuguese -i MyApp-ezsetup.ini -r leiame.txt -e eula.txt -o InstalarMyApp.exe


O bat chama o aplicativo ezsetup.exe (que deve estar dentro da pasta ezsetup), definindo o idioma para português, o arquivo leiame, o arquivo  de termos de uso, indicando que deve ser utilizado o arquivo de projeto do EzSetup de nome MyApp-ezsetup.ini e que o nome do instalador será InstalarMyApp.exe.

Agora dê dois cliques no arquivo 2-compile-ezsetup.bat para executá-lo. Se tudo correr bem, será criado o arquivo InstalarMyApp.exe. Caso contrário, abra um prompt e execute o bat de lá para ver possíveis mensagens de erro.

Ah, e antes que me perguntem porque eu não gerei um arquivo bat só, vou responder logo: primeiro porque não funcionou nem a pau (não me pergunta o motivo) e segundo, depois de tudo, com dois ficou mais didático :).


## Instalando o aplicativo no dispositivo móvel


Para instalar o aplicativo, o dispositivo móvel deve estar conectado a este computador via cabo USB ou outra forma, por intermédio do Microsoft Active Sync. O instalador criado fará a transferência do arquivo cab para o dispositivo móvel, e iniciará o processo de instalação do aplicativo no mesmo.

O processo de desinstalação do aplicativo também é feito pelo PC. A seguir são mostradas algumas imagens do instalado em ação e do resultado final: a aplicação instalada em um Pocket PC.
<table border="0" >
<tbody >
<tr >

<td >

[caption id="attachment_1413" align="alignleft" width="300" caption="Instalador do MyApp rodando no PC"][![Instalador do MyApp rodando no PC](http://manoelcampos.com/wp-content/uploads/InstalarMyApp-300x229.png)](http://manoelcampos.com/wp-content/uploads/InstalarMyApp.png)[/caption]
</td>

<td >

[caption id="attachment_1414" align="alignright" width="195" caption="MyApp Instalada em um PocketPC"][![MyApp Instalada em um PocketPC](http://manoelcampos.com/wp-content/uploads/MyAppInstalled-195x300.png)](http://manoelcampos.com/wp-content/uploads/MyAppInstalled.png)[/caption]
</td>
</tr>
<tr >

<td >

[caption id="attachment_1415" align="alignleft" width="195" caption="Atalhos de MyApp no Windows Mobile"][![Atalhos de MyApp no Windows Mobile](http://manoelcampos.com/wp-content/uploads/MyAppShortcut-195x300.png)](http://manoelcampos.com/wp-content/uploads/MyAppShortcut.png)[/caption]
</td>

<td >

[caption id="attachment_1416" align="alignright" width="191" caption="MyApp em Execução em um Pocket PC com Windows Mobile"][![MyApp em Execução em um Pocket PC com Windows Mobile](http://manoelcampos.com/wp-content/uploads/MyAppExecuting-191x300.png)](http://manoelcampos.com/wp-content/uploads/MyAppExecuting.png)[/caption]
</td>
</tr>
</tbody>
</table>
[attachments title="Download" force_saveas="1" logged_users="0" size="custom"]


## Referências


[http://www.trajectorylabs.com/pocket_pc_cab_file.html](http://www.trajectorylabs.com/pocket_pc_cab_file.html)

[http://windowsmobiledn.com/using-ezsetup-for-creating-pocket-pc-installations/](http://windowsmobiledn.com/using-ezsetup-for-creating-pocket-pc-installations/)

[http://www.smartphonemag.com/cms/_archives/Feb05/installers.aspx](http://www.smartphonemag.com/cms/_archives/Feb05/installers.aspx)
