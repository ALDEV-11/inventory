<p align="center">
  <img src="public/dist-dashboard/assets/images/logo/smartstock.png" width="120" alt="SIGAP Logo">
</p>

<h1 align="center">SMARTSTOCK</h1>
<p align="center"><strong>Sistem Informasi Gudang dan Persediaan</strong></p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=flat&logo=bootstrap" alt="Bootstrap">
  <img src="https://img.shields.io/badge/License-MIT-green?style=flat" alt="License">
</p>

---

## 📖 Tentang Aplikasi

**SmartStock** adalah aplikasi manajemen inventaris gudang berbasis web yang 
dibangun menggunakan Laravel 12. Aplikasi ini dirancang untuk membantu 
pengelola gudang dalam mencatat, memantau, dan mengendalikan seluruh 
aktivitas keluar masuk barang secara digital, akurat, dan real-time.

Aplikasi ini memiliki **3 role pengguna** dengan privilege berbeda:
- 👤 **Administrator** — akses penuh ke seluruh sistem
- 👷 **Petugas Gudang** — input transaksi harian
- 👔 **Kepala Gudang** — monitoring dan laporan

---

## ✨ Fitur Utama

- 🔐 **Autentikasi Role-based** — Login dengan 3 level akses berbeda
- 📦 **Manajemen Master Data** — Barang, Kategori, Supplier, Lokasi/Rak
- 📥 **Barang Masuk (Purchase Order)** — Dengan sistem approval via scan barcode
- 📤 **Barang Keluar** — Validasi stok real-time via AJAX
- 🔄 **Retur Barang** — Dari pelanggan & ke supplier
- 📊 **Dashboard Interaktif** — Chart.js (Area Chart & Donut Chart)
- 🔔 **Notifikasi Stok Minimum** — Alert otomatis ke Admin & Kepala
- 📄 **Laporan** — Mutasi, Stok Opname, Kartu Stok (PDF & Excel)
- 🔖 **Barcode Generator** — Generate & download barcode per dokumen PO
- 📷 **Scan Barcode Approval** — Upload gambar barcode untuk approve PO
- 🛡️ **Keamanan** — CSRF, SQL Injection prevention, No-cache middleware

---

## 🛠️ Tech Stack

| Kategori | Teknologi |
|----------|-----------|
| Framework | Laravel 12 |
| Bahasa | PHP 8.2+ |
| Database | MySQL 8.0 |
| Frontend | Bootstrap 5 + AdminLTE |
| Barcode | picqer/php-barcode-generator ^3.2 |
| PDF | barryvdh/laravel-dompdf ^3.1 |
| Excel | maatwebsite/excel ^3.1 |
| Chart | Chart.js |
| Barcode Scanner | QuaggaJS |

---

## ⚙️ Cara Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL 8.0

### Langkah-langkah

**1. Clone repository**
```bash
git clone https://github.com/username/inventory.git
cd smartstock
```

**2. Install dependencies**
```bash
composer install
npm install && npm run dev
```

**3. Konfigurasi environment**
```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env`:
```env
APP_NAME=SIGAP
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventaris_gudang
DB_USERNAME=root
DB_PASSWORD=
```

**4. Migrasi & Seeder database**
```bash
php artisan migrate --seed
```

**5. Storage link**
```bash
php artisan storage:link
```

**6. Jalankan aplikasi**
```bash
php artisan serve
```

Buka browser: `http://localhost:8000`

---

## 👥 Akun Demo

| Role | Email | Password |
|------|-------|----------|
| Administrator | admin@gudang.com | admin123 |
| Petugas Gudang | petugas@gudang.com | petugas123 |
| Kepala Gudang | kepala@gudang.com | kepala123 |

---

## 🔑 Privilege per Role

| Fitur | Admin | Petugas | Kepala |
|-------|-------|---------|--------|
| Login & Logout | ✅ | ✅ | ✅ |
| CRUD Data Barang | ✅ | ✅ | ❌ |
| CRUD Kategori, Supplier, Lokasi | ✅ | ❌ | ❌ |
| Input Barang Masuk (PO) | ✅ | ✅ | ❌ |
| Approve PO (scan barcode) | ✅ | ✅ | ❌ |
| Input Barang Keluar | ✅ | ✅ | ❌ |
| Retur Barang | ✅ | ✅ | ❌ |
| Lihat Stok Real-time | ✅ | ✅ | ✅ |
| Peringatan Stok Minimum | ✅ | ✅ | ✅ |
| Generate Laporan | ✅ | ❌ | ✅ |

---

## 🗄️ Struktur Database

Aplikasi menggunakan **12 tabel** utama:
```
users                   → data pengguna + role
kategori_barang         → master kategori
supplier                → master supplier
lokasi                  → master lokasi/rak gudang
barang                  → master barang + stok
barang_masuk            → header Purchase Order
detail_barang_masuk     → detail item PO
barang_keluar           → header transaksi keluar
detail_barang_keluar    → detail item keluar
retur_barang            → header retur
detail_retur            → detail item retur
notifications           → notifikasi sistem
```

---

## 📁 Struktur Folder Penting
```
app/
  Http/Controllers/
    AuthController.php
    DashboardController.php
    BarangController.php
    BarangMasukController.php
    BarangKeluarController.php
    ReturBarangController.php
    LaporanController.php
    NotificationController.php
  Models/
  Notifications/
    PoDisetujuiNotification.php
    StokMinimumNotification.php
  Exports/
resources/views/
  dashboard/
    admin.blade.php
    petugas.blade.php
    kepala.blade.php
  barang-masuk/
  barang-keluar/
  laporan/
  notifikasi/
```

---

## 🔒 Keamanan

- ✅ **SQL Injection** — PDO Prepared Statements via Eloquent ORM
- ✅ **CSRF Protection** — Token CSRF di setiap form
- ✅ **Role-based Access** — 3 lapis: route middleware, controller, blade
- ✅ **Browser Back Button** — NoCacheMiddleware + pageshow event
- ✅ **DB Transaction** — Konsistensi data di setiap transaksi stok

---

## 📋 Perintah Berguna
```bash
# Reset database + isi data awal
php artisan migrate:fresh --seed

# Clear semua cache
php artisan optimize:clear

# Buat tabel notifikasi
php artisan notifications:table && php artisan migrate
```

---

## 📄 Lisensi

Aplikasi ini dibuat untuk keperluan **UJI KOMPETENSI KEAHLIAN (UKK)**  
Program Keahlian Rekayasa Perangkat Lunak — Tahun Pelajaran 2024/2025.

---

<p align="center">
  ALDEV 
</p>
