# Laravel CMS - User & Role Management System

A comprehensive Content Management System built with Laravel 12, PostgreSQL, and Docker, featuring authentication and role-based access control.

## 🚀 Features

### Core Features

-   **User Registration** - Public user registration with automatic role assignment
-   **User Authentication** - Secure login/logout functionality
-   **User Management** - Super Users can create, edit, and delete users
-   **Role Management** - Super Users can create and manage roles
-   **Role-Based Access Control** - Fine-grained permissions system

### Roles

1. **Super User**

    - Full access to all features
    - Can register other users
    - Can manage roles
    - Can perform all CRUD operations on users and roles

2. **User Viewer**
    - Limited read-only access
    - Default role for public registration
    - Can view dashboard

## 🛠️ Tech Stack

-   **Backend**: Laravel 12.x (PHP 8.2)
-   **Frontend**: Blade Templates + Tailwind CSS
-   **Authentication**: Laravel Breeze
-   **Database**: PostgreSQL 15
-   **Containerization**: Docker & Docker Compose
-   **Web Server**: Nginx

## 📋 Prerequisites

-   [Docker Desktop](https://www.docker.com/products/docker-desktop)
-   No need to install PHP, Composer, or PostgreSQL locally!

## 🔧 Installation & Setup

Panduan lengkap untuk setup project ini dari awal setelah melakukan git pull atau clone.

### 1. Clone atau Pull Repository

Jika belum memiliki project, clone repository terlebih dahulu:

```bash
git clone <repository-url>
cd test-cheil-cms_php
```

Jika sudah memiliki project dan ingin update dari git:

```bash
git pull origin master
```

### 2. Setup Environment File (.env)

Laravel memerlukan file `.env` untuk konfigurasi. Salin file `.env.example` menjadi `.env`:

```bash
# Di Windows (PowerShell)
Copy-Item .env.example .env

# Di Linux/Mac
cp .env.example .env
```

**Penting**: File `.env` sudah berisi konfigurasi database yang sesuai dengan Docker setup, jadi tidak perlu diubah kecuali ada kebutuhan khusus.

### 3. Build dan Start Docker Containers

Pastikan Docker Desktop sudah berjalan, lalu build dan jalankan container:

```bash
# Build image Docker
docker-compose build

# Jalankan container di background
docker-compose up -d

# Verifikasi container berjalan
docker-compose ps
```

Setelah menjalankan perintah di atas, Anda akan memiliki 3 container:

-   **app**: Container Laravel (PHP 8.2 + Nginx)
-   **db**: Container PostgreSQL 15
-   **adminer**: Database management tool (opsional)

### 4. Install Dependencies PHP (Composer)

Install semua package PHP yang diperlukan:

```bash
docker-compose exec app composer install
```

### 5. Generate Application Key

Laravel memerlukan application key untuk enkripsi. Generate key dengan perintah:

```bash
docker-compose exec app php artisan key:generate
```

### 6. Setup Database

Jalankan migration dan seeder untuk membuat tabel dan data awal:

```bash
# Jalankan migration (membuat tabel di database)
docker-compose exec app php artisan migrate

# Jalankan seeder (mengisi data default: roles dan super user)
docker-compose exec app php artisan db:seed
```

**Catatan**: Setelah menjalankan seeder, Anda akan memiliki:

-   2 default roles: "Super User" dan "User Viewer"
-   1 super user account: `superadmin@cheil.com` / `password`

### 7. Set Permission Storage dan Cache

Set permission untuk folder storage dan cache agar Laravel bisa menulis file:

```bash
# Di Windows (PowerShell) - biasanya tidak diperlukan
# Di Linux/Mac
docker-compose exec app chmod -R 777 storage bootstrap/cache
```

### 8. Install Dependencies Frontend (NPM) dan Build Assets

Install package Node.js dan build asset untuk frontend:

```bash
# Install dependencies
docker-compose exec app npm install

# Build assets untuk production
docker-compose exec app npm run build
```

Atau untuk development dengan hot reload:

```bash
# Jalankan di terminal terpisah untuk watch mode
docker-compose exec app npm run dev
```

### 9. Verifikasi Setup

Setelah semua langkah di atas selesai, verifikasi bahwa semua berjalan dengan baik:

```bash
# Cek status container
docker-compose ps

# Cek log aplikasi (jika ada error)
docker-compose logs app

# Cek log database (jika ada error)
docker-compose logs db
```

### 10. Akses Aplikasi

Buka browser dan akses:

-   **Aplikasi Web**: http://localhost:8000
-   **Adminer (Database Manager)**: http://localhost:8080

Login dengan kredensial default:

-   Email: `superadmin@cheil.com`
-   Password: `password`

---

## 🔄 Setup untuk Update Project

Jika Anda sudah pernah setup sebelumnya dan hanya ingin update dari git:

```bash
# 1. Pull perubahan terbaru
git pull origin master

# 2. Update dependencies jika ada perubahan composer.json
docker-compose exec app composer install

# 3. Update dependencies frontend jika ada perubahan package.json
docker-compose exec app npm install
docker-compose exec app npm run build

# 4. Jalankan migration baru jika ada
docker-compose exec app php artisan migrate

# 5. Clear cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

## ✅ Access the Application

### Application URLs

-   **Web Application**: http://localhost:8000
-   **Adminer (Database Manager)**: http://localhost:8080

### Default Credentials

#### Super User Account

```
Email: superadmin@cheil.com
Password: password
```

#### Database Access (via Adminer)

```
System: PostgreSQL
Server: db
Database: user_data_db
Username: user_admin_cheil
Password: password_admin_cheil
```

## 📖 User Guide

### For Public Users

1. Visit http://localhost:8000
2. Click **Register** to create a new account
3. Fill in your details (Name, Email, Password)
4. Your account will be automatically assigned the **User Viewer** role
5. Login with your credentials to access the dashboard

### For Super Users

After logging in as a Super User, you have access to:

#### User Management (`/admin/users`)

-   **View All Users**: See a list of all registered users with their roles
-   **Create User**: Register new users with specific roles
-   **Edit User**: Update user information and change their roles
-   **Delete User**: Remove users from the system (cannot delete your own account)

#### Role Management (`/admin/roles`)

-   **View All Roles**: See all available roles and their user counts
-   **Create Role**: Add new roles with descriptions
-   **Edit Role**: Update role names and descriptions
-   **Delete Role**: Remove roles (only if no users are assigned)

## 🎯 Key Routes

### Public Routes

-   `/` - Welcome page
-   `/register` - User registration
-   `/login` - User login

### Authenticated Routes

-   `/dashboard` - User dashboard (shows role-specific content)
-   `/profile` - Edit user profile

### Admin Routes (Super User Only)

-   `/admin/users` - User management
-   `/admin/roles` - Role management

## 💻 Development Commands

### Laravel Artisan Commands

```bash
# Run migrations
docker-compose exec app php artisan migrate

# Seed database
docker-compose exec app php artisan db:seed

# Clear cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear

# View all routes
docker-compose exec app php artisan route:list
```

### Composer Commands

```bash
# Install new package
docker-compose exec app composer require package-name

# Update dependencies
docker-compose exec app composer update
```

### Frontend Development

```bash
# Install NPM dependencies
docker-compose exec app npm install

# Run development build
docker-compose exec app npm run dev

# Build for production
docker-compose exec app npm run build
```

### Database Commands

```bash
# Access PostgreSQL via psql
docker-compose exec db psql -U user_admin_cheil -d user_data_db

# View roles
docker-compose exec db psql -U user_admin_cheil -d user_data_db -c "SELECT * FROM roles;"

# View users
docker-compose exec db psql -U user_admin_cheil -d user_data_db -c "SELECT id, name, email, role_id FROM users;"
```

## 🔒 Security Features

-   **Password Hashing**: All passwords are hashed using bcrypt
-   **CSRF Protection**: All forms are protected against CSRF attacks
-   **Middleware Protection**: Admin routes are protected by custom middleware
-   **Email Validation**: Unique email addresses required
-   **Password Confirmation**: Required for new user creation
-   **Role Validation**: Users cannot manually assign roles during public registration

## 📁 Project Structure

```
test-cheil-cms_php/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Admin/
│   │   │       ├── UserController.php
│   │   │       └── RoleController.php
│   │   └── Middleware/
│   │       └── CheckSuperUser.php
│   └── Models/
│       ├── User.php
│       └── Role.php
├── database/
│   ├── migrations/
│   │   ├── create_roles_table.php
│   │   └── add_role_id_to_users_table.php
│   └── seeders/
│       ├── RoleSeeder.php
│       └── SuperUserSeeder.php
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── users/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   └── roles/
│       │       ├── index.blade.php
│       │       ├── create.blade.php
│       │       └── edit.blade.php
│       └── dashboard.blade.php
├── routes/
│   └── web.php
├── docker/
│   └── nginx/
│       └── default.conf
├── docker-compose.yml
├── Dockerfile
└── README.md
```

## 🐛 Troubleshooting

### Port Already in Use

If port 8000 or 5432 is already in use:

```bash
# Edit docker-compose.yml and change the port mappings
# For example: "8001:80" instead of "8000:80"
```

### Permission Denied Errors

```bash
docker-compose exec app chmod -R 777 storage bootstrap/cache
```

### Database Connection Issues

```bash
# Check if containers are running
docker-compose ps

# Restart database container
docker-compose restart db

# View logs
docker-compose logs db
```

### Clear All Caches

```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

## 🔄 Common Workflows

### Creating a New User (Super User)

1. Login as Super User
2. Navigate to **User Management**
3. Click **Create New User**
4. Fill in user details and select a role
5. Click **Create User**

### Changing User Roles (Super User)

1. Navigate to **User Management**
2. Click **Edit** next to the user
3. Select the new role from the dropdown
4. Click **Update User**

### Adding New Roles (Super User)

1. Navigate to **Role Management**
2. Click **Create New Role**
3. Enter role name and description
4. Click **Create Role**

## 📊 Database Schema

### Users Table

-   `id`: Primary key
-   `name`: User's full name
-   `email`: Unique email address
-   `password`: Hashed password
-   `role_id`: Foreign key to roles table
-   `email_verified_at`: Email verification timestamp
-   `timestamps`: created_at, updated_at

### Roles Table

-   `id`: Primary key
-   `name`: Role name (e.g., "Super User")
-   `slug`: URL-friendly slug (e.g., "super-user")
-   `description`: Role description
-   `timestamps`: created_at, updated_at

## 🎨 UI/UX Features

-   **Responsive Design**: Works on desktop, tablet, and mobile
-   **Tailwind CSS**: Modern, utility-first CSS framework
-   **Role Badges**: Visual indicators for user roles
-   **Success/Error Messages**: User feedback for all actions
-   **Confirmation Dialogs**: Prevents accidental deletions
-   **Pagination**: Efficient handling of large datasets
-   **Active Navigation**: Highlights current page in navigation

## 📝 Notes

-   **Data Persistence**: PostgreSQL data is stored in a Docker volume and persists between container restarts
-   **Hot Reload**: Code changes are immediately reflected (no need to restart containers)
-   **Environment Variables**: Sensitive configuration is stored in `.env` file
-   **Default Role**: Public registration automatically assigns "User Viewer" role
-   **Self-Protection**: Super Users cannot delete their own accounts

## 📚 Additional Documentation

This project includes comprehensive documentation for various aspects:

-   **[QUICKSTART.md](QUICKSTART.md)** - Quick setup guide to get started in minutes
-   **[CREDENTIALS.md](CREDENTIALS.md)** - Quick reference for login credentials and database access
-   **[TEST_CREDENTIALS.md](TEST_CREDENTIALS.md)** - Complete list of test user accounts for testing
-   **[DATABASE_DUMP_USAGE.md](DATABASE_DUMP_USAGE.md)** - Instructions for using the example database dump
-   **[API_QUICK_START.md](API_QUICK_START.md)** - RESTful API usage and authentication guide
-   **[API_DOCUMENTATION.md](API_DOCUMENTATION.md)** - Complete API endpoint documentation
-   **example_database.sql** - Pre-populated database dump with 5 test users for easy testing

### Quick Database Restore

To restore the example database with test data:

```bash
docker exec -i laravel_postgres psql -U user_admin_cheil -d user_data_db < example_database.sql
```

This will give you 5 ready-to-use test accounts (2 Super Users and 3 User Viewers).

## 🆘 Support

For issues, questions, or contributions:

-   Laravel Documentation: https://laravel.com/docs
-   Docker Documentation: https://docs.docker.com
-   PostgreSQL Documentation: https://www.postgresql.org/docs

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🎉 Credits

Built with:

-   [Laravel](https://laravel.com)
-   [Laravel Breeze](https://github.com/laravel/breeze)
-   [Tailwind CSS](https://tailwindcss.com)
-   [PostgreSQL](https://www.postgresql.org)
-   [Docker](https://www.docker.com)
