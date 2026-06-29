# Panduan Konfigurasi API & Environment (.env) — TrustCheck AI

Dokumen ini adalah panduan resmi cara mendapatkan kunci API (*API Key*) dan mengonfigurasi variabel *environment* (`.env`) untuk mengaktifkan mesin pengumpul data (*Scraping Engine*) dan analisis kecerdasan buatan (*AI Provider*) pada aplikasi **TrustCheck AI**.

---

## 1. Konfigurasi AI Provider (LLM)

TrustCheck AI mendukung berbagai penyedia model AI melalui arsitektur modular (*Adapter Pattern*). Anda cukup memilih salah satu provider pada `AI_PROVIDER` dan mengisi kredensial terkait.

### Pilihan Pengaturan Dasar
```env
# Pilihan opsi AI_PROVIDER: openai, gemini, claude, openrouter, custom
AI_PROVIDER=gemini
AI_TIMEOUT=30
```

---

### A. Google Gemini API (Rekomendasi Utama & Gratis/Murah)
Model Gemini sangat cepat dan memiliki *context window* besar untuk memproses teks ulasan publik dan berita panjang.

- **Cara Mendapatkan API Key:**
  1. Kunjungi [Google AI Studio](https://aistudio.google.com/).
  2. Login menggunakan akun Google Anda.
  3. Klik tombol **"Get API key"** atau **"Create API key"**.
  4. Salin kunci yang dihasilkan dan tempel ke dalam `.env`.
- **Konfigurasi `.env`:**
  ```env
  GEMINI_API_KEY=AIzaSy...
  GEMINI_MODEL=gemini-2.5-flash
  ```

---

### B. OpenAI API (ChatGPT)
Standar industri dengan kemampuan analisis penalaran yang stabil dan terstruktur.

- **Cara Mendapatkan API Key:**
  1. Kunjungi [OpenAI Developer Platform](https://platform.openai.com/).
  2. Masuk ke menu **Dashboard** → **API Keys** → klik **"Create new secret key"**.
  3. Pastikan akun Anda memiliki saldo/tagihan aktif (*Billing*).
- **Konfigurasi `.env`:**
  ```env
  OPENAI_API_KEY=sk-proj-...
  OPENAI_MODEL=gpt-4o-mini
  ```

---

### C. Anthropic Claude API
Model dengan kemampuan menulis ringkasan yang sangat natural, bernuansa formal, dan mematuhi aturan objektivitas dengan ketat.

- **Cara Mendapatkan API Key:**
  1. Kunjungi [Anthropic Console](https://console.anthropic.com/).
  2. Masuk ke menu **API Keys** → klik **"Create Key"**.
- **Konfigurasi `.env`:**
  ```env
  CLAUDE_API_KEY=sk-ant-api03-...
  CLAUDE_MODEL=claude-3-5-sonnet-20241022
  ```

---

### D. OpenRouter API (Akses Multi-Model dalam 1 Key)
Gerbang aggregator yang memungkinkan Anda mengakses ratusan model AI (Llama 3, Mistral, Gemini, Claude, OpenAI) menggunakan satu saldo saldo prabayar.

- **Cara Mendapatkan API Key:**
  1. Kunjungi [OpenRouter.ai](https://openrouter.ai/).
  2. Buat akun dan masuk ke menu **Keys** → klik **"Create Key"**.
- **Konfigurasi `.env`:**
  ```env
  OPENROUTER_API_KEY=sk-or-v1-...
  OPENROUTER_MODEL=google/gemini-2.5-flash-001
  ```

---

### E. Custom LLM / Local AI (Ollama, vLLM, LM Studio)
Pilihan bagi perusahaan berskala enterprise yang menjalankan model AI sendiri di server lokal atau cloud pribadi atas alasan keamanan data (*Data Privacy*).

- **Konfigurasi `.env`:**
  ```env
  CUSTOM_AI_BASE_URL=http://localhost:11434/v1
  CUSTOM_AI_API_KEY=rahasia-lokal-123
  CUSTOM_AI_MODEL=llama3.3:70b
  ```

---

## 2. Konfigurasi Live Search & Scraping (Mesin Pengumpul Data)

Mesin *due diligence* membutuhkan informasi publik real-time (berita terbaru, putusan hukum, ulasan konsumen). TrustCheck AI didukung oleh beberapa penyedia *Search & Web Scraping*.

### Pilihan Pengaturan Dasar
```env
# Pilihan opsi SEARCH_PROVIDER: tavily, serpapi, firecrawl
SEARCH_PROVIDER=tavily
CACHE_TTL_DAYS=7
```
*(Catatan: `CACHE_TTL_DAYS=7` berarti laporan analisis perusahaan yang sudah selesai diproses akan disimpan di database lokal selama 7 hari sebelum sistem melakukan pencarian ulang untuk menghemat kuota API).*

---

### A. Tavily Search API (Rekomendasi Utama AI Search)
Tavily adalah mesin pencari yang dirancang khusus untuk agen AI. Hasilnya sudah bersih dari iklan dan langsung mengembalikan cuplikan teks relevan.

- **Cara Mendapatkan API Key:**
  1. Kunjungi [Tavily.com](https://tavily.com/).
  2. Daftar akun gratis (mendapatkan kuota gratis 1.000 pencarian/bulan).
  3. Salin API Key dari dashboard utama.
- **Konfigurasi `.env`:**
  ```env
  TAVILY_API_KEY=tvly-...
  ```

---

### B. SerpAPI (Google Search Aggregator)
Mengambil hasil pencarian langsung dari Google Search Engine Result Page (SERP) secara akurat, termasuk tab Berita (*Google News*).

- **Cara Mendapatkan API Key:**
  1. Kunjungi [SerpAPI.com](https://serpapi.com/).
  2. Daftar akun gratis (mendapatkan 100 pencarian gratis/bulan).
  3. Masuk ke dasbor akun Anda untuk melihat rahasia API Key.
- **Konfigurasi `.env`:**
  ```env
  SERPAPI_API_KEY=45a6b7c8d9...
  ```

---

### C. Firecrawl API (Deep Web Scraper & HTML Cleaner)
Digunakan untuk membuka tautan website resmi atau artikel berita dan mengekstrak seluruh isinya menjadi format *Markdown* bersih yang siap dibaca oleh LLM.

- **Cara Mendapatkan API Key:**
  1. Kunjungi [Firecrawl.dev](https://www.firecrawl.dev/).
  2. Daftar akun (tersedia kuota uji coba gratis 500 kredit).
  3. Klik menu **API Keys** untuk membuat kunci baru.
- **Konfigurasi `.env`:**
  ```env
  FIRECRAWL_API_KEY=fc-123456...
  ```

---

## Ringkasan Ekosistem Teknologi TrustCheck AI

| Komponen | Teknologi yang Digunakan | Penjelasan |
| :--- | :--- | :--- |
| **Backend Core** | PHP 8.2+, Laravel 12 | Kerangka kerja utama aplikasi berskala enterprise |
| **Styling & UI** | Tailwind CSS v4.0, Alpine.js | Desain UI modern berkapasitas sangat ringan tanpa virtual DOM berat |
| **Database** | MariaDB / MySQL | Penyimpanan relasional laporan perbandingan dan pengguna |
| **Audit & Keamanan** | Spatie Permission & Activitylog | Proteksi rute berbasis hak izin (*gate bypass superadmin*) & pencatatan log |
| **Ekspor Laporan** | DOMPDF (`barryvdh/laravel-dompdf`) | Generator laporan resmi *Due Diligence* berformat PDF |
