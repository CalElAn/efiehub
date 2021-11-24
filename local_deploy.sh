#!/bin/sh
set -e
 
#vendor/bin/phpunit
sail php artisan test
 
(git push) || true
 
git checkout production
git merge master
 
git push origin production
 
git checkout master