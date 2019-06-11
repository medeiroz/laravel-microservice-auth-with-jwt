# Order API

Atualizar as dependencias do projeto
```
docker exec -it order-api-app composer update
```

Gerando a hash do jwt
``` 
docker exec -it order-api-app php artisan jwt:secret
```

Copiar o arquivo .env.example
```
docker exec -it order-api-app cp .env.example .env
```

Limpar o cache
```
docker exec -it order-api-app php artisan cache:clear && composer dumpautoload
```
"# laravel-microservice-auth-with-jwt" 
