# Laravel CMS - User & Role Management System

A comprehensive Content Management System built with Laravel 12, PostgreSQL, and Docker, featuring authentication and role-based access control.

## 🚀 Features

### Core Features

- **User Registration** - Public user registration with automatic role assignment
- **User Authentication** - Secure login/logout functionality
- **User Management** - Super Users can create, edit, and delete users
- **Role Management** - Super Users can create and manage roles
- **Role-Based Access Control** - Fine-grained permissions system

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

- **Backend**: Laravel 12.x (PHP 8.2)
- **Frontend**: Blade Templates + Tailwind CSS
- **Authentication**: Laravel Breeze
- **Database**: PostgreSQL 15
- **Containerization**: Docker & Docker Compose
- **Web Server**: Nginx

## 📋 Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- No need to install PHP, Composer, or PostgreSQL locally!

## 🔧 Installation & Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd test-cheil-cms_php
```

### 2. Build and Start Docker Containers

```bash
docker-compose build
docker-compose up -d
```

### 3. Install Dependencies & Setup Laravel

```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app chmod -R 777 storage bootstrap/cache
```

### 4. Build Frontend Assets

```bash
docker-compose exec app npm install
docker-compose exec app npm run build
```

## ✅ Access the Application

### Application URLs

- **Web Application**: http://localhost:8000
- **Adminer (Database Manager)**: http://localhost:8080

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

- **View All Users**: See a list of all registered users with their roles
- **Create User**: Register new users with specific roles
- **Edit User**: Update user information and change their roles
- **Delete User**: Remove users from the system (cannot delete your own account)

#### Role Management (`/admin/roles`)

- **View All Roles**: See all available roles and their user counts
- **Create Role**: Add new roles with descriptions
- **Edit Role**: Update role names and descriptions
- **Delete Role**: Remove roles (only if no users are assigned)

## 🎯 Key Routes

### Public Routes

- `/` - Welcome page
- `/register` - User registration
- `/login` - User login

### Authenticated Routes

- `/dashboard` - User dashboard (shows role-specific content)
- `/profile` - Edit user profile

### Admin Routes (Super User Only)

- `/admin/users` - User management
- `/admin/roles` - Role management

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

- **Password Hashing**: All passwords are hashed using bcrypt
- **CSRF Protection**: All forms are protected against CSRF attacks
- **Middleware Protection**: Admin routes are protected by custom middleware
- **Email Validation**: Unique email addresses required
- **Password Confirmation**: Required for new user creation
- **Role Validation**: Users cannot manually assign roles during public registration

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

- `id`: Primary key
- `name`: User's full name
- `email`: Unique email address
- `password`: Hashed password
- `role_id`: Foreign key to roles table
- `email_verified_at`: Email verification timestamp
- `timestamps`: created_at, updated_at

### Roles Table

- `id`: Primary key
- `name`: Role name (e.g., "Super User")
- `slug`: URL-friendly slug (e.g., "super-user")
- `description`: Role description
- `timestamps`: created_at, updated_at

## 🎨 UI/UX Features

- **Responsive Design**: Works on desktop, tablet, and mobile
- **Tailwind CSS**: Modern, utility-first CSS framework
- **Role Badges**: Visual indicators for user roles
- **Success/Error Messages**: User feedback for all actions
- **Confirmation Dialogs**: Prevents accidental deletions
- **Pagination**: Efficient handling of large datasets
- **Active Navigation**: Highlights current page in navigation

## 📝 Notes

- **Data Persistence**: PostgreSQL data is stored in a Docker volume and persists between container restarts
- **Hot Reload**: Code changes are immediately reflected (no need to restart containers)
- **Environment Variables**: Sensitive configuration is stored in `.env` file
- **Default Role**: Public registration automatically assigns "User Viewer" role
- **Self-Protection**: Super Users cannot delete their own accounts

## 🆘 Support

For issues, questions, or contributions:

- Laravel Documentation: https://laravel.com/docs
- Docker Documentation: https://docs.docker.com
- PostgreSQL Documentation: https://www.postgresql.org/docs

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🎉 Credits

Built with:

- [Laravel](https://laravel.com)
- [Laravel Breeze](https://github.com/laravel/breeze)
- [Tailwind CSS](https://tailwindcss.com)
- [PostgreSQL](https://www.postgresql.org)
- [Docker](https://www.docker.com)
