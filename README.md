# Post/Users

## Introducción

Api basada en Laravel

## Requerimentos de sistema

- [Docker](https://www.docker.com) >= 17.06 CE
- [Docker Compose](https://docs.docker.com/compose/install/)

## Tecnología

- [PHP]
- [SQLite]

## Instalación

1.- Ejecutar comando para construir y levantar los contenedores:
- Al levantar los contenedores se ejecutara en el servidor el composer, los migrations y el cron que inserta usuarios y post en la BD.
```bash
   $ docker-compose up --build
```

## Endpoints
 
### GET
[http://localhost:8045/api/posts/{id}]
[http://localhost:8045/api/post/top]
[http://localhost:8045/api/users]

