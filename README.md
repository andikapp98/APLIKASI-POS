# Aplikasi POS (Point of Sale)

Aplikasi Point of Sale (POS) berbasis web yang dibangun dengan Laravel untuk mengelola penjualan, inventori, dan operasional bisnis retail.

## 🚀 Fitur Utama

### Manajemen Produk

- ✅ Kategori produk dengan foto
- ✅ Data produk lengkap (nama, deskripsi, harga, stok)
- ✅ Manajemen inventori per gudang
- ✅ Produk merchant (untuk multi-vendor)

### Manajemen Gudang

- ✅ Multi-gudang support
- ✅ Tracking stok per gudang
- ✅ Transfer produk antar gudang

### Sistem Transaksi

- ✅ Pencatatan transaksi penjualan
- ✅ Detail produk per transaksi
- ✅ History transaksi lengkap

### Manajemen User & Merchant

- ✅ Sistem autentikasi user
- ✅ Profil merchant
- ✅ Multi-merchant support

## 🛠️ Tech Stack

- **Backend**: Laravel 11.x
- **Database**: MySQL/PostgreSQL
- **Frontend**: Blade Templates + Vite
- **Styling**: Tailwind CSS (via Vite)
- **Authentication**: Laravel Sanctum/Breeze

## 📋 Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Git

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd AplikasiPOS
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Install Dependencies JavaScript

```bash
npm install
```

### 4. Setup Environment

```bash
cp .env.example .env
```

Edit file `.env` dan konfigurasikan:

```env
APP_NAME="Aplikasi POS"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aplikasi_pos
DB_USERNAME=root
DB_PASSWORD=

# Storage untuk foto kategori
FILESYSTEM_DISK=public
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Setup Database

```bash
php artisan migrate
php artisan db:seed
```

### 7. Build Assets

```bash
npm run build
# atau untuk development
npm run dev
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📁 Struktur Proyek

```
app/
├── Http/
│   ├── Controllers/     # Controller untuk API/Web
│   ├── Requests/        # Form validation requests
│   └── Resources/       # API Resources
├── Models/              # Eloquent Models
│   ├── Category.php
│   ├── Product.php
│   ├── Warehouse.php
│   ├── Merchant.php
│   ├── Transaction.php
│   └── User.php
├── Repositories/        # Repository pattern
├── Services/           # Business logic layer
└── Providers/

database/
├── migrations/         # Database migrations
├── seeders/           # Database seeders
└── factories/         # Model factories

resources/
├── js/                # JavaScript/Vue files
├── css/               # Stylesheets
└── views/             # Blade templates

routes/
├── web.php            # Web routes
└── api.php            # API routes
```

## 🔧 Konfigurasi

### Environment Variables

File `.env` berisi konfigurasi penting:

- Database connection
- Mail configuration
- Storage configuration
- Cache & session drivers

### Storage Link

Untuk mengakses file upload (foto kategori):

```bash
php artisan storage:link
```

## 📊 Database Schema

### Tabel Utama

- `users` - Data pengguna
- `categories` - Kategori produk
- `products` - Data produk
- `warehouses` - Data gudang
- `warehouse_products` - Stok produk per gudang
- `merchants` - Data merchant/vendor
- `merchant_products` - Produk per merchant
- `transactions` - Header transaksi
- `transaction_products` - Detail produk per transaksi

## 🧪 Testing

Jalankan test suite:

```bash
php artisan test
```

Atau dengan coverage:

```bash
php artisan test --coverage
```

## 📚 API Documentation

### Endpoints Utama

#### Categories

- `GET /api/categories` - List semua kategori
- `POST /api/categories` - Buat kategori baru
- `GET /api/categories/{id}` - Detail kategori
- `PUT /api/categories/{id}` - Update kategori
- `DELETE /api/categories/{id}` - Hapus kategori

#### Products

- `GET /api/products` - List semua produk
- `POST /api/products` - Buat produk baru
- `GET /api/products/{id}` - Detail produk
- `PUT /api/products/{id}` - Update produk
- `DELETE /api/products/{id}` - Hapus produk

#### Transactions

- `GET /api/transactions` - List semua transaksi
- `POST /api/transactions` - Buat transaksi baru
- `GET /api/transactions/{id}` - Detail transaksi

## 🤝 Contributing

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.

## 👥 Authors

- **Developer Name** - _Initial work_ - [GitHub Profile](https://github.com/username)

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Font Awesome
- Dan komunitas open source lainnya

---

**Catatan**: Dokumentasi ini masih dalam pengembangan. Untuk informasi lebih detail, silakan lihat kode sumber atau hubungi tim development.

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
