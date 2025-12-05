# 📚 Digital Library Management System

**Full-Stack academic project developed for the Web Development course at PUCPR.**

This repository contains a complete web application for managing a digital library. It implements a secure **Authentication System** and allows users to manage (CRUD) books and authors. The backend is built with **PHP** connecting to a **MySQL** database.

## 🛠️ Tech Stack
- **Backend:** PHP 8.x (Native)
- **Database:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3, Bootstrap 5.3
- **Architecture:** MVC-like structure (Processors, Views, Assets).

## 🔐 Key Security Features
- **SQL Injection Protection:** Uses `mysqli` Prepared Statements for all database queries.
- **Password Hashing:** User passwords are encrypted using `password_hash()` (Bcrypt).
- **Session Management:** Protected routes checking active sessions (`$_SESSION`).

## 📋 Features
- [x] **User System:** Login, Registration, and Logout.
- [x] **Dashboard:** Overview of the library collection.
- [x] **Authors Management:** Add, Edit, List, and Delete authors.
- [x] **Books Management:** Complete CRUD for books, linked to authors via Foreign Keys.

## 🚀 How to Run (Localhost)
Since this project uses PHP, it requires a local server like **XAMPP**, **WAMP**, or **Docker**.

1. **Clone the repo** into your server's public folder (e.g., `htdocs` in XAMPP).
2. **Database Setup:**
   - Open phpMyAdmin (usually `http://localhost/phpmyadmin`).
   - Create a database named `Biblioteca`.
   - Import the file `SQL/tabelas_biblioteca.sql` located in this repo.
3. **Configuration:**
   - Check `conexao.php` to ensure the database credentials match your local setup.
4. **Access:**
   - Open your browser and go to `http://localhost/Digital-Library-Manager/`.

---
*Developed by Matheus Ramon - 2025*
