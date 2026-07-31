#!/bin/sh
set -e

echo "1. Deletando caches físicos de inicialização do Laravel..."
rm -rf bootstrap/cache/*.php

echo "2. Regenerando autoloader do Composer sem scripts..."
composer dump-autoload --optimize --no-scripts

echo "3. Limpando configurações e caches do Artisan..."
php -d display_errors=Off artisan config:clear || true
php -d display_errors=Off artisan route:clear || true
php -d display_errors=Off artisan cache:clear || true

echo "4. Rodando migrations no Supabase..."
php -d display_errors=Off artisan migrate --force

echo "5. Criando link de storage..."
php -d display_errors=Off artisan storage:link || true

echo "6. Iniciando o servidor..."
exec php -d display_errors=Off -d error_reporting="E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED" -S 0.0.0.0:10000 -t public
