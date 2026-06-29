# Roadmap & Task List — TrustCheck AI

Dokumen ini berisi daftar tugas (*task breakdown*) tahap demi tahap dalam pengembangan **TrustCheck AI** dari fase MVP hingga rilis penuh berstandar enterprise.

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
- [x] Membangun `ScoringEngine` untuk menghitung Trust Score (0-100) dan mengkategorikan Risk Level (*Low Risk, Medium Risk, High Risk*).

### 3. Backend Controller & Background Job
- [x] Membuat `ProcessDueDiligenceJob` untuk memproses agregasi data di latar belakang.
- [x] Membuat `SearchController` dengan sanitasi input pencegahan injeksi, validasi ketat, dan sistem *caching* pencarian.
- [x] Mendaftarkan rute pencarian dan hasil pada `routes/web.php` dengan konvensi *dot notation*.

### 4. Antarmuka Pengguna (Tailwind CSS v4 + Alpine.js)
- [x] Menyusun layout utama `app-frontend.blade.php` bergaya *Modern Enterprise* dengan font *Plus Jakarta Sans*.
- [x] Membangun halaman beranda `index.blade.php` dengan *Hero Search Bar* dan daftar pencarian populer.
- [x] Membangun halaman `loading.blade.php` dengan tampilan *Skeleton Loading* profesional dan AJAX polling otomatis.
- [x] Membangun laporan lengkap `result.blade.php` meliputi Trust Score besar, badges topik, breakdown skor, kesehatan website, timeline berita, dan transparansi referensi publik.

---

## 🚀 Fase 2: Integrasi Live MCP & Caching Lanjutan (Selesai ✅)

Fase ini bertujuan untuk menghubungkan adapter pengumpul data ke sumber eksternal waktu nyata (*real-time*).

- [x] **Integrasi Search Engine API Asli:**
  - [x] Menghubungkan `GoogleSearchAdapter` ke layanan Brave Search API / SerpAPI / Tavily MCP.
  - [x] Menambahkan validasi batas kuota harian (*rate limiting*) pada API pencarian eksternal.
- [x] **Integrasi Web Scraper Worker:**
  - [x] Menghubungkan `WebsiteScraperAdapter` dengan Firecrawl MCP atau Playwright untuk ekstraksi metadata WHOIS dan SSL secara langsung.
  - [x] Pembersihan dan normalisasi DOM HTML mentah agar bebas iklan dan navigasi sebelum dikirim ke LLM.
- [x] **Optimasi Cache & Queue Worker:**
  - [x] Konfigurasi masa kadaluarsa hasil pencarian (*Cache TTL*) selama 7 hari agar hemat biaya token API.
  - [x] Konfigurasi *failed job handling* pada Laravel Queue jika provider AI mengalami kendala koneksi.

---

## 📈 Fase 3: Fitur Ekstrem & Pelaporan Enterprise (Roadmap)

Fase lanjutan untuk melengkapi kebutuhan pengguna bisnis tingkat tinggi.

- [ ] **Ekspor Laporan Resmi (PDF Generation):**
  - [ ] Menambahkan tombol unduh laporan due diligence berformat PDF dengan kop surat resmi TrustCheck AI.
- [ ] **Komparasi Reputasi Perusahaan (Company Comparison):**
  - [ ] Fitur membandingkan 2 atau 3 perusahaan sekaligus dalam satu layar bertabel berdampingan.
- [ ] **Panel Admin & Analitik Penggunaan Token:**
  - [ ] Dasbor internal untuk memantau jumlah pencarian harian, rata-rata Trust Score, dan konsumsi token API AI.
