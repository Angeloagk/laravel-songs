# Gebruik PHP 8.2 met Apache
FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installeer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Zet werkdirectory
WORKDIR /var/www/html

# Kopieer alle bestanden
COPY . .

# Installeer PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Zet permissies voor storage en cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Kopieer env-testing als basis en genereer key
RUN cp .env.testing .env && php artisan key:generate --ansi

# Expose Apache poort
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
