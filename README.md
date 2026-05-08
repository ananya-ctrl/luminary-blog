# Luminary Blog Management System

A full-stack Blog Management System built using Laravel, PostgreSQL, AJAX, and jQuery with a luxury emerald-green premium UI.

## Live Demo

https://luminary-blog-v29j.onrender.com

---

# Features

## User Side
- View all blogs dynamically from database
- Responsive premium UI
- Blog detail page
- Category filtering using AJAX + jQuery
- Date filtering
- Search functionality
- Mobile and desktop responsive

## Admin Panel
- Admin authentication
- Add blogs
- Edit blogs
- Delete blogs
- Upload blog images
- Rich text editor support

---

# Tech Stack

- Laravel
- PHP
- PostgreSQL
- HTML5
- Tailwind CSS
- JavaScript
- jQuery AJAX
- Render Deployment
- Docker

---

# Installation & Setup

```bash
1. git clone https://github.com/ananya-ctrl/luminary-blog
```

```bash
2. Move into project
cd luminary-blog
```

```bash
3. Install dependencies
composer install
```

```bash
4. Create environment file
cp .env.example .env
```

```bash
5. Generate app key
php artisan key:generate
```

```bash
6. Configure database in .env
Update:
DB_CONNECTION=pgsqlDB_HOST=your_hostDB_PORT=5432DB_DATABASE=your_databaseDB_USERNAME=your_usernameDB_PASSWORD=your_password
```

```bash
7. Run migrations
php artisan migrate
```

```bash
8. Start server
php artisan serve
```

## Admin Login

Login URL:

https://luminary-blog-v29j.onrender.com/login

## Deployment

Deployed on Render using Docker and PostgreSQL.

