Site on symfony with easy admin panel
=====================================

This is a test project for try new technologies. Used here:
* PHP 8
* Symfony 5.4
* Easy admin 4
* Docker
* Rabbit MQ
* Redis
* Api platform(Swagger 3 + JWT token secure auth)

Development manual
------------------

1. Set up environment variables, create `.env.local` and set
   1. MAILER_DSN
2. Set permissions on folder `var` [link on article](https://symfony.com/doc/current/setup/file_permissions.html#1-using-acl-on-a-system-that-supports-setfacl-linux-bsd)
3. Deploy project with docker `docker compose -p interview up -d`
4. Enter in php-fpm container `docker exec -it interview-php-1 sh`
   1. Execute migrations `php bin/console doctrine:migrations:execute`
   2. Generate the public and private keys used for signing JWT tokens `php bin/console lexik:jwt:generate-keypair`
   3. For email receiving start consumer in container `php bin/console messenger:consume async -vv`

Usage
-----

1. For access to admin panel need register user on page `/register` and set role `ROLE_ADMIN` from DB
2. For access to test api methods in doc swagger - enter in `/api`, send request `Creates a user token.` and authorize in swagger with received token like this: `Bearer {token}`

**Note:**
Temporarily project without front
