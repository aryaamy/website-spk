# 🎓 SPK Rekomendasi Konsentrasi Studi (Metode SAW)

Sistem Pendukung Keputusan (SPK) berbasis web untuk merekomendasikan konsentrasi program studi mahasiswa. Dibangun menggunakan framework **Laravel** dan mengimplementasikan algoritma **Simple Additive Weighting (SAW)**.

Sistem ini memiliki dua antarmuka utama:
1. **Portal Mahasiswa:** Halaman publik yang *clean* untuk mahasiswa mengecek hasil rekomendasi dan mengunduh rapor PDF hanya dengan menggunakan NIM (Tanpa perlu login).
2. **Dashboard Admin:** Panel kontrol khusus Staf/Admin Prodi untuk mengelola master data dan menginput transkrip nilai akademik.

---

## ✨ Fitur Utama

- **Otomatisasi Hitung IPK:** Sistem otomatis menghitung IPK asli mahasiswa berdasarkan nilai mutlak (A, B, C) dan bobot SKS mata kuliah.
- **Algoritma SAW:** Implementasi *ranking* keputusan menggunakan metode *Simple Additive Weighting* (Normalisasi Matriks & Pembobotan Kriteria).
- **Multi-Interface:** Pemisahan *layout* antara portal publik mahasiswa dan *dashboard* admin.
- **Export Rapor PDF:** Cetak hasil analisis keputusan dan detail transkrip nilai langsung ke format PDF.
- **Reset Transkrip:** Fitur *quick-reset* untuk menghapus transkrip nilai jika terjadi kesalahan input oleh admin.

---

## 🛠️ Teknologi yang Digunakan

- **Framework:** Laravel 
- **Database:** MySQL
- **Template UI Admin:** [Stisla](https://themewagon.com/themes/free-bootstrap-4-html-5-admin-dashboard-template-stisla/) (Bootstrap 4)
- **Library PDF:** `barryvdh/laravel-dompdf`

---

## 🚀 Cara Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di *localhost*:

1. **Clone Repository / Extract Folder**
   Pastikan folder project sudah berada di dalam direktori server lokal (misal: `htdocs` untuk XAMPP).

2. **Install Dependencies**
   Buka terminal di dalam folder project dan jalankan:
   ```bash
   composer install

3. **Konfigurasi Environment**

    Copy file `.env.example` menjadi `.env.`
    Buka file `.env` dan sesuaikan nama database:
    ```bash
    DB_DATABASE=nama_database_kamu

4. **Generate Application Key**
   ```bash
    php artisan key:generate

5.  **Migrasi & Seeding Database**
    Jalankan perintah ini untuk membuat tabel dan akun admin default:
    ```bash
    php artisan migrate:fresh --seed

6. **Jalankan Aplikasi**
   ```bash
   php artisan serve

   Aplikasi dapat diakses melalui browser di: `http://localhost:8000`

🔐 Akses Login Default
Gunakan kredensial berikut untuk masuk ke Dashboard Admin (Bisa diakses melalui tombol Login di portal mahasiswa atau via URL /login):

    ```bash
    Email: admin@kampus.ac.id
    Password: password123

Dibuat untuk memenuhi project Sistem Pendukung Keputusan.