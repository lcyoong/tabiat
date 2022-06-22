# This image contains the rest of Laravel's required PHP extensions
FROM php:8.0.3-fpm-buster

# Install PHP extensions
RUN docker-php-ext-install bcmath pdo_mysql

# Arguments defined in docker-compose.yml
# ARG user
# ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
# RUN groupadd -g 1000 www
# RUN useradd -u 1000 -ms /bin/bash -g www www

# Set working directory
# WORKDIR /var/www/wise.ticket

RUN composer global require "laravel/envoy=~1.0"

# USER $user
# RUN chmod -R ug+w /var/www/storage

# PHP Error Log Files
# RUN mkdir /var/log/php
# RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log