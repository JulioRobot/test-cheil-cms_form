# 🗄️ Example Database - Quick Reference

## What is `example_database.sql`?

This is a **PostgreSQL database dump** containing a fully populated test database for the Laravel CMS. It includes:

- ✅ All database tables and schema
- ✅ 2 predefined roles (Super User, User Viewer)
- ✅ 5 test user accounts (2 admins, 3 viewers)
- ✅ All necessary migrations applied
- ✅ Ready for immediate testing

## 📦 File Size
- **36.69 KB** - Compact and easy to share

## 🚀 Quick Start (60 seconds)

### 1. Restore the Database
```bash
docker exec -i laravel_postgres psql -U user_admin_cheil -d user_data_db < example_database.sql
```

### 2. Clear Laravel Cache
```bash
docker exec laravel_app php artisan cache:clear
```

### 3. Login & Test
Navigate to http://localhost:8000/login and use any of these accounts:

**Super Admin**:
- Email: `superadmin@cheil.com`
- Password: `password`

**Regular User**:
- Email: `john.viewer@cheil.com`
- Password: `password`

That's it! You now have a fully working system with test data.

## 📊 What's Inside?

### 5 Test Users

| Name         | Email                      | Role        | Access Level |
|--------------|----------------------------|-------------|--------------|
| Super Admin  | superadmin@cheil.com       | Super User  | Full Admin   |
| Bob Admin    | bob.admin@cheil.com        | Super User  | Full Admin   |
| John Viewer  | john.viewer@cheil.com      | User Viewer | Read-Only    |
| Jane Smith   | jane.smith@cheil.com       | User Viewer | Read-Only    |
| Alice Viewer | alice.viewer@cheil.com     | User Viewer | Read-Only    |

All passwords: **`password`**

### 2 Roles

1. **Super User** - Full administrative access
2. **User Viewer** - Read-only access

### Database Tables

- `users` - User accounts
- `roles` - User roles
- `migrations` - Migration history
- `sessions` - Active sessions
- `password_reset_tokens` - Password reset functionality
- `cache`, `cache_locks` - Application cache
- `jobs`, `job_batches`, `failed_jobs` - Queue system
- `personal_access_tokens` - API authentication

## 🔄 Common Operations

### Fresh Start
```bash
# Option 1: Restore from dump (fastest)
docker exec -i laravel_postgres psql -U user_admin_cheil -d user_data_db < example_database.sql

# Option 2: Run migrations & seeders (from scratch)
docker exec laravel_app php artisan migrate:fresh --seed
docker exec laravel_app php artisan db:seed --class=TestUsersSeeder
```

### Backup Current Database
```bash
# Create a new dump
docker exec laravel_postgres pg_dump -U user_admin_cheil -d user_data_db \
  --clean --if-exists --inserts > my_backup.sql
```

### Check Database Contents
```bash
# View all users
docker exec laravel_postgres psql -U user_admin_cheil -d user_data_db \
  -c "SELECT u.name, u.email, r.name as role FROM users u JOIN roles r ON u.role_id = r.id;"

# View all roles
docker exec laravel_postgres psql -U user_admin_cheil -d user_data_db \
  -c "SELECT * FROM roles;"
```

## 🧪 Testing Scenarios

### Test 1: Admin Access
1. Login as `superadmin@cheil.com`
2. Go to http://localhost:8000/admin/users
3. ✅ Should see all 5 users
4. ✅ Should be able to create/edit/delete users

### Test 2: User Viewer Restrictions
1. Login as `john.viewer@cheil.com`
2. Try to access http://localhost:8000/admin/users
3. ✅ Should be redirected/denied access
4. ✅ Dashboard should show limited options

### Test 3: API Authentication
```bash
# Get auth token
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"superadmin@cheil.com","password":"password"}'

# Use token for authenticated requests
curl http://localhost:8000/api/users \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## 📖 Related Documentation

- **[DATABASE_DUMP_USAGE.md](DATABASE_DUMP_USAGE.md)** - Detailed usage instructions
- **[TEST_CREDENTIALS.md](TEST_CREDENTIALS.md)** - All test account credentials
- **[CREDENTIALS.md](CREDENTIALS.md)** - Quick credentials reference
- **[README.md](README.md)** - Full project documentation

## 🔧 Troubleshooting

### Issue: "No such file or directory"
**Solution**: Make sure you're in the project root directory
```bash
pwd  # Should show: E:\_KERJA\test-cheil-cms_php
```

### Issue: "Connection refused"
**Solution**: Ensure Docker containers are running
```bash
docker ps  # Should show laravel_postgres and laravel_app
docker-compose up -d  # Start if not running
```

### Issue: "Permission denied"
**Solution**: Check database credentials in `.env` match docker-compose.yml
```bash
DB_USERNAME=user_admin_cheil
DB_PASSWORD=password_admin_cheil
DB_DATABASE=user_data_db
```

## ⚠️ Important Notes

- **Development Only**: This dump is for testing and development
- **Security**: Never use these credentials in production
- **Password**: All test accounts use the password `password`
- **Email Verified**: All accounts are pre-verified (no email verification needed)
- **Clean Install**: The dump includes `--clean` flag, so it will drop existing tables

## 💡 Pro Tips

1. **Quick Reset**: Keep this dump file to quickly reset your database during development
2. **Testing**: Use different test accounts to verify role-based access control
3. **API Development**: All accounts work with API authentication out of the box
4. **Customization**: You can add more test users by running additional seeders before creating a new dump

## 🎯 Next Steps

After restoring the database:

1. ✅ Test login with different user roles
2. ✅ Explore admin features (user/role management)
3. ✅ Test API endpoints with different authentication tokens
4. ✅ Create additional test data as needed
5. ✅ Build new features on top of this foundation

---

**Created**: October 31, 2025  
**Database**: PostgreSQL 15  
**Laravel**: 12.x  
**Users**: 5 test accounts  
**Roles**: 2 predefined roles

