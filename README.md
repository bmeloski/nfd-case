# NFD API Test case

## Description

"Build REST API using Symfony/Laravel framework. The goal of the application is sending information about companies (name, tax number, address, city, postal code) and their workers(first name, last name, email, phone number(not required). All fields are required except for those that are stated not to. Develop endpoints for both entities."
## Installation

1. Clone repo.

2. Create the file `./.docker/.env.nginx` using `./.docker/.env.nginx.local` as template. The value of the variable `NGINX_BACKEND_DOMAIN` is the `server_name` used in NGINX.

3. Go inside folder `./docker` and run `docker-sync-stack start` to start containers.

5. Inside the `php` container, run `composer install` to install dependencies from `/var/www/symfony` folder.

6. Use the following value for the DATABASE_URL environment variable:

```
DATABASE_URL=mysql://app_nfd:helloworld@db:3306/nfd_test?serverVersion=8.0.23
```
7. Inside the php container you have to run command to set up db:
```
php bin/console doctrine:database:create
```
and then you have to set up schemas
```
php bin/console doctrine:migrations:migrate
```

8. After all those steps you are ready to test the API. Start with creating Company and Worker

## Api documentation
Here below i created api documentation for the task. 
https://documenter.getpostman.com/view/21888762/UzJQotER
