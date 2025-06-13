# Laravel User CRUD API + Admin Panel

A full-featured user management system with both web UI and RESTful API.

## Features

- ✅ CRUD (Web + API)
- ✅ Unique validation (email & phone)
- ✅ Pagination & filtering
- ✅ Soft deletes & bulk delete
- ✅ Excel export
- ✅ Laravel Form Requests
- ✅ API documentation (Swagger)
- ✅ PHPUnit unit tests
- ✅ Bootstrap 5 frontend

## Setup

```bash
git clone ...
cd user-crud-api
composer install
cp .env.example .env
php artisan key:generate

-----------------
update .env
-----------------
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=user_management
DB_USERNAME=root
DB_PASSWORD=

php artisan migrate
php artisan serve

## API Documentation
Visit /api/documentation for Swagger UI.

## Testing
php artisan test tests/Feature/UserApiTest.php

