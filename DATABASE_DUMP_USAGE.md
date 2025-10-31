# Example Database Dump Usage Guide

This file provides instructions on how to use the `example_database.sql` dump file for testing and development purposes.

## Database Contents

The `example_database.sql` file contains a complete PostgreSQL dump with the following data:

### Tables Included:

-   `migrations` - Database migration history
-   `users` - User accounts
-   `roles` - User roles (Super User, User Viewer)
-   `password_reset_tokens` - Password reset functionality
-   `sessions` - User sessions
-   `cache` and `cache_locks` - Application cache
-   `jobs`, `job_batches`, `failed_jobs` - Queue management
-   `personal_access_tokens` - API authentication tokens (Laravel Sanctum)

### Pre-seeded Data:

#### Roles:

1. **Super User** (`super-user`)

    - Full access to all features
    - Can manage users and roles

2. **User Viewer** (`user-viewer`)
    - Limited access with read-only permissions

#### Default Users:

1. **Super Admin**
    - Email: `superadmin@cheil.com`
    - Password: `password`
    - Role: Super User

## How to Restore the Database

### Method 1: Using Docker (Recommended)

#### Option A: From Host Machine

```bash
# Restore the database
docker exec -i laravel_postgres psql -U user_admin_cheil -d user_data_db < example_database.sql
```

#### Option B: Copy to Container First

```bash
# Copy dump file into the container
docker cp example_database.sql laravel_postgres:/tmp/example_database.sql

# Execute the restore
docker exec laravel_postgres psql -U user_admin_cheil -d user_data_db -f /tmp/example_database.sql

# Clean up
docker exec laravel_postgres rm /tmp/example_database.sql
```

### Method 2: Using Laravel Artisan

If you prefer to use migrations and seeders instead:

```bash
# Reset and seed the database
docker exec laravel_app php artisan migrate:fresh --seed

# Or if running locally
php artisan migrate:fresh --seed
```

### Method 3: Direct PostgreSQL Connection

If you have `psql` installed locally:

```bash
# Connect to the database and restore
psql -h localhost -p 5433 -U user_admin_cheil -d user_data_db < example_database.sql
```

## Creating a New Database Dump

To create a fresh dump with updated data:

```bash
# Create a new dump
docker exec laravel_postgres pg_dump -U user_admin_cheil -d user_data_db --clean --if-exists --inserts > example_database.sql

# Or with additional options for better readability
docker exec laravel_postgres pg_dump -U user_admin_cheil -d user_data_db \
  --clean \
  --if-exists \
  --inserts \
  --no-owner \
  --no-acl > example_database.sql
```

## Database Credentials

From `docker-compose.yml` and `.env`:

-   **Host**: `db` (from container) / `localhost` (from host)
-   **Port**: `5432` (from container) / `5433` (from host)
-   **Database**: `user_data_db`
-   **Username**: `user_admin_cheil`
-   **Password**: `password_admin_cheil`

## Testing the Restore

After restoring, verify the data:

```bash
# Check if tables exist
docker exec -it laravel_postgres psql -U user_admin_cheil -d user_data_db -c "\dt"

# Check roles
docker exec -it laravel_postgres psql -U user_admin_cheil -d user_data_db -c "SELECT * FROM roles;"

# Check users
docker exec -it laravel_postgres psql -U user_admin_cheil -d user_data_db -c "SELECT id, name, email FROM users;"

# Or use Laravel Artisan
docker exec laravel_app php artisan tinker --execute="User::with('role')->get()"
```

## Common Use Cases

### 1. Reset Database to Initial State

```bash
# Drop all tables and restore from dump
docker exec -i laravel_postgres psql -U user_admin_cheil -d user_data_db < example_database.sql
```

### 2. Clone Database for Testing

```bash
# Create a test database
docker exec laravel_postgres psql -U user_admin_cheil -c "CREATE DATABASE user_data_db_test;"

# Restore dump to test database
docker exec -i laravel_postgres psql -U user_admin_cheil -d user_data_db_test < example_database.sql
```

### 3. Export Data Only (No Schema)

```bash
# Create data-only dump
docker exec laravel_postgres pg_dump -U user_admin_cheil -d user_data_db --data-only --inserts > example_data_only.sql
```

### 4. Export Specific Tables

```bash
# Export only users and roles tables
docker exec laravel_postgres pg_dump -U user_admin_cheil -d user_data_db \
  --table=users --table=roles \
  --clean --if-exists --inserts > users_roles_dump.sql
```

## Troubleshooting

### Error: "database does not exist"

```bash
# Create the database first
docker exec laravel_postgres psql -U user_admin_cheil -c "CREATE DATABASE user_data_db;"
```

### Error: "permission denied"

Make sure you're using the correct username and the Docker container is running:

```bash
# Check container status
docker ps | grep postgres

# Restart container if needed
docker restart laravel_postgres
```

### Clear Laravel Cache After Restore

```bash
docker exec laravel_app php artisan cache:clear
docker exec laravel_app php artisan config:clear
docker exec laravel_app php artisan view:clear
```

## API Testing

With the restored database, you can test the API immediately:

```bash
# Login and get token
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"superadmin@cheil.com","password":"password"}'
```

See `API_QUICK_START.md` for more API testing examples.

## Notes

-   The dump file includes `--clean` and `--if-exists` flags, so it will drop existing tables before creating them
-   All data is exported using `INSERT` statements for better readability and portability
-   The dump is specific to PostgreSQL 15 (as per docker-compose.yml)
-   Passwords are already hashed with bcrypt
-   The default password for all seeded users is: `password`

## Security Notice

⚠️ **Important**: This database dump is for development and testing purposes only.

-   Never use these credentials in production
-   Always change default passwords in production environments
-   Keep this file out of version control if it contains sensitive data

## Related Documentation

-   `QUICKSTART.md` - Getting started guide
-   `API_QUICK_START.md` - API testing guide
-   `CREDENTIALS.md` - Login credentials reference
-   `README.md` - Full project documentation
