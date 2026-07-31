#!/bin/sh
set -e

echo "1. Deletando caches físicos e autoloaders antigos..."
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/views/*
rm -rf storage/framework/cache/*

echo "2. Reconstruindo o Autoload do Composer..."
composer dump-autoload --optimize --no-scripts --ignore-platform-reqs

echo "3. Forçando limpeza de configuração do Laravel..."
php -d display_errors=Off artisan config:clear || true
php -d display_errors=Off artisan cache:clear || true
php -d display_errors=Off artisan view:clear || true

echo "4. Rodando migrations no Supabase..."
php -d display_errors=Off artisan migrate --force

echo "5. Criando link de storage..."
php -d display_errors=Off artisan storage:link || true

echo "6. Iniciando o servidor..."
exec php -d display_errors=Off -d error_reporting="E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED" -S 0.0.0.0:10000 -t public
