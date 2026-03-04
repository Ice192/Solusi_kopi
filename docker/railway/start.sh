#!/usr/bin/env bash
set -euo pipefail

PORT="${PORT:-8080}"

if grep -q '^Listen 80$' /etc/apache2/ports.conf; then
  sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
else
  sed -i "s/^Listen [0-9]\+$/Listen ${PORT}/" /etc/apache2/ports.conf
fi

sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

a2dismod mpm_event mpm_worker >/dev/null 2>&1 || true
a2enmod mpm_prefork >/dev/null 2>&1 || true

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
  php artisan migrate --force
fi

if [ "${RUN_SEEDERS:-false}" = "true" ]; then
  php artisan db:seed --force
fi

if [ ! -L public/storage ]; then
  php artisan storage:link || true
fi

php artisan optimize:clear
php artisan config:cache

exec apache2-foreground
