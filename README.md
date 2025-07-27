# Bus Route Management System (CIS 241 Unit 3 Project)

## Project Overview

This project is a PHP/MySQL web application designed to manage bus routes. It includes a login system with role-based access for **administrators** and **users**.

- **Admins** can: add, edit, delete routes.
- **Users** can: view routes and "attend" them.
- The system uses session-based authentication and basic MVC-style includes (header, footer, route list).

---

## File Structure

```
/BusRoute
├── index.php               # Main landing page
├── admin.php               # Admin-only dashboard
├── login.php               # Handles login POST logic
├── login_form.php          # Displays login form
├── register.php            # User registration page
├── add_route.php           # Admin-only add route
├── edit_route.php          # Admin-only edit route
├── delete_route.php        # Admin-only delete route
├── route_list.php          # Route list shown to all users
├── header.php              # Shared header
├── footer.php              # Shared footer
├── controllers/
│   └── route_controller.php  # Central controller (optional)
├── models/
│   ├── database.php        # PDO DB connection
│   ├── route_db.php        # Functions for managing routes
│   └── user_db.php         # Functions for user/admin auth
```

---

##  Users and Roles

- Users log in from the `users` table.
- Admins log in from the `administrators` table.

### `users` table:

| Column     | Type      |
|------------|-----------|
| id         | INT (PK)  |
| email      | VARCHAR   |
| password   | VARCHAR (hashed) |
| admin      | VARCHAR (default: 'user') |

### `administrators` table:

| Column        | Type               |
|---------------|--------------------|
| adminID       | INT (PK)           |
| emailAddress  | VARCHAR            |
| password      | VARCHAR (hashed)   |
| role          | ENUM('admin','user') |

---

## Role-based Access

| Feature              | Admin | User |
|----------------------|-------|------|
| View routes          | ✅     | ✅    |
| Add/Edit/Delete      | ✅     | ❌    |
| Attend Route         | ❌     | ✅    |

---

## Technologies

- PHP 8.x
- MySQL 8.x
- WAMP / XAMPP (local development)
- Sessions for authentication
- Bcrypt password hashing
- Basic MVC (flat file with includes)

---

## Setup Instructions

1. Import the SQL file into phpMyAdmin:
   - Database: `busroutedb`
   - Tables: `routes`, `users`, `administrators`

2. Update `models/database.php` with your DB credentials.

3. Start the PHP server (WAMP/XAMPP).

4. Navigate to `login.php` and test login with:
   - Admin: `admin@example.com` / [your hashed password]
   - Or register a new user

---

## Status

This project is being rebuilt from scratch. All files will be rewritten to restore full functionality as per CIS 241 project guidelines.