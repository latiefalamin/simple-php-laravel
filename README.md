# Simple Laravel Project

Project manajemen pengguna sederhana (CRUD User + Authentication) yang dibangun dengan Laravel.

## 🛠 Tools yang Digunakan

- **PHP** (v8.2+)
- **Laravel** (v11)
- **MySQL** (v8.0)
- **Docker & Docker Compose**
- **Nginx** (Web Server)

## 🚀 Cara Menjalankan Project

### Opsi A: Menggunakan Docker (Rekomendasi)

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

### Opsi B: Tanpa Docker (Lokal)

Pastikan Anda sudah menginstall **PHP 8.2+** dan **Composer** di sistem komputer Anda.

1. **Install Dependencies:**
   ```bash
   composer install
   ```

2. **Copy file environment & Generate Key:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Konfigurasi Database:**
   Buka file `.env` dan sesuaikan pengaturan database Anda. Jika menggunakan SQLite (paling praktis di lokal):
   ```env
   DB_CONNECTION=sqlite
   # Hapus atau beri komentar baris konfigurasi DB_HOST, DB_PORT, dll
   ```

4. **Jalankan Migrasi Database:**
   ```bash
   php artisan migrate
   ```

5. **Jalankan Development Server:**
   ```bash
   php artisan serve
   ```
   Buka browser dan kunjungi: **[http://localhost:8000](http://localhost:8000)**


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
  - `id` (Primary Key)
  - `name` (String, Nama Lengkap)
  - `email` (String, Unik)
  - `password` (String, Bcrypt hashed)
  - `address` (String, nullable, Alamat)
  - `remember_token` (String)
  - `created_at` (Timestamp)
  - `updated_at` (Timestamp)

## ☁️ Deploy ke Hostinger Shared Hosting

### Persiapan Lokal

1. **Build untuk production:**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install && npm run build
   ```

2. **Buat ZIP untuk upload** (kecualikan `.git`, `node_modules`, `.env`, `docker-compose.yml`, `Dockerfile`):
   ```bash
   zip -r ../deploy.zip . \
     --exclude "*.git*" --exclude "*/node_modules/*" \
     --exclude ".env" --exclude "docker-compose.yml" \
     --exclude "Dockerfile" --exclude "nginx/*"
   ```

### Setup di Hostinger

1. **Upload ZIP** via File Manager hPanel ke folder `~/laravel/`, lalu Extract.

2. **Upload ke `public_html/`** dua file berikut dari `_hostinger_files/public_html/`:
   - `index.php` — mengarahkan request ke folder Laravel
   - `.htaccess` — mengatur Apache routing

3. **Set PHP ke versi 8.4** via hPanel → Tingkat Lanjut → Konfigurasi PHP.

4. **Buat database MySQL** via hPanel → Database → MySQL Databases:
   - Buat database baru (misal: `vibecoding`) → Hostinger prefix otomatis
   - Buat user MySQL dengan password
   - Assign user ke database dengan **All Privileges**

5. **Buat file `.env`** di folder `~/laravel/` berdasarkan `.env.example`:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://domain-anda.com

   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=u[id]_vibecoding
   DB_USERNAME=u[id]_vibecoding
   DB_PASSWORD=password_anda
   ```

6. **Jalankan Artisan Commands** — pilih salah satu opsi:

   **Opsi A: Jika Terminal tersedia** (hPanel → Tingkat Lanjut → Terminal):
   ```bash
   cd ~/laravel
   php artisan key:generate
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   chmod -R 775 storage bootstrap/cache
   ```

   **Opsi B: Jika Terminal TIDAK tersedia** (via browser):
   - Upload `_hostinger_files/setup.php` ke `public_html/`
   - Buka di browser: `https://domain-anda.com/setup.php?secret=vibecoding_setup_2024`
   - Script akan otomatis menjalankan semua perintah di atas
   - **⚠️ Hapus `setup.php` segera setelah selesai!**


