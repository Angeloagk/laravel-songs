# Gebruik PHP 8.2 + Apache
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
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && a2enmod rewrite

# Composer toevoegen
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Zet werkdirectory
WORKDIR /var/www/html

# Kopieer projectbestanden
COPY . .

# Installeer Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Zet permissies
RUN chown -R www-data:www-data storage bootstrap/cache

# Zet .env en genereer app key
RUN cp .env.testing .env && php artisan key:generate --ansi

# Pas Apache config aan voor Laravel routes
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>' >> /etc/apache2/apache2.conf

# Exposeer poort 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
