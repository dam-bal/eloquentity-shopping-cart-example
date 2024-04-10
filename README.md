# Eloquentity Shopping Cart Example

This project is to show how [Eloquentity](https://github.com/dam-bal/eloquentity) can be used to achieve proper DDD/Hexagonal Architecture with Laravel

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
