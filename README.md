# Atak Test - BackEnd

O BackEnd do projeto foi construído em PHP usando Laravel. Após clonar a aplicação, acesse o diretório do projeto, instale as suas dependências e inicie o serviço da aplicação.

## Requisitos

 - PHP 8.2
 - Composer

## Instruções

### Entre no diretório do projeto
```
cd .\BMSAtakTest\
```

### Instale as dependências
```
composer install
```

### Execute a aplicação
```
php artisan serve
```

## Utilização

A API estará disponível pelo seguinte endereço:
```
localhost:8000/api/search
```

A requisição deve ser enviada via GET com a variavel 'q' contendo o que deverá ser pesquisado. Exemplo:
```
localhost:8000/api/search?q=pipoca
```
