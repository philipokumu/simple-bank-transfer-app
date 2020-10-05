<h3><b>Setting up project</b></h3>

Run:

<p>1. Composer install</p>

<p><h3><b>Setup the environment</b></h3></p>
<p>2. cp .env.example .env</p>
<p>3. Open .env and input your database name, database username & database password and save</p>
<p>4. php artisan key:generate</p>
<p></p>

<p><h3><b>Generate database data and start server</b></h3></p>
<p>5. php artisan migrate --seed <b>NOTE:</b><i>(Ensure to have created your database first with the above database name in your server)</i></p>
<p>6. php artisan serve</p>
