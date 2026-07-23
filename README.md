# Active Drivers – Driver Booking & Management System

A multi-role Laravel web application connecting customers with available drivers for ride bookings, with dedicated portals for Admins, Customers, and Drivers.

## Overview

Active Drivers is a driver booking and management platform where customers can search for available drivers, book rides, and manage their bookings, while drivers set their availability and view assigned trips. Admins oversee the entire system — managing drivers, customers, cars, bookings, banners, and role-based permissions from a dedicated dashboard.

## Key Features

- **Three Role-Based Portals** — Separate, middleware-protected areas for Admin, Customer, and Driver, each with its own authentication flow
- **Driver Management** — Driver profiles with license number, experience, hill-driving and luxury car experience, accident history, and profile images
- **Availability Scheduling** — Drivers set available dates and time slots; customers can search and filter available drivers accordingly
- **Booking System** — Full booking flow with pickup/drop location, postcode, journey type, fare, distance, duration, and status tracking (pending, accepted, completed, cancelled)
- **Customer & Car Management** — Customers manage their profile and registered vehicles
- **Dynamic Roles & Permissions** — Admin-configurable role-based access control (not hardcoded), managed through dedicated roles and permissions tables
- **Complete Audit Trail** — Every core table (drivers, bookings, customers, roles, permissions, banners, cars, availability) has a matching history table that logs every create/update/delete action
- **Security Safeguards** — Soft deletes across core tables, failed-login-attempt tracking, and account blocking for drivers
- **Session Protection** — Custom middleware prevents authenticated pages from being accessed via browser back button after logout

## Tech Stack

- **Framework:** Laravel 12
- **Language:** PHP 8.2
- **Database:** MySQL
- **Frontend:** HTML, CSS, Bootstrap, jQuery, Blade templates
- **Auth:** Custom role-based middleware (Admin / Customer / Driver guards)

## Architecture

The app is split into three independently-routed portals:

| Portal | Route File | Middleware | Capabilities |
|---|---|---|---|
| **Admin** | `routes/admin.php` | `admin`, `prevent-back-history` | Manage drivers, customers, cars, bookings, banners, users, roles & permissions |
| **Customer** | `routes/customer.php` | `Customer`, `prevent-back-history` | Browse available drivers, book rides, manage profile & cars, view booking history |
| **Driver** | `routes/driver.php` | `Driver`, `prevent-back-history` | Set availability, manage profile, view assigned trips |

### Audit-History Design
Every major write operation is mirrored into a corresponding `*_history` table (e.g. `bookings` → `bookings_history`) with an `action` column recording what happened — giving the system a full, queryable audit log without relying on third-party packages.

## Getting Started

```bash
git clone https://github.com/kishoreravichandrannerxpire/active_drivers.git
cd active_drivers
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Author

**Kishore R**
PHP Laravel Developer
[GitHub](https://github.com/kishoreravichandrannerxpire) · kishoreravichandran7@gmail.com
