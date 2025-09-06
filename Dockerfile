FROM php:8.2-apache

# Installeer PHP-extensies + tools
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

# Kopieer project
COPY . .

# Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Permissies
RUN chown -R www-data:www-data storage bootstrap/cache

# Gebruik .env.testing en genereer app key
RUN cp .env.testing .env && php artisan key:generate --ansi

# Apache config
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>' >> /etc/apache2/apache2.conf

EXPOSE 80
CMD ["apache2-foreground"]
