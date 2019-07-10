# Laravel Micro Service Auth With Jwt"

## Table of contents
- [Getting started](#getting-started)
    * [Clone Repository](#clone-repository)
    * [Up Project](#up-project)
- [Documentation](#documentation)
    * [Allowed verbs](#allowed-verbs)
    * [Required in the header of all requests](#required-in-the-header-of-all-requests)
    * [Required in the Header of all requisitions that need to be authorized](#required-in-the-Header-of-all-requisitions-that-need-to-be-authorized)
    * [Authentication](#authentication)
    * [Getting resource with required authorization](#getting-resource-with-required-authorization)
    * [Resources](#resources)
        * [Without authentication](#without-authentication)
        * [With authentication](#with-authentication)
            * [Users](#users)
            * [Roles](#roles)
            * [Permissions](#permissions)
    * [Filter / Select / Paginate / Sort](#filter---select---paginate---sort)
        * [Filter](#filter)
        * [Select](#select)
        * [Paginate](#paginate)
        * [Sort](#sort)

## Getting startd

### Clone Repository
```
git clone https://github.com/MedeirosDev/laravel-microservice-auth-with-jwt.git
```


### Up Project
Up Containers
```
docker-compose up -d
```

Update project dependences
```
docker exec -it api-users-app composer update
```

copy .env.example to .env
```
docker exec -it api-users-app cp .env.example .env
```

Generate hash Jwt
``` 
docker exec -it api-users-app php artisan jwt:secret
```

Clear cache
```
docker exec -it api-users-app php artisan cache:clear && composer dumpautoload
```

Run Migrations with seeders
```
docker exec -it api-users-app php artisan migrate:refresh --seed
```


## Documentation
### Allowed verbs
 `GET`, `POST`, `PUT`, `PATCH` ou `DELETE`

### Required in the header of all requests
```
Content-Type: application/json
Accept: application/json
```

### Required in the Header of all requisitions that need to be authorized
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
```

### Authentication
[POST /auth/login](http://127.0.0.1:8000/auth/login) - Login

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

### Getting resource with required authorization
[GET /auth/me](http://127.0.0.1:8000/auth/me) - Return my information

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

# Resources
## Without authentication
[POST /register/create](http://127.0.0.1:8000/register/create) - Register a new user 

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


[POST /register/send_email_verification/{email}](http://127.0.0.1:8000/register/send_email_verification/{email}) - Send email for account verification

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

[POST /register/recovery/{email}](http://127.0.0.1:8000/register/recovery/{email}) - Send password recovery email

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

[PUT /register/change_password/?token={token}](http://127.0.0.1:8000/register/change_password/?token={token}) - Makes password change after password recovery email

Request
```
Content-Type: application/json
Accept: application/json
{
	"password": "secret"
}
```

## With authentication

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

### Users
[GET /users](http://127.0.0.1:8000/users) - Returns all users currently available

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

[POST /users](http://127.0.0.1:8000/users) - Add User

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

[GET /users/{id}](http://127.0.0.1:8000/users/{id}) - Show User

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


[PUT /users/{id}](http://127.0.0.1:8000/users/{id}) - Updates all fields for User

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


[PATCH /users/{id}](http://127.0.0.1:8000/users/{id}) - Updates one or more user fields a User

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "name": "Flavio da Silva Medeiros",
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

[DELETE /users/{id}](http://127.0.0.1:8000/users/{id}) - Delete User

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

[GET /users/{id}/roles](http://127.0.0.1:8000/users/{id}/roles) - Show user roles

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
            "name": "admin",
            "display_name": "Administrador",
            "description": "Administrador do sistema.",
            "created_at": "2019-07-10 11:41:27",
            "updated_at": null,
            "user_id": 1,
            "role_id": 1
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/users/1/roles?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/users/1/roles?page=1",
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/users/1/roles",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```

[PUT /users/{id}/roles](http://127.0.0.1:8000/users/{id}/roles) - Update all user roles

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "roles": [
	    1
    ]
}
```

Response
```json
[
    {
        "id": 1,
        "name": "admin",
        "display_name": "Administrador",
        "description": "Administrador do sistema.",
        "created_at": "2019-07-10 11:41:27",
        "updated_at": null,
        "pivot": {
            "user_id": 1,
            "role_id": 1
        }
    }
]
```

### Roles
[GET /roles](http://127.0.0.1:8000/roles) - Returns all roles currently available

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
            "name": "admin",
            "display_name": "Administrador",
            "description": "Administrador do sistema.",
            "created_at": "2019-07-10 11:41:27",
            "updated_at": null
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/roles?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/roles?page=1",
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/roles",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```


[POST /roles](http://127.0.0.1:8000/roles) - Add Role

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "name": "Test",
    "display_name": "Test.",
    "description": "Test Role"
}
```

Response
```json
{
    "name": "Test",
    "display_name": "Test.",
    "description": "Test Role",
    "updated_at": "2019-07-10 11:53:03",
    "created_at": "2019-07-10 11:53:03",
    "id": 2
}
```

[GET /roles/{id}](http://127.0.0.1:8000/roles/{id}) - Show Role

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
    "name": "admin",
    "display_name": "Administrador",
    "description": "Administrador do sistema.",
    "created_at": "2019-07-10 11:41:27",
    "updated_at": null
}
```


[PUT /roles/{id}](http://127.0.0.1:8000/roles/{id}) - Updates all fields for Role

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "name": "administrator",
    "display_name": "administrator",
    "description": "administrator system"
}
```

Response
```json
{
    "id": 1,
    "name": "administrator",
    "display_name": "administrator",
    "description": "administrator system",
    "created_at": "2019-07-10 11:41:27",
    "updated_at": "2019-07-10 11:56:34"
}
```


[PATCH /roles/{id}](http://127.0.0.1:8000/roles/{id}) - Updates one or more user fields a Role

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
	"name": "adm",
    "display_name": "Admin..."
}
```

Response
```json
{
    "id": 1,
    "name": "adm",
    "display_name": "Admin...",
    "description": "administrator system",
    "created_at": "2019-07-10 11:41:27",
    "updated_at": "2019-07-10 11:58:09"
}
```

[DELETE /roles/{id}](http://127.0.0.1:8000/roles/{id}) - Delete Role

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
    "name": "adm",
    "display_name": "Admin...",
    "description": "administrator system",
    "created_at": "2019-07-10 11:41:27",
    "updated_at": "2019-07-10 11:58:09"
}
```

[GET /roles/{id}/permissions](http://127.0.0.1:8000/roles/{id}/permissions) - Show role permissions

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
            "name": "users.read",
            "display_name": "Usuarios / Visualização",
            "description": null,
            "created_at": "2019-07-10 11:59:31",
            "updated_at": null,
            "permission_id": 1,
            "role_id": 1
        },
        {
            "id": 2,
            "name": "users.store",
            "display_name": "Usuarios / Criação",
            "description": null,
            "created_at": "2019-07-10 11:59:31",
            "updated_at": null,
            "permission_id": 2,
            "role_id": 1
        },
        ...
    ],
    "first_page_url": "http://127.0.0.1:8000/roles/1/permissions?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://127.0.0.1:8000/roles/1/permissions?page=2",
    "next_page_url": "http://127.0.0.1:8000/roles/1/permissions?page=2",
    "path": "http://127.0.0.1:8000/roles/1/permissions",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 16
}
```

[PUT /roles/{id}/permissions](http://127.0.0.1:8000/roles/{id}/permissions) - Update all role permissions

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
	"permissions": [
		1,
		2,
		3
	]
}
```

Response
```json
[
    {
        "id": 1,
        "name": "users.read",
        "display_name": "Usuarios / Visualização",
        "description": null,
        "created_at": "2019-07-10 12:05:44",
        "updated_at": null,
        "pivot": {
            "role_id": 1,
            "permission_id": 1
        }
    },
    {
        "id": 2,
        "name": "users.store",
        "display_name": "Usuarios / Criação",
        "description": null,
        "created_at": "2019-07-10 12:05:44",
        "updated_at": null,
        "pivot": {
            "role_id": 1,
            "permission_id": 2
        }
    },
    ...
]
```

### Permissions
[GET /permissions](http://127.0.0.1:8000/permissions) - Returns all permissions currently available

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
            "name": "users.read",
            "display_name": "Usuarios / Visualização",
            "description": null,
            "created_at": "2019-07-10 12:09:48",
            "updated_at": null
        },
        {
            "id": 2,
            "name": "users.store",
            "display_name": "Usuarios / Criação",
            "description": null,
            "created_at": "2019-07-10 12:09:48",
            "updated_at": null
        },
        ...
    ],
    "first_page_url": "http://127.0.0.1:8000/permissions?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://127.0.0.1:8000/permissions?page=2",
    "next_page_url": "http://127.0.0.1:8000/permissions?page=2",
    "path": "http://127.0.0.1:8000/permissions",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 16
}
```


[POST /permissions](http://127.0.0.1:8000/permissions) - Add Permission

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "name": "permissao.teste",
    "display_name": "Permissão de teste.",
    "description": "Apenas para teste"
}
```

Response
```json
{
    "name": "permissao.teste",
    "display_name": "Permissão de teste.",
    "description": "Apenas para teste",
    "updated_at": "2019-07-10 12:13:19",
    "created_at": "2019-07-10 12:13:19",
    "id": 17
}
```

[GET /permissions/{id}](http://127.0.0.1:8000/permissions/{id}) - Show Permission

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
    "name": "users.read",
    "display_name": "Usuarios / Visualização",
    "description": null,
    "created_at": "2019-07-10 12:09:48",
    "updated_at": null
}
```


[PUT /permissions/{id}](http://127.0.0.1:8000/permissions/{id}) - Updates all fields for Permission

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "name": "permissao.teste",
    "display_name": "Permissão de teste...",
    "description": "Apenas para teste"
}
```

Response
```json
{
    "id": 17,
    "name": "permissao.teste",
    "display_name": "Permissão de teste...",
    "description": "Apenas para teste",
    "created_at": "2019-07-10 12:13:19",
    "updated_at": "2019-07-10 12:17:21"
}
```


[PATCH /permissions/{id}](http://127.0.0.1:8000/permissions/{id}) - Updates one or more user fields a Permission

Request
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZXYuZG9ja2VyLmNvbTo4MDAwXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2MjM1OTc2MywiZXhwIjoxNTYyMzYzMzYzLCJuYmYiOjE1NjIzNTk3NjMsImp0aSI6IloyMklEcklZSXhiaTBLYloiLCJzdWIiOjEsInBydiI6IjEzZThkMDI4YjM5MWYzYjdiNjNmMjE5MzNkYmFkNDU4ZmYyMTA3MmUifQ.dPzPdRvcQd-yagIvdoOD_y3knDMCVHcKpbCW_U2FNSc
{
    "display_name": "Permissão de... test"
}
```

Response
```json
{
    "id": 17,
    "name": "permissao.teste",
    "display_name": "Permissão de... test",
    "description": "Apenas para teste",
    "created_at": "2019-07-10 12:13:19",
    "updated_at": "2019-07-10 12:18:22"
}
```

[DELETE /permission/{id}](http://127.0.0.1:8000/permission/{id}) - Delete Permission

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
    "id": 17,
    "name": "permissao.teste",
    "display_name": "Permissão de... test",
    "description": "Apenas para teste",
    "created_at": "2019-07-10 12:13:19",
    "updated_at": "2019-07-10 12:18:22"
}
```


###Filter / Select / Paginate / Sort
#### Filter
Allow filters ` `, `eq`, `lt`, `lte`, `gt`, `gte`, `like`, `regex`

Obs: ` ` references of `eq`
--
Use ` ` and `eq` in field filter `display_name`

` ` and `eq` Filter by equals
```
http://dev.docker.com:8000/permissions?display_name=Usuarios / Atualização
```
```
http://dev.docker.com:8000/permissions?display_name[eq]=Usuarios / Atualização
```

Use `lt` in field filter `created_at`

`lt` Filter by less
```
http://dev.docker.com:8000/permissions?created_at[lt]=2019-07-11
```
```
http://dev.docker.com:8000/permissions?created_at[lt]=2019-07-11 12:30
```

Use `lte` in field filter `created_at`

`lte` Filter by less or equal
```
http://dev.docker.com:8000/permissions?created_at[lte]=2019-07-11
```
```
http://dev.docker.com:8000/permissions?created_at[lte]=2019-07-11 12:30
```

Use `gt` in field filter `updated_at`

`gt` Filter by greater
```
http://dev.docker.com:8000/permissions?updated_at[gt]=2019-07-11
```
```
http://dev.docker.com:8000/permissions?updated_at[gt]=2019-07-11 12:30
```

Use `gte` in field filter `updated_at`

`gte` Filter by greater or equal
```
http://dev.docker.com:8000/permissions?updated_at[gte]=2019-07-11
```
```
http://dev.docker.com:8000/permissions?updated_at[gte]=2019-07-11 12:30
```

Use `lte` and `gte` in field filter `created_at`

`lte` Filter by less or equal

`gte` Filter by greater or equal
```
http://dev.docker.com:8000/permissions?created_at[lte]=2019-07-11&created_at[gte]=2019-06-11
produce =>   created_at <= 2019-07-11 && created_at >= 2019-06-11
```

Use `like` in field filter `display_name`

`like` Filter by contains
```
http://dev.docker.com:8000/permissions?display_name[like]=Usuarios
```
```
http://dev.docker.com:8000/permissions?display_name[like]=Criação
```

Use `regex` in field filter `name`

`regex` Filter by regular expression - [https://dev.mysql.com/doc/refman/5.6/en/regexp.html](https://dev.mysql.com/doc/refman/5.6/en/regexp.html)
```
http://dev.docker.com:8000/permissions?name[regex]=[a-z\\.]
```
```
http://dev.docker.com:8000/permissions?name[regex]=[0-9]
```


#### Select
select specific fields for resources
```
http://dev.docker.com:8000/permissions?fields=name,display_name
```
Response
```json
{
    "current_page": 1,
    "data": [
        {
            "name": "users.read",
            "display_name": "Usuarios / Visualização"
        },
        {
            "name": "users.store",
            "display_name": "Usuarios / Criação"
        },
        {
            "name": "users.update",
            "display_name": "Usuarios / Atualização"
        },
        ...
    ],
    "first_page_url": "http://dev.docker.com:8000/permissions?fields=name,display_name&page=1",
    ...
}
```

#### Paginate
Paginate Data

`per_page` default: 15 - Accept `all` to returl all results 

`page` default: 1


```
http://dev.docker.com:8000/permissions?page=1&per_page=15
http://dev.docker.com:8000/permissions
```
```
http://dev.docker.com:8000/permissions?page=2&per_page=15
http://dev.docker.com:8000/permissions?page=2
```
```
http://dev.docker.com:8000/permissions?per_page=all
```

#### Sort
Sort Data

`ASC` => ` ` or `+`

`DESC` => `-`
```
http://dev.docker.com:8000/permissions?sort=name,-display_name
http://dev.docker.com:8000/permissions?sort=+name,-display_name
```
```
http://dev.docker.com:8000/permissions?sort=+created_at
```
```
http://dev.docker.com:8000/permissions?sort=-updated_at,+created_at
```
```
http://dev.docker.com:8000/permissions?sort=-name,-created_at
```

#### Combine filter, select, paginate and sort
Combine filter, select, paginate and sort data
```
http://dev.docker.com:8000/permissions?
    fields=name,display_name&
    name[like]=user&
    sort=-name&
    per_page=30&
    page=1
```

```
http://dev.docker.com:8000/permissions?
    fields=name,display_name,created_at&
    name[like]=user&
    sort=-name&
    per_page=30
```

```
http://dev.docker.com:8000/permissions?
    fields=name,display_name,created_at&
    name[gte]=2019-06-10&
    sort=-updated_at&
    per_page=all
```
