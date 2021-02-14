FROM php:7.4-fpm

RUN apt-get -y update \
 && apt-get install -y libicu-dev \
 && apt-get install -y libzip-dev\
 && apt-get install -y libpng-dev

RUN docker-php-ext-install pdo_mysql opcache intl gd zip