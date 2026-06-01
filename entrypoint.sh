#!/bin/bash
cd /var/www/html

echo "Generating Application Key..."
php artisan key:generate

echo "Optimalisasi"
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "Symbolic link"
php artisan storage:link

echo "Running Database Migrations..."
php artisan session:table
php artisan migrate:fresh

exec "$@"
