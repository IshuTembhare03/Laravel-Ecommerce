# 🛒 Laravel Ecommerce Project

A fully functional **Ecommerce Web Application** built using Laravel and MySQL.  
This project includes Product Management, Multiple Image Upload, Cart System, REST APIs, and proper exception handling.

---

## 🚀 Project Overview

This project is developed as a backend + API-based ecommerce system with admin-level control over products and cart functionality.

---

## ✨ Features

- Product CRUD (Create, Read, Update, Delete)
- Multiple Product Image Upload
- Cart Management System
- RESTful APIs for all operations
- Proper Exception Handling (No API crashes)
- Clean MVC Architecture
- Database normalization
- Secure and structured backend

---

## 🛠️ Tech Stack

- Backend: Laravel (PHP)
- Database: MySQL
- API Testing: Postman
- Architecture: MVC Pattern

---

## 📁 Project Structure
Laravel-Ecommerce/
│
├── app/
├── bootstrap/
├── config/
├── database/
│ ├── migrations/
│ └── ecommerce_project.sql
├── postman/
│ └── ecommerce-api.json
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/
└── README.md


---

## ⚙️ Installation & Setup Guide

### 1. Clone the Repository
```bash
git clone https://github.com/IshuTembhare03/Laravel-Ecommerce.git
cd Laravel-Ecommerce

2. Install Dependencies
composer install

3. Setup Environment File
cp .env.example .env

4. Generate Application Key
php artisan key:generate

5. Configure Database in .env
DB_CONNECTION=mysqlDB_HOST=127.0.0.1DB_PORT=3306DB_DATABASE=ecommerce_projectDB_USERNAME=rootDB_PASSWORD=

6. Import Database
Import this file into MySQL:
database/ecommerce_project.sql
You can use:


phpMyAdmin OR


MySQL CLI



7. Run Migrations (Optional)
php artisan migrate

8. Start Development Server
php artisan serve
Project will run at:
http://127.0.0.1:8000

📬 API Documentation (Postman)
All APIs are tested using Postman.
📁 File Location:
/postman/ecommerce-api.json
Includes APIs for:


Product CRUD APIs


Product Image Upload APIs


Cart APIs


Fetch Product List APIs



⚠️ Exception Handling
All APIs are protected with proper error handling:
Example:
try {    // logic here} catch (\Exception $e) {    return response()->json([        'status' => false,        'message' => $e->getMessage()    ], 500);}
API Response Format:
{  "status": true,  "message": "Success",  "data": []}

🗄️ Database Details
Tables:


products


product_images


carts


SQL Backup File:
database/ecommerce_project.sql

📌 Important Submission Requirements
✔ Project must be submitted via GitHub
✔ Include SQL database backup file
✔ Include Postman collection file
✔ APIs must not crash
✔ Proper error handling must be implemented
✔ Include setup instructions (this README)

❌ Do NOT include in GitHub


node_modules/


vendor/


.env file



👨‍💻 Author
Ishu Tembhare
GitHub: https://github.com/IshuTembhare03

🎯 Final Note
This project is fully structured for submission with:


Backend APIs


Database backup


Postman documentation


Setup guide


Exception handling


---# 🚀 DONENow just:1. Copy this file  2. Paste into `README.md` in your project  3. Commit & push to :contentReference[oaicite:0]{index=0}  ---If you want next upgrade, I can also help you:✅ Create Postman JSON file for all APIs  ✅ Make your Laravel project 100% error-free  ✅ Add admin panel structure  ✅ Or prepare deployment (live hosting)Just tell 👍
