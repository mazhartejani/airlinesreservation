#!/bin/bash

# Run php artisan migrate in container_name_1
docker exec -it docker-php-1 composer install
docker exec -it docker-php-1 cp .env.example .env
docker exec -it docker-php-1 php artisan key:generate
docker exec -it docker-php-1 php artisan key:generate
docker exec -it docker-php-1 chown -R www-data:www-data /var/www/html/storage
docker exec -it docker-php-1 npm install
docker exec -it docker-php-1 npm run build
docker exec -it docker-php-1 php artisan migrate:fresh --seed