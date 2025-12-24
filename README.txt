LIBRARY MANAGEMENT SYSTEM (OEL) - Improved Version

What you asked:
- Public Home page (no login) -> shows ONLY Available books
- Admin Login is required for Add / Edit / Delete
- Removed extra tip texts from pages
- Logo text does NOT show course name

How to run (XAMPP):
1) Copy folder "library_oel_project" into: C:\xampp\htdocs\
2) Start Apache + MySQL
3) phpMyAdmin -> Import -> database.sql
4) Open:
   - Public Home: http://localhost/library_oel_project/index.php
   - Admin Login: http://localhost/library_oel_project/login.php

Admin credentials (not shown on the login page):
- username: admin
- password: admin123

Files:
- index.php        (Public Home: Available Books only)
- login.php        (Admin login)
- dashboard.php    (Admin dashboard with Add/Edit/Delete)
- add_book.php     (Admin add)
- edit_book.php    (Admin edit)
- delete_book.php  (Admin delete)
- contact.php      (Admin only, message length validation)
- auth.php         (Session-based access control)
- config.php       (DB connection)
- style.css        (UI styles)
- scripts.js       (DOM + validation + events)
- database.sql     (DB + tables + seed)
