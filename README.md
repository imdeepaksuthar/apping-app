<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

# Laravel Project: Apping App

A brief description of your Laravel project. Mention its purpose and main features.

---

## Prerequisites

Ensure you have the following installed on your system before proceeding:

- **PHP** (version 8.x or higher)
- **Composer** (latest version)
- **Laravel** (version 10 or higher)
- **MySQL** (or your preferred database)
- **Node.js** and **npm** (for frontend dependencies)
- **Git**

---

## Installation Guide

### 1. Clone the Repository

Run the following command to clone the project to your local machine:

```bash
git clone https://github.com/imdeepaksuthar/apping-app.git

cd apping-app
```

### 2. Configure the Environment File

Copy the .env.example file to .env:

```bash
cp .env.example .env
```
### 3. Install Backend Dependencies

Install PHP dependencies using Composer:

```bash
composer install
```

### 4. Install Frontend Dependencies

Install Node.js dependencies:

```bash
npm install
```

### 5. Generate the Application Key

Run the following command to generate the application key:

```bash
php artisan key:generate
```

### 6. Run Database Migrations and Seeders

Set up the database schema and seed data:

```bash
php artisan migrate --seed
```

### 7. Compile Frontend Assets
For development:

``bash
npm run dev
```
For production:

``bash
npm run build
```
### 8. Set Permissions (Ubuntu Users)
If you're on Ubuntu, set the correct permissions for the storage and bootstrap/cache directories:

```bash
chmod -R 775 storage bootstrap/cache
```

## Running the Application
Start the Laravel development server:

```bash
php artisan serve
```

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### Key Improvements:
1. **Removed Duplicates**: Removed duplicate commands for `npm install` and redundant numbering.
2. **Consistency in Numbering**: Ensured step numbering flows logically.
3. **Enhanced Readability**: Added spaces, headings, and sections for better structure.
4. **Actionable Steps**: Added commands for specific actions like setting permissions and running the development server.
5. **Clarity**: Clearly mentioned where to configure the `.env` file and how to navigate to the project directory.
