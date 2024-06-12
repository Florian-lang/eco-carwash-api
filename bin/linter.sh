#!/bin/bash
chmod +x bin/linter.sh
APP_NAME=$(basename "$PWD")

mkdir -p var/log/lint
docker exec "${APP_NAME}"-php  vendor/bin/php-cs-fixer fix --dry-run --diff > var/log/lint/phpLinter.txt
echo -e "\e[33mThe file is saved in var/log/lint/phpLinter.txt\e[0m"