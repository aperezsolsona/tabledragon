# TableDragon - PHP+Symf HTTP API - Hexagonal Architecture

This repository contains a personal boilerplate for a PHP REST API application, built over DDD+Hexagonal principles.

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

### Pending

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

In order to prepopulate the database, execute the following:
```sh
docker exec -it php-fpm sh
php bin/console tabledragon:command:populate-categories
```
### Tests

To execute all tests, just run:
