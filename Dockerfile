# Gebruik officiële PHP image met Apache
FROM php:8.2-apache

# Installeer systeem dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Enable Apache modules die Laravel nodig heeft
RUN a2enmod rewrite

# Stel werkdirectory in
WORKDIR /var/www/html

# Kopieer composer vanaf officiële image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Kopieer projectbestanden
COPY . .

# Pas Apache config aan zodat DocumentRoot naar /public wijst
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/|/var/www/html/public|g' /etc/apache2/apache2.conf

# Stel juiste permissies in
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Installeer PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
