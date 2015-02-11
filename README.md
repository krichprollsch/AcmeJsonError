# AcmeJsonErrorBundle

Sample usage of catching errors with symfony to return a json message response.

## Install

```
composer install
php app/console server:run
```

Then you can test following pages :

* [normal response](http://127.0.0.1:8000/)
* [exception json response](http://127.0.0.1:8000/exception)
* [error json response](http://127.0.0.1:8000/error)
* [not found json response](http://127.0.0.1:8000/notfound)

## Tests

```
./bin/phpunit -c app
```
