# TableDragon - PHP+Symf HTTP API - Hexagonal Architecture

TableDragon is a Table Tennis app to handle players and TT leagues.

This repository works as my personal boilerplate for a PHP REST API application, built over DDD+Hexagonal principles, thus its domain features just exist to demonstrate architecture design.

## Stack

- PHP 8.3
- Symfony 7 + Messenger
- Doctrine >3
- PHP-FPM + nGinx
- PostgreSQL

## Purpose

The objective of this repo is
- To have a boilerplate for pet projects
- To play around with PHP >8 features (readOnly, etc)
- To play around with Symfony 7
- To play around with Doctrine XML entity mapping (in order to separate infra from domain)

### Roadmap!

- Implement Player update controller
- Implement Matches and Leagues feature
- Implement Symfony Validation
- Implement command buses and CQRS

## Requirements

- PHP >8.2

## Usage

To execute the application, just run:

```sh
docker network create tabledragon
docker compose build 
docker-compose up
```

Now the API server should be available in 
```sh
http://localhost:80
```
Feel free to use your terminal or any API client to access it.
### Fixtures
In order to prepopulate the database, execute the following:
```sh
docker exec -it php-fpm sh
php bin/console tabledragon:command:populate-categories
```
Also, there are some Fixtures available under src/Infrastructure/Persistence/Fixtures implemented with DoctrineFixtures Bundle.
At the moment some are used in functional tests in order to create data for the endpoints.

### Tests
To execute all tests, up the application and then run:
```sh
docker exec -it php-fpm sh
php bin/phpunit
```
Note that since functional and integration tests are created, the app needs a database to be up, so you need to execute tests from inside the php-fpm container.