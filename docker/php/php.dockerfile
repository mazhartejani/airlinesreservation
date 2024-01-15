FROM php:8.1.0-fpm-alpine

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pcntl


# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html