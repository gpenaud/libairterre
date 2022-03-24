FROM php:7.2.34-apache

RUN a2enmod ssl
RUN a2enmod rewrite
RUN a2enmod headers

RUN \
  apt-get update && apt-get install --yes \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libonig-dev \
    zlib1g-dev

RUN \
  docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ && \
  docker-php-ext-install gd mbstring mysqli pdo pdo_mysql pdo_pgsql
