# Eloquentity Shopping Cart Example

This project demonstrates the implementation of Domain-Driven Design (DDD), Hexagonal Architecture, and Command Query Responsibility Segregation (CQRS) principles using [Eloquentity](https://github.com/dam-bal/eloquentity) with Laravel. It serves as a practical example of how to achieve a modular, maintainable, and scalable application architecture by separating concerns and adhering to best practices.

## Getting started

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

```shell
./vendor/bin/sail up -d
```

## QA Checks

PHPMD, Deptrac, PHPStan, PHPCS and Tests

```shell
./checks.sh
```
