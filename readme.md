## About

This is an example of SPA site built on Laravel 5.5 and VueJS 2. Also it uses Elasticsearch for searching Post in database.

## Installation

For installing you should run next commands:

* git clone https://github.com/NMFES/test-blog.git
* cd test-blog
* cp .env.example .env
* composer install
* npm install
* php artisan gey:generate
* Edit .env and set your database connection params. Also you need to change charset=utf8 and collation=utf8_general_ci in config/database.php
* php artisan migrate
* php artisan db:seed if you want to seed database with random data
npm run watch (or "npm run watch-poll", or "npm run prod")




...
...
