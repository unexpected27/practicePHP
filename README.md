# Practice PHP Project - Bid CRUD API

## Project Description
This is a university project demonstrating the implementation of a RESTful CRUD API using two popular PHP frameworks: **Symfony** and **Laravel**. The project focuses on a "Bid" entity, allowing users to create, read, update, and delete bids through standardized endpoints.

## Structure
The repository is organized into two main folders, each containing a full implementation of the API:

```text
frameworks/
├── laravel/          # Laravel 11 implementation
│   ├── app/          # Core logic (Models, Controllers)
│   ├── database/     # Migrations and Seeders
│   ├── routes/       # API route definitions
│   └── ...
└── symfony/          # Symfony 7.4 implementation
    ├── config/       # Configuration and Routes
    ├── migrations/   # Database migrations
    ├── src/          # Core logic (Entities, Controllers)
    └── ...
```

## Features
- **CRUD operations** for the Bid entity.
- **REST API** following standard HTTP methods.
- **Dual implementation**: Compare how the same functionality is built in Symfony vs Laravel.
- **Validation**: Strict data validation for all input fields.
- **Postman Collections**: Pre-configured collections for easy testing.
- **Database Support**: SQLite configuration for zero-setup local development.

## How to Run

### Laravel Implementation
1. Navigate to the Laravel directory:
   ```bash
   cd frameworks/laravel
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Run migrations and seed data:
   ```bash
   php artisan migrate --seed
   ```
5. Start the server:
   ```bash
   php artisan serve
   ```
   The API will be available at `http://localhost:8000/api/bids`.

### Symfony Implementation
1. Navigate to the Symfony directory:
   ```bash
   cd frameworks/symfony
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Run migrations:
   ```bash
   php bin/console doctrine:migrations:migrate --no-interaction
   ```
4. Start the server:
   ```bash
   php -S localhost:8001 -t public
   ```
   The API will be available at `http://localhost:8001/api/bids`.

## API Documentation
Detailed API documentation for both frameworks can be found in [API_DOCS.md](./API_DOCS.md).

## Postman Collections
Postman collections are provided for both frameworks to facilitate testing:
- **Laravel**: `frameworks/laravel/bid_api_postman_collection.json`
- **Symfony**: `frameworks/symfony/bid_api_postman_collection.json`

Import these files into Postman and set the `base_url` variable accordingly.

---

## Author
**Performed by:**
- **Name:** Антипенко Артем
- **Group:** ВТ-24-1
- **Email:** vt241_aaa@student.ztu.edu.ua
