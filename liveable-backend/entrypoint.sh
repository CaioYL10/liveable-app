#!/bin/sh
set -e

echo "1. Deletando caches físicos de inicialização do Laravel..."
rm -rf bootstrap/cache/*.php

echo "2. Regenerando autoloader do Composer sem scripts..."
composer dump-autoload --optimize --no-scripts

echo "3. Limpando configurações e caches do Artisan..."
php artisan config:clear || true
php artisan route:clear || true
php artisan cache:clear || true

echo "4. Rodando migrations no Supabase..."
php artisan migrate --force

echo "5. Criando link de storage..."
php artisan storage:link || true

echo "6. Iniciando o servidor..."
exec php artisan serve --host=0.0.0.0 --port=10000
