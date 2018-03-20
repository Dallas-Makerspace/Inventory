MAINTAINER infrastructure@dallasmakerspace.org
FROM php:7-apache

ARG FWATCHDOG_VERSION "0.7.1"

EXPOSE 80

ENV VIRTUAL_PORT 80
ENV VIRTUAL_PROTO http

HEALTHCHECK --interval=5s CMD 'curl -sSlk http://localhost/'

COPY . /var/www/html/

RUN a2enmod rewrite && \
    apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        zlib1g-dev \
        libicu-dev \
        g++ \
    && curl -sL https://github.com/openfaas/faas/releases/download/${FWATCHDOG_VERSION}/fwatchdog > /usr/bin/fwatchdog \
    && chmod +x /usr/bin/fwatchdog \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) iconv mcrypt intl pdo pdo_mysql mbstring \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && chmod -R 777 /var/www/html/{tmp,logs}
