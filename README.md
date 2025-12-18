# Project Setup Guide

This README provides step-by-step instructions to set up and run the Laravel project locally.

---

## Requirements

* PHP (recommended: 8.1+)
* Composer
* MySQL / compatible database
* Laravel supported web server (Apache / Nginx)

---

## Installation Steps

### 1. Install Dependencies

Run Composer to install all required PHP dependencies:

```bash
composer install
```

---

### 2. Set Folder Permissions

Laravel requires write permissions for cache and logs. Run the following command:

```bash
sudo chmod -R 777 storage/logs storage/framework bootstrap/cache
```

> ⚠️ **Note:** `777` permissions are recommended only for local or development environments.

---

### 3. Configure Environment

* Copy the environment file:

```bash
cp .env.example .env
```

* Update database credentials in the `.env` file
* Generate application key:

```bash
php artisan key:generate
```

---

## Database Migration

### 4. Run All Migrations

To migrate all default and configured databases:

```bash
php artisan migrate
```

---

### 5. Migrate Specific Database (If Not Generated)

If a specific migration for another database (e.g., tenant or users DB) was not executed automatically, run it manually using the path:

```bash
php artisan migrate --path=database/migrations/users/2025_12_18_084409_create_users_table.php
```

---

## Final Notes

* Ensure the correct database connection is configured for multiple databases
* Clear cache if needed:

```bash
php artisan optimize:clear
```

---

✅ Setup completed successfully. You can now run the application.
