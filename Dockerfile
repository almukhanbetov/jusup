# =========================
# 1) Node stage: build Vite
# =========================
FROM node:22-alpine AS node-builder

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.* tailwind.config.* postcss.config.* ./

RUN npm run build


# =========================
# 2) PHP stage: Laravel app
# =========================
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl unzip zip \
    libpng-dev libzip-dev libpq-dev \
    && docker-php-ext-install pdo_pgsql zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Сначала composer-файлы (чтобы кэш работал)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Потом весь проект
COPY . .

# Подкладываем Vite build из node-stage (и он будет единственный)
COPY --from=node-builder /app/public/build /var/www/public/build

# Права и папки (чтобы artisan cache/clear не падали)
RUN mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

USER www-data

EXPOSE 9000
CMD ["php-fpm"]
