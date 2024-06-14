# Laravel Docker Setup

This repository provides a Docker-based setup for Laravel projects.

## How To Deploy

### For First Time Only

1. Clone the repository:

    ```bash
    git clone https://github.com/strong/laravel-docker.git
    ```

2. Navigate to the project directory:

    ```bash
    cd laravel-docker
    ```

3. Build and start the Docker containers:

    ```bash
    docker compose up -d --build
    ```

4. Set permissions for phpMyAdmin sessions:

    ```bash
    docker compose exec phpmyadmin chmod 777 /sessions
    ```

5. Access the PHP container's shell:

    ```bash
    docker compose exec php bash
    ```

6. Set ownership and permissions for Laravel storage and cache directories:

    ```bash
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache
    ```

7. Run Composer setup:
    ```bash
    composer setup
    ```

### From the Second Time Onwards

1. Start the Docker containers:
    ```bash
    docker compose up -d
    ```

## Notes

### Laravel Versions

-   Laravel 11.x
-   Laravel 10.x

### Laravel App

-   URL: [http://localhost](http://localhost)

### Mailpit

-   URL: [http://localhost:8025](http://localhost:8025)

### phpMyAdmin

-   URL: [http://localhost:8080](http://localhost:8080)
-   Server: db
-   Username: strong
-   Password: strong
-   Database: strong

### Adminer

-   URL: [http://localhost:9090](http://localhost:9090)
-   Server: db
-   Username: strong
-   Password: strong
-   Database: strong
