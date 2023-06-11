# Laravel Project - README

This project is a web application developed using the Laravel framework. It is a small application that allows users to view and interact with a list of trending movies retrieved from an external API.

## Installation

1. Clone this code repository to your machine:

    ``` bash
    git clone https://github.com/mouadaarab/laravel-films.git
    ```

2. Navigate to the project directory:
    ``` bash
    cd laravel-films
    ```

3. Install the PHP dependencies using Composer:
    ``` bash
    composer install
    ```

4. Install the JavaScript dependencies using npm:

    ``` bash
    npm install
    ```

5. Copy the .env.example file and rename it to .env. You can configure it based on your development environment (e.g., database settings).

    ``` bash
    cp .env.example .env
    ```

6. Generate a new Laravel application key:

    ``` bash
    php artisan key:generate
    ```


7. Compile the front-end assets:

    ``` bash
    npm install
    npm run dev
    ```

## Usage with Laravel Sail

1. Launch the Docker containers using Laravel Sail:

    ``` bash
    ./vendor/bin/sail up -d
    ```


2. Run the custom app:init command to initialize the application. This command will automatically run the database migrations and seeders:

    ``` bash
    ./vendor/bin/sail artisan app:init --sync-data=true
    ```


    Note: If you prefer to manually run the migrations and seeders, you can use the following commands:

    - Run the database migrations:

    ```
    ./vendor/bin/sail artisan migrate
    ```

    - Run the seeders to populate the database:

    ```
    ./vendor/bin/sail artisan db:seed
    ```

3. Default User Credentials:

    - Email: test@example.com
    - Password: password

Please note that these instructions assume you have Docker, Composer, and npm installed on your machine.


Please note that the default user credentials (`test@example.com` and `password`) are provided for testing purposes only. Make sure to change them or disable the default user in a production environment.

If you have any other requests, feel free to ask!
