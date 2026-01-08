# =========================
# 1️⃣ Node stage — build frontend
# =========================
FROM node:22-alpine AS node-builder

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY vite.config.js tailwind.config.js postcss.config.js ./

RUN npm run build


# =========================
# 2️⃣ PHP stage — Laravel
# =========================
FROM php:8.3-fpm

# System deps
RUN apt update && apt install -y \
    git curl unzip zip nano \
    libpng-dev libzip-dev libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Composer deps
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# App source
COPY . .

# Frontend build → public/build
COPY --from=node-builder /app/public/build ./public/build

# Laravel optimizations
RUN php artisan key:generate --force || true \
    && php artisan storage:link || true \
    && php artisan optimize || true

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

USER www-data

EXPOSE 9000
CMD ["php-fpm"]
