FROM php:8.1-fpm
#RUN apt-get update && apt-get install curl
#RUN docker-php-ext-install pdo mysqli pdo_mysql
COPY --from=composer usr/bin/composer /usr/bin/composer