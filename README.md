# Laravel Micro Service Auth With Jwt"

Subindo os containers
```
docker-compose up -d
```

Atualizar as dependencias do projeto
```
docker exec -it api-users-app composer update
```

Copiar o arquivo .env.example
```
docker exec -it api-users-app cp .env.example .env
```

Gerando a hash do Jwt
``` 
docker exec -it api-users-app php artisan jwt:secret
```

Limpar o cache
```
docker exec -it api-users-app php artisan cache:clear && composer dumpautoload
```

Rodando as Migrations com as Seeders
```
docker exec -it api-users-app php artisan migrate:refresh --seed
```


# Documentation
