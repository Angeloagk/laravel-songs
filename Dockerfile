# Gebruik PHP 8.2 met Apache
FROM php:8.2-apache

# Installeer PHP-extensies en tools
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd \
    && a2enmod rewrite

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Werkdirectory
WORKDIR /var/www/html

# Kopieer projectbestanden
COPY . .

# Installeer Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Stel permissies in voor storage en cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

# Gebruik .env.example en genereer app key
RUN cp .env.example .env && php artisan key:generate --ansi || true

# Apache configuratie
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>' >> /etc/apache2/apache2.conf

# Expose poort 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
