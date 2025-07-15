FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel

RUN docker-php-ext-install pdo pdo_mysql

RUN apk add --no-cache linux-headers  \
    && apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS \  
    && pecl install xdebug \  
    && docker-php-ext-enable xdebug \  
    && pecl clear-cache \  
    && apk del .build-dependencies



# RUN chmod 777 -R storage/
# RUN chmod 777 -R database/