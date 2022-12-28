FROM php:8.1-fpm
COPY --from=composer usr/bin/composer /usr/bin/composer
RUN apt-get install npm -y \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug