<!-- 666b0065-8025-41a3-aa3a-47689f3565e0 3ee82ced-f4d6-4452-8ff8-c315657a820f -->
# Plan: Laravel CMS dengan Authentication & Role Management

## Phase 1: Setup Laravel Project

**Setup base Laravel application dengan Docker**

- Verify Docker setup sudah berjalan dengan baik
- Install Laravel project fresh (jika belum ada folder Laravel)
- Configure environment untuk PostgreSQL
- Test koneksi database dan pastikan migrations berjalan

## Phase 2: Install & Configure Laravel Breeze

**Setup authentication scaffolding**

- Install Laravel Breeze via Composer: `laravel/breeze`
- Install Breeze dengan Blade stack
- Run npm install dan npm run build
- Test halaman register dan login default Breeze

## Phase 3: Database Schema - Roles & Relationships

**Create tables untuk role management**

- Create migration untuk `roles` table:
- Fields: `id`, `name`, `slug`, `description`, `timestamps`
- Seed 2 roles default: "Super User" dan "User Viewer"
- Modify `users` table migration:
- Add `role_id` foreign key ke roles table
- Create seeder untuk roles (SuperUser & UserViewer)
- Create seeder untuk default super user account

## Phase 4: Models & Relationships

**Setup Eloquent models**

- Create `Role` model dengan relationship ke User
- Update `User` model:
- Add `role()` belongsTo relationship
- Add helper methods: `isSuperUser()`, `isUserViewer()`
- Test relationships via tinker

## Phase 5: Middleware & Authorization

**Implement role-based access control**

- Create middleware `CheckSuperUser` untuk protect admin routes
- Create middleware `CheckRole` (generic role checker)
- Register middleware di `app/Http/Kernel.php`
- Update route groups dengan middleware yang sesuai

## Phase 6: User Management (Super User Only)

**Build user management interface**

- Create `Admin/UserController` dengan resource methods
- Create routes di `routes/web.php`:
- `/admin/users` (index, create, store, edit, update, destroy)
- Create views untuk user management:
- `admin/users/index.blade.php` (list all users)
- `admin/users/create.blade.php` (register new user by super user)
- `admin/users/edit.blade.php` (edit user)
- Create Form Request validation: `StoreUserRequest`, `UpdateUserRequest`
- Implement user CRUD functionality

## Phase 7: Role Management (Super User Only)

**Build role management interface**

- Create `Admin/RoleController` dengan resource methods
- Create routes: `/admin/roles` (index, create, store, edit, update)
- Create views untuk role management:
- `admin/roles/index.blade.php`
- `admin/roles/create.blade.php`
- `admin/roles/edit.blade.php`
- Implement role CRUD functionality

## Phase 8: Dashboard & Navigation

**Setup dashboard dan navigation menu**

- Create dashboard controller & view
- Update layout navigation:
- Show "User Management" & "Role Management" hanya untuk Super User
- Show user role badge di navbar
- Implement role-based menu visibility dengan `@can` atau custom blade directives

## Phase 9: Public Registration Enhancement

**Customize public registration**

- Update registration form jika perlu
- Set default role untuk public registration (User Viewer)
- Ensure public users tidak bisa set role sendiri
- Add validation dan security checks

## Phase 10: Testing & Refinement

**Test all features thoroughly**

- Test public registration flow
- Test login/logout
- Test super user dapat register users lain
- Test role-based access (middleware blocking)
- Test user & role CRUD operations
- Fix any bugs or permission issues
- Add error handling dan user-friendly messages

## Phase 11: Documentation & Final Touches

**Finalize project**

- Update README.md dengan:
- Credentials super user default
- Cara akses admin panel
- Role descriptions
- Create migration guide
- Add comments di code untuk maintainability

## Key Files to Create/Modify:

**Migrations:**

- `create_roles_table.php`
- Update `create_users_table.php` (add role_id)

**Models:**

- `app/Models/Role.php`
- Update `app/Models/User.php`

**Controllers:**

- `app/Http/Controllers/Admin/UserController.php`
- `app/Http/Controllers/Admin/RoleController.php`

**Middleware:**

- `app/Http/Middleware/CheckSuperUser.php`
- `app/Http/Middleware/CheckRole.php`

**Views:**

- `resources/views/admin/users/` (index, create, edit)
- `resources/views/admin/roles/` (index, create, edit)
- Update `resources/views/layouts/navigation.blade.php`

**Seeders:**

- `database/seeders/RoleSeeder.php`
- `database/seeders/SuperUserSeeder.php`

**Routes:**

- Update `routes/web.php` dengan admin routes

### To-dos

- [ ] Setup Laravel project dengan Docker dan verify database connection
- [ ] Install dan configure Laravel Breeze untuk authentication
- [ ] Create migrations untuk roles table dan modify users table dengan role_id
- [ ] Create seeders untuk roles dan default super user
- [ ] Create Role model dan update User model dengan relationships
- [ ] Create middleware untuk role-based access control
- [ ] Build user management interface (controller, routes, views) untuk super user
- [ ] Build role management interface (controller, routes, views) untuk super user
- [ ] Setup dashboard dan navigation menu dengan role-based visibility
- [ ] Customize public registration dengan default role assignment
- [ ] Test semua features dan fix bugs
- [ ] Update documentation dengan credentials dan user guide