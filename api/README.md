<b>Setting up</b>

Run:

#Composer update
composer update

#Setup the environment
cp .env.example .env
input your database name, database password and save
php artisan key:generate

#For environment variables to reflect
php artisan config:cache and cache:clear

#Generate database data and start server
php artisan migrate --seed
php artisan serve
