## About Laravel Couchbase Sample

Laravel Couchbase Sample is a Laravel application used to demonstrate using Laravel with Couchbase Server.

## Installation

This sample application uses Docker Desktop on Mac or Windows. Follow these steps to get up and running.

Commands below should be run from the project root directory. Run them in Terminal, CMD.exe or Powershell.

1. Clone this repository.
2. Ensure [Docker Desktop](https://www.docker.com/products/docker-desktop) is running.
3. Create the `docker-compose` environment file.
    ```
    cd ./scripts/Docker
    cp dev.env .env
    ```
   If you modify the *.env* file, you also have to modify the Laravel .env file to use the same username, password and bucket name in the demo. We recommend you try the demo first with the defaults in place then modify them in the future if desired. DO NOT use the defaults in a production environment.
4. Build the Docker Images
    ```
    cd ./scripts/Docker
    docker-compose build
    ```
5. Start the Docker Containers
    ```
    docker-compose up -d
    ```
6. Tail the Docker Logs
    ```
    docker-compose logs -f
    ```
7. Connect to the `php-fpm` Docker container.
    ```
    docker-compose exec php-fpm bash
    ```
8. Install `composer` and `npm` dependencies in the project.
    ```
    composer install
    npm install
    npm run dev
    ```
9. Copy the `.env.example` to `.env`. If you modified the Docker .env file above, also modify the values in this file to match.
    ```
    cp .env.example .env
    ```
10. The demo should now work. Access it:
    * http://localhost:8091 (Couchbase Server - Login with admin/secret1234 by default)
    * http://localhost:9090 (Demo App)

You can edit project files and they will be reflected live in the Docker container using the magic of [Docker Volumes](https://docs.docker.com/compose/compose-file/#volume-configuration-reference).

## Contributing

Thank you for considering contributing to the Laravel Couchbase Sample! To keep this as simple as possible, please follow the Laravel contribution guide that can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## License

The Laravel Couchbase Sample is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
