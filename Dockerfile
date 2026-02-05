# 1. PHP Image use karein
FROM php:8.2-fpm

# 2. System dependencies install karein
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl

# 3. PHP Extensions install karein
RUN docker-php-ext-install pdo_mysql gd

# 4. Composer copy karein
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Project files copy karein
WORKDIR /var/www
COPY . .

# 6. Permissions set karein
# Purani line: RUN chown -R www-data:www-data /var/www/storage /var/www/cache
# Nayi behtar line:
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]