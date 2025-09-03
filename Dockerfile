# Gebruik PHP 8.2 met Apache
FROM php:8.2-apache

# Install system dependencies en PHP-extensies
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

# Kopieer alle bestanden naar de container
COPY . .

# Installeer PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Pas Apache DocumentRoot aan naar public/
RUN sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Zet permissies voor storage en cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Stel omgeving variabelen (optioneel, kunnen ook via Render UI)
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV PORT=10080

# Expose port 80
EXPOSE 80

# Voer migraties uit
RUN php artisan migrate --force

# Start Apache
CMD ["apache2-foreground"]
