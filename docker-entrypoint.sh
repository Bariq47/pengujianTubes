#!/bin/sh
set -e

if [ "$APP_ENV" = "production" ]; then
    php artisan storage:link --no-interaction --force 2>/dev/null || true

    php artisan config:cache --no-interaction 2>/dev/null || true
    php artisan route:cache --no-interaction 2>/dev/null || true
    php artisan view:cache --no-interaction 2>/dev/null || true
fi

php artisan migrate --force --no-interaction 2>/dev/null || true
php artisan db:seed --force --no-interaction 2>/dev/null || true

exec "$@"
