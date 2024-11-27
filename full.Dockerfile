FROM php:8.2-fpm
WORKDIR /var/www
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    htop \
    unzip \
    nodejs \
    npm \
    supervisor \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html
RUN chown -R root:root /var/www/html \
    && chmod -R 755 /var/www/html/storage
WORKDIR /var/www/html
RUN composer install --no-interaction --no-plugins --no-scripts
RUN npm install
RUN npm run build
COPY nginx.conf /etc/nginx/sites-available/default
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN mkdir -p /var/log/php-fpm && chown -R www-data:www-data /var/log/php-fpm
COPY start.sh /start.sh
RUN chmod +x /start.sh
EXPOSE 8090
CMD ["/start.sh"]
