# Roadmap & Task List — TrustCheck AI

Dokumen ini berisi daftar tugas (_task breakdown_) tahap demi tahap dalam pengembangan **TrustCheck AI** dari fase MVP hingga rilis penuh berstandar enterprise.

---

## 🏆 Fase 1: MVP Core Engine & Antarmuka (Selesai ✅)

Fase ini berfokus pada fondasi arsitektur modular, database, integrasi AI dasar, dan antarmuka pengguna responsif.

### 1. Fondasi Database & Struktur Model

- [x] Merancang migrasi tabel `companies` (dengan UUID), `company_metrics`, `company_sources`, `company_news`, dan `search_histories`.
- [x] Membuat Eloquent Model (`Company`, `CompanyMetric`, `CompanySource`, `CompanyNews`, `SearchHistory`) beserta relasi database.
- [x] Membuat seeder terpisah `CompanySeeder.php` dengan sampel data nyata perusahaan Indonesia (PT Telkom Indonesia, PT GoTo Gojek Tokopedia) dan riwayat pencarian populer.

### 2. Layer Adapter & AI Multi-Provider Service

- [x] Membangun antarmuka modular `SourceAdapterInterface`.
- [x] Menyediakan adapter fallback `GoogleSearchAdapter` dan `WebsiteScraperAdapter`.
- [x] Membangun `SearchOrchestrator` untuk mengeksekusi pengumpulan data dari berbagai kanal secara berurutan.
- [x] Membangun `AiAnalyzer` yang mendukung 5 opsi LLM (OpenAI, Gemini, Claude, OpenRouter, Custom Base URL) melalui `config/ai.php` dan `.env`.
- [x] Membangun `ScoringEngine` untuk menghitung Trust Score (0-100) dan mengkategorikan Risk Level (_Low Risk, Medium Risk, High Risk_).

### 3. Backend Controller & Background Job

- [x] Membuat `ProcessDueDiligenceJob` untuk memproses agregasi data di latar belakang.
- [x] Membuat `SearchController` dengan sanitasi input pencegahan injeksi, validasi ketat, dan sistem _caching_ pencarian.
- [x] Mendaftarkan rute pencarian dan hasil pada `routes/web.php` dengan konvensi _dot notation_.

### 4. Antarmuka Pengguna (Tailwind CSS v4 + Alpine.js)

- [x] Menyusun layout utama `app-frontend.blade.php` bergaya _Modern Enterprise_ dengan font _Plus Jakarta Sans_.
- [x] Membangun halaman beranda `index.blade.php` dengan _Hero Search Bar_ dan daftar pencarian populer.
- [x] Membangun halaman `loading.blade.php` dengan tampilan _Skeleton Loading_ profesional dan AJAX polling otomatis.
- [x] Membangun laporan lengkap `result.blade.php` meliputi Trust Score besar, badges topik, breakdown skor, kesehatan website, timeline berita, dan transparansi referensi publik.

---

## 🚀 Fase 2: Integrasi Live MCP & Caching Lanjutan (Selesai ✅)

Fase ini bertujuan untuk menghubungkan adapter pengumpul data ke sumber eksternal waktu nyata (_real-time_).

- [x] **Integrasi Search Engine API Asli:**
    - [x] Menghubungkan `GoogleSearchAdapter` ke layanan Brave Search API / SerpAPI / Tavily MCP.
    - [x] Menambahkan validasi batas kuota harian (_rate limiting_) pada API pencarian eksternal.
- [x] **Integrasi Web Scraper Worker:**
    - [x] Menghubungkan `WebsiteScraperAdapter` dengan Firecrawl MCP atau Playwright untuk ekstraksi metadata WHOIS dan SSL secara langsung.
    - [x] Pembersihan dan normalisasi DOM HTML mentah agar bebas iklan dan navigasi sebelum dikirim ke LLM.
- [x] **Optimasi Cache & Queue Worker:**
    - [x] Konfigurasi masa kadaluarsa hasil pencarian (_Cache TTL_) selama 7 hari agar hemat biaya token API.
    - [x] Konfigurasi _failed job handling_ pada Laravel Queue jika provider AI mengalami kendala koneksi.

---

## 📈 Fase 3: Fitur Ekstrem & Pelaporan Enterprise (Selesai ✅)

Fase lanjutan untuk melengkapi kebutuhan pengguna bisnis tingkat tinggi.

- [x] **Ekspor Laporan Resmi (PDF Generation):**
    - [x] Menambahkan tombol unduh laporan due diligence berformat PDF dengan kop surat resmi TrustCheck AI.
- [x] **Komparasi Reputasi Perusahaan (Company Comparison):**
    - [x] Fitur membandingkan 2 atau 3 perusahaan sekaligus dalam satu layar bertabel berdampingan.
- [x] **Panel Admin & Analitik Penggunaan Token:**
    - [x] Dasbor internal untuk memantau jumlah pencarian harian, rata-rata Trust Score, dan konsumsi token API AI.

---

## 🛡️ Fase 4: Keamanan & Proteksi Penyalahgunaan (Selesai ✅)

Fase persiapan keamanan sistem sebelum diluncurkan ke publik agar tidak rentan serangan bot dan kebocoran kuota LLM.

- [x] **Proteksi Rute dengan Permission & Logging Aktivitas:**
    - [x] Menginstal dan mengonfigurasi `spatie/laravel-permission` untuk proteksi rute berbasis izin spesifik (_permission-based_, tanpa mengandalkan _role_).
    - [x] Menginstal `spatie/laravel-activitylog` untuk mencatat riwayat pencarian dan aktivitas analitik due diligence AI.
- [x] **Halaman Login & URL Netral Tanpa Nama Role:**
    - [x] Menghapus tombol link dasbor dari portal publik.
    - [x] Mengubah rute dasbor kelola dari `/admin` menjadi URL netral `/portal-kelola` yang dilindungi _middleware permission_ Spatie (`permission:access_portal_kelola`).
    - [x] Membuat fitur Autentikasi Login (`/login`) untuk pengelola sistem.
- [x] **FAQ Dinamis Interaktif:**
    - [x] Menampilkan pusat bantuan FAQ di portal utama publik (_Accordion_) yang dapat dikelola (CRUD) secara dinamis melalui `/portal-kelola/faq`.
- [x] **Adopsi Standar Ekosistem Laravel 12:**
    - [x] Menerapkan standar penulisan _Laravel AI SDK_ (`laravel.com/docs/12.x/ai-sdk`) melalui rancangan modular AiAnalyzer dengan dukungan multi-LLM driver.
    - [x] Merencanakan & merancang integrasi _Laravel MCP Server_ (`laravel.com/docs/12.x/mcp`) agar agen eksternal dapat mengecek Trust Score secara programatik.
    - [x] Merencanakan & mengadopsi _Laravel Boost_ (`laravel.com/docs/12.x/boost`) untuk akselerasi performa tingkat lanjut.
- [x] **Pembatasan Kecepatan Pencarian (Rate Limiting):**
    - [x] Menerapkan _throttling_ pada endpoint `POST /search` (`throttle:search`, maksimal 5 pencarian per menit per IP).
- [x] **Integrasi Proteksi Anti-Bot:**
    - [x] Menambahkan dukungan verifikasi transparan Cloudflare Turnstile pada form pencarian portal utama.
- [x] **Sanitasi Anti-Prompt Injection AI:**
    - [x] Memperkuat filter input nama perusahaan dengan regex khusus untuk mendeteksi dan menolak anomali atau instruksi manipulatif terhadap model AI.

---

## ⚡ Fase 5: Optimasi Kinerja & SEO Production (Selesai ✅)

Fase peningkatkan kecepatan muat, keandalan antrean latar belakang, dan visibilitas organik di mesin pencari.

- [x] **Konfigurasi Worker Antrean Production:**
    - [x] Menyiapkan pedoman pemrosesan _background job_ menggunakan Supervisor atau Laravel Horizon (`docs/queue-worker-production.md`).
- [x] **Metadata SEO Dinamis & OpenGraph (OG Tags):**
    - [x] Menyematkan meta tag sosial dinamis pada halaman laporan agar menampilkan kartu cuplikan saat dibagikan ke media sosial.
- [x] **Generator Sitemap Otomatis (`/sitemap.xml`):**
    - [x] Membuat rute sitemap untuk mendaftarkan indeks tautan seluruh perusahaan berstatus `completed` ke Google Search Console.

---

## 📊 Fase 6: Pemantauan Real-Time & Reliability (Roadmap Production)

Fase pemeliharaan jangka panjang untuk mendeteksi _downtime_ provider AI dan mengumpulkan umpan balik pengguna.

- [ ] **Notifikasi Error Real-Time:**
    - [ ] Menghubungkan _Exception Handler_ aplikasi ke channel peringatan darurat (Telegram / Sentry) jika API LLM gagal merespons.
- [ ] **Endpoint Pemantauan Kesehatan (`/up`):**
    - [ ] Pengecekan otomatis status database dan waktu respons API eksternal.
- [ ] **Fitur Umpan Balik Koreksi Data:**
    - [ ] Menambahkan opsi interaktif bagi pengguna publik untuk melaporkan ketidakakuratan data hasil analisis AI.
