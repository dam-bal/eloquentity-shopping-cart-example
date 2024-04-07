#!/usr/bin/env sh

echo "#########"
echo "# Tests #"
echo "#########"
temp_file=$(mktemp)

./vendor/bin/sail artisan test >"$temp_file" 2>&1

if [ $? -eq 0 ]; then
    echo "SUCCESS"
    rm "$temp_file"  # Clean up the temporary file on success
else
    echo "FAIL"
    cat "$temp_file"  # Display the output on failure
    rm "$temp_file"  # Clean up the temporary file
fi

echo "#######################"
echo "# Architecture Checks #"
echo "#######################"
temp_file=$(mktemp)

./vendor/bin/sail php vendor/bin/deptrac >"$temp_file" 2>&1

if [ $? -eq 0 ]; then
    echo "SUCCESS"
    rm "$temp_file"  # Clean up the temporary file on success
else
    echo "FAIL"
    cat "$temp_file"  # Display the output on failure
    rm "$temp_file"  # Clean up the temporary file
fi

echo "###################"
echo "# Static Analysis #"
echo "###################"
temp_file=$(mktemp)

./vendor/bin/sail php vendor/bin/phpstan analyse src --level 3 >"$temp_file" 2>&1

if [ $? -eq 0 ]; then
    echo "SUCCESS"
    rm "$temp_file"  # Clean up the temporary file on success
else
    echo "FAIL"
    cat "$temp_file"  # Display the output on failure
    rm "$temp_file"  # Clean up the temporary file
fi

echo "##################"
echo "# Mess Detection #"
echo "##################"
temp_file=$(mktemp)

./vendor/bin/sail php vendor/bin/phpmd src/ text codesize,unusedcode,design,cleancode >"$temp_file" 2>&1

if [ $? -eq 0 ]; then
    echo "SUCCESS"
    rm "$temp_file"  # Clean up the temporary file on success
else
    echo "FAIL"
    cat "$temp_file"  # Display the output on failure
    rm "$temp_file"  # Clean up the temporary file
fi

echo "###################"
echo "# Code Formatting #"
echo "###################"
temp_file=$(mktemp)

./vendor/bin/sail php vendor/bin/phpcs --standard=PSR12 src/ >"$temp_file" 2>&1

if [ $? -eq 0 ]; then
    echo "SUCCESS"
    rm "$temp_file"  # Clean up the temporary file on success
else
    echo "FAIL"
    cat "$temp_file"  # Display the output on failure
    rm "$temp_file"  # Clean up the temporary file
fi
