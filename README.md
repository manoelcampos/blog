# Introdução

Arquivos fonte em formato markdown para geração do blog estático acessível em <http://manoelcampos.com.br>

O blog é gerado utilizando o [Spress 2.0](http://spress.yosymfony.com), um gerador de blogs estáticos
feito em PHP. 

# Requisitos para compilar o blog

- PHP 5.5+
- [Composer](http://getcomposer.org)
- Arquivo phar do [Spress 2.0](http://spress.yosymfony.com) na pasta do projeto
- [AWS Command Line Tools (aws-cli)](https://github.com/aws/aws-cli) para enviar os arquivos compilados para o Amazon S3

# Estrutura

- *src*: arquivos fonte em formato markdown que são lidos pelo Spress e compilados para HTML
- *build*: pasta onde o blog estático é gerado
- *vendor*: dependências do [Composer](http://getcomposer.org) usadas pelo Spress (para instalar execute `composer install`)

# Makefile

- *make*: compila os arquivos markdown gerando os HTML no diretório *build* 
- *make publish*: compila e faz upload dos arquivos gerados para o Amazon S3
- *make clean*: limpa a pasta *build*