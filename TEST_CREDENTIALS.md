# Test Database Credentials

This file lists all user accounts included in the `example_database.sql` dump for easy testing.

## Test Users

All users have the same password: **`password`**

### Super User Accounts (Full Access)

1. **Super Admin**

    - Email: `superadmin@cheil.com`
    - Password: `password`
    - Role: Super User
    - Permissions: Full access to all features, user management, role management

2. **Bob Admin**
    - Email: `bob.admin@cheil.com`
    - Password: `password`
    - Role: Super User
    - Permissions: Full access to all features, user management, role management

### User Viewer Accounts (Read-Only)

1. **John Viewer**

    - Email: `john.viewer@cheil.com`
    - Password: `password`
    - Role: User Viewer
    - Permissions: Limited access, read-only

2. **Jane Smith**

    - Email: `jane.smith@cheil.com`
    - Password: `password`
    - Role: User Viewer
    - Permissions: Limited access, read-only

3. **Alice Viewer**
    - Email: `alice.viewer@cheil.com`
    - Password: `password`
    - Role: User Viewer
    - Permissions: Limited access, read-only

## Roles

### 1. Super User

-   **Slug**: `super-user`
-   **Description**: Has full access to all features including user and role management
-   **Capabilities**:
    -   Create, read, update, delete users
    -   Assign roles to users
    -   Manage role definitions
    -   Access admin dashboard
    -   View all system data

### 2. User Viewer

-   **Slug**: `user-viewer`
-   **Description**: Has limited access with read-only permissions
-   **Capabilities**:
    -   View own profile
    -   Read-only access to permitted resources
    -   Cannot create or modify data
    -   Cannot access admin features

## Quick Login Commands

### Web Login

Navigate to: http://localhost:8000/login

### API Login (cURL)

#### Super Admin Login

```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "superadmin@cheil.com",
    "password": "password"
  }'
```

#### User Viewer Login

```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john.viewer@cheil.com",
    "password": "password"
  }'
```

## Testing Scenarios

### Test Super User Features

1. Login as `superadmin@cheil.com`
2. Navigate to User Management: http://localhost:8000/admin/users
3. Navigate to Role Management: http://localhost:8000/admin/roles
4. Try creating a new user
5. Try assigning roles

### Test User Viewer Restrictions

1. Login as `john.viewer@cheil.com`
2. Try accessing http://localhost:8000/admin/users (should be denied)
3. Verify dashboard access is limited
4. Verify profile can be viewed but admin features are hidden

### Test API Authentication

1. Get token by logging in via API
2. Use token to access protected endpoints
3. Test role-based API access control

## Security Notes

⚠️ **Important**:

-   These credentials are for **DEVELOPMENT AND TESTING ONLY**
-   Never use these credentials in production
-   All passwords are hashed using Laravel's bcrypt
-   The default password `password` should be changed in any non-development environment
-   Email verification is pre-completed for all test users

## Database Statistics

-   **Total Users**: 5
-   **Super Users**: 2
-   **User Viewers**: 3
-   **Total Roles**: 2

## Related Files

-   `example_database.sql` - The actual database dump
-   `DATABASE_DUMP_USAGE.md` - Instructions for using the dump
-   `CREDENTIALS.md` - Main credentials documentation
-   `API_QUICK_START.md` - API testing guide
-   `README.md` - Full project documentation
