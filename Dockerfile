FROM php:8.2-apache

# Required system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application
COPY . /var/www/html

# Laravel application directory
WORKDIR /var/www/html/src

# Install Laravel dependencies
RUN composer install \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data \
    /var/www/html/src/storage \
    /var/www/html/src/bootstrap/cache

EXPOSE 80