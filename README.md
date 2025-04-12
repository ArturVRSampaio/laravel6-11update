
# Inventory Management System

## Overview

The Inventory Management System is a Laravel 6 web application designed for businesses to track stock levels, monitor sales, and manage restocking. Built with PHP 7.2, it supports role-based access for warehouse staff and managers, asynchronous bulk updates, automated low-stock alerts, and integration with external supplier APIs for reordering. The system includes a user-friendly dashboard, a RESTful API, and caching for performance optimization.

## Features

Authentication: Role-based access for warehouse staff (view/update stock) and managers (full control).
Queues: Asynchronous processing of bulk inventory updates using Laravel’s queue system.
Observers: Automatic logging of low-stock alerts for inventory monitoring.
Email Sending: Notifications to managers for restocking needs.
User Interface: Stock dashboard with charts and real-time alerts.
API: RESTful endpoints for external systems to query stock levels.
Feature Flag: Toggle experimental barcode scanning feature using configuration.
Interface/Abstract Class: Stockable interface for products and raw materials.
Outside API Consumption: Integration with a supplier API for automated reordering.
Caching: Optimized stock summaries using Laravel’s caching system.

## Prerequisites

PHP 7.2
Composer
Laravel 6.x
MySQL 5.7 (or compatible database)
Redis or database driver for caching and queues
Mail server (e.g., Mailtrap for testing, SMTP for production)
Node.js & NPM (for frontend assets)
Supplier API credentials (for external API integration)
Installation

Clone the repository: git clone https://github.com/your-repo/inventory-management-system.git cd inventory-management-system
Install dependencies: composer install npm install
Copy the environment file and configure: cp .env.example .env
Generate application key: php artisan key:generate
Set up the database:
Update .env with database credentials (e.g., DB_CONNECTION=mysql).
Run migrations: php artisan migrate
Configure queue driver:
For Redis, update .env with QUEUE_DRIVER=redis and Redis credentials.
For database, set QUEUE_DRIVER=database and run: php artisan queue:table php artisan migrate
Start queue worker: php artisan queue:work
Compile frontend assets: npm run dev
Start the development server: php artisan serve
Development Tasks Checklist

- ### Authentication
Install Laravel Authentication scaffolding with laravel/ui: composer require laravel/ui:^1.2 php artisan ui vue --auth npm install && npm run dev
Create a role column in the users table (warehouse_staff, manager).
Implement middleware for warehouse_staff to restrict to stock view/update routes.
Implement middleware for manager to allow full access.
Customize login, registration, and password reset views using Blade.
Test role-based access for protected routes.

- ### Queues
Configure queue driver in .env (QUEUE_DRIVER=redis or database).
Create a BulkInventoryUpdateJob: php artisan make:job BulkInventoryUpdateJob
Implement job logic to process stock updates (e.g., CSV uploads).
Add a controller action to dispatch BulkInventoryUpdateJob.
Test job processing with php artisan queue:work.
Configure job retries and timeouts in config/queue.php.

- ### Observers
Create an Inventory model with fields: product_id, quantity, threshold.
Generate an InventoryObserver: php artisan make:observer InventoryObserver --model=Inventory
Implement observer logic to check quantity < threshold on updated events.
Log low-stock alerts to a stock_alerts table (product_id, quantity, created_at).
Register the observer in AppServiceProvider.
Test observer for create/update events using PHPUnit.
Prevent unnecessary triggers for non-quantity updates.

- ### Email Sending
Configure mail driver in .env (e.g., MAIL_DRIVER=smtp or log).
Create a LowStockNotification mailable: php artisan make:mail LowStockNotification
Trigger emails to managers when low-stock alerts are logged.
Design email template with Blade (product name, quantity, restock link).
Queue email sending using Mail::queue().
Test email delivery and rendering with Mailtrap or log driver.

- ### User Interface
Use Blade templating with Bootstrap or Vue.js (via laravel/ui).
Create a stock dashboard (resources/views/dashboard.blade.php) showing stock levels.
Integrate Chart.js for stock trend visualization.
Build a form for warehouse staff to update stock quantities.
Create a manager-only view for stock summaries and restock actions.
Test UI across browsers and devices for responsiveness.

- ### API
Define API routes in routes/api.php with auth:api middleware.
Create a StockController: php artisan make:controller API/StockController --api
Implement index and show methods for stock queries (GET /api/stock).
Use API resources for response formatting: php artisan make:resource StockResource
Add rate limiting in RouteServiceProvider (e.g., 60 requests/minute).
Test API endpoints with PHPUnit or Postman.

- ### Feature Flag
Add a barcode_scanning_enabled key in config/app.php (default: false).
Create a barcode scanning view and controller, guarded by: if (config('app.barcode_scanning_enabled')) { /* logic */ }
Allow managers to toggle the flag via an admin form (store in .env or database).
Test barcode scanning behavior when enabled/disabled.
Provide fallback (e.g., manual entry) when disabled.

- ### Interface/Abstract Class
Define a Stockable interface in app/Contracts/Stockable.php: interface Stockable { public function getStockLevel(); public function updateStock($quantity); }
Create an abstract class StockableBase with shared logic.
Implement Product and RawMaterial models using Stockable.
Update inventory logic to handle any Stockable item polymorphically.
Test interface and abstract class with PHPUnit.
Document the interface in code comments.
Outside API Consumption
Choose a mock supplier API (e.g., public REST API or local mock).
Install Guzzle: composer require guzzlehttp/guzzle:~6.0
Create a SupplierService class to handle API requests.
Implement a job (RestockOrderJob) to trigger reordering on low-stock alerts.
Store API credentials in .env (e.g., SUPPLIER_API_KEY).
Test API integration with mocked responses using Guzzle’s handler stack.
- ### Caching
Configure Redis or file cache in .env (CACHE_DRIVER=redis or file).
Cache stock summaries in the dashboard: Cache::remember('stock_summary', 300, function () { /* query */ });
Invalidate cache on stock updates using Cache::forget('stock_summary').
Create a command to clear stock caches: php artisan make:command ClearStockCache
Test caching performance and invalidation logic.
Ensure cache fallback if Redis is unavailable.

## General Tasks
Create migrations for users, products, inventory, stock_alerts.
Seed database with sample data: php artisan make:seeder DatabaseSeeder
Write PHPUnit tests for models, controllers, and jobs.
Optimize queries with Eloquent’s with() for eager loading.
Set up .gitignore for .env, vendor/, and node_modules/.
Document setup and usage in this README.
Usage

- ### Warehouse Staff:
Log in to view/update stock levels.
See low-stock alerts on the dashboard.
Use barcode scanning (if enabled).
- ### Managers:
Access stock summaries and restock controls.
Receive restock email notifications.
Toggle barcode scanning feature.
- ### External Systems:
Query stock via API (GET /api/stock).
Integrate with supplier APIs for reordering.

## Testing

Run tests:
vendor/bin/phpunit

Ensure coverage for authentication, queues, API, and observers.

---
### Get mysql containerID
`docker ps`
### Enter mysql container
`docker exec -it <containerID> bash`
### enter mysql shell
`mysql -u root -p`
### update user auth on mysql
`ALTER USER 'laravel'@'%' IDENTIFIED WITH mysql_native_password BY 'laravel';`
