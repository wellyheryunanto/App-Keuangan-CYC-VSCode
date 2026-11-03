# Sistem Informasi Keuangan CYC

Aplikasi internal keuangan perusahaan berbasis Laravel, PHP, dan PostgreSQL. Frontend menggunakan Blade/Livewire, Tailwind CSS, dan Vite.

## Prasyarat

- PHP 8.5 dengan ekstensi `pdo_pgsql`, `pgsql`, `openssl`, `mbstring`, `fileinfo`, `intl`, `sodium`, dan `zip`.
- Ekstensi `pdo_sqlite` dan `sqlite3` untuk menjalankan test suite.
- Composer 2.
- PostgreSQL 18.
- Node.js dan npm.

## Menyiapkan PostgreSQL lokal

1. Hubungkan ke server PostgreSQL lokal sebagai administrator melalui pgAdmin atau `psql`.
2. Buat role aplikasi dan database. Pilih kata sandi sendiri secara lokal; jangan menyimpan atau membagikannya di source code.

```sql
CREATE ROLE keuangan_app WITH LOGIN PASSWORD '<kata-sandi-yang-dibuat-lokal>';
CREATE DATABASE keuangan_cyc OWNER keuangan_app ENCODING 'UTF8';
```

3. Isi `DB_PASSWORD` di file `.env` lokal dengan kata sandi role tersebut. Jangan commit `.env`.
4. Jalankan dari folder `keuangan-cyc`:

```powershell
php artisan migrate
php artisan app:setup
```

`app:setup` meminta nama perusahaan, nama/email direktur pertama, dan kata sandi awal secara interaktif. Kata sandi tidak dicetak; gunakan minimal 12 karakter. Perintah ini membuat tiga bidang usaha dan prefix awal nomor dokumen (`PRJ-`, `INV-`, `TRX-`, `PO-`, `JRN-`). Format dan prefix dapat dikonfigurasi setelah layar pengaturan dibuat.

## Menjalankan aplikasi

```powershell
npm install
npm run build
php artisan serve
```

Buka `http://127.0.0.1:8000`. Login hanya tersedia bagi akun yang dibuat oleh administrator; pendaftaran publik dinonaktifkan.

## Pengembangan dan pengujian

```powershell
php artisan test
vendor/bin/pint --dirty --format agent
composer audit
```

Test suite menggunakan SQLite in-memory agar dapat dijalankan tanpa kredensial database lokal. PostgreSQL tetap menjadi database utama aplikasi dan harus diverifikasi melalui migrasi/integrasi lokal sebelum deployment.

Dokumen desain Phase 1 tersedia di `../docs/phase-1-design.md`. Migration baru tidak boleh menimpa atau menghapus transaksi yang sudah posted.
