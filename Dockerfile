# ==========================================
# Stage 1: Build aset Vite menggunakan Node.js
# ==========================================
FROM node:22-alpine AS node-builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build # Production build
# RUN npm run dev # Development process

# ==========================================
# Stage 2: Setup Server PHP-Apache
# ==========================================
FROM php:8.3-apache
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    soap \
    && apt-get clean && rm -rf /var/var/lib/apt/lists/*

COPY --from=composer:2.10 /usr/bin/composer /usr/bin/composer

RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

COPY . .
COPY --from=node-builder /app/public/build ./public/build

RUN composer install --no-dev -o

RUN chown -R www-data:www-data /var/www/html

# ==========================================
# Stage 3: Running Entrypoint Script
# ==========================================
COPY entrypoint.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

ENTRYPOINT ["/usr/local/bin/init.sh"]
CMD ["apache2-foreground"]

EXPOSE 80
