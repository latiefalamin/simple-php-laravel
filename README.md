# Simple Laravel Project

Project manajemen pengguna sederhana (CRUD User + Authentication) yang dibangun dengan Laravel.

## 🛠 Tools yang Digunakan

- **PHP** (v8.2+)
- **Laravel** (v11)
- **MySQL** (v8.0)
- **Docker & Docker Compose**
- **Nginx** (Web Server)

## 🚀 Cara Menjalankan Project

1. **Copy file environment:**
   Pastikan Anda sudah memiliki file `.env`. Jika belum, salin dari `.env.example`:
   ```bash
   cp .env.example .env
   ```

2. **Jalankan Docker Compose:**
   Mulai semua container (App, Nginx, MySQL) di background:
   ```bash
   docker compose up -d
   ```

3. **Install Dependencies (Jika diperlukan):**
   ```bash
   docker compose exec app composer install
   ```

4. **Jalankan Migrasi Database:**
   Buat struktur tabel di database:
   ```bash
   docker compose exec app php artisan migrate
   ```

5. **Akses Aplikasi:**
   Buka browser dan kunjungi: **[http://localhost](http://localhost)**

## 🧪 Cara Menjalankan Unit Test

Aplikasi ini dilengkapi dengan *Feature Tests* untuk memastikan keamanan dan fungsionalitas seluruh endpoint (Autentikasi & Manajemen Pengguna). Untuk menjalankan seluruh test case, jalankan perintah berikut:

```bash
docker compose exec app php artisan test
```
*(Catatan: Pengujian menggunakan database In-Memory SQLite secara otomatis, sehingga tidak akan mengganggu data utama).*

## 🗄 Detail Database & Tabel

Konfigurasi database berjalan di dalam container MySQL:
- **Database:** `laravel`
- **Username:** `laravel`
- **Password:** `secret`
- **Port:** `3306`

**Tabel Utama: `users`**
Tabel ini digunakan untuk menyimpan data pengguna terdaftar beserta autentikasinya.
- **Kolom:**
  - `id` (Primary Key)
  - `name` (String, Nama Lengkap)
  - `email` (String, Unik)
  - `password` (String, Bcrypt hashed)
  - `address` (String, nullable, Alamat)
  - `remember_token` (String)
  - `created_at` (Timestamp)
  - `updated_at` (Timestamp)
