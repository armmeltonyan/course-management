#!/bin/bash
set -eo pipefail

composer clear-cache
composer install --optimize-autoloader --no-dev --no-interaction --prefer-dist
php artisan migrate --force
# Currently FLUSHDB command is disabled
# php artisan cache:clear
php artisan route:cache
php artisan config:cache
php artisan view:cache
composer dump-autoload --optimize
php artisan storage:link
php artisan up

exec $@
