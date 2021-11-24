#!/bin/sh
set -e
 
#vendor/bin/phpunit
vendor/bin/sail php artisan test
 
(git push) || true
 
git checkout production
git merge master
 
git push origin production
 
git checkout master