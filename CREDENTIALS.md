# 🔐 Quick Credentials Reference

## Application Access

### Web Application
**URL**: http://localhost:8000

### Super User Account (Full Admin Access)
```
Email: superadmin@cheil.com
Password: password
```

**Capabilities**:
- Full access to all features
- User management (create, edit, delete users)
- Role management (create, edit, delete roles)
- Dashboard with admin panel

> 📋 **More Test Users Available**: See `TEST_CREDENTIALS.md` for a complete list of test accounts (5 users with different roles) included in the example database dump.

## Database Access

### Adminer (Web-based Database Manager)
**URL**: http://localhost:8080

**Connection Details**:
```
System: PostgreSQL
Server: db
Database: user_data_db
Username: user_admin_cheil
Password: password_admin_cheil
```

### PostgreSQL Direct Access
```bash
# Via Docker
docker-compose exec db psql -U user_admin_cheil -d user_data_db

# Via Host (if port 5433 is exposed)
psql -h localhost -p 5433 -U user_admin_cheil -d user_data_db
```

### Database Dump for Testing
A pre-populated database dump is available:
- **File**: `example_database.sql` (includes 5 test users and 2 roles)
- **Usage**: See `DATABASE_DUMP_USAGE.md` for restore instructions
- **Quick Restore**:
  ```bash
  docker exec -i laravel_postgres psql -U user_admin_cheil -d user_data_db < example_database.sql
  ```

## Default Roles

1. **Super User** (ID: 1, Slug: `super-user`)
   - Full administrative access
   - Can manage users and roles

2. **User Viewer** (ID: 2, Slug: `user-viewer`)
   - Read-only access
   - Default role for public registration

## Quick Start

1. **Start the application**:
   ```bash
   docker-compose up -d
   ```

2. **Access the web app**: http://localhost:8000

3. **Login as Super User**:
   - Email: `superadmin@cheil.com`
   - Password: `password`

4. **Start managing users and roles**!

## Testing User Registration

To test the public registration flow:

1. Visit http://localhost:8000/register
2. Create a new account with any email/password
3. The new user will automatically be assigned the "User Viewer" role
4. Login with the new credentials
5. Notice limited access compared to Super User

## Important Notes

⚠️ **Security Warning**: The default credentials are meant for development only. In production, you should:
- Change all default passwords
- Use strong, unique passwords
- Enable environment-specific security measures
- Configure proper email verification
- Set up SSL/TLS certificates

🔒 **Password Policy**: 
- Minimum 8 characters
- Can include letters, numbers, and special characters
- Password confirmation required on registration

📧 **Email Requirements**:
- Must be a valid email format
- Must be unique (no duplicate emails allowed)

---

**Last Updated**: October 31, 2025  
**Laravel Version**: 12.x  
**PHP Version**: 8.2  
**PostgreSQL Version**: 15

