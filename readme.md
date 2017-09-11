# Laravel 5.5 / Vue 2 (VueRouter) / Bootstrap 3.3.7 SPA

This is an example of [Single-Page Application](https://en.wikipedia.org/wiki/Single-page_application) site built on Laravel 5.5 and VueJS 2. Also it uses Elasticsearch for searching Post in database. Webpack used via laravel-min plugin.
It contains of those pages:
* index page with all posts and search-field
* author's contact page with form
* comments page with ability to add new comments and answering to selected commenter
* login/register page

## Installation

For installing you should run next commands:

* `git clone https://github.com/NMFES/test-blog.git`
* `cd test-blog`
* `cp .env.example .env`
* `composer install`
* `npm install`
* `php artisan gey:generate`
* Edit .env and set your database connection params. Also you need to change charset=utf8 and collation=utf8_general_ci in config/database.php
* `php artisan migrate`
* `php artisan db:seed` if you want to seed database with random data

Also you should install Elasticsearch server, because the site searching uses it. Then you need to create index and fill out it.
`sudo service elasticsearch start` for running the server
`php artisan tinker`
`Post::createIndex()` (`Post::deleteIndex()` for deleting the index)
`Post::reindex()`

## Usage

``` bash
# build and watch
npm run watch (or "npm run watch-poll")

# build for production
npm run prod
```
