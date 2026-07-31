FROM php:8.4-cli

# Instala pacotes do sistema e extensões para PostgreSQL e MySQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copia o Composer oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copia os arquivos do Laravel para o container
COPY . .

# Garante que as pastas existem e têm permissão de escrita
RUN mkdir -p bootstrap/cache storage \
    && chmod -R 777 storage bootstrap/cache

# Instala dependências sem rodar scripts automáticos do Laravel
# e remove qualquer cache antigo de bootstrap
RUN composer install --no-dev --no-scripts \
    && rm -f bootstrap/cache/packages.php bootstrap/cache/services.php bootstrap/cache/config.php

# Copia e prepara o script de entrada
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expõe a porta usada pelo Render
EXPOSE 10000

# Usa o script de entrada para inicializar a aplicação
ENTRYPOINT ["entrypoint.sh"]
