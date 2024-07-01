# Avaliacao-PHP-MYSQL

## O projeto consiste em análisar o conhecimento nas seguintes técnologias:

* PHP Orientado a Objetos
* Arquiteura MVC
* PDO com MySql
* Javascript ou JQuery

*Obs.: Favor enviar junto com o projeto o script da criação das tabelas.*


# Sobre o projeto

## Passo a Passo para Configuração

### 1. Clone o repositório

Clone o repositório do projeto para a sua máquina local usando o comando abaixo:

```bash
git clone https://github.com/Radbios/projeto_avaliacao_php.git
```

Entre no diretório do sistema (há dois, um é para o teste SQL)

```
cd projeto_avaliacao_php/projeto_avaliacao_php
```

### 2. Autoload

Os arquivos de autoload já estão gerados, mas se necessário, utiliza o comando

```
composer dump-autoload -o
```

### 3. Arquivo de Configuração
Faça uma cópia do arquivo ```example.php```e renomeie para ```config.php``` é nele você colocará as configurações do banco de dados

Copiar e renomear arquivo
```
cp example.php config.php
```

### 4. Banco de Dados

No projeto há o diretório ```database/migrations```, nele estará o script das tabelas utilizadas no sistema

Na raiz do projeto, execute as ```migrations``` para criar o banco e as tabelas, se elas não existirem

```
php database/migration.php
```
### 5. Inicie o Servidor

Inicie o servidor de desenvolvimento da aplicação

```
php -S localhost:8000 -t public
```

## Estrutura do Projeto

* ```app/``` - Arquivos principais da aplicação
* ```core/``` - Arquivos de controle do MVC
* ```database/``` - Arquivos de migração do banco
* ```public/``` - Arquivos públicos e raiz do sistema
* ```routes/``` - Arquivos de rotas da aplicação
* ```vendor/``` - Dependências do projeto (até então contém apenas o autoload)
* ```views/``` - Arquivos de view

# Notas do Desenvolvedor
1. Tentei deixar o mais parecido possível com o Laravel, então a estrutura é bem familiar (apesar de ser uma estrutura MVC simples).
2. Há vários espaços para organização e refatoração que sobraram pelo curto tempo de desenvolvimento.
3. ...







