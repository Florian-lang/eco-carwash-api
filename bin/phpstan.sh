#!/bin/bash -e

APP_NAME=$(basename "$PWD")
echo -e "\033[1;34mEnter 1 to generate a PHPStan log file\033[0m"
echo -e "\033[1;34mEnter 2 to display the result on the terminal logs\033[0m"

read number

case $number in
    1)
        echo ________________________________________________date : $(date '+%Y-%m-%d_%H-%M-%S')__________________________________________________ >> var/log/phpstan/report_phpstan.txt
        docker exec "${APP_NAME}"-php vendor/bin/phpstan analyse src >> var/log/phpstan/report_phpstan.txt
        echo -e "\033[32mPHPStan analysis is complete\033[0m"
        echo -e "\033[33mThe file is saved in var/log/phpstan/report_phpstan.txt\033[0m"
        ;;
    2)
        echo "Displaying the result on the terminal logs"
        docker exec "${APP_NAME}"-php vendor/bin/phpstan analyse src
        ;;
    *)
        echo -e "\033[1;31mPlease enter 1 or 2\033[0m"
        exit 1
        ;;
esac