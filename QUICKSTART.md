# 🚀 Quick Start Guide - Super Simpel!

Panduan super cepat untuk menjalankan project ini.

## ⚡ Setup Pertama Kali (5 Langkah)

### 1️⃣ Install Docker Desktop

Download dan install dari: https://www.docker.com/products/docker-desktop

### 2️⃣ Buat Laravel Project Baru

```bash
docker run --rm -v "%cd%":/app composer create-project laravel/laravel .
```

⏱️ _Tunggu 2-3 menit_

### 3️⃣ Setup Environment

```bash
copy .env.example .env
```

### 4️⃣ Build & Jalankan Docker

```bash
docker-compose up -d
```

⏱️ _Tunggu 3-5 menit (pertama kali saja)_

### 5️⃣ Setup Laravel

```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app chmod -R 777 storage bootstrap/cache
```

## ✅ Selesai!

Buka browser: **http://localhost:8000**

---

## 🔄 Untuk Menjalankan Project yang Sudah Ada

Jika project sudah pernah di-setup:

```bash
# Start containers
docker-compose up -d

# Buka http://localhost:8000
```

---

## 🛑 Stop Project

```bash
docker-compose stop
```

---

## 📌 Command Penting Sehari-hari

### Migration

```bash
docker-compose exec app php artisan migrate
```

### Buat Controller

```bash
docker-compose exec app php artisan make:controller NamaController
```

### Buat Model

```bash
docker-compose exec app php artisan make:model NamaModel -m
```

### Install Package Laravel

```bash
docker-compose exec app composer require nama-package
```

### Lihat Log Error

```bash
docker-compose logs -f app
```

---

## 🆘 Ada Masalah?

Baca `README.md` untuk troubleshooting lengkap!
