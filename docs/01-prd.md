# Product Requirements Document (PRD)

# Project: TrustCheck AI

### AI Company Reputation & Due Diligence Search Engine

**Version:** 1.0 (MVP)
**Status:** Draft

---

# 1. Executive Summary

TrustCheck AI adalah mesin pencari (Search Engine) berbasis AI yang membantu pengguna melakukan **due diligence awal** terhadap sebuah perusahaan.

Berbeda dengan website review, TrustCheck AI **tidak menerima review dari pengguna** dan **tidak membuat opini sendiri**.

Aplikasi akan:

- mencari informasi publik dari internet
- mengambil data dari berbagai sumber
- melakukan ekstraksi informasi
- melakukan normalisasi data
- menghilangkan informasi duplikat
- melakukan AI Summarization
- menghasilkan laporan yang mudah dipahami

Sehingga pengguna tidak perlu membuka puluhan website hanya untuk mencari apakah sebuah perusahaan layak diajak bekerja sama.

---

# 2. Product Vision

Menjadi "Google + AI" khusus untuk mengecek reputasi perusahaan berdasarkan informasi publik yang tersedia di internet.

---

# 3. Product Positioning

Bukan:

❌ Website Review

❌ Forum

❌ Media Berita

❌ Legal Advisor

Tetapi:

✅ AI Company Intelligence

✅ Company Due Diligence

✅ Public Information Aggregator

✅ Company Reputation Search Engine

---

# 4. Goals

Memudahkan pengguna sebelum:

- Melamar kerja
- Menjadi vendor
- Menjadi supplier
- Menjadi investor
- Menandatangani kontrak
- Menggunakan jasa perusahaan
- Membeli franchise
- Menjadi partner bisnis

---

# 5. Target User

- Job Seeker
- Freelancer
- Procurement
- Purchasing
- Vendor
- Investor
- Startup Founder
- UMKM
- Enterprise

---

# 6. MVP Scope

Versi pertama hanya memiliki:

```
Homepage

↓

Search

↓

Data Collection

↓

AI Analysis

↓

Result
```

Tidak ada:

- Login
- Register
- Subscription
- User Review
- Dashboard
- Admin Panel kompleks (cukup internal)

---

# 7. System Architecture

Karena **tidak memiliki API resmi**, seluruh data diperoleh melalui proses agregasi informasi publik.

```
User Search

↓

Search Engine

↓

Collector

↓

Scraper / MCP

↓

Normalizer

↓

AI Analysis

↓

Result Page
```

---

# 8. Data Collection Strategy

Sistem menggunakan beberapa metode secara bertahap (fallback mechanism).

## Level 1 — MCP Server (Prioritas)

Jika tersedia MCP Server untuk sumber tertentu, gunakan terlebih dahulu.

Contoh:

- Browser MCP
- Firecrawl MCP
- Playwright MCP
- Brave Search MCP
- Tavily MCP
- DuckDuckGo MCP
- Exa MCP
- GitHub MCP (jika perusahaan open source)
- LinkedIn MCP (jika tersedia)
- Reddit MCP
- News MCP

Kelebihan:

- Lebih stabil
- Lebih cepat
- Lebih mudah dipelihara

---

## Level 2 — Search Engine

Jika MCP gagal.

Cari menggunakan:

Google Query

```
PT ABC Indonesia
```

atau

```
PT ABC Indonesia review
```

atau

```
PT ABC Indonesia scam
```

atau

```
PT ABC Indonesia reddit
```

Kemudian ambil halaman yang relevan.

---

## Level 3 — Scraping

Jika data belum cukup.

Gunakan:

- Playwright
- Puppeteer
- Firecrawl
- Crawl4AI
- BeautifulSoup (Python Worker)

Untuk mengambil informasi publik.

---

## Level 4 — AI Extraction

Setelah HTML diperoleh.

AI akan melakukan:

- membaca halaman
- mengambil informasi penting
- menghapus iklan
- menghapus navigasi
- menghapus footer
- menghapus duplicate content

Output menjadi structured JSON.

---

# 9. Data Sources

## Company Website

Cari:

- nama
- alamat
- email
- nomor telepon
- layanan
- tahun berdiri
- partner
- client
- sertifikasi

---

## Google Search

Cari:

- company review
- complaint
- scam
- fraud
- lawsuit
- award
- partnership

---

## News

Ambil berita dari media online.

AI akan merangkum.

---

## Reddit

Cari diskusi.

AI mengambil:

- top positive discussion
- top negative discussion
- frequently mentioned issue

---

## Glassdoor

Jika tersedia secara publik.

Ambil:

- work culture
- management
- salary
- recommendation

---

## Trustpilot

Jika tersedia.

Ambil:

- rating
- jumlah review
- AI Summary

---

## LinkedIn

Jika ada.

Ambil:

- company size
- industry
- followers
- active posting

---

## WHOIS

Cari

- umur domain
- registrar
- expiry
- creation date

---

## Website Technical Analysis

- SSL
- HTTPS
- Mobile Friendly
- Performance
- Security Header
- DNS

---

# 10. AI Pipeline

```
Collect Data

↓

HTML Cleaning

↓

Duplicate Removal

↓

Content Extraction

↓

Fact Extraction

↓

Entity Detection

↓

Sentiment Analysis

↓

Topic Detection

↓

Risk Analysis

↓

Trust Score

↓

Summary Generation
```

---

# 11. AI Output

AI tidak boleh membuat opini.

AI hanya boleh:

✅ Merangkum

✅ Menjelaskan

✅ Membandingkan

✅ Mengutip fakta

AI tidak boleh mengatakan:

```
Perusahaan ini penipu.
```

AI hanya boleh mengatakan:

```
Ditemukan beberapa keluhan publik mengenai...

Tidak ditemukan bukti publik mengenai...

Mayoritas sumber menyatakan...
```

---

# 12. Trust Score

Contoh bobot.

| Faktor           | Bobot |
| ---------------- | ----- |
| Website          | 10    |
| Domain           | 10    |
| Public Review    | 25    |
| News             | 20    |
| Company Profile  | 15    |
| Digital Presence | 10    |
| AI Confidence    | 10    |

Total

100

---

# 13. Homepage UI

```
---------------------------------------------------

TrustCheck AI

Cari reputasi perusahaan sebelum
Anda bekerja sama.

_________________________________

Masukkan nama perusahaan

             [ Search ]

---------------------------------------------------
```

---

# 14. Result Page

## Header

```
PT ABC Indonesia

Technology

Jakarta

Website
```

---

## Trust Score

```
92 / 100

★★★★★

LOW RISK
```

---

## AI Summary

```
Perusahaan memiliki reputasi baik
berdasarkan berbagai sumber publik.

Mayoritas ulasan menunjukkan
pelayanan yang profesional.

Tidak ditemukan indikasi publik
mengenai tindakan penipuan.

Disarankan tetap membaca kontrak
sebelum bekerja sama.
```

---

## Company Profile

Card

```
Website

Industry

Head Office

Email

Phone

Founded

Employees
```

---

## Public Reputation

Progress Bar

```
Review

92%

News

89%

Website

94%

Digital Presence

88%
```

---

## Positive Topics

```
Professional

Fast Payment

Good Support

Quality Product

Communication
```

---

## Negative Topics

```
Slow Response

Refund

Documentation
```

---

## Website Health

```
HTTPS

SSL

Domain Age

Hosting

Security

Performance
```

---

## News Summary

Timeline.

---

## Public Sources

Grid.

Setiap card berisi:

```
Source

Status

Confidence

Last Updated

Summary
```

---

## References

Semua sumber ditampilkan.

Misalnya:

```
Official Website

LinkedIn

Glassdoor

Trustpilot

News

Reddit
```

User dapat membuka sumber asli untuk verifikasi.

---

## Disclaimer

```
Laporan ini dibuat berdasarkan informasi
yang tersedia secara publik.

AI hanya merangkum data yang berhasil
dikumpulkan dan tidak memberikan
kesimpulan hukum maupun finansial.

Pengguna tetap disarankan melakukan
due diligence lanjutan sebelum
mengambil keputusan.
```

---

# 15. Teknologi

## Backend & Audit Security

Laravel 12 (PHP 8.2+)

Spatie Permission (Proteksi hak akses berbasis izin dengan *bypass all* untuk role `superadmin`)

Spatie Activitylog (Pencatatan riwayat audit dan penelusuran *due diligence*)

DOMPDF (Ekspor dokumen laporan resmi PDF)

---

## Frontend

Blade

Tailwind CSS v4

AlpineJS

---

## Database

MariaDB / MySQL

---

## Queue

Laravel Queue (Pemrosesan latar belakang asinkron)

---

## AI Providers (Fleksibel)

OpenAI (GPT-4o)

Google Gemini (Gemini 2.5 Flash)

Anthropic Claude (Sonnet 3.5)

OpenRouter (Multi-model gateway)

Custom Base URL (Ollama / Local LLM)

---

## Scraping Worker

Python

Playwright

Firecrawl

BeautifulSoup

Crawl4AI

---

## MCP Server (Opsional tetapi Sangat Direkomendasikan)

Agar arsitektur fleksibel, semua koneksi ke sumber data sebaiknya melalui lapisan adapter sehingga mudah mengganti implementasi tanpa mengubah aplikasi utama.

Contoh adapter yang dapat digunakan:

- Browser MCP
- Firecrawl MCP
- Playwright MCP
- Brave Search MCP
- Tavily MCP
- Exa MCP
- Reddit MCP
- News MCP
- Generic HTTP Fetch MCP

Dengan pola adapter, jika suatu sumber berubah struktur HTML atau tersedia API resmi di masa depan, Anda cukup mengganti adapter tanpa mengubah logika bisnis.

---

# 16. Catatan Teknis Penting

Karena proyek ini akan mengandalkan scraping dan MCP, ada beberapa tantangan yang perlu dipertimbangkan sejak awal:

- **Legalitas penggunaan data:** Hormati Terms of Service setiap situs. Jika suatu sumber melarang scraping, pertimbangkan untuk tidak menggunakannya atau gunakan data yang memang tersedia secara publik melalui mekanisme yang diizinkan.
- **Rate limiting:** Terapkan antrean (queue), pembatasan kecepatan, dan cache agar tidak membebani situs sumber.
- **Normalisasi data:** Nama perusahaan sering memiliki variasi (misalnya "PT ABC", "PT ABC Indonesia", "ABC Indonesia"), sehingga perlu algoritma pencocokan (fuzzy matching) untuk menghindari hasil yang salah.
- **Transparansi:** Selalu tampilkan daftar sumber yang berhasil digunakan, waktu pengambilan data, dan tingkat kepercayaan (confidence score) agar pengguna dapat memverifikasi hasil sendiri.
- **Arsitektur modular:** Pisahkan komponen menjadi `Search Orchestrator`, `Source Adapters`, `Content Extractor`, `AI Analyzer`, dan `Scoring Engine`. Dengan begitu, Anda bisa menambah atau mengganti sumber data tanpa memengaruhi modul lain.

## Roadmap yang Saya Sarankan

Alih-alih langsung mendukung puluhan sumber, bangun secara bertahap:

**Fase 1 (MVP)**

- Website resmi perusahaan
- Mesin pencari (melalui MCP/Search)
- Ringkasan AI
- Analisis website dan domain
- Berita publik

**Fase 2**

- Reddit
- LinkedIn
- Trustpilot
- Glassdoor
- Analisis sentimen lintas sumber

**Fase 3**

- Perbandingan beberapa perusahaan
- Riwayat perubahan reputasi
- Monitoring otomatis jika ada berita baru
- Ekspor laporan PDF
- API untuk integrasi dengan sistem procurement atau CRM

Pendekatan bertahap ini akan membuat pengembangan lebih realistis, mengurangi risiko pemeliharaan, dan memudahkan validasi apakah hasil analisis benar-benar bermanfaat bagi pengguna sebelum menambah kompleksitas.
