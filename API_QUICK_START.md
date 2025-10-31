# Quick Start - Testing API dengan Postman

Panduan singkat untuk memulai testing API dengan Postman.

## Prerequisites

- Docker sudah running
- Postman sudah terinstall

## Steps

### 1. Start Docker & Seed Database

```bash
# Start containers
docker-compose up -d

# Migrate & seed database
docker-compose exec app php artisan migrate:fresh --seed
```

### 2. Import Postman Collection

1. Buka Postman
2. Klik **Import** 
3. Pilih file **`postman_collection.json`**
4. Collection "Laravel CMS API" akan muncul

### 3. Login

1. Buka folder **Auth** → **Login**
2. Klik **Send**
3. Token akan otomatis tersimpan

**Default credentials:**
- Email: `superadmin@example.com`
- Password: `password`

### 4. Test Endpoints

Sekarang semua endpoints bisa ditest. Token authentication sudah otomatis ter-set di collection level.

#### Contoh Endpoints yang bisa ditest:

- ✅ **GET** `/api/me` - Get current user
- ✅ **GET** `/api/users` - Get all users
- ✅ **POST** `/api/users` - Create user
- ✅ **GET** `/api/roles` - Get all roles
- ✅ **POST** `/api/roles` - Create role

### 5. Test Flow Lengkap

```
1. Login (Auth → Login)
2. Get Me (Auth → Get Current User)
3. Get All Users (Users → Get All Users)
4. Create Role (Roles → Create Role)
5. Create User (Users → Create User)
6. Update User (Users → Update User)
7. Delete User (Users → Delete User)
8. Logout (Auth → Logout)
```

## Base URL

```
http://localhost:8000/api
```

## Available Endpoints

### Authentication (Public)
- `POST /api/register` - Register user baru
- `POST /api/login` - Login & get token

### Authentication (Protected)
- `GET /api/me` - Get current user info
- `POST /api/logout` - Logout (revoke token)

### Users (Protected)
- `GET /api/users` - List users dengan pagination & search
- `POST /api/users` - Create user
- `GET /api/users/{id}` - Get single user
- `PUT /api/users/{id}` - Update user
- `DELETE /api/users/{id}` - Delete user

### Roles (Protected)
- `GET /api/roles` - List all roles dengan search
- `POST /api/roles` - Create role
- `GET /api/roles/{id}` - Get single role
- `PUT /api/roles/{id}` - Update role
- `DELETE /api/roles/{id}` - Delete role

## Tips

### Token Auto-save
Token akan otomatis tersimpan setelah login berkat script di tab **Tests** pada request Login.

### Manual Set Token
Jika perlu manual set token:
1. Buka collection "Laravel CMS API"
2. Tab **Variables**
3. Set `auth_token` dengan token dari login response

### Search & Pagination
```
GET /api/users?per_page=10&search=john
GET /api/roles?search=super
```

### Testing dengan Multiple Users

Untuk test dengan user berbeda:
1. **Logout** dari current session
2. **Login** dengan credentials user lain
3. Token akan terupdate otomatis

## Expected Responses

### Success Response

```json
{
    "message": "User created successfully",
    "user": { ... }
}
```

### Error Response

```json
{
    "message": "The email has already been taken.",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

## Troubleshooting

**Error: "Unauthenticated"**
- Login dulu untuk mendapatkan token
- Token akan otomatis digunakan untuk semua protected endpoints

**Error: "Validation failed"**
- Check required fields di request body
- Check format data (email, password min 8 chars, dll)

**Error: "Cannot connect"**
- Pastikan Docker containers running: `docker-compose ps`
- Pastikan aplikasi accessible di `http://localhost:8000`

## Full Documentation

Untuk dokumentasi lengkap dengan detail semua endpoints, lihat **`API_DOCUMENTATION.md`**

---

Happy Testing! 🚀

