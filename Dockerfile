# Use PHP 8.3 FPM image
FROM php:8.3-fpm

# Instalacija system dependencies i PHP ekstenzija
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Instalacija Node.js i npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Instalacija Composer-a
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Postavljanje radnog direktorijuma
WORKDIR /var/www

# Kopiranje Laravel aplikacije u kontejner
COPY . .

# Instalacija Composer dependencija
RUN composer install

# Pokretanje Laravel development servera
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
