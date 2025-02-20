FROM php:8.1-fpm

# Çeşitli bağımlılıkları yükle
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Composer'ı yükle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizini oluştur
WORKDIR /var/www/html

# PHP uzantılarını yükle
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Kopyalama işlemi sırasında izinlerin doğru ayarlanması için bu kısmı ekle
RUN chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]