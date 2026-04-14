# Product Management System

A simple, full-stack Product Management System focusing on CRUD operations, database relationships, and modern UI/UX.

## Technology Stack
- **Backend:** Laravel 12/13
- **Frontend:** Vue 3 (Composition API) + Inertia.js
- **Styling:** Tailwind CSS
- **Database:** SQLite

## Features
- Create, Read, Update, and Delete Products.
- Filter products by category.
- Sort products by name and quantity.
- Responsive table layout.
- Minimum quantity validation (>= 1).
- Notification messages for success actions.

## Setup Instructions

1. Clone the repository and navigate into the project directory:
```bash
git clone <repository-url>
cd simple_product_management
```

2. Install PHP dependencies:
```bash
composer install
```

3. Setup environment configuration:
```bash
cp .env.example .env
php artisan key:generate
```

4. Install NPM dependencies and build assets:
```bash
npm install && npm run build
```

5. Run database migrations and seeders:
```bash
touch database/database.sqlite
php artisan migrate --seed
```

6. Start the local development server:
```bash
php artisan serve
```

You can now visit the application at `http://localhost:8000`.

## Testing
- Ensure the database is successfully seeded.
- Click "Create Product" to verify validations (Quantity must be >= 1).
- Sort the table columns or filter by category to see Inertia.js preserving state during updates.
