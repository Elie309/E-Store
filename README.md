# E-Store

A modern e-commerce platform built with Laravel.

## Overview

E-Store is a full-featured e-commerce solution that allows you to create and manage your online store with ease. This application provides a robust set of features for both administrators and customers.

## Features

- User authentication and authorization
- Product catalog management
- Shopping cart functionality
- Order processing and management
- Payment integration
- Admin dashboard
- Responsive design

## Technologies Used

- Laravel
- MySQL
- Redis
- Vite
- PHP

## Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL
- Node.js & NPM

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/yourusername/e-store.git
   cd e-store
   ```

2. Install dependencies:
   ```
   composer install
   npm install
   ```

3. Copy the example environment file and configure it:
   ```
   cp .env.example .env
   ```

4. Generate application key:
   ```
   php artisan key:generate
   ```

5. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=e-store
   DB_USERNAME=root
   DB_PASSWORD=root
   ```

6. Run migrations and seed the database:
   ```
   php artisan migrate --seed
   ```

7. Build assets:
   ```
   npm run build
   ```

8. Start the development server:
   ```
   php artisan serve
   ```

## Usage

After installation, you can access the application at http://localhost:8000

### Admin Access

To access the admin dashboard, visit http://localhost:8000/admin and log in with the admin credentials.

## Session and Cache Configuration

The application uses database sessions and cache:
- Session lifetime: 120 minutes
- Cache store: database

## Queue and Filesystem

- Queue connection: database
- Default filesystem disk: local

## Testing

Run the test suite with:
```
php artisan test
```

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
