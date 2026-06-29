<div align="center">

# 🛡️ TrustCheck AI
### *AI-Powered Company Reputation & Due Diligence Search Engine*

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-Lightweight-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![Database](https://img.shields.io/badge/MySQL_%2F_MariaDB-Enterprise-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](https://opensource.org/licenses/MIT)

<p class="mt-4 text-slate-600 text-sm">
Mesin pencari intelijensi bisnis berbasis Kecerdasan Buatan (AI) yang mengagregasi, membersihkan, dan menyintesis informasi publik secara otomatis untuk verifikasi reputasi dan mitigasi risiko sebelum pengambilan keputusan bisnis.
</p>

[Fitur Utama](#-fitur-unggulan-portfolio-highlights) • [Arsitektur Sistem](#-arsitektur--teknologi) • [Dokumentasi Resmi](#-dokumentasi-resmi) • [Panduan Instalasi](#-panduan-instalasi--penggunaan) • [Lisensi](#-lisensi--disclaimer)

</div>

---

## 📌 Deskripsi Singkat GitHub (*Short Description*)
> Gunakan teks di bawah ini untuk kolom **About / Description** pada repository GitHub Anda:
```text
🔍 AI-Powered Company Reputation & Due Diligence Search Engine. Mesin pencari intelijensi bisnis berbasis AI untuk verifikasi reputasi, analisis risiko (Trust Score), komparasi entitas, dan ekstraksi fakta publik secara real-time. Built with Laravel 12 & Tailwind CSS v4.
```

---

## ✨ Fitur Unggulan (*Portfolio Highlights*)

TrustCheck AI dirancang dengan filosofi **Modern Enterprise** yang mengutamakan kecepatan, objektivitas data, dan antarmuka bisnis kelas atas (*Clean & Minimalist*).

### 🔎 1. Mesin Pencari & Agregator Intelijensi Publik
- **Real-Time Data Collection:** Menarik informasi publik dari situs resmi perusahaan, portal berita online, data WHOIS domain, dan rekam jejak digital secara otomatis.
- **Tanpa Login Wajib:** Pengguna dapat langsung melakukan pencarian entitas bisnis secara cepat tanpa hambatan pendaftaran akun (*frictionless UI*).

### 🤖 2. Analisis AI Objektif & Multi-LLM Driver
- **Sintesis Fakta Bebas Opini:** AI dilarang keras membuat opini subjektif atau menghakimi. Laporan difokuskan murni pada fakta publik yang dapat diverifikasi (*Neutral Diction*).
- **Fleksibilitas Provider AI:** Mendukung arsitektur *adapter pattern* yang dapat diganti sewaktu-waktu melalui `.env`: **OpenAI**, **Google Gemini**, **Anthropic Claude**, **OpenRouter**, hingga **Custom LLM Base URL**.

### 📊 3. Skor Kepercayaan (*Trust Score*) & Tingkat Risiko
- Mengkalkulasi **Trust Score (0 - 100)** berdasarkan bobot indikator multi-dimensi:
  - 🌐 **Situs Web & Keamanan SSL** (10%)
  - 🔍 **Umur & Reputasi Domain** (10%)
  - 🗣️ **Sentimen & Ulasan Publik** (25%)
  - 📰 **Rekam Jejak Berita Media** (20%)
  - 🏢 **Kelengkapan Profil Perusahaan** (15%)
  - 📈 **Jejak Digital & Transparansi** (10%)
  - 🧠 **Tingkat Keyakinan AI (*Confidence*)** (10%)
- Dilengkapi klasifikasi **Risk Level** otomatis: *Risiko Rendah (Aman)*, *Risiko Sedang (Perhatian)*, dan *Risiko Tinggi (Waspada)*.

### ⚖️ 4. Matriks Komparasi Reputasi Perusahaan
- Memungkinkan pengguna membandingkan metrik reputasi, sentimen publik, dan parameter teknis dari beberapa perusahaan sekaligus berdampingan dalam satu layar visual yang interaktif.

### 📄 5. Ekspor Laporan PDF Kop Resmi Enterprise
- Menghasilkan dokumen laporan *Due Diligence* berformat PDF siap saji (*investor & executive ready*) dengan tata letak profesional untuk lampiran kontrak atau rapat bisnis.

### 🛡️ 6. Keamanan & Proteksi Tingkat Lanjut
- **Anti-Prompt Injection AI:** Regex sanitasi khusus untuk mencegah serangan manipulasi instruksi LLM dari input pencarian.
- **Proteksi Anti-Bot & Rate Limiting:** Pembatasan ketat (`throttle:search`) serta dukungan verifikasi transparan **Cloudflare Turnstile**.
- **Role Superadmin & Portal Netral:** URL kelola sistem aman tanpa nama role standar (contoh: `/portal-kelola`) dengan proteksi *permission bypass*.

### ⚡ 7. Pemantauan Real-Time & Reliabilitas Production
- **Endpoint Monitoring (`/up`):** Health check otomatis berformat JSON untuk memantau status konektivitas database PDO dan latensi respons AI.
- **Notifikasi Darurat Telegram:** Integrasi pelaporan error otomatis ke saluran Telegram jika terjadi gangguan pada provider AI eksternal.
- **Umpan Balik Koreksi Data:** Portal pelaporan transparan bagi publik untuk mengoreksi ketidakakuratan data hasil ekstraksi AI.

---

## 🛠 Arsitektur & Teknologi

| Komponen | Teknologi yang Digunakan | Keterangan |
| :--- | :--- | :--- |
| **Backend Core** | PHP 8.2+, Laravel 12 | Framework utama dengan arsitektur modular & service pattern |
| **Frontend Styling** | Tailwind CSS v4.0 | Vanilla CSS bercita rasa enterprise yang sangat ringan & cepat |
| **Interaktivitas UI** | Alpine.js | Micro-framework JS tanpa kompleksitas virtual DOM berlebihan |
| **Database** | MySQL / MariaDB | Penyimpanan relasional riwayat pencarian, metrik, & laporan koreksi |
| **Queue & Background** | Laravel Queue (Supervisor/Horizon) | Pemrosesan scraping & analisis AI asinkron di belakang layar |
| **PDF Generator** | Barryvdh DomPDF | Rendering laporan resmi berformat A4 |
| **Iconography** | Lucide Icons | Set ikon vektor konsisten bergaya modern bersih |

---

## 📚 Dokumentasi Resmi

Proyek ini dilengkapi dengan dokumentasi terstruktur berurutan (*logical reading order*) yang tersimpan di dalam direktori `docs/`:

1. [**00-index.md**](docs/00-index.md) — Indeks utama panduan dokumentasi proyek.
2. [**01-prd.md**](docs/01-prd.md) — *Product Requirements Document* (Spesifikasi produk & alur kerja).
3. [**02-design.md**](docs/02-design.md) — *Design Philosophy & UI/UX Guidelines* (Aturan visual Modern Enterprise).
4. [**03-api-guide.md**](docs/03-api-guide.md) — Panduan konfigurasi API LLM (OpenAI, Gemini, Claude, dll) & Scraping.
5. [**04-tasks.md**](docs/04-tasks.md) — Roadmap pengembangan & daftar periksa tugas (100% Selesai ✅).
6. [**05-queue-worker-production.md**](docs/05-queue-worker-production.md) — Panduan deployment Queue Worker pada server Linux.
7. [**GEMINI.md**](GEMINI.md) — Aturan kerja utama (*Single Source of Truth*) AI Agent & developer.

---

## 🚀 Panduan Instalasi & Penggunaan

### 1. Persyaratan Sistem (*Prerequisites*)
- PHP >= 8.2
- Composer
- MySQL / MariaDB Server
- Node.js & NPM

### 2. Langkah Instalasi

```bash
# 1. Kloning repositori proyek
git clone https://github.com/hndko/app_trustcheck_laravel12.git
cd app_trustcheck_laravel12

# 2. Install dependensi backend & frontend
composer install
npm install

# 3. Salin konfigurasi environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate
```

### 3. Konfigurasi Database & API Key (`.env`)
Sesuaikan kredensial database dan pilih provider AI pilihan Anda pada berkas `.env`:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_trustcheck_laravel12
DB_USERNAME=root
DB_PASSWORD=

# Pilihan AI Provider: openai, gemini, claude, openrouter, custom
AI_PROVIDER=gemini
GEMINI_API_KEY=your_gemini_api_key_here
GEMINI_MODEL=gemini-2.5-flash
```

### 4. Migrasi & Seeder Database

```bash
# Jalankan migrasi beserta seeder data awal & akun Superadmin
php artisan migrate --seed
```

> **Akses Akun Superadmin:**
> - Email: `superadmin@example.com`
> - Kata Sandi: `password`
> - URL Portal Kelola: `http://localhost:8000/portal-kelola`

### 5. Menjalankan Server Pengembangan

Buka 2 terminal terpisah untuk menjalankan *development server* dan *asset bundler*:

```bash
# Terminal 1: Menjalankan server Laravel
php artisan serve

# Terminal 2: Menjalankan Vite asset bundler
npm run dev
```

Aplikasi kini dapat diakses melalui peramban pada alamat **`http://localhost:8000`**.

---

## 👨‍💻 Konsep & Portofolio Pengembang

Proyek **TrustCheck AI** dikembangkan sebagai bukti konsep (*Proof of Concept* / Portofolio Showpiece) dalam membangun aplikasi bisnis kelas enterprise yang memadukan keandalan framework **Laravel 12**, antarmuka bersih **Tailwind CSS v4**, serta integrasi kecerdasan buatan (**Multi-LLM Engine**) secara aman, asinkron, dan terstruktur.

---

## ⚖️ Lisensi & Disclaimer Hukum

- **Lisensi:** Kode sumber aplikasi ini dirilis di bawah [Lisensi MIT](https://opensource.org/licenses/MIT).
- **Pernyataan Sanggahan (*Legal Disclaimer*):** TrustCheck AI bukan merupakan lembaga penegak hukum, penasihat keuangan, maupun biro investigasi swasta. Seluruh informasi dan *Trust Score* yang disajikan dihasilkan oleh algoritma kecerdasan buatan dari pengumpulan data publik online secara otomatis. Karena data diekstraksi secara terbuka, ketidakakuratan dapat terjadi jika situs sumber mengalami perubahan. Pengguna disarankan melakukan verifikasi mandiri melalui daftar referensi tautan sumber yang disediakan di setiap laporan.

<div align="center">
<p class="mt-8 text-xs text-slate-500">Dibuat dengan ❤️ menggunakan Laravel 12 & AI Engineering</p>
</div>
