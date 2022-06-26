# syntax = docker/dockerfile:1.0-experimental

FROM php:8.1.4-fpm-alpine3.15

ARG DA_DEBUG

RUN apk add --no-cache unzip libxml2 libxml2-dev libpng-dev libzip-dev readline-dev gettext-dev oniguruma-dev \
    groff py-pip freetype-dev libjpeg-turbo-dev git icu-dev php8-pecl-apcu bash \
    && docker-php-ext-install -j$(nproc) bcmath opcache pcntl pdo_mysql mysqli soap zip \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd \
    && pip install awscli \
    && apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ --allow-untrusted gnu-libiconv \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.3.1 \
    && if [ "$DA_DEBUG" = "true" ]; then apk add --no-cache $PHPIZE_DEPS && pecl install xdebug-3.1.3 \
    && docker-php-ext-enable xdebug; fi

RUN apk add --no-cache bash && curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && apk add symfony-cli

RUN git config --global user.email "denisov1985@gmail.com"
RUN git config --global user.name "Dmytro Denysov"