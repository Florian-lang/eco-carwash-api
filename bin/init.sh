#!/bin/bash -e

APP_NAME=$(basename "$PWD")

echo "Creating docker containers"
docker-compose up -d

echo "Installing dependencies"
docker exec "${APP_NAME}"-php composer install

echo "Initializing database"
docker exec "${APP_NAME}"-php php bin/console doctrine:database:create --if-not-exists
docker exec "${APP_NAME}"-php php bin/console doctrine:migrations:migrate --no-interaction

echo "Create JWT keys pair"
docker exec "${APP_NAME}"-php mkdir -p config/jwt
docker exec "${APP_NAME}"-php lexik:jwt:generate-keypair

echo "Loading fixtures"
docker exec "${APP_NAME}"-php php bin/console doctrine:fixtures:load --no-interaction
docker exec "${APP_NAME}"-php php bin/console app:add-wash-stations

echo "Adding git hooks"
bash bin/git-hooks.sh