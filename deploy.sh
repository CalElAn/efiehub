#!/bin/sh

# activate maintenance mode
php artisan down

# update source code
git pull

# update PHP dependencies
composer install --no-interaction --no-dev --prefer-dist

#optimize loading
php artisan config:cache
php artisan route:cache
php artisan view:cache

# update database
#php artisan migrate --force

#install and compile js assets
npm install
npx mix --production

# stop maintenance mode
php artisan up
