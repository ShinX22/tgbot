FROM php:8.2-apache

# Install zip extension for Composer if needed
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files (Notice the space between . and .)
COPY . .

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader

# Expose port 80
EXPOSE 80
