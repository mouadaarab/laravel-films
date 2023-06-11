# Projet Laravel - README

Ce projet est une application web développée avec le framework Laravel. Il s'agit d'une petite appli permettant de visualiser et d'interagir avec une liste de films tendance récupérés depuis une API externe.

## Installation

1. Clonez ce dépôt de code sur votre machine :

    ``` bash
    git clone https://github.com/mouadaarab/laravel-films.git
    ```

2. Accédez au répertoire du projet :
    ``` bash
    cd laravel-films
    ```

3. Installez les dépendances PHP à l'aide de Composer :
    ``` bash
    composer install
    ```

4. Installez les dépendances JavaScript avec npm :

    ``` bash
    npm install
    ```

5. Copiez le fichier d'environnement `.env.example` et renommez-le en `.env`. Vous pouvez le configurer en fonction de votre environnement de développement (par exemple, les paramètres de base de données).

    ``` bash
    cp .env.example .env
    ```

6. Générez une nouvelle clé d'application Laravel :

    ``` bash
    php artisan key:generate
    ```


7. Compilez les ressources frontales :

    ``` bash
    npm install
    npm run dev
    ```

## Utilisation avec Laravel Sail

1. Lancez les conteneurs Docker à l'aide de Laravel Sail :

    ``` bash
    ./vendor/bin/sail up -d
    ```


2. Exécutez la commande personnalisée `app:init` pour initialiser l'application. Cette commande exécutera automatiquement les migrations de base de données et les *seeds* (remplissage de la base de données) :

    ``` bash
    ./vendor/bin/sail artisan app:init --sync-data=true
    ```


    Remarque : Si vous préférez exécuter manuellement les migrations et les *seeds*, vous pouvez utiliser les commandes suivantes :

    - Exécuter les migrations de base de données :

    ```
    ./vendor/bin/sail artisan migrate
    ```

    - Exécuter les *seeds* pour remplir la base de données :

    ```
    ./vendor/bin/sail artisan db:seed
    ```


3. Identifiants de l'utilisateur par défaut :

   - Email : test@example.com
   - Mot de passe : password

Veuillez noter que ces instructions supposent que vous avez Docker, Composer et npm installés sur votre machine.

Veuillez également noter que les identifiants de l'utilisateur par défaut (`test@example.com` et `password`) sont fournis uniquement à des fins de test. Assurez-vous de les modifier ou de désactiver l'utilisateur par défaut dans un environnement de production.

Si vous avez d'autres demandes, n'hésitez pas à les poser !
