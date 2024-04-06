#!/usr/bin/env sh

echo "#########"
echo "# Tests #"
echo "#########"
./vendor/bin/sail artisan test

echo "#######################"
echo "# Architecture Checks #"
echo "#######################"
./vendor/bin/sail php vendor/bin/deptrac

echo "###################"
echo "# Static Analysis #"
echo "###################"
./vendor/bin/sail php vendor/bin/phpstan analyse src --level 3

echo "##################"
echo "# Mess Detection #"
echo "##################"
./vendor/bin/sail php vendor/bin/phpmd src/ text codesize,unusedcode,design,cleancode
