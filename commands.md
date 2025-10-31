# 📝 Cheat Sheet Commands

Kumpulan command yang sering dipakai untuk development Laravel dengan Docker.

## 🐳 Docker Commands

### Start/Stop Containers

```bash
# Start semua containers
docker-compose up -d

# Stop semua containers
docker-compose stop

# Restart semua containers
docker-compose restart

# Stop dan remove containers
docker-compose down

# Lihat status containers
docker-compose ps

# Lihat logs
docker-compose logs -f app
```

### Rebuild Containers

```bash
# Rebuild semua
docker-compose build --no-cache

# Rebuild dan restart
docker-compose up -d --build
```

## 🎨 Laravel Artisan Commands

### Migration & Database

```bash
# Jalankan migrations
docker-compose exec app php artisan migrate

# Rollback migration
docker-compose exec app php artisan migrate:rollback

# Reset database
docker-compose exec app php artisan migrate:fresh

# Jalankan seeder
docker-compose exec app php artisan db:seed

# Fresh migration + seed
docker-compose exec app php artisan migrate:fresh --seed
```

### Generate Code

```bash
# Controller
docker-compose exec app php artisan make:controller UserController
docker-compose exec app php artisan make:controller API/UserController --api

# Model
docker-compose exec app php artisan make:model User
docker-compose exec app php artisan make:model User -m                    # dengan migration
docker-compose exec app php artisan make:model User -mcr                  # model + migration + controller + resource

# Migration
docker-compose exec app php artisan make:migration create_users_table

# Seeder
docker-compose exec app php artisan make:seeder UserSeeder

# Request
docker-compose exec app php artisan make:request StoreUserRequest

# Middleware
docker-compose exec app php artisan make:middleware CheckAge

# Resource
docker-compose exec app php artisan make:resource UserResource
```

### Cache & Config

```bash
# Clear cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear

# Cache config (production)
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
```

### Lainnya

```bash
# Lihat routes
docker-compose exec app php artisan route:list

# Generate APP_KEY
docker-compose exec app php artisan key:generate

# Run queue worker
docker-compose exec app php artisan queue:work

# Run scheduler (development)
docker-compose exec app php artisan schedule:work

# Tinker (Laravel REPL)
docker-compose exec app php artisan tinker
```

## 📦 Composer Commands

```bash
# Install dependencies
docker-compose exec app composer install

# Update dependencies
docker-compose exec app composer update

# Install package baru
docker-compose exec app composer require package/name

# Remove package
docker-compose exec app composer remove package/name

# Autoload optimization
docker-compose exec app composer dump-autoload
```

## 📦 NPM Commands (Frontend)

```bash
# Install dependencies
docker-compose exec app npm install

# Development mode
docker-compose exec app npm run dev

# Build for production
docker-compose exec app npm run build

# Watch mode (auto compile)
docker-compose exec app npm run watch
```

## 🗄️ Database Commands

### Akses PostgreSQL

```bash
# Masuk ke container database
docker-compose exec db bash

# Akses psql
docker-compose exec db psql -U user_admin_cheil -d user_data_db

# Backup database
docker-compose exec db pg_dump -U user_admin_cheil user_data_db > backup.sql

# Restore database
docker-compose exec -T db psql -U user_admin_cheil user_data_db < backup.sql
```

### SQL Queries dari psql

```sql
-- Lihat semua tables
\dt

-- Describe table
\d table_name

-- List databases
\l

-- Quit psql
\q
```

## 🔧 Permission Commands (Jika Ada Error)

```bash
# Fix storage permissions
docker-compose exec app chmod -R 777 storage bootstrap/cache

# Fix ownership
docker-compose exec app chown -R www-data:www-data /var/www
```

## 🐚 Masuk ke Container

```bash
# Masuk ke app container (PHP/Laravel)
docker-compose exec app bash

# Masuk ke database container
docker-compose exec db bash

# Masuk ke nginx container
docker-compose exec nginx sh
```

## 🧹 Cleanup Commands

```bash
# Remove stopped containers
docker-compose rm

# Remove all unused images, containers, networks
docker system prune -a

# Remove volumes (HATI-HATI: data hilang!)
docker-compose down -v
```

## 🔍 Debugging Commands

```bash
# Lihat logs container tertentu
docker-compose logs app
docker-compose logs nginx
docker-compose logs db

# Follow logs (live)
docker-compose logs -f app

# Lihat logs Laravel
docker-compose exec app tail -f storage/logs/laravel.log

# Check container resources
docker stats
```

## 🧪 Testing Commands

```bash
# Run PHPUnit tests
docker-compose exec app php artisan test

# Run specific test
docker-compose exec app php artisan test --filter=UserTest

# Run with coverage
docker-compose exec app php artisan test --coverage
```

---

**Tips:** Simpan file ini dan buka kapanpun butuh referensi command! 🚀
