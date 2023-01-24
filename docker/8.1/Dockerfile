FROM php:8.1-apache-buster
RUN docker-php-ext-install mysqli
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/php.ini
#RUN chown -R www-data:www-data /var/www/html
