## Build PHP application
FROM php:8.2-fpm as php

# Install packages
ARG PHP_EXTS="bcmath pdo pdo_mysql soap zip gd"
ARG PHP_DEPENDENCIES="git nginx curl unzip openssh-client openssl \
                    libcurl4-gnutls-dev libzip-dev libmcrypt-dev  \
                    libxml2-dev libpq-dev libbz2-dev libicu-dev \
                    libpng-dev libjpeg-dev"

ARG PHP_DEPENDENCIES
RUN apt-get update -y
RUN apt-get install -y ${PHP_DEPENDENCIES}

ARG PHP_EXTS
RUN docker-php-ext-install ${PHP_EXTS}

WORKDIR /var/www

COPY --chown=www-data:www-data . .

COPY --from=composer:2.8.5 /usr/bin/composer /usr/bin/composer

# Add configuration files.
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

ENTRYPOINT [ "docker/entrypoint.sh" ]
