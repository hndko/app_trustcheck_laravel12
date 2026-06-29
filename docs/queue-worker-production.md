# Panduan Konfigurasi Queue Worker Production (Supervisor)

Dokumen ini berisi pedoman resmi pengaturan sistem antrean (*background job queue worker*) pada server production Linux (Ubuntu/Debian/CentOS) menggunakan **Supervisor** atau **Laravel Horizon** guna menjamin keandalan proses scraping dan analisis AI TrustCheck AI.

---

## 1. Konfigurasi Menggunakan Supervisor (Standar VPS / Dedicated Server)

Supervisor adalah monitor proses untuk Linux yang akan otomatis menjalankan kembali (*restart*) *queue worker* Laravel apabila proses mati atau server mengalami *reboot*.

### Langkah A: Instalasi Supervisor
Pada server Ubuntu / Debian:
```bash
sudo apt-get update
sudo apt-get install supervisor
```

### Langkah B: Buat Konfigurasi Worker TrustCheck AI
Buat file baru di `/etc/supervisor/conf.d/trustcheck-worker.conf`:
```ini
[program:trustcheck-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/app_trustcheck_laravel12/artisan queue:work --sleep=3 --tries=3 --max-time=3600 --timeout=120
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=4
redirect_stderr=true
stdout_logfile=/path/to/app_trustcheck_laravel12/storage/logs/worker.log
stopwaitsecs=3600
```

> **Catatan Penting:**
> - Sesuaikan `/path/to/app_trustcheck_laravel12/` dengan path direktori proyek Anda di server (misal `/var/www/trustcheck`).
> - `numprocs=4`: Menjalankan 4 proses worker paralel untuk mempercepat antrean due diligence saat traffic tinggi.
> - `--timeout=120`: Batas waktu pemrosesan satu job (karena scraping & LLM API membutuhkan waktu beberapa detik).

### Langkah C: Aktifkan & Jalankan Supervisor
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start trustcheck-worker:*
```

Untuk mengecek status worker:
```bash
sudo supervisorctl status trustcheck-worker:*
```

---

## 2. Praktik Terbaik Penanganan Error & Deployment

### Restart Worker Saat Deployment
Setiap kali melakukan pembaruan kode aplikasi (*deployment* atau `git pull`), worker wajib di-restart agar membaca kode baru:
```bash
php artisan queue:restart
```

### Penanganan Pekerjaan Gagal (*Failed Jobs*)
Jika LLM atau scraper mengalami *rate limit* atau putus koneksi, pekerjaan akan masuk ke tabel `failed_jobs`.
- Melihat daftar job gagal: `php artisan queue:failed`
- Mencoba kembali seluruh job gagal: `php artisan queue:retry all`
- Menghapus job gagal yang sudah kadaluarsa: `php artisan queue:flush`

---

## 3. Alternatif: Menggunakan Laravel Horizon (Khusus Redis Queue)

Jika server production menggunakan driver antrean **Redis** (`QUEUE_CONNECTION=redis` di `.env`), sangat disarankan menggunakan **Laravel Horizon**.
1. Jalankan `php artisan horizon` via Supervisor (ganti `command=php /path/to/.../artisan queue:work` menjadi `command=php /path/to/.../artisan horizon`).
2. Pantau throughput antrean secara visual dan real-time melalui URL `/horizon` (dilindungi oleh middleware autentikasi *superadmin*).
