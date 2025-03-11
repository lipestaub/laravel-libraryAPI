# Library API

This repository contains a Laravel-based RESTful API for managing library resources, specifically books and genres.

## Description

This API provides endpoints for accessing and manipulating library data, focusing on books and genres. It is designed to be used as a backend for a library application.

## Features

* Endpoints for retrieving book information:
    * `GET /books`: Retrieve a list of all books.
    * `GET /book/{id}`: Retrieve a specific book by ID.
* Endpoints for managing books:
    * `POST /book`: Create a new book.
    * `PATCH /book/{id}`: Update an existing book.
    * `DELETE /book/{id}`: Delete a book.
* Endpoints for retrieving genre information:
    * `GET /genres`: Retrieve a list of all genres.
    * `GET /genre/{id}`: Retrieve a specific genre by ID.
* Endpoints for managing genres:
    * `POST /genre`: Create a new genre.
    * `PATCH /genre/{id}`: Update an existing genre.
 
## Installation

1.  Clone the repository:

    ```bash
    git clone https://github.com/lipestaub/library-api.git
    cd library-api
    ```

2.  Install dependencies:

    ```bash
    composer install
    ```

3.  Copy the `.env.example` file to `.env` and configure your database settings.

    ```bash
    cp .env.example .env
    ```

4.  Generate an application key:

    ```bash
    php artisan key:generate
    ```

5.  Run database migrations:

    ```bash
    php artisan migrate
    ```

6.  Start the development server:

    ```bash
    php artisan serve
    ```

7.  The API will be available at `http://localhost:8000`.

## Usage

* Use a REST client (e.g., Postman, Insomnia) to interact with the API endpoints.
* Ensure that the JSON data you send in POST and PATCH requests matches the expected format.
