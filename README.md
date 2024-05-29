# Documentation du Projet

## Prérequis

Pour ce projet, vous aurez besoin de :

- Docker
- Git
- Un compte Google Cloud et une clé API Google Map valide

## Installation

Suivez ces étapes pour installer le projet :

1. **Clonez le projet** : Utilisez la commande suivante pour cloner le projet :
    ```bash
    git clone <url_du_projet>
    ```

2. **Accédez au dossier du projet** : Utilisez la commande suivante pour accéder au dossier du projet :
    ```bash
    cd <nom_du_projet>
    ```

3. **Créez un fichier .env.local** : Créez un fichier .env.local à la racine du projet et initialisez les variables d'environnement :
    ```env
    GOOGLE_API_KEY=<votre_clé_api_google>
    COORDINATES_API=<coordonnées_gps>
    RADIUS_API=<rayon_de_recherche>
    ```

4. **Lancez le script d'installation** : Utilisez l'une des commandes suivantes pour lancer le script d'installation :
    ```bash
    bash bin/init.sh
    ```
   ou, selon votre système d'exploitation :
    ```bash
    ./bin/init.sh
    ```

Une fois l'installation terminée, l'API sera disponible localement à l'URL suivante : `localhost:8081/api`.