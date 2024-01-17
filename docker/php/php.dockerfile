FROM php:8.1.0-fpm-alpine

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pcntl

# Install Node.js and npm from NodeSource repository
RUN apk add --update nodejs npm

# Set up the NodeSource repository
RUN apk add --no-cache curl && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | sh

# Install Node.js and npm again to get the desired version
RUN apk add --update nodejs npm

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html