FROM php:8.1.27
RUN apt-get update -y && apt-get install -y openssl zip unzip git libonig-dev libxml2-dev
RUN apt-get clean
RUN docker-php-ext-install pdo pdo_mysql mbstring xml
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

RUN composer install
CMD php artisan serve --host=0.0.0.0 --port=80
EXPOSE 80
