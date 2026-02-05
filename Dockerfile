# 1. PHP Image use karein (FPM ki jagah standard PHP use kar rahe hain for artisan serve)
FROM php:8.2-cli

# 2. System dependencies install karein
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev

# 3. PHP Extensions install karein
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. Composer copy karein official image se
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Project files copy karein
WORKDIR /var/www
COPY . .

# 6. Dependencies install karein (Jo pehle missing thi)
# Yeh command vendor folder banayegi
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 7. Permissions set karein storage aur cache ke liye
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# 8. Port 8000 expose karein
EXPOSE 8000

# 9. Laravel server start karein
# --host=0.0.0.0 lazmi hai taaki AWS external requests accept kare
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]