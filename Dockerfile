# Gebruik een officiële PHP image met Apache
FROM php:8.2-apache

# Installeer systeem dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd \
    && a2enmod rewrite

# Installeer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Kopieer project bestanden
COPY . .

# Rechten voor storage en bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Gebruik CI env bestand en genereer app key
RUN cp .env.ci .env && php artisan key:generate --ansi

# Expose poort 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
