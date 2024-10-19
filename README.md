# Aplikasi Management Inventaris

Aplikasi **Management Inventaris** adalah sebuah sistem berbasis web yang dirancang untuk membantu pengelolaan barang-barang inventaris dengan lebih efisien. Aplikasi ini memiliki fitur lengkap untuk mengatur barang, kategori, ruangan, pemasok, laporan, serta pemeliharaan barang. Aplikasi ini dibangun menggunakan framework [Laravel 10](https://laravel.com/) dan [Laravel Filament](https://filamentphp.com/) sebagai panel administrasi yang mudah digunakan.

## Fitur Utama

1. **Manajemen Barang**
   - Menambahkan, memperbarui, menghapus, dan melihat informasi detail barang inventaris.
   - Pengelolaan stok barang dan informasi terkait seperti kode barang, harga, dan kondisi.

2. **Manajemen Kategori**
   - Mengelompokkan barang berdasarkan kategori tertentu untuk memudahkan pencarian dan pengelolaan.
   
3. **Manajemen Ruangan**
   - Mengelola informasi tentang ruangan tempat penyimpanan barang inventaris, seperti nama ruangan dan lokasi.

4. **Manajemen Pemasok**
   - Mengatur data pemasok barang, termasuk informasi kontak dan transaksi pemasokan.

5. **Laporan**
   - Menyediakan laporan barang masuk, barang keluar, stok saat ini, serta laporan pengeluaran barang dalam format yang mudah dipahami.

6. **Maintenance Barang**
   - Mencatat dan memonitor aktivitas pemeliharaan barang untuk menjaga kondisi barang inventaris tetap baik.

## Teknologi yang Digunakan

- **Laravel 10**: Framework PHP yang digunakan sebagai backend utama.
- **Laravel Filament**: Digunakan untuk membangun panel administrasi yang interaktif dan mudah dikelola.
- **MySQL**: Basis data yang digunakan untuk menyimpan semua informasi terkait inventaris.
- **Tailwind CSS**: Framework CSS yang digunakan untuk styling frontend agar tampilan lebih modern dan responsif.

## Instalasi

Berikut langkah-langkah untuk menjalankan aplikasi ini di lingkungan lokal:

1. Clone repository ini:
   ```bash
   git clone https://github.com/rafli5131/Aplikasi-Manajemen-Inventaris.git
   cd Aplikasi-Manajemen-Inventaris```

2. Copy file `.env.example` dan buat file `.env`:
   ```bash
   cp .env.example .env
   ```
3. Set up database di `.env`:
   ```
   DB_DATABASE=nama_database
   DB_USERNAME=username
   DB_PASSWORD=password
   ```
4. Jalankan perintah instalasi:
    ```bash
    composer install
    php artisan install```
