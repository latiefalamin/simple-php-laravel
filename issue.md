# Rencana Setup Proyek Laravel

Berikut adalah rencana high-level untuk men-setup proyek PHP dengan framework Laravel.

## Langkah-langkah

1.  **Inisialisasi Proyek Laravel:**
    *   Gunakan `composer create-project` untuk membuat proyek Laravel baru.

2.  **Halaman "Hello World":**
    *   Definisikan rute utama (`/`) di `routes/web.php`.
    *   Buat file view Blade sederhana (`welcome.blade.php`) yang menampilkan "Hello world".
    *   Tambahkan beberapa style CSS inline atau internal di dalam file Blade untuk styling dasar.

3.  **Dockerisasi:**
    *   Buat `Dockerfile` di root proyek.
    *   Dockerfile akan menggunakan base image PHP (misalnya, `php:8.2-fpm`).
    *   Konfigurasi akan menyalin file aplikasi, menginstal dependensi Composer, dan mengatur permission.
    *   (Opsional) Buat file `docker-compose.yml` untuk memudahkan menjalankan aplikasi dengan web server seperti Nginx.

## Kriteria Keberhasilan

*   Aplikasi Laravel dapat diakses melalui browser di `http://localhost`.
*   Halaman utama menampilkan tulisan "Hello world".
*   Aplikasi dapat dibangun dan dijalankan menggunakan Docker.
