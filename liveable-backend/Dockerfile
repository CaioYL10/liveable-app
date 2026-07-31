FROM php:8.2-cli

# Instala pacotes do sistema e extensões para o PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Copia o Composer oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copia os arquivos do Laravel para o container
COPY . .

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Expõe a porta usada pelo Render
EXPOSE 10000

# Executa o servidor do Laravel na porta exigida pelo Renders
CMD php artisan serve --host=0.0.0.0 --port=10000
