#!/bin/sh
set -e

echo "1. Limpando caches antigos do Laravel..."
rm -f bootstrap/cache/*.php

echo "2. Regenerando autoloader e carregando pacotes..."
composer dump-autoload --optimize --no-scripts

echo "3. Rodando migrations no Supabase..."
php artisan migrate --force

echo "4. Criando link de storage..."
php artisan storage:link || true

echo "5. Limpando caches de rotas e config..."
php artisan config:clear
php artisan route:clear

echo "6. Iniciando servidor do Laravel..."
exec php artisan serve --host=0.0.0.0 --port=10000
