<h3><b>Setting up project</b></h3>

Run:

1. Composer update

<p><h3><b>Setup the environment</h3></p>
<p>2. cp .env.example .env</p>
<p>3. input your database name, database password and save</p>
<p>4. php artisan key:generate</p>
<p></p>
<p><h3><b>For environment variables to reflect</h3></p>
<p>5. php artisan config:cache and cache:clear</p>
<p></p>
<p><h3><b>Generate database data and start server</h3></p>
<p>6. php artisan migrate --seed</p>
<p>7. php artisan serve</p>
