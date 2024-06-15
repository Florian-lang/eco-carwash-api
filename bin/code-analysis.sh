#!/bin/bash

echo -e "\033[1;34mPlease choose the code analysis tool to use: \033[0m"
echo "1. PHPStan"
echo "2. PHPUnit"
echo "3. PHP cs-fixer"
echo '4. To run everything'

while true;
do
    read number
    case $number in
        1)
            clear
            echo "Starting PHPStan"
            ./bin/phpstan.sh
            echo -e "\033[1;32mEnd of PHPStan\033[0m"
            break
            ;;
        2)
            clear
            echo "This script is to run the tests and generate the coverage report"
            ./bin/phpunit.sh
            echo -e "\033[1;32mEnd of unit tests and code coverage\033[0m"
            break
            ;;
        3)
            clear
            echo "Starting PHP cs-fixer"
            ./bin/linter.sh
            echo -e "\033[1;32mEnd of PHP cs-fixer\033[0m"
            break
            ;;
        4)
            clear
            echo "Running all tools"
            ./bin/phpstan.sh
            echo -e "\033[1;32mEnd of PHPStan\033[0m"
            ./bin/phpunit.sh
            echo -e "\033[1;32mEnd of unit tests and code coverage\033[0m"
            ./bin/linter.sh
            echo -e "\033[1;32mEnd of PHP cs-fixer\033[0m"
            break
            ;;
        *)
            echo -e "\033[1;31mInvalid option, please choose a number between 1 and 4\033[0m"
            ;;
    esac
done