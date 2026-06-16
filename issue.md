# Fitur Login User

## Deskripsi
Menambahkan fitur autentikasi (login) untuk pengguna yang telah melakukan registrasi di aplikasi.

## Rencana Implementasi (High-Level)

1. **Backend & Routing**
   - Membuat controller untuk menangani proses login (contoh: `LoginController`).
   - Menyiapkan dua buah rute: satu untuk menampilkan form login (`GET /login`) dan satu lagi untuk memproses input autentikasi (`POST /login`).
   - Menggunakan mekanisme bawaan Laravel (`Auth::attempt`) untuk memverifikasi kecocokan `email` dan `password` pengguna dengan data di database.
   - Menangani alur pengalihan (redirect):
     - Jika **sukses** login: Alihkan pengguna ke halaman utama (welcome page).
     - Jika **gagal** login: Kembalikan pengguna ke halaman login beserta pesan error yang relevan (kredensial salah).

2. **Frontend (Tampilan)**
   - Membuat file view menggunakan Blade template untuk form login (misalnya `login.blade.php`).
   - Mempercantik halaman login dengan menggunakan styling CSS sederhana (inline atau internal stylesheet), agar konsisten dengan desain yang ada tanpa harus menginstal dependensi tambahan via `npm`.
   - Menampilkan blok pesan peringatan/error apabila upaya login pengguna tidak berhasil.
