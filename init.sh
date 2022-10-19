#!/bin/sh

echo "------------------ Checking for Composer Install ------------------"
composer install
echo "------------------ Checking for Composer Updates ------------------"
#composer -n update
echo "------------------ Checking for Composer Autoload ------------------"
composer dump-autoload

echo "------------------ Exec Migrations ------------------"

#php artisan key:generate
#php artisan horizon:install
#php artisan telescope:install
#php artisan storage:link
php artisan migrate
#php artisan migrate --seed

echo "------------------ Updating permitions ------------------"

chmod 777 -R storage
chmod 777 -R bootstrap/cache

echo "------------------ Exec Crons ------------------"
php artisan dataPostUser:cron

echo "------------------ Starting apache server ------------------"
exec "apache2-foreground"
