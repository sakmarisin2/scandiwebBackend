FROM php:8.3-apache
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www/html
COPY . /var/www/html
EXPOSE 80