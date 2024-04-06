FROM php:8.2-fpm

RUN apt-get update && apt-get install -y

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
    && docker-php-ext-install \
        zip \
        intl 
    
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

COPY backend/ /var/www/html

COPY .docker/composer/entrypoint.sh /entrypoint.sh
CMD ["php-fpm"]
ENTRYPOINT ["sh", "/entrypoint.sh"]

WORKDIR /var/www/html/