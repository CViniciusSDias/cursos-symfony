FROM php:8.4-cli

RUN apt update && apt install -y libzip-dev libicu-dev
RUN docker-php-ext-install sockets zip intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN echo "display_errors=Off" >> /usr/local/etc/php/conf.d/docker-php.ini

ENTRYPOINT ["php", "-S", "0.0.0.0:8000", "-t", "public/"]