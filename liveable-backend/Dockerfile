FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN chmod -R 777 storage bootstrap/cache

RUN composer install --no-dev --no-scripts --optimize-autoloader \
    && rm -f bootstrap/cache/packages.php bootstrap/cache/services.php bootstrap/cache/config.php

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 10000

ENTRYPOINT ["entrypoint.sh"]
