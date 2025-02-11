<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Consultório Vem pra Moc</h1>
    <br>
</p>

Consultório Vem pra Moc é um sistema de gerenciamento para consultórios médicos, desenvolvido com o framework [Yii 2](https://www.yiiframework.com/).

O sistema inclui funcionalidades para gerenciar pacientes, médicos, consultas, prontuários eletrônicos, especialidades médicas e usuários do sistema.

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
      models/             contém classes de modelos
      runtime/            contém arquivos gerados durante a execução
      tests/              contém vários testes para a aplicação básica
      vendor/             contém pacotes de terceiros dependentes
      views/              contém arquivos de visualização para a aplicação Web
      web/                contém o script de entrada e recursos Web

REQUISITOS
----------

O requisito mínimo para este projeto é que seu servidor Web suporte PHP 7.4.

INSTALAÇÃO
----------

### Instalar via Composer

Se você não tem o [Composer](https://getcomposer.org/), você pode instalá-lo seguindo as instruções em [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-nix).

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
    'cookieValidationKey' => '<secret random string goes here>',
],
```

Você pode então acessar a aplicação através da seguinte URL:

~~~
http://localhost/basic/web/
~~~

### Instalar com Docker

Atualize seus pacotes de vendor

    docker-compose run --rm php composer update --prefer-dist
    
Execute os gatilhos de instalação (criando o código de validação de cookies)

    docker-compose run --rm php composer install    
    
Inicie o container

    docker-compose up -d
    
Você pode então acessar a aplicação através da seguinte URL:

    http://127.0.0.1:8000

**NOTAS:** 
- Versão mínima do Docker engine `17.04` para desenvolvimento (veja [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- A configuração padrão usa um host-volume no seu diretório home `.docker-composer` para caches do composer

CONFIGURAÇÃO
-------------

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
- Consulte o README no diretório `tests` para obter informações específicas sobre os testes da aplicação básica.

TESTES
------

Os testes estão localizados no diretório `tests`. Eles são desenvolvidos com o [Codeception PHP Testing Framework](https://codeception.com/).
Por padrão, existem 3 suítes de teste:

- `unit`
- `functional`
- `acceptance`

Os testes podem ser executados executando

```
vendor/bin/codecept run
```

O comando acima executará testes unitários e funcionais. Os testes unitários estão testando os componentes do sistema, enquanto os testes funcionais são para testar a interação do usuário. Os testes de aceitação estão desativados por padrão, pois exigem configuração adicional, pois realizam testes em um navegador real.

### Executando testes de aceitação

Para executar testes de aceitação, faça o seguinte:  

1. Renomeie `tests/acceptance.suite.yml.example` para `tests/acceptance.suite.yml` para habilitar a configuração da suíte

2. Substitua o pacote `codeception/base` em `composer.json` por `codeception/codeception` para instalar a versão completa do Codeception

3. Atualize as dependências com o Composer 

    ```
    composer update  
    ```

4. Baixe o [Selenium Server](https://www.seleniumhq.org/download/) e inicie-o:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    No caso de usar o Selenium Server 3.0 com o navegador Firefox desde a versão 48 ou Google Chrome desde a versão 53, você deve baixar o [GeckoDriver](https://github.com/mozilla/geckodriver/releases) ou o [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) e iniciar o Selenium com ele:

    ```
    # para Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar
    
    # para Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ``` 
    
    Como alternativa, você pode usar um container Docker já configurado com versões mais antigas do Selenium e Firefox:
    
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

Por padrão, a cobertura de código está desativada no arquivo de configuração `codeception.yml`, você deve descomentar as linhas necessárias para poder coletar a cobertura de código. Você pode executar seus testes e coletar a cobertura com o seguinte comando:

```
# coletar cobertura para todos os testes
vendor/bin/codecept run --coverage --coverage-html --coverage-xml

# coletar cobertura apenas para testes unitários
vendor/bin/codecept run unit --coverage --coverage-html --coverage-xml

# coletar cobertura para testes unitários e funcionais
vendor/bin/codecept run functional,unit --coverage --coverage-html --coverage-xml
```

Você pode ver a saída da cobertura de código no diretório `tests/_output`.
