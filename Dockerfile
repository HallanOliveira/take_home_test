# Use the official PHP image
FROM php:8.1.27-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . .

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Expose port 80
EXPOSE 80

# Start Laravel server
CMD bash -c "composer install && php artisan serve --host 0.0.0.0 --port 80"