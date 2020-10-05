<h3><b>Setting up project</b></h3>

Run:

Composer update

<h3><b>Setup the environment</h3><br />
cp .env.example .env<br />
input your database name, database password and save<br />
php artisan key:generate<br />
<br />
<h3><b>For environment variables to reflect</h3><br />
php artisan config:cache and cache:clear<br />
<br />
<h3><b>Generate database data and start server</h3><br />
php artisan migrate --seed<br />
php artisan serve<br />
