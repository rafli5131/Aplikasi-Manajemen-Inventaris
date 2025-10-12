FROM php:8.3-apache

# Install system dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        zip \
        unzip \
        libzip-dev \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libicu-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zlib1g-dev \
        mariadb-client \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl bcmath intl
RUN docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd

# Enable apache mods and rewrite
RUN a2enmod rewrite

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www/html

# Copy application files (in development we'll mount the code from host)
COPY . /var/www/html

# Copy custom apache vhost (serve from public)
COPY docker/php/000-default.conf /etc/apache2/sites-available/000-default.conf

# Ensure permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

EXPOSE 80

CMD ["apache2-foreground"]
