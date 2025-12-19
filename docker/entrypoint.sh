#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    COMPOSER=composer-pipeline.json composer require laravel/telescope
    COMPOSER=composer-pipeline.json composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "'.env' file does not exists, creating it for $APP_ENV"
    cp .env.example .env
else
    echo "'env' file exist, proceeding.."
fi


# Give www-data access to the following folders:
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage
chmod -R 777 /var/www/storage/logs


# Remove local ssh key from the container
SSH_FILE="/root/.ssh/id_ed25519"
if [ -f "${SSH_FILE}" ]; then
    echo "Removing ssh key from the container"
    echo "" > ${SSH_FILE}
else
    echo "${SSH_FILE} does not exist."
fi

role=${CONTAINER_ROLE:-app}

php artisan migrate

set -e

php-fpm -F -O &

if [ "${APP_ENV}" = "local" ]; then
    echo "Running in local environment"
else
    echo "Running in ${APP_ENV} environment"

    mkdir -p /usr/local/var/log
    touch /usr/local/var/log/php-fpm.log
    chown -R www-data:www-data /usr/local/var/log

    tail -F /usr/local/var/log/php-fpm.log >&1 &
    sleep 1
fi

exec nginx -g "daemon off;"
