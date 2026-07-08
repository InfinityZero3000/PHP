FROM php:8.3-apache

RUN a2enmod rewrite \
    && docker-php-ext-install mysqli pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html
