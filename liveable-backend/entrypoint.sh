#!/bin/sh
set -e

echo "Rodando package:discover..."
php artisan package:discover --ansi

echo "Limpando caches de config/route..."
php artisan config:clear
php artisan route:clear

echo "Rodando migrations (opcional - remova se não quiser migrar automaticamente)..."
# php artisan migrate --force

echo "Iniciando servidor..."
php artisan serve --host=0.0.0.0 --port=10000
