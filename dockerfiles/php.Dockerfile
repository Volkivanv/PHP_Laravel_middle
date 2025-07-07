FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel

RUN docker-php-ext-install pdo pdo_mysql

# RUN chmod 777 -R storage/
# RUN chmod 777 -R database/