FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . /var/www/html/

WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80


