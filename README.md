
# Setup Instructions

- Once downloaded and extracted, copy the contents of `.env.example` into a new file name `.env`
- Run the command `touch database/database.sqlite` or create a file within the database folder named `database.sqlite`

## Install Dependencies
- Run `composer install`
- Run `php artisan key:generate`
- Run `npm install`

## Run migrations and seeder
- Run `php artisan migrate:fresh --seed`

## Building the frontend
- Run `npm run build:prod` 

## Serve the application
- Run `php artisan serve`
- In a browser of your choice go to `http://localhost:8000`

## Run tests
- Run `php artisan test` or for parallel testing run `composer test`
