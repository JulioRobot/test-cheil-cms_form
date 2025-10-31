# API Documentation - Laravel CMS

Dokumentasi API untuk testing dengan Postman.

## Base URL

```
http://localhost:8000/api
```

## Setup Postman

### 1. Import Collection

1. Buka Postman
2. Klik **Import** 
3. Pilih file `postman_collection.json`
4. Collection akan muncul dengan nama **"Laravel CMS API"**

### 2. Setup Environment (Opsional)

Collection sudah include variables:
- `base_url`: `http://localhost:8000`
- `auth_token`: (akan ter-set otomatis setelah login)

## Authentication

API menggunakan Laravel Sanctum untuk authentication dengan Bearer Token.

### Workflow Authentication:

1. **Login** atau **Register** untuk mendapatkan token
2. Token akan otomatis tersimpan di variable `auth_token` (jika menggunakan collection)
3. Semua request yang memerlukan authentication akan otomatis menggunakan token ini

## API Endpoints

### 🔓 Public Endpoints (Tidak perlu authentication)

#### 1. Register User

```http
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role_id": 2
}
```

**Response:**
```json
{
    "message": "User registered successfully",
    "user": {
        "id": 2,
        "name": "John Doe",
        "email": "john@example.com",
        "email_verified_at": null,
        "role": {
            "id": 2,
            "name": "User Viewer",
            "slug": "user-viewer",
            "description": "Can view users but cannot modify"
        },
        "created_at": "2025-10-31T12:00:00.000000Z",
        "updated_at": "2025-10-31T12:00:00.000000Z"
    },
    "token": "1|eyJ0eXAiOiJKV1QiLCJhbGc..."
}
```

#### 2. Login

```http
POST /api/login
Content-Type: application/json

{
    "email": "superadmin@example.com",
    "password": "password"
}
```

**Response:**
```json
{
    "message": "Login successful",
    "user": {
        "id": 1,
        "name": "Super Admin",
        "email": "superadmin@example.com",
        "email_verified_at": "2025-10-31T12:00:00.000000Z",
        "role": {
            "id": 1,
            "name": "Super User",
            "slug": "super-user",
            "description": "Has full access to the system"
        },
        "created_at": "2025-10-31T12:00:00.000000Z",
        "updated_at": "2025-10-31T12:00:00.000000Z"
    },
    "token": "2|eyJ0eXAiOiJKV1QiLCJhbGc..."
}
```

**Default Login Credentials:**
- Email: `superadmin@example.com`
- Password: `password`

---

### 🔒 Protected Endpoints (Perlu authentication)

**Header yang diperlukan:**
```
Authorization: Bearer {token}
Accept: application/json
```

#### 3. Get Current User

```http
GET /api/me
Authorization: Bearer {token}
```

**Response:**
```json
{
    "user": {
        "id": 1,
        "name": "Super Admin",
        "email": "superadmin@example.com",
        "email_verified_at": "2025-10-31T12:00:00.000000Z",
        "role": {
            "id": 1,
            "name": "Super User",
            "slug": "super-user",
            "description": "Has full access to the system"
        },
        "created_at": "2025-10-31T12:00:00.000000Z",
        "updated_at": "2025-10-31T12:00:00.000000Z"
    }
}
```

#### 4. Logout

```http
POST /api/logout
Authorization: Bearer {token}
```

**Response:**
```json
{
    "message": "Logged out successfully"
}
```

---

### 👥 User Management

#### 5. Get All Users

```http
GET /api/users?per_page=15&search=john
Authorization: Bearer {token}
```

**Query Parameters:**
- `per_page` (optional): Jumlah data per halaman (default: 15)
- `search` (optional): Pencarian berdasarkan name atau email

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Super Admin",
            "email": "superadmin@example.com",
            "email_verified_at": "2025-10-31T12:00:00.000000Z",
            "role": {
                "id": 1,
                "name": "Super User",
                "slug": "super-user",
                "description": "Has full access to the system"
            },
            "created_at": "2025-10-31T12:00:00.000000Z",
            "updated_at": "2025-10-31T12:00:00.000000Z"
        }
    ],
    "links": {...},
    "meta": {...}
}
```

#### 6. Get Single User

```http
GET /api/users/{id}
Authorization: Bearer {token}
```

#### 7. Create User

```http
POST /api/users
Authorization: Bearer {token}
Content-Type: application/json

{
    "name": "Jane Smith",
    "email": "jane@example.com",
    "password": "password123",
    "role_id": 2
}
```

**Response:**
```json
{
    "message": "User created successfully",
    "user": {
        "id": 3,
        "name": "Jane Smith",
        "email": "jane@example.com",
        "email_verified_at": null,
        "role": {...},
        "created_at": "2025-10-31T12:00:00.000000Z",
        "updated_at": "2025-10-31T12:00:00.000000Z"
    }
}
```

#### 8. Update User

```http
PUT /api/users/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
    "name": "Jane Smith Updated",
    "email": "jane.updated@example.com",
    "password": "newpassword123",
    "role_id": 1
}
```

**Note:** Field `password` adalah optional. Jika tidak dikirim, password tidak akan diupdate.

#### 9. Delete User

```http
DELETE /api/users/{id}
Authorization: Bearer {token}
```

**Response:**
```json
{
    "message": "User deleted successfully"
}
```

**Note:** Tidak bisa delete user sendiri.

---

### 🎭 Role Management

#### 10. Get All Roles

```http
GET /api/roles?search=super
Authorization: Bearer {token}
```

**Query Parameters:**
- `search` (optional): Pencarian berdasarkan name atau description

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Super User",
            "slug": "super-user",
            "description": "Has full access to the system",
            "created_at": "2025-10-31T12:00:00.000000Z",
            "updated_at": "2025-10-31T12:00:00.000000Z"
        },
        {
            "id": 2,
            "name": "User Viewer",
            "slug": "user-viewer",
            "description": "Can view users but cannot modify",
            "created_at": "2025-10-31T12:00:00.000000Z",
            "updated_at": "2025-10-31T12:00:00.000000Z"
        }
    ]
}
```

#### 11. Get Single Role

```http
GET /api/roles/{id}
Authorization: Bearer {token}
```

#### 12. Create Role

```http
POST /api/roles
Authorization: Bearer {token}
Content-Type: application/json

{
    "name": "Content Manager",
    "description": "Can manage content and posts"
}
```

**Response:**
```json
{
    "message": "Role created successfully",
    "role": {
        "id": 3,
        "name": "Content Manager",
        "slug": "content-manager",
        "description": "Can manage content and posts",
        "created_at": "2025-10-31T12:00:00.000000Z",
        "updated_at": "2025-10-31T12:00:00.000000Z"
    }
}
```

#### 13. Update Role

```http
PUT /api/roles/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
    "name": "Content Manager Updated",
    "description": "Can manage all content including posts and pages"
}
```

#### 14. Delete Role

```http
DELETE /api/roles/{id}
Authorization: Bearer {token}
```

**Response:**
```json
{
    "message": "Role deleted successfully"
}
```

**Note:** Tidak bisa delete role yang masih memiliki users.

---

## Error Responses

### Validation Error (422)

```json
{
    "message": "The email has already been taken. (and 1 more error)",
    "errors": {
        "email": [
            "The email has already been taken."
        ],
        "password": [
            "The password field is required."
        ]
    }
}
```

### Unauthenticated (401)

```json
{
    "message": "Unauthenticated."
}
```

### Forbidden (403)

```json
{
    "message": "You cannot delete your own account"
}
```

### Not Found (404)

```json
{
    "message": "No query results for model [App\\Models\\User] 999"
}
```

---

## Testing Flow

### 1. Login sebagai Super Admin

```bash
POST /api/login
{
    "email": "superadmin@example.com",
    "password": "password"
}
```

Copy token dari response dan set di Postman Authorization.

### 2. Get Current User Info

```bash
GET /api/me
```

### 3. Get All Users

```bash
GET /api/users
```

### 4. Create New Role

```bash
POST /api/roles
{
    "name": "Editor",
    "description": "Can edit content"
}
```

### 5. Create New User dengan Role Baru

```bash
POST /api/users
{
    "name": "Editor User",
    "email": "editor@example.com",
    "password": "password123",
    "role_id": 3
}
```

### 6. Update User

```bash
PUT /api/users/3
{
    "name": "Editor User Updated",
    "email": "editor@example.com",
    "role_id": 3
}
```

### 7. Delete User

```bash
DELETE /api/users/3
```

### 8. Logout

```bash
POST /api/logout
```

---

## Tips Postman

### Auto-save Token setelah Login

Postman collection sudah include script untuk auto-save token setelah login. Script ini ada di tab **Tests** pada request Login:

```javascript
var jsonData = pm.response.json();
pm.environment.set("auth_token", jsonData.token);
```

### Manual Set Token

Jika perlu manual set token:

1. Buka collection **"Laravel CMS API"**
2. Klik tab **Variables**
3. Set value untuk `auth_token` dengan token dari login response

### Testing dengan Different Users

Untuk testing dengan user berbeda:
1. Logout dulu
2. Login dengan credentials user lain
3. Token akan otomatis terupdate

---

## Troubleshooting

### Error: "Unauthenticated"

- Pastikan sudah login dan token tersimpan
- Cek Authorization header sudah ter-set
- Cek token masih valid (belum di-revoke via logout)

### Error: "The given data was invalid"

- Cek format JSON request body
- Cek required fields sudah lengkap
- Cek validation rules (email format, password min 8 characters, dll)

### Error: "CORS"

- Pastikan Laravel sudah setup CORS dengan benar
- Check `config/cors.php` settings

---

## Development

Untuk development, pastikan:

1. Docker containers sudah running:
   ```bash
   docker-compose up -d
   ```

2. Database sudah di-migrate dan di-seed:
   ```bash
   docker-compose exec app php artisan migrate:fresh --seed
   ```

3. Server accessible di `http://localhost:8000`

---

## Roles Available

1. **Super User** (ID: 1)
   - Full access ke semua endpoints
   - Dapat manage users dan roles

2. **User Viewer** (ID: 2)
   - Read-only access
   - Dapat view users dan roles

---

Untuk pertanyaan atau issues, silakan check repository atau contact developer.

