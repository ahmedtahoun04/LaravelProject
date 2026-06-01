# 🛍️ Fashion Store - E-Commerce Platform

A full-featured e-commerce platform built with Laravel 11, featuring a complete shopping experience for customers and a powerful admin panel for store management.

---

## 🚀 Features

### 🛒 Customer Features
- Browse products with category filtering and search
- Product details with images, pricing, and reviews
- Shopping cart with quantity management
- Secure checkout with order placement
- Order history and tracking
- Product reviews and star ratings
- User authentication (register/login)

### ⚙️ Admin Panel Features
- Dashboard with statistics (categories, products, orders)
- Full CRUD for Categories (with parent/child hierarchy)
- Full CRUD for Products (with image upload)
- Order management with status updates
- Role-based access control (Admin/User)

---

## 🛠️ Tech Stack

| Technology | Purpose |
|------------|---------|
| **Laravel 11** | PHP Framework |
| **PHP 8.2** | Backend Language |
| **MySQL** | Database |
| **Eloquent ORM** | Database Management |
| **Laravel Breeze** | Authentication |
| **AdminLTE 3** | Admin Panel UI |
| **Bootstrap 5** | Frontend UI |
| **Blade** | Templating Engine |

---

## ⚙️ Installation

### Requirements
- PHP >= 8.2
- Composer
- MySQL
- Node.js & npm

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/ahmedtahoun04/LaravelProject.git
cd LaravelProject
```

**2. Install dependencies**
```bash
composer install
npm install
```

**3. Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure database in .env**

DB_DATABASE=laravelproject
DB_USERNAME=root
DB_PASSWORD=

**5. Run migrations and seeders**
```bash
php artisan migrate --seed
```

**6. Create storage link**
```bash
php artisan storage:link
```

**7. Start the server**
```bash
php artisan serve
```

---

## 👤 Default Admin Account
Email:    admin@fashionstore.com
Password: password123

---

## 📊 Database Schema

users ──────────── role_user ──────── roles
│
├── orders ───── order_items ─── products ─── categories
│                                    │
└── reviews ────────────────────────┘


---

## 🎯 Key Concepts Implemented

- **MVC Architecture** - Clean separation of concerns
- **Eloquent ORM** - Database relationships (One-to-Many, Many-to-Many)
- **Authentication** - Laravel Breeze with role-based access
- **Middleware** - Route protection based on user roles
- **Session Management** - Shopping cart using Laravel sessions
- **File Upload** - Product image management
- **Blade Templating** - Reusable layouts and components
- **RESTful Routes** - Resource controllers for CRUD operations

---

## 📁 Project Structure


app/
├── Http/Controllers/
│   ├── Admin/
│   │   ├── CategoryController.php
│   │   ├── ProductController.php
│   │   └── OrderController.php
│   ├── CartController.php
│   ├── OrderController.php
│   └── ReviewController.php
├── Models/
│   ├── User.php
│   ├── Category.php
│   ├── Product.php
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Review.php
│   └── Role.php
database/
├── migrations/
└── seeders/
resources/views/
├── layouts/
│   ├── admin.blade.php
│   └── app.blade.php
├── admin/
│   ├── categories/
│   ├── products/
│   └── orders/
├── home.blade.php
├── shop.blade.php
├── product.blade.php
├── cart.blade.php
├── checkout.blade.php
├── my-orders.blade.php
└── order-details.blade.php


---

## 👨‍💻 Developer

**Ahmed Abdelaziz Tahoun**
- GitHub: [@ahmedtahoun04](https://github.com/ahmedtahoun04)
- University: Nişantaşı University
- LinkedIn: [Ahmed Tahoun](https://www.linkedin.com/in/ahmed-tahoun-b1a71b319/)
---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
