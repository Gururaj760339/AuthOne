FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer config -g process-timeout 2000 \
    && composer config -g repos.packagist composer https://packagist.org \
    && composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000