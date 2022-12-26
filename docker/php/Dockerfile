FROM php:8.1-fpm
##RUN curl -sS https://getcomposer.org/installer | \
##    php -- --install-dir=/usr/bin/ --filename=composer
##WORKDIR ./../task
##COPY . ./
##RUN composer install --no-dev --no-interaction -o
COPY --from=composer usr/bin/composer /usr/bin/composer
###RUN chmod -R 755 ./
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer