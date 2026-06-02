#!/bin/bash
cd /var/www/html

if [ ! -f .env ]; then
    echo "Create .env file.."
    cp .env.example .env
fi

if ! grep -q "APP_KEY=base64" .env; then
    echo "Generating Application Key..."
    php artisan key:generate
fi

if [ ! -d public/storage ]; then
    echo "Creating symbolic link for storage..."
    php artisan storage:link
fi

echo "Running Database Migrations..."
php artisan migrate --force

echo "Optimizing application performance..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Fixing file permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/.env

exec "$@"
