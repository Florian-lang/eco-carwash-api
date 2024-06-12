#!/bin/bash -e

APP_NAME=$(basename "$PWD")

echo -e "\033[1;34mDo you want to save the test report in var/test/logs.text? [y/n]\033[0m"
read -r save_reportgoing

if [ "$save_report" = "y" ]; then
    echo "Saving test report in var/test/logs.txt"

    mkdir -p var/log/test
    docker exec "${APP_NAME}"-php php bin/phpunit > var/log/test/logs.txt

    echo -e "\033[1;32mTest report saved in var/test/logs.txt\033[0m"
elif [ "$save_report" = "n" ]; then
    echo "Running tests"
    docker exec "${APP_NAME}"-php php bin/phpunit
fi

echo -e "\033[1;34mDo you want to generate the coverage report? [y/n]\033[0m"
read -r generate_coverage

if [ "$generate_coverage" = "y" ]; then
    echo "Generating coverage report"
    docker exec -e XDEBUG_MODE=coverage "${APP_NAME}"-php php bin/phpunit --coverage-html var/coverage
    echo -e "\033[33mCoverage report generated in var/coverage\033[0m"
fi
