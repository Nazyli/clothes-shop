FROM php:8.0-fpm-alpine AS php

WORKDIR /var/www/rpl03

# Install system dependencies
RUN apk --update add \
    curl \
	openssl \
    libpng-dev \
    libxml2-dev \
	libzip-dev \
    curl-dev \
    oniguruma-dev

# Install PHP extensions
RUN docker-php-ext-install bcmath curl gd exif mbstring mysqli pdo pdo_mysql pcntl xml zip

# Clear cache
RUN apk del gcc g++
RUN rm -rf /var/cache/apk/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./ /var/www/rpl03

RUN composer install && mv /var/www/rpl03/vendor /lara_vendor