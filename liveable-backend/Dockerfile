FROM php:8.4-cli

# Instala pacotes do sistema e extensões para PostgreSQL e MySQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Silencia avisos de depreciação do PHP
RUN echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED" > /usr/local/etc/php/conf.d/error-reporting.ini

# Copia o Composer oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copia os arquivos do Laravel para o container
COPY . .

# Garante permissões nas pastas de cache e storage
RUN mkdir -p bootstrap/cache storage \
    && chmod -R 777 storage bootstrap/cache

# Instala dependências ignorando travas rígidas de versão do PHP no lock file
RUN composer install --no-dev --no-scripts --optimize-autoloader --no-cache --ignore-platform-reqs \
    && rm -f bootstrap/cache/packages.php bootstrap/cache/services.php bootstrap/cache/config.php

# Copia e prepara o script de entrada
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expõe a porta do Render
EXPOSE 10000

# Executa o container
ENTRYPOINT ["entrypoint.sh"]
