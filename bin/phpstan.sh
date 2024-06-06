#!/bin/bash

echo "lancement du script phpstan.sh"

APP_NAME=$(basename "$PWD")
echo "Entrez 1 pour génrer un fichier de log PHPStan"
echo "Entrez 2 pour afficher le résultat sur les log dans le terminal"

read number

case $number in
    1)
        echo ________________________________________________date : $(date '+%Y-%m-%d_%H-%M-%S')__________________________________________________ >> var/log/phpstan/report_phpstan.txt
        docker exec "${APP_NAME}"-php vendor/bin/phpstan analyse src >> var/log/phpstan/report_phpstan.txt
        echo -e "\033[32mL'analyse PHPStan est terminée. Vérifiez le fichier report_phpstan.txt dans var/log/phpstan pour les résultats.\033[0m"
        ;;
    2)
        echo "Affichage du résultat sur les logs dans le terminal"
        docker exec "${APP_NAME}"-php vendor/bin/phpstan analyse src
        ;;
    *)
        echo "Veuillez entrer 1 ou 2"
        exit 1
        ;;
esac
echo "fin du script phpstan.sh"

