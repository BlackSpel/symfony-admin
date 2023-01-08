# Site on symfony with easy admin panel

## Development manual
1. Set up environment variables, create `.env.local` and set
   1. MAILER_DSN
2. Set permissions on folder `var` [link on article](https://symfony.com/doc/current/setup/file_permissions.html#1-using-acl-on-a-system-that-supports-setfacl-linux-bsd)
3. Deploy project with docker `docker compose -p interview up -d`
4. Enter in php-fpm container `docker exec -it interview-php-1 sh`
   1. Execute migrations `php bin/console doctrine:migrations:execute`
   2. For email receiving start consumer in container `php bin/console messenger:consume async -vv`
