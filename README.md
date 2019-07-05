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


# Documentação

## API Resources
### Verbos permitidos
 `GET`, `POST`, `PUT`, `PATCH` ou `DELETE`

### Necessário no header de todas as requisições
Header
```
Content-Type: application/json
Accept: application/json
```

### Necessário no hedader de todas as requisições que precisam estar autorizadas
Header
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
```

### Autenticação
[POST /auth/login](http://127.0.0.1:8000/auth/login) - Fazer login

Request
```
Content-Type: application/json
Accept: application/json
{
    "email": "smedeiros.flavio@gmail.com",
    "password": "secret"
}
```

Response
```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc",
    "token_type": "bearer",
    "expires_in": 3600
}
```

### Obtendo recurso com autorização necessária
[GET /auth/me](http://127.0.0.1:8000/auth/me)

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{ }
```

Response
```
{
    "id": 1,
    "name": "Flávio Medeiros",
    "email": "smedeiros.flavio@gmail.com",
    "email_verified_at": "2019-07-01 19:44:02",
    "created_at": "2019-06-18 18:35:07",
    "updated_at": "2019-07-01 19:44:03"
}
```

# Recursos
## Sem autenticação
[POST /register/create](http://127.0.0.1:8000/register/create) - Registrar um novo usuário 

Request
```
Content-Type: application/json
Accept: application/json
{
    "name": "Flávio Medeiros",
    "email": "mail@example.com",
    "password": "secret"
}
```
Response
```json
{
    "message": "Access your email to verify your account"
}
```


[POST /register/send_email_verification/{email}](http://127.0.0.1:8000/register/send_email_verification/{email}) - Envia o email para verificação da conta

Request
```
Content-Type: application/json
Accept: application/json
{ }
```

Response
```json
{
    "message": "Access your email to verify your account"
}
```

[POST /register/recovery/{email}](http://127.0.0.1:8000/register/recovery/{email}) - Envia o email de recuperação de senha

Request
```
Content-Type: application/json
Accept: application/json
{
	"url": "http://callback/url"
}
```

Response
```json
{
    "message": "Access your email to recovery your password"
}
```

[PUT /register/change_password/?token={token}](http://127.0.0.1:8000/register/change_password/?token={token}) - Faz a auteração da senha após o email de recuperação de senha

Request
```
Content-Type: application/json
Accept: application/json
{
	"password": "secret"
}
```

## Com autenticação

#### Logout
[POST /auth/logout](http://127.0.0.1:8000/auth/logout) - Logout

Request
```
Content-Type: application/json
Accept: application/json
{ }
```

Response
```json
{
    "message": "Successfully logged out"
}
```

[POST /auth/refresh](http://127.0.0.1:8000/auth/refresh) - Refresh Jwt

Request
```
Content-Type: application/json
Accept: application/json
{ }
```

Response
```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTYyMzYxODYxLCJleHAiOjE1NjIzNjU0NjEsIm5iZiI6MTU2MjM2MTg2MSwianRpIjoiVzViNGF1OEFyMlI5QzVLRCIsInN1YiI6MSwicHJ2IjoiMTNlOGQwMjhiMzkxZjNiN2I2M2YyMTkzM2RiYWQ0NThmZjIxMDcyZSJ9.5fhTO50P4Q3F_f_WoKb5fgIBB4aMNRA9xx6KrrarU8k",
    "token_type": "bearer",
    "expires_in": 3600
}
```

### Usuários
[GET /users](http://127.0.0.1:8000/users) - retorna todos os usuários disponíveis atualmente

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{ } 
```

Response
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "Flávio Medeiros",
            "email": "smedeiros.flavio@gmail.com",
            "email_verified_at": "2019-07-01 19:44:02",
            "created_at": "2019-06-18 18:35:07",
            "updated_at": "2019-07-01 19:44:03"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/users?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/users?page=1",
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/users",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```

[POST /users](http://127.0.0.1:8000/users) - Adiciona um usuário

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "name": "Flavio Medeiros",
    "email": "example@mail.com",
    "password": "secret"
} 
```

Response
```json
{
    "message": "Access your email to verify your account"
}
```

[GET /users/{id}](http://127.0.0.1:8000/users/{id}) - Retorna um usuário

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{ } 
```

Response
```json
{
    "id": 1,
    "name": "Flávio Medeiros",
    "email": "smedeiros.flavio@gmail.com",
    "email_verified_at": "2019-07-01 19:44:02",
    "created_at": "2019-06-18 18:35:07",
    "updated_at": "2019-07-01 19:44:03"
}
```


[PUT /users/{id}](http://127.0.0.1:8000/users/{id}) - Atualiza todos os campos de um usuário

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "name": "Flavio Medeiros",
    "email": "example@mail.com",
    "password": "secret"
} 
```

Response
```json
{
    "id": 1,
    "name": "Flávio Medeiros",
    "email": "example@mail.com",
    "email_verified_at": "2019-07-01 19:44:02",
    "created_at": "2019-06-18 18:35:07",
    "updated_at": "2019-07-05 21:30:56"
}
```


[PATCH /users/{id}](http://127.0.0.1:8000/users/{id}) - Atualiza um ou mais campos do usuário

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "name": "Flavio da Silva Medeiros Medeiros",
    ...
} 
```

Response
```json
{
    "id": 1,
    "name": "Flávio da Silva Medeiros",
    "email": "smedeiros.flavio@gmail.com",
    "email_verified_at": "2019-07-05 21:37:30",
    "created_at": "2019-07-05 21:37:30",
    "updated_at": "2019-07-05 21:37:49"
}
```

[DELETE /users/{id}](http://127.0.0.1:8000/users/{id}) - Delete um usuário

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{ } 
```

Response
```json
{
    "id": 1,
    "name": "Flávio da Silva Medeiros",
    "email": "smedeiros.flavio@gmail.com",
    "email_verified_at": "2019-07-05 21:37:30",
    "created_at": "2019-07-05 21:37:30",
    "updated_at": "2019-07-05 21:37:49"
}
```
