# Setup
## Prerequisites
It assumed that you know (and have): 
- PHP 5.6
- Composer
- Artisan
- MVC architecure
- Some way of hosting a PHP application
- MySQL
- Lumen framework (Or laravel)

## Install
- `git clone <project.git>`
- `composer install`
- setup the `.env` file (see next section)
- run `php artisan migrate``
- run `php artisan db:seed`

## Environment
Before you can migrate and seed you database you will need to setup you environment file. 

```
APP_ENV=local
APP_DEBUG=true
APP_KEY=<some random hash>
APP_TIMEZONE=UTC

DB_CONNECTION=mysql
DB_HOST=<ip to your db, like localhost>
DB_PORT=<port to you db, like 3306>
DB_DATABASE=mmseproject
DB_USERNAME=<db username>
DB_PASSWORD=<db password>

CACHE_DRIVER=memcached
QUEUE_DRIVER=sync
USE_MOCK=false
```

If you want to mock your database and just use the mock implementation of the datalayer (as in the unit tests) you can set you `USE_MOCK` flag to `true`. 
```
USE_MOCK=true
```
Then you can mock out your entire data layer. 

## Lumen docs

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).
