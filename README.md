# Atak Test - BackEnd

O BackEnd do projeto foi construído em PHP 8.2 usando Laravel. Após clonar a aplicação, acesse o diretório do projeto, instale as bibliotecas necessarias e inicie o serviço da aplicação.

## Instruções

### Entre no diretorio do projeto
```
cd .\BMSAtakTest\
```

### Instale as bibliotecas e dependências
```
composer install
```

### Execute a aplicacao
```
php artisan serve
```



A API estará disponível pelo seguinte endereço:
```
localhost:8000/api/search
```

A requisição deve ser enviada via GET com a variavel 'q' contendo o que deverá ser pesquisado. Exemplo:
```
localhost:8000/api/search?q=pipoca
```
