# StockOps — Multi-Tenant Product Management
![Version](https://img.shields.io/badge/version-1.1.0--stable-orange)
![Framework](https://img.shields.io/badge/Laravel-13-red)
![Frontend](https://img.shields.io/badge/Vue-3-green)

StockOps is a premium, multi-tenant inventory and category management system built for scalability and high-performance user experiences. Designed with an "Industrial Orange" aesthetic, it provides a seamless, professional environment for multiple users to manage their inventories in complete isolation.

## 🚀 Key Features

- **Multi-Tenant Architecture**: Robust user isolation ensuring each user only accesses their own categories and products.
- **Industrial Orange Design System**: A bespoke, high-contrast UI featuring glassmorphism, backdrop blurs, and micro-animations.
- **Global Command Palette**: Instant navigation and product search using `⌘+K` or `Ctrl+K`.
- **Intelligent Category Guard**: Automated system that ensures valid data structures by requiring categories before product creation.
- **Advanced Filtering & Sorting**: Real-time server-side filtering with state preservation via Inertia.js.
- **Integrated Image Management**: Support for both local file uploads and external URL referencing.
- **Premium Feedback System**: Global SweetAlert2 integration for critical alerts and toast notifications for success actions.
- **Sticky Glass Footer**: Persistent system monitoring and versioning anchor with a frosted-glass effect.

## 🛠️ Technology Stack

- **Backend:** Laravel 11/13 (PHP 8.2+)
- **Frontend:** Vue 3 (Composition API) + Inertia.js
- **Styling:** Tailwind CSS + Vanilla CSS
- **Interactions:** SweetAlert2 + HeroIcons
- **Database:** SQLite / MySQL

## 📦 Setup Instructions

1. **Clone & Navigate**:
```bash
git clone <repository-url>
cd simple_product_management
```

2. **Backend Setup**:
```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
```

3. **Frontend Setup**:
```bash
npm install
npm run build
```

4. **Launch**:
```bash
php artisan serve
```

## 🔐 Testing Credentials
After running the seeder, you can log in with the following default administrative account:
- **Email**: `test@gmail.com`
- **Password**: `12345678`

## 📐 Versioning System
The system utilizes a semantic versioning approach displayed globally in the dashboard footer.
- **Current Stable**: `v1.1.0`
- **Focus**: Multi-tenant logic, Industrial UI standardization, and Global Search.

---
© 2026 StockOps. All Rights Reserved.
