# Panduan Upgrade Aplikasi di Server

Berikut adalah langkah-langkah untuk melakukan update/upgrade aplikasi di server produksi.

## Opsi 1: Menggunakan Script Otomatis (Direkomendasikan)

Kami telah menyediakan script `deploy.sh` untuk mempermudah proses ini. Script ini akan otomatis menarik kode terbaru dari git, menginstall dependency, dan menjalankan migrasi database.

### Langkah-langkah:

1.  **Masuk ke server** melalui SSH atau terminal.
2.  **Masuk ke direktori project**:
    ```bash
    cd /path/ke/folder/project/Aplikasi-Manajemen-Inventaris
    ```
3.  **Pastikan script bisa dieksekusi** (hanya perlu dilakukan sekali):
    ```bash
    chmod +x deploy.sh
    ```
4.  **Jalankan script deploy**:
    ```bash
    ./deploy.sh
    ```

Tunggu hingga proses selesai. Jika berhasil, Anda akan melihat pesan "Deployment finished successfully!".

---

## Opsi 2: Cara Manual

Jika Anda ingin melakukan proses satu per satu atau jika script mengalami kendala, ikuti langkah berikut:

### 1. Ambil Kode Terbaru
Pastikan Anda berada di branch yang benar (misalnya `main`).
```bash
git fetch
git pull origin main
```

### 2. Install Dependency PHP
Jika ada perubahan pada `composer.json` (penambahan library baru):
```bash
composer install --no-dev --optimize-autoloader
```

### 3. Build Aset Frontend (Opsional)
Jika ada perubahan pada file CSS/JS atau `package.json`:
```bash
npm install
npm run build
```

### 4. Jalankan Migrasi Database
Penting untuk menerapkan perubahan struktur database jika ada.
```bash
php artisan migrate --force
```
*Note: `--force` digunakan agar tidak meminta konfirmasi di mode production.*

### 5. Bersihkan dan Cache Konfigurasi
Untuk memastikan aplikasi membaca konfigurasi terbaru:
```bash
php artisan optimize:clear
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
```

### 6. Upgrade Filament (Jika diperlukan)
```bash
php artisan filament:upgrade
```

### 7. Restart Queue Worker (Jika menggunakan Queue)
Jika Anda menggunakan Supervisor untuk queue, restart worker-nya:
```bash
php artisan queue:restart
```
atau
```bash
sudo supervisorctl restart all
```

---

## Troubleshooting

- **Permission Denied**:
  Pastikan folder `storage` dan `bootstrap/cache` memiliki izin tulis (write permission).
  ```bash
  chmod -R 775 storage bootstrap/cache
  chown -R www-data:www-data storage bootstrap/cache
  ```
  *(Sesuaikan `www-data` dengan user web server Anda, misal `apache` atau `nginx`)*

- **Maintenance Mode**:
  Jika proses upgrade cukup lama, Anda bisa mengaktifkan mode maintenance agar user tidak mengakses sistem saat sedang diperbarui.
  ```bash
  php artisan down
  # ... lakukan proses upgrade ...
  php artisan up
  ```
