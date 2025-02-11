<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](https://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.4.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](https://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](https://www.yiiframework.com/download/) to
a directory named `basic` that is directly under the Web root.

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install with Docker

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up -d
    
You can then access the application through the following URL:

    http://127.0.0.1:8000

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](https://codeception.com/).
By default, there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

To execute acceptance tests do the following:  

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full-featured
   version of Codeception

3. Update dependencies with Composer 

    ```
    composer update  
    ```

4. Download [Selenium Server](https://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    In case of using Selenium Server 3.0 with Firefox browser since v48 or Google Chrome since v53 you must download [GeckoDriver](https://github.com/mozilla/geckodriver/releases) or [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) and launch Selenium with it:

    ```
    # for Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar
    
    # for Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ``` 
    
    As an alternative way you can use already configured Docker container with older versions of Selenium and Firefox:
    
    ```
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```

5. (Optional) Create `yii2basic_test` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


6. Start web server:

    ```
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```
   # run all available tests
   vendor/bin/codecept run

   # run acceptance tests
   vendor/bin/codecept run acceptance

   # run only unit and functional tests
   vendor/bin/codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template é uma aplicação esqueleto [Yii 2](https://www.yiiframework.com/) ideal para criar pequenos projetos rapidamente.

O template contém os recursos básicos, incluindo login/logout de usuário e uma página de contato.
Inclui todas as configurações comumente usadas que permitem focar na adição de novos recursos à sua aplicação.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

ESTRUTURA DO DIRETÓRIO
----------------------

      assets/             contém definições de assets
      commands/           contém comandos de console (controllers)
      config/             contém configurações da aplicação
      controllers/        contém classes de controllers Web
      mail/               contém arquivos de visualização para e-mails
      models/             contém classes de modelo
      runtime/            contém arquivos gerados durante a execução
      tests/              contém vários testes para a aplicação básica
      vendor/             contém pacotes de terceiros dependentes
      views/              contém arquivos de visualização para a aplicação Web
      web/                contém o script de entrada e recursos Web

REQUISITOS
----------

O requisito mínimo para este template de projeto é que seu servidor Web suporte PHP 7.4.

INSTALAÇÃO
----------

### Instalar via Composer

Se você não tem o [Composer](https://getcomposer.org/), pode instalá-lo seguindo as instruções em [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-nix).

Você pode então instalar este template de projeto usando o seguinte comando:

~~~
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
~~~

Agora você deve ser capaz de acessar a aplicação através da seguinte URL, assumindo que `basic` é o diretório diretamente sob a raiz Web.

~~~
http://localhost/basic/web/
~~~

### Instalar a partir de um Arquivo de Arquivo

Extraia o arquivo de arquivo baixado de [yiiframework.com](https://www.yiiframework.com/download/) para um diretório chamado `basic` que está diretamente sob a raiz Web.

Defina a chave de validação de cookie no arquivo `config/web.php` para uma string secreta aleatória:

```php
'request' => [
    // !!! insira uma chave secreta na seguinte (se estiver vazia) - isso é necessário para a validação de cookies
    'cookieValidationKey' => '<chave secreta aleatória aqui>',
],
```

Você pode então acessar a aplicação através da seguinte URL:

~~~
http://localhost/basic/web/
~~~

### Instalar com Docker

Atualize seus pacotes de fornecedor

    docker-compose run --rm php composer update --prefer-dist
    
Execute os gatilhos de instalação (criando código de validação de cookie)

    docker-compose run --rm php composer install    
    
Inicie o container

    docker-compose up -d
    
Você pode então acessar a aplicação através da seguinte URL:

    http://127.0.0.1:8000

**NOTAS:** 
- Versão mínima do Docker engine requerida `17.04` para desenvolvimento (veja [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- A configuração padrão usa um host-volume no seu diretório home `.docker-composer` para caches do composer

CONFIGURAÇÃO
------------

### Banco de Dados

Edite o arquivo `config/db.php` com dados reais, por exemplo:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTAS:**
- O Yii não criará o banco de dados para você, isso deve ser feito manualmente antes que você possa acessá-lo.
- Verifique e edite os outros arquivos no diretório `config/` para personalizar sua aplicação conforme necessário.
- Consulte o README no diretório `tests` para informações específicas sobre testes da aplicação básica.

TESTES
------

Os testes estão localizados no diretório `tests`. Eles são desenvolvidos com o [Codeception PHP Testing Framework](https://codeception.com/).
Por padrão, há 3 suítes de teste:

- `unit`
- `functional`
- `acceptance`

Os testes podem ser executados executando

```
vendor/bin/codecept run
```

O comando acima executará testes unitários e funcionais. Os testes unitários testam os componentes do sistema, enquanto os testes funcionais
testam a interação do usuário. Os testes de aceitação estão desativados por padrão, pois exigem configuração adicional, pois
executam testes em um navegador real.

### Executando testes de aceitação

Para executar testes de aceitação, faça o seguinte:

1. Renomeie `tests/acceptance.suite.yml.example` para `tests/acceptance.suite.yml` para habilitar a configuração da suíte

2. Substitua o pacote `codeception/base` em `composer.json` por `codeception/codeception` para instalar a versão completa
   do Codeception

3. Atualize as dependências com o Composer 

    ```
    composer update  
    ```

4. Baixe o [Selenium Server](https://www.seleniumhq.org/download/) e inicie-o:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    No caso de usar o Selenium Server 3.0 com o navegador Firefox desde a versão 48 ou Google Chrome desde a versão 53, você deve baixar o [GeckoDriver](https://github.com/mozilla/geckodriver/releases) ou [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) e iniciar o Selenium com ele:

    ```
    # para Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar
    
    # para Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ``` 
    
    Como uma alternativa, você pode usar um container Docker já configurado com versões mais antigas do Selenium e Firefox:
    
    ```
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```

5. (Opcional) Crie o banco de dados `yii2basic_test` e atualize-o aplicando migrações, se houver.

   ```
   tests/bin/yii migrate
   ```

   A configuração do banco de dados pode ser encontrada em `config/test_db.php`.

6. Inicie o servidor web:

    ```
    tests/bin/yii serve
    ```

7. Agora você pode executar todos os testes disponíveis

   ```
   # execute todos os testes disponíveis
   vendor/bin/codecept run

   # execute testes de aceitação
   vendor/bin/codecept run acceptance

   # execute apenas testes unitários e funcionais
   vendor/bin/codecept run unit,functional
   ```

### Suporte a cobertura de código

Por padrão, a cobertura de código está desativada no arquivo de configuração `codeception.yml`, você deve descomentar as linhas necessárias para poder
coletar a cobertura de código. Você pode executar seus testes e coletar a cobertura com o seguinte comando:

```
# coletar cobertura para todos os testes
vendor/bin/codecept run --coverage --coverage-html --coverage-xml

# coletar cobertura apenas para testes unitários
vendor/bin/codecept run unit --coverage --coverage-html --coverage-xml

# coletar cobertura para testes unitários e funcionais
vendor/bin/codecept run functional,unit --coverage --coverage-html --coverage-xml
```

Você pode ver a saída da cobertura de código no diretório `tests/_output`.

vendor/bin/codecept run --coverage --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit --coverage --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit --coverage --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
