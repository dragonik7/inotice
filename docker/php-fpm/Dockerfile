FROM php:7.4-fpm

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN apt-get update && apt-get install -y && apt-get install curl -y && apt-get install git -y

RUN apt-get update -y && apt-get install -y iproute2 && apt-get install iputils-ping -y && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev

RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install gd
RUN docker-php-ext-install exif

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update && apt-get upgrade -y \
    && apt-get install apt-utils -y \
#
#    устанавливаем необходимые пакеты
    && apt-get install git zip vim libzip-dev libgmp-dev libffi-dev libssl-dev -y \
#
#    Включаем необходимые расширения
    && docker-php-ext-install -j$(nproc) sockets zip gmp pcntl bcmath ffi \
#
#    Расшерения через pecl ставятся так, то в php 8 pecl сейчас отсутствует, так что строки закоментированы
#    && PHP_OPENSSL=yes pecl install ev \
#    && docker-php-ext-enable ev \
#
#    Чистим временные файлы
    && docker-php-source delete \
    && apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y

RUN apt update \
    && apt-get install autoconf g++ make \
    && pecl install xdebug\
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

# COPY ./common/php/conf.d  /usr/local/etc/php/conf.d
# COPY ./php/conf.d /usr/local/etc/php/conf.d

# RUN chmod +x /usr/local/bin/docker-php-entrypoint

WORKDIR /var/www/app
