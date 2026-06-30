# Panduan Lengkap Deployment Production (Cloud VPS & Shared Hosting)

Dokumen ini merupakan pedoman resmi dan komprehensif untuk melakukan *deployment* (peluncuran ke server produksi) aplikasi **TrustCheck AI** berbasis Laravel 12. Panduan ini mencakup 2 (dua) skenario lingkungan server utama:
1. **Cloud VPS (Virtual Private Server):** Metode yang **sangat direkomendasikan** untuk skala produksi tingkat enterprise karena memberikan kontrol penuh terhadap antrean proses latar belakang (*queue worker*), latensi rendah, serta keamanan maksimal.
2. **Shared Hosting (cPanel / DirectAdmin):** Metode alternatif untuk lingkungan skala kecil atau efisiensi biaya, dengan penyesuaian khusus pada struktur direktori `public_html` dan mekanisme antrean tanpa proses *daemon* permanen.

---

## 1. Persyaratan Sistem Umum (System Requirements)

Sebelum memulai deployment, pastikan lingkungan server memenuhi spesifikasi berikut:
- **PHP:** Versi 8.2 atau 8.3 dengan ekstensi aktif: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO_MySQL`, `Tokenizer`, `XML`, `cURL`, dan `ZIP`.
- **Database:** MariaDB 10.6+ atau MySQL 8.0+.
- **Composer:** Versi 2.x.
- **Node.js & NPM:** Versi 20+ (Khusus untuk proses kompilasi aset Vite).

---

## 2. Panduan Deployment di Cloud VPS (Ubuntu 24.04 / 22.04 LTS)

Metode ini mengadopsi tumpukan teknologi modern: **Ubuntu + Nginx + PHP-FPM + MariaDB + Supervisor + Certbot SSL**.

### Langkah 1: Persiapan Server & Kode Sumber
Masuk ke server VPS melalui SSH dan pasang repositori aplikasi di direktori `/var/www/`:

```bash
cd /var/www
git clone https://github.com/hndko/app_trustcheck_laravel12.git trustcheck
cd /var/www/trustcheck

# Atur hak kepemilikan direktori kepada user web server (www-data)
sudo chown -R $USER:www-data /var/www/trustcheck
sudo chmod -R 775 storage bootstrap/cache
```

### Langkah 2: Instalasi Dependensi PHP & Frontend
Instal dependensi Laravel untuk lingkungan produksi (tanpa paket *development*):

```bash
# Instalasi vendor PHP yang dioptimalkan
composer install --optimize-autoloader --no-dev

# Instalasi paket Node dan kompilasi aset Tailwind CSS v4 dengan Vite
npm ci
npm run build
```

### Langkah 3: Konfigurasi Environment & Database
Buat database baru di MySQL/MariaDB server Anda, kemudian salin konfigurasi `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan parameter di file `.env` untuk mode produksi:
```ini
APP_NAME="TrustCheck AI"
APP_ENV=production
APP_KEY=base64:xxx...
APP_DEBUG=false
APP_URL=https://trustcheck.domain-anda.com

LOG_CHANNEL=daily
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_trustcheck_prod
DB_USERNAME=user_trustcheck
DB_PASSWORD="PasswordSangatKuat123!"

# Gunakan database sebagai penggerak antrean (Wajib)
QUEUE_CONNECTION=database
CACHE_STORE=database
SESSION_DRIVER=database

# Konfigurasi AI Default
AI_DEFAULT_PROVIDER=gemini
GEMINI_API_KEY="AIzaSy..."
```

Jalankan migrasi skema database serta buat tautan simbolis (*symlink*) penyimpanan:
```bash
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

### Langkah 4: Konfigurasi Virtual Host Nginx
Buat file konfigurasi Nginx di `/etc/nginx/sites-available/trustcheck.conf`:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name trustcheck.domain-anda.com;
    root /var/www/trustcheck/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock; # Sesuaikan versi PHP FPM server
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Aktifkan konfigurasi virtual host:
```bash
sudo ln -s /etc/nginx/sites-available/trustcheck.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### Langkah 5: Konfigurasi Background Queue Worker (Supervisor)
Karena ekstraksi informasi publik dan analisis LLM AI memerlukan waktu pemrosesan latar belakang, Supervisor wajib dipasang agar antrean berjalan konstan tanpa henti. (Referensi mendalam dapat dilihat pada `docs/05-queue-worker-production.md`).

Buat file konfigurasi Supervisor di `/etc/supervisor/conf.d/trustcheck-worker.conf`:

```ini
[program:trustcheck-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/trustcheck/artisan queue:work database --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/trustcheck/storage/logs/worker.log
stopwaitsecs=3600
```

Aktifkan proses worker:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start trustcheck-worker:*
```

### Langkah 6: Konfigurasi Penjadwalan Otomatis (Cron Job)
Tambahkan entri cron job berikut agar sistem menjalankan tugas terjadwal Laravel:
```bash
crontab -e
```
Tambahkan baris di bagian bawah:
```cron
* * * * * cd /var/www/trustcheck && php artisan schedule:run >> /dev/null 2>&1
```

### Langkah 7: Sertifikasi SSL Gratis (Let's Encrypt)
Pasang sertifikat HTTPS menggunakan Certbot:
```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d trustcheck.domain-anda.com
```

---

## 3. Panduan Deployment di Shared Hosting (cPanel / DirectAdmin)

Lingkungan *Shared Hosting* memiliki batasan hak akses (tidak ada akses root, tidak bisa menginstal Supervisor, dan keterbatasan RAM/CPU untuk kompilasi Node.js). Ikuti pedoman adaptasi berikut:

### Langkah 1: Persiapan Build secara Lokal (Komputer Developer)
Sebelum mengunggah file ke Shared Hosting, lakukan build aset di komputer lokal Anda terlebih dahulu agar server hosting tidak terbebani:

```bash
# Di komputer lokal Anda:
composer install --optimize-autoloader --no-dev
npm ci
npm run build
```

Pastikan direktori `public/build` telah terbentuk dengan sempurna.

### Langkah 2: Pemisahan Direktori Core & `public_html` (Sangat Penting untuk Keamanan)
**Dilarang keras** mengunggah seluruh folder proyek langsung ke dalam `public_html`. Jika file `.env` berada di dalam `public_html`, kredensial database dan API Key Anda dapat diretas jika web server salah dikonfigurasi.

Struktur penyimpanan aman di file manager Shared Hosting:
```text
/home/username_hosting/
├── trustcheck_core/         <-- Letakkan seluruh isi proyek di sini (app, bootstrap, config, vendor, .env, dll)
└── public_html/             <-- Letakkan HANYA isi dari folder public/ di sini (index.php, .htaccess, build/, assets/)
```

**Cara Mengatur:**
1. Buat folder baru di luar `public_html` bernama `trustcheck_core`.
2. Unggah seluruh file proyek Anda (kecuali isi folder `public/`) ke dalam `trustcheck_core`.
3. Salin seluruh **isi** folder `public/` proyek Anda dan letakkan langsung di dalam `public_html`.

### Langkah 3: Penyesuaian File `index.php` di `public_html`
Buka dan edit file `/home/username_hosting/public_html/index.php`. Ubah jalur alamat menuju direktori `trustcheck_core`:

```php
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../trustcheck_core/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../trustcheck_core/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../trustcheck_core/bootstrap/app.php')
    ->handleRequest(Request::capture());
```

### Langkah 4: Penyesuaian `AppServiceProvider.php` untuk Public Path
Agar Laravel mengetahui alamat baru folder publik pada lingkungan Shared Hosting, tambahkan pembaruan *binding path* di `app/Providers/AppServiceProvider.php` (sudah didukung atau bisa ditambahkan jika mengalami kendala aset):

```php
public function register(): void
{
    if ($this->app->environment('production') && !str_contains(base_path(), 'var/www')) {
        $this->app->usePublicPath(realpath(base_path('../public_html')));
    }
}
```

### Langkah 5: Konfigurasi Database di Shared Hosting
1. Masuk ke menu **MySQL Databases** di cPanel.
2. Buat database baru (contoh: `username_trustcheck`).
3. Buat user database baru dan berikan hak akses penuh (*All Privileges*).
4. Perbarui file `/home/username_hosting/trustcheck_core/.env` dengan rincian database tersebut.

### Langkah 6: Pembuatan Symlink Storage di Shared Hosting
Karena terminal CLI terbatas, Anda dapat membuat file sementara `symlink.php` di dalam `public_html/` untuk membuat tautan simbolis folder gambar/pdf:

```php
<?php
// file: public_html/symlink.php
$target = __DIR__ . '/../trustcheck_core/storage/app/public';
$shortcut = __DIR__ . '/storage';
if (symlink($target, $shortcut)) {
    echo "Symlink berhasil dibuat!";
} else {
    echo "Gagal membuat symlink.";
}
?>
```
Buka `https://domain-anda.com/symlink.php` di browser sekali saja sampai muncul pesan berhasil, setelah itu **segera hapus file `symlink.php`**.

### Langkah 7: Strategi Background Queue di Shared Hosting
Karena Anda tidak dapat menjalankan proses *Supervisor Daemon* di Shared Hosting, gunakan salah satu dari 2 opsi berikut:

#### Opsi A: Menggunakan Cron Job cPanel (Rekomendasi untuk Shared Hosting)
Masuk ke menu **Cron Jobs** di cPanel dan atur penjadwalan setiap 1 menit (*Every Minute*):
```cron
* * * * * /usr/local/bin/php /home/username_hosting/trustcheck_core/artisan queue:work database --stop-when-empty --max-time=50 >> /dev/null 2>&1
```
*Catatan:* Jalur `/usr/local/bin/php` dapat berbeda di tiap hosting (contoh: `/opt/cpanel/ea-php83/root/usr/bin/php`). Tanyakan kepada penyedia hosting Anda untuk path binary PHP 8.3 yang tepat. Perintah `--stop-when-empty` memastikan proses berhenti sendiri setelah antrean habis sehingga tidak memblokir memori hosting.

#### Opsi B: Mengubah Koneksi Antrean Menjadi Sinkron (Sync Fallback)
Jika penyedia Shared Hosting melarang pengeksekusian perintah antrean via Cron Job, ubah parameter di file `trustcheck_core/.env`:
```ini
QUEUE_CONNECTION=sync
```
Dengan mode `sync`, proses scraping web dan analisis AI akan dijalankan langsung pada saat pengguna menekan tombol cari (eksekusi HTTP sinkron). Kelemahannya adalah waktu tunggu *loading* pada halaman web sedikit lebih lama (5-15 detik), namun sistem tetap berfungsi normal 100% tanpa memerlukan *background worker*.

---

## 4. Checklist Pasca-Deployment & Troubleshooting

| Gejala / Masalah | Penyebab Utama | Solusi & Tindakan Korektif |
| :--- | :--- | :--- |
| **HTTP 500 Internal Server Error** | Izin folder `storage` atau `bootstrap/cache` tidak dapat ditulisi oleh PHP. | Ubah izin folder menjadi 775 atau 777 (`chmod -R 775 storage bootstrap/cache`). |
| **Aset CSS/JS Tidak Muncul (404)** | Lupa menjalankan `npm run build` atau jalur `public_html` belum dipetakan. | Periksa apakah direktori `build/` sudah ada di dalam `public/` atau `public_html/`. |
| **Pencarian Perusahaan Macet di Status "Sedang Diproses AI"** | `QUEUE_CONNECTION=database` aktif tetapi Worker/Cron tidak berjalan. | Pastikan Supervisor aktif (di VPS) atau ubah `QUEUE_CONNECTION=sync` di `.env` jika di Shared Hosting. |
| **Halaman Kelola Provider AI Tidak Bisa Menyimpan** | Cache config lama masih tersimpan di memori Laravel. | Jalankan perintah `php artisan config:clear` atau `php artisan optimize:clear`. |
| **Turnstile / Rate Limiter Error** | IP dibatasi oleh middleware throttle karena pengujian berulang. | Tunggu 1 menit atau jalankan `php artisan cache:clear`. |
