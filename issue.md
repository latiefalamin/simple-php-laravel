# Fitur Registrasi User

## Deskripsi
Menambahkan fitur registrasi user ke dalam aplikasi beserta penyiapan database MySQL menggunakan Docker.

## Kebutuhan Data (Tabel Users)
Tabel user perlu memuat informasi berikut:
- **Nama lengkap** (String)
- **Email** (String, Unique)
- **Password** (String, disimpan menggunakan enkripsi `bcrypt`)

## Rencana Implementasi (High-Level)

1. **Konfigurasi Database (Docker)**
   - Menambahkan service `mysql` pada file `docker-compose.yml`.
   - Mengatur kredensial database (seperti nama database, user, password, root password).
   - Memastikan container aplikasi Laravel dapat terhubung dan mengakses container MySQL tersebut.

2. **Backend & Database (Laravel)**
   - Menyiapkan migration untuk tabel `users` (atau menyesuaikan migration bawaan Laravel) agar sesuai dengan kebutuhan data.
   - Membuat controller untuk mengelola alur registrasi (menampilkan form dan memproses input pengguna).
   - Menyimpan data ke database dengan memastikan password dienkripsi dengan `bcrypt` sebelum disimpan.
   - Memperbarui file konfigurasi koneksi database (`.env`).

3. **Frontend (Tampilan)**
   - Membuat halaman/view form registrasi menggunakan Blade template.
   - Menggunakan styling CSS sederhana (internal/inline) untuk mempercantik form tanpa perlu instalasi via `npm` atau build tools tambahan.
