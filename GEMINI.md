# GEMINI — Dokumentasi & Aturan Kerja Project TrustCheck AI

Dokumen ini berisi informasi lengkap spesifikasi project **TrustCheck AI** sekaligus menjadi patokan aturan kerja wajib (*Rules & Conventions*) bagi AI Agent (Gemini) maupun developer dalam mengembangkan aplikasi ini. Dokumen ini bertindak sebagai pedoman utama (*single source of truth*) untuk seluruh keputusan penulisan kode, standar desain UI/UX, dan arsitektur sistem.

---

## BAGIAN I: INFORMASI PROJECT

### 1. Deskripsi & Latar Belakang
- **Nama Project:** TrustCheck AI (*AI Company Reputation & Due Diligence Search Engine*)
- **Objektif:** Mesin pencari (*Search Engine*) berbasis kecerdasan buatan yang membantu pengguna melakukan *due diligence* awal dan verifikasi reputasi sebuah perusahaan berdasarkan ekstraksi informasi publik sebelum mengambil keputusan bisnis (melamar kerja, menjadi vendor/supplier, investasi, atau penandatanganan kontrak).
- **Product Positioning:** TrustCheck AI **bukan** website review, forum, media berita, atau penasihat hukum. Aplikasi **tidak menerima review dari pengguna** dan **tidak membuat opini sendiri**. TrustCheck bertindak murni sebagai *Public Information Aggregator* dan *Company Intelligence*.
- **Alur Utama MVP:** `Homepage` → `Search` → `Data Collection` → `AI Analysis` → `Result Page`.

### 2. Tech Stack & Arsitektur
- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Laravel Blade, Tailwind CSS v4.0, Alpine.js (Arsitektur ringan, cepat, tanpa framework JS berat berlebihan).
- **Database:** MariaDB / MySQL.
- **Queue System:** Laravel Queue (Wajib digunakan untuk menangani proses scraping dan analisis AI di belakang layar agar tidak memblokir HTTP response).
- **AI Integration:** OpenAI API / Gemini API / Claude / OpenRouter / Custom Base URL + API Key (Mendukung fleksibilitas pergantian provider LLM). Digunakan untuk ekstraksi informasi, normalisasi, pembersihan HTML, analisis topik/sentimen, dan penyusunan ringkasan fakta.
- **Scraping & Data Aggregation Strategy:**
  - **Level 1 (Prioritas - Adapter Pattern):** MCP Servers (Browser MCP, Firecrawl MCP, Playwright MCP, Brave Search MCP, Tavily MCP, dll.).
  - **Level 2 (Fallback):** Google Search Queries (`PT ABC review`, `PT ABC scam`, dll).
  - **Level 3 (Fallback):** Scraping Workers (Python, Playwright, Firecrawl, BeautifulSoup, Crawl4AI).
  - **Level 4:** AI Extraction & Cleaning (Mengubah raw HTML menjadi structured JSON bebas duplikat/iklan).

### 3. Daftar Fitur MVP Scope (Fase 1)
1. **Homepage Pencarian Minimalis:** Antarmuka berfokus pada pencarian (*Search Bar* di tengah layar, contoh pencarian, pencarian populer, dan penjelasan singkat fitur). Tanpa kewajiban login, register, atau subscription.
2. **Mesin Pengumpul Data (*Data Collector Engine*):** Agregasi otomatis informasi publik dari website resmi perusahaan, berita online, data WHOIS domain, dan mesin pencari.
3. **Analisis AI Objektif & Trust Score:**
   - Menghasilkan **Trust Score (0 - 100)** berdasarkan bobot gabungan (Website 10%, Domain 10%, Public Review 25%, News 20%, Company Profile 15%, Digital Presence 10%, AI Confidence 10%).
   - Menyusun **AI Summary** faktual. AI dilarang keras membuat opini subjektif atau menghakimi (contoh dilarang: *"Perusahaan ini penipu"*). AI hanya boleh menggunakan diksi netral (contoh: *"Ditemukan beberapa keluhan publik mengenai..."* atau *"Tidak ditemukan bukti publik mengenai..."*).
4. **Result Page Komprehensif:**
   - Header & Quick Facts Panel Sidebar (Menampilkan angka Trust Score besar, label *Risk Level*, dan informasi dasar).
   - Tabel Profil Perusahaan (Website, Industry, Head Office, Email, Phone, Founded, Employees).
   - Reputasi Publik (Progress bar presentase positif/negatif dari berbagai kanal).
   - Topik Positif & Negatif (*Badges/Tags* untuk isu yang sering disebut).
   - Kesehatan Website & Analisis Teknis (Status HTTPS, SSL, umur domain, keamanan).
   - Ringkasan Berita (*Vertical Timeline*).
   - Referensi & Transparansi Sumber (*Accordion grid* menampilkan daftar sumber publik, status, *confidence score*, dan waktu pembaruan agar user dapat melakukan verifikasi mandiri).
   - Disclaimer Hukum yang jelas di bagian bawah laporan.
5. **Konfigurasi AI Provider Fleksibel:** Sistem mendukung integrasi berbagai penyedia layanan LLM (*OpenAI, Gemini, Claude, OpenRouter, atau Custom Base URL*) sehingga memudahkan pergantian model AI sesuai kebutuhan biaya dan performa tanpa mengubah logika bisnis utama.

---

## BAGIAN II: ATURAN KERJA AGENT (RULES & CONVENTIONS)

Jika terdapat konflik antara kebiasaan umum penulisan kode dengan aturan di bawah ini, maka aturan pada dokumen `GEMINI.md` ini yang **wajib diprioritaskan**.

### 1. Pedoman Utama & Bahasa Komunikasi
- **Single Source of Truth:** Seluruh pengembangan kode dan UI wajib mengacu pada `GEMINI.md`, `docs/prd.md`, dan `docs/design.md`.
- **Aturan Bahasa (Wajib):**
  - Seluruh elemen antarmuka yang dibaca oleh pengguna (*user-facing text*), seperti teks halaman web, **alert**, notifikasi *toast*, pesan error, *empty state*, label form, *placeholder*, dan teks *disclaimer* **WAJIB menggunakan Bahasa Indonesia** yang formal, profesional, jelas, dan baku.
  - Untuk struktur file, penamaan variabel, *function/method*, *controller*, *model*, migrasi database, dan komentar kode teknis diperbolehkan dan disarankan menggunakan **Bahasa Inggris** sesuai standar ekosistem Laravel.
  - **Aturan Disclaimer & Verifikasi Publik:** Seluruh laporan hasil analisis due diligence (web maupun PDF) serta jawaban FAQ wajib mencantumkan kalimat sanggahan standar: *"Karena data diekstraksi secara otomatis dari sumber terbuka publik, ketidakakuratan dapat terjadi jika situs sumber mengalami perubahan. Anda dapat melakukan verifikasi mandiri melalui daftar referensi sumber tautan yang kami sediakan di bagian bawah laporan."*
- **Integritas Kode:** Lakukan perubahan kode secara terisolasi dan spesifik. Dilarang menghapus fitur, komentar, atau file lain yang tidak terkait langsung dengan instruksi kerja.

### 2. Aturan UI/UX & Design Philosophy (Mengacu pada `docs/design.md`)
- **Konsep Visual:** *Modern Enterprise, Flat Design, Professional, Trust, Fast, Clean, Minimal*. Tampilan harus terasa seperti aplikasi bisnis tingkat enterprise (sekelas Stripe, GitHub, Notion, Linear, atau Cloudflare).
- **Pantangan Keras Desain (*Strictly Forbidden*):**
  - ❌ **Dilarang** menggunakan *Glassmorphism, Neon UI, Heavy Gradients, Blur Background*, atau efek *Morphism/Skeuomorphism*.
  - ❌ **Dilarang** membuat UI yang terlihat seperti *AI Chatbot standar, Crypto Dashboard, Gaming UI*, atau *Landing Page* startup yang berlebihan.
  - ❌ **Dilarang** menggunakan animasi berlebihan (*No bounce, zoom, rotate, pulse, floating*). Gunakan transisi halus maksimal 150ms *ease* untuk efek *hover*.
  - ❌ **Dilarang** menggunakan ilustrasi AI stereotipikal (seperti gambar robot, otak bercahaya, sirkuit komputer, atau *neural network*).
  - ❌ **Dilarang** menggunakan *Speedometer, Gauge*, atau *Pie Chart* untuk indikator skor/reputasi. Gunakan angka besar bergaya tipografi bersih dan *Progress Bar* vertikal/horizontal.
- **Palet Warna & Elemen UI (Tailwind CSS v4):**
  - *Primary:* Blue 600 (`#2563EB`), Hover: `#1D4ED8`.
  - *Background:* Neutral Light (`#F8FAFC`), Surface/Card: White (`#FFFFFF`).
  - *Text:* Primary (`#0F172A`), Secondary (`#475569`), Muted (`#64748B`).
  - *Status Alert/Badge:* Success Green (`#16A34A`), Warning Orange (`#D97706`), Danger Red (`#DC2626`), Info Blue (`#0284C7`).
  - *Border & Radius:* Card di batasi dengan *border* tipis (`1px solid #E5E7EB`) dan *shadow* sangat halus (`shadow-sm` atau `shadow-md`). Border radius maksimal `16px` (Small `8px`, Medium `12px`, Large `16px`).
- **Tipografi & Readability:** Gunakan font Inter, Geist, atau Plus Jakarta Sans. Kontras warna minimal memenuhi standar WCAG AA agar sangat mudah dibaca.
- **Standar State UI:**
  - *Loading State:* Wajib menggunakan **Skeleton Loading** yang rapi memvisualisasikan layout card (bukan *spinner* putar berukuran besar).
  - *Empty State:* Tampilkan ikon sederhana (Lucide Icons), penjelasan singkat dalam Bahasa Indonesia, dan tombol pencarian ulang.
  - *Error State:* Tampilkan dalam card merah berborder tipis dengan ikon alert dan pesan kesalahan yang edukatif dalam Bahasa Indonesia.
  - *Notification / Alert:* Wajib menggunakan **Global Floating Toast Alert** (berbasis Alpine.js di sudut layar) untuk menampilkan pesan sukses atau error dari sesi balasan controller. Dilarang menggunakan kotak alert statis konvensional di dalam layout halaman.

### 3. Arsitektur Backend & Keamanan AI
- **Desain Modular (Adapter Pattern):** Komponen pengumpul data harus dipisahkan menjadi modul terisolasi (`SearchOrchestrator`, `SourceAdapters`, `ContentExtractor`, `AiAnalyzer`, dan `ScoringEngine`). Hal ini memastikan sistem tetap fleksibel jika struktur HTML sumber berubah atau jika API resmi ditambahkan di masa depan.
- **Penanganan Error API LLM & Scraping (*Fallback Mechanism*):**
  - Setiap integrasi eksternal (OpenAI/Gemini/Claude/OpenRouter/Custom LLM/Scraper/MCP) wajib dibungkus dengan *try-catch* dan batas waktu (*timeout*) yang ketat.
  - Jika satu sumber data mengalami kegagalan (*rate limit/block*), sistem harus melanjutkan agregasi dari sumber lain yang tersedia tanpa menyebabkan aplikasi *crash* (HTTP 500).
- **Optimasi Kinerja & Caching:**
  - Gunakan Laravel Queue untuk pemrosesan berat di latar belakang.
  - Implementasikan sistem *cache* database untuk menyimpan hasil analisis due diligence perusahaan yang sudah diproses dalam kurun waktu tertentu agar menghemat biaya API dan mempercepat waktu respons pencarian serupa.
- **Keamanan & Validasi Input:**
  - Simpan seluruh API Key dan kredensial sensitif hanya pada file `.env`.
  - Lakukan sanitasi dan validasi ketat terhadap input pencarian nama perusahaan menggunakan regex anti-anomali untuk mencegah *Prompt Injection AI* (seperti instruksi override LLM), XSS, dan SQL Injection.
  - **Proteksi Anti-Bot & Rate Limiting:** Endpoint pencarian (`POST /search`) wajib dilindungi oleh rate limiter `throttle:search` (maksimal 5 pencarian per menit per IP di luar unit test) serta verifikasi transparan Cloudflare Turnstile jika rahasia dikonfigurasi di environment.
- **Proteksi Hak Akses & Role Superadmin:**
  - URL pengelolaan sistem wajib bersifat netral tanpa nama role (contoh: `/portal-kelola`). Dilarang menggunakan `/admin` atau menampilkan link kelola di portal publik.
  - Role utama sistem bernama `superadmin`. Menggunakan override `Gate::before` di `AppServiceProvider.php` sehingga `superadmin` selalu memiliki seluruh hak izin (*permission bypass*). Seeder pembuatan akun utama wajib disimpan di `UserSeeder.php` terpisah.

### 4. Arsitektur Folder & Asset
- **Asset Statis:** File CSS kustom, JS, gambar, dan font disimpan di dalam `public/assets/`.
- **Controller:** Berada di subfolder terstruktur `app/Http/Controllers/Auth/`, `app/Http/Controllers/Frontend/`, dan `app/Http/Controllers/Backend/` agar sejajar dengan pembagian direktori tampilan pada `resources/views/`.
- **Model:** Berada di `app/Models/`.
- **Service & Adapter:** Logika pengumpulan data eksternal dan AI disimpan terstruktur di `app/Services/` atau `app/Adapters/`.
- **View:**
  - Halaman portal pencarian utama dan hasil due diligence berada di `resources/views/frontend/` atau subfolder modul terkait.
  - Layout utama berada di `resources/views/layouts/`.
- **Larangan Folder Partials:** Jangan membuat folder atau view bertipe `partials`. Markup UI wajib ditulis penuh di dalam file view fitur terkait agar kode tetap mudah ditelusuri dalam satu file.
- **Pengaturan Sistem:** Identitas sistem (Judul aplikasi, konfigurasi LLM aktif, API Key) bersumber dari `.env` atau tabel pengaturan/config, tidak boleh di-*hardcode* di dalam view atau controller.

### 5. File Layout Utama

| Layout | File Path | Penggunaan |
| :--- | :--- | :--- |
| **Frontend** | `resources/views/layouts/app-frontend.blade.php` | Halaman portal pencarian utama dan halaman hasil analisis due diligence |
| **Backend / Kelola** | `resources/views/layouts/app-backend.blade.php` | Halaman portal kelola sistem internal (`/portal-kelola`) |

### 6. Konvensi Layout & Blade
- **Pembatasan Yield:** Layout utama hanya boleh menyediakan satu `@yield('content')` sebagai slot area konten utama.
- **Pengiriman Title & Metadata SEO:** Judul halaman dan metadata SEO (seperti `$metaDescription`, `$ogTitle`, `$ogDescription`, `$canonicalUrl`) dikirim langsung dari associative array `$data` di Controller untuk dirender pada layout utama (`app-frontend.blade.php`). Jangan menambahkan `@yield('title')`, `@yield('styles')`, atau `@yield('scripts')` baru. Generator sitemap otomatis tersedia di rute `/sitemap.xml` melalui `SitemapController`.
- **Pemanfaatan Asset & Tailwind CSS v4:** Seluruh styling wajib menggunakan Tailwind CSS v4. Ikuti aturan standar Tailwind v4 berikut agar tidak menimbulkan warning/error:
  - Gunakan `shrink-0` (bukan `flex-shrink-0`).
  - Gunakan `grow` (bukan `flex-grow`).
  - Gunakan `inset-s-0` / `inset-e-0` (bukan `start-0` / `end-0`).
  - Gunakan `bg-linear-to-r` (bukan `bg-gradient-to-r`).
  - Ikon antarmuka menggunakan **Lucide Icons** sesuai arahan `docs/design.md`.
- **Larangan Query di Blade:** Dilarang keras melakukan query database atau memanggil Eloquent langsung di dalam file `.blade.php` (contoh: `Company::get()`). Seluruh data harus disiapkan oleh controller.
- **Larangan Blok PHP di View:** Hindari penggunaan tag `@php ... @endphp` atau `<?php ... ?>` di dalam Blade. Pemetaan warna status (*badge*), kalkulasi skor, atau logika kondisional harus diproses di Controller, Service, atau Helper.
- **Keutuhan Form & Halaman:** Halaman web wajib ditulis secara utuh dan mandiri. Jangan menggunakan `@include()` untuk memotong komponen utama.

### 7. Konvensi Controller & Eloquent Model
- **Passing Data ke View:** Gunakan return view dengan associative array `$data` (contoh: `return view('frontend.search.result', $data);`). Dilarang menggunakan fungsi `compact()`.
- **Parameter Route:** Method controller menerima parameter ID bertipe string: `public function show(string $id)`, **bukan** *Implicit Route Model Binding*.
- **Pencarian Data Eksplisit:** Ambil data di dalam method menggunakan `Model::findOrFail($id)`.
- **Validasi Request:** Selalu gunakan `$request->validate([...])` secara eksplisit sebelum melakukan pemrosesan data. Hindari penggunaan `$request->all()`.
- **Transaksi Database:** Gunakan `DB::transaction()` untuk operasi yang melibatkan manipulasi beberapa tabel sekaligus.

### 8. Tabel Pedoman Penamaan

| Elemen | Konvensi | Contoh |
| :--- | :--- | :--- |
| **File View** | `snake_case.blade.php` | `index.blade.php`, `result.blade.php`, `company_profile.blade.php` |
| **Folder View** | `lowercase` sesuai modul | `frontend/search`, `frontend/company`, `layouts` |
| **Controller** | `PascalCase + Controller` | `SearchController.php`, `CompanyController.php`, `AiAnalysisController.php` |
| **Model** | `PascalCase` (Tunggal) | `Company.php`, `SearchHistory.php`, `TrustScore.php` |
| **Service/Adapter**| `PascalCase` | `SearchOrchestrator.php`, `OpenAiAdapter.php`, `FirecrawlAdapter.php` |
| **Route Name** | `dot.notation` | `search.index`, `company.show`, `analysis.process` |
| **File Layout** | `app-[nama].blade.php` | `app-frontend.blade.php`, `app-backend.blade.php` |

### 9. Alur Menambah Halaman / Fitur Baru
1. Buat file view baru di `resources/views/frontend/[modul]/nama_blade.blade.php`.
2. Gunakan `@extends('layouts.app-frontend')` dan `@section('content')`.
3. Di dalam Controller, siapkan array `$data['title'] = 'Judul Halaman';` beserta data model atau hasil ekstraksi AI yang dibutuhkan.
4. Daftarkan route di `routes/web.php` dengan penamaan `dot.notation`.

### 10. Aturan Git Commit & Auto-Push

Setiap selesai pengerjaan instruksi, agent wajib melakukan **auto commit dan push** dengan aturan penulisan pesan commit:

#### A. Struktur Pesan
`type(scope): subject`

- **Type (huruf kecil):**
  - `feat`: Menambahkan fitur baru.
  - `fix`: Memperbaiki bug.
  - `docs`: Perubahan dokumentasi.
  - `refactor`: Perubahan kode yang tidak memperbaiki bug atau menambah fitur.
  - `test`: Menambahkan atau memperbaiki tes.
  - `chore`: Pekerjaan rutin seperti build atau manajemen dependensi.
- **Scope:** (Opsional) Bagian kode yang diubah dalam tanda kurung, contoh: `(search)`, `(ai)`, `(ui)`.
- **Subject:** Deskripsi singkat perubahan menggunakan kalimat imperatif (contoh: "tambahkan", "ubah", bukan "menambahkan" atau "mengubah").

#### B. Aturan 50/72
- **Maksimal 50 Karakter:** Baris subjek/judul tidak boleh lebih dari 50 karakter.
- **Maksimal 72 Karakter:** Bagian isi (*body*) dibungkus maksimal 72 karakter per baris.

#### C. Best Practices
- Gunakan huruf kecil, kecuali untuk kata pertama pada kalimat deskripsi di body.
- Selalu beri jarak satu baris kosong antara judul commit dan isi penjelasan (*body*).
- Fokus pada **mengapa** perubahan dibuat, bukan bagaimana cara kerjanya.
