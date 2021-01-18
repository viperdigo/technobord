FROM php:7.4.14-fpm-alpine

WORKDIR /var/www

COPY . .

RUN apk update --no-cache \
&& apk add \
icu-dev \
oniguruma-dev \
tzdata

RUN docker-php-ext-install intl

RUN docker-php-ext-install pcntl

RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-install mbstring

RUN rm -rf /var/cache/apk/*

CMD ["php-fpm"]