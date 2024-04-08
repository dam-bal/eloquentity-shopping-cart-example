#!/usr/bin/env sh

run_command() {
    temp_file=$(mktemp)
    $1 >"$temp_file" 2>&1

    if [ $? -eq 0 ]; then
        echo -e "\e[32mSUCCESS\e[0m"
        rm "$temp_file"
    else
        echo -e "\e[31mFAIL\e[0m"
        cat "$temp_file"
        rm "$temp_file"
    fi
}

echo "#########"
echo "# Tests #"
echo "#########"
run_command "./vendor/bin/sail artisan test"

echo "#######################"
echo "# Architecture Checks #"
echo "#######################"
run_command "./vendor/bin/sail php vendor/bin/deptrac"

echo "###################"
echo "# Static Analysis #"
echo "###################"
run_command "./vendor/bin/sail php vendor/bin/phpstan analyse src --level 9"

echo "##################"
echo "# Mess Detection #"
echo "##################"
run_command "./vendor/bin/sail php vendor/bin/phpmd src/ text codesize,unusedcode,design,cleancode"

echo "###################"
echo "# Code Formatting #"
echo "###################"
run_command "./vendor/bin/sail php vendor/bin/phpcs --standard=PSR12 src/"
