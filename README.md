# E-Commerce Laravel Template

Template website e-commerce modern yang dibangun dengan Laravel dengan semua fitur essential untuk online store.

## Fitur Utama

✅ **Katalog Produk** - Manajemen produk dengan kategori dan detail lengkap
✅ **Keranjang Belanja** - Sistem shopping cart yang responsif
✅ **Integrasi Pembayaran** - Midtrans payment gateway
✅ **Autentikasi Pengguna** - Login, Register, Password Reset
✅ **Dashboard Admin** - Manajemen produk, order, dan user
✅ **Pencarian & Penyaringan** - Filter produk by kategori, harga, rating
✅ **Order Management** - Track dan kelola pesanan
✅ **Review & Rating** - Sistem review produk dari customer

## Tech Stack

- **Backend**: Laravel 11
- **Database**: MySQL
- **Frontend**: Blade + Tailwind CSS
- **Authentication**: Laravel Auth
- **Payment**: Midtrans
- **API**: RESTful API

## Instalasi

### Prerequisites
- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js & NPM

### Setup

```bash
# Clone repository
git clone https://github.com/chitrachrsm8/commerce-laravel.git
cd commerce-laravel

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Migrate database
php artisan migrate --seed

# Build assets
npm run dev

# Run server
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## Struktur Folder

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── Customer/
│   │   │   ├── Auth/
│   │   │   └── ...
│   ├── Models/
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Cart.php
│   │   ├── Order.php
│   │   └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── customer/
│   │   └── layouts/
│   └── css/
├── routes/
│   ├── web.php
│   ├── api.php
│   └── admin.php
└── storage/
```

## Demo Login

**Admin:**
- Email: `admin@example.com`
- Password: `password`

**Customer:**
- Email: `customer@example.com`
- Password: `password`

## Dokumentasi

Silakan baca dokumentasi lengkap di folder `docs/`

## License

MIT License
