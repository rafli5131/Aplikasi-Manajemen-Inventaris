# Inventory Management Application

A web application for organizing inventory records, item categories, storage locations, suppliers, and maintenance activities. The application uses Laravel and Filament for its administrative interface.

## Main features

- Inventory records with stock, cost, condition, and item details.
- Categories, rooms or locations, and supplier records.
- Reporting and tracking for inventory and maintenance workflows.
- Administrative interface built with Filament.

## Technology

PHP, Laravel, Filament, MySQL, Tailwind CSS, and Docker Compose for local development.

## Local installation

```bash
git clone https://github.com/rafli5131/Aplikasi-Manajemen-Inventaris.git
cd Aplikasi-Manajemen-Inventaris
composer install
cp .env.example .env
php artisan key:generate
```

Configure `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in your local `.env`, then initialize the database:

```bash
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

## Docker development

An example Docker environment is included in the repository. Review the values in `.env.docker` and change any sample credentials before starting services.

```bash
cp .env.docker .env
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
```

The application and database-management interfaces are documented in the Docker configuration. Do not expose development database tools or default credentials to the public internet.

## Project layout

- `app/`: models, application logic, and Filament resources.
- `database/`: migrations, factories, and seeders.
- `resources/`: frontend views and assets.
- `routes/`: application routes.
- `tests/`: test scaffolding.

A [server upgrade tutorial](TUTORIAL_UPGRADE_SERVER.md) is also included. Validate its steps against your deployment environment before using it on a production system.
