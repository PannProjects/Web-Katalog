# Web Katalog Produk

Aplikasi web katalog produk berbasis client-server yang dibangun dengan Laravel. Proyek ini dibuat sebagai bagian dari Uji Kompetensi Keahlian (UKK) 2026.

## Fitur

- Autentikasi (Login & Register)
- Katalog produk dengan foto
- Komentar pada produk
- Dashboard admin untuk manajemen produk (CRUD)
- Otorisasi berbasis role (Admin & User)

## Teknologi

- **Backend:** Laravel 12 (PHP 8.2)
- **Database:** MariaDB
- **Frontend:** Blade Templates, Tailwind CSS 4
- **Build Tool:** Vite

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js >= 18
- MariaDB / MySQL
- Git

## Cara Menjalankan

1. Clone repositori ini:

```bash
git clone https://github.com/username/web-katalog.git
cd web-katalog
```

2. Install dependensi PHP:

```bash
composer install
```

3. Install dependensi Node.js:

```bash
npm install
```

4. Salin file konfigurasi dan generate application key:

```bash
cp .env.example .env
php artisan key:generate
```

5. Konfigurasi database di file `.env`:

```env
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_katalog
DB_USERNAME=root
DB_PASSWORD=
```

6. Buat database `web_katalog` di phpMyAdmin, lalu jalankan migrasi dan seeder:

```bash
php artisan migrate --seed
php artisan storage:link
```

7. Jalankan aplikasi:

```bash
composer run dev
```

8. Buka browser dan akses `http://localhost:8000`

## Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@admin.com | password |

## Hak Akses

| Fitur | Admin | User | Guest |
|-------|-------|------|-------|
| Login & Logout | ✅ | ✅ | — |
| Register | — | — | ✅ |
| Lihat Katalog | ✅ | ✅ | ✅ |
| Tambah/Edit/Hapus Produk | ✅ | — | — |
| Komentar | ✅ | ✅ | — |

## Struktur Folder Penting

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── ProductController.php
│   │   └── CommentController.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/
│   ├── User.php
│   ├── Product.php
│   └── Comment.php
database/
├── migrations/
└── seeders/
resources/views/
├── layouts/app.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── products/
│   ├── index.blade.php
│   └── show.blade.php
└── admin/products/
    ├── index.blade.php
    ├── create.blade.php
    └── edit.blade.php
```

## Lisensi

Proyek ini dibuat untuk keperluan UKK 2026.
