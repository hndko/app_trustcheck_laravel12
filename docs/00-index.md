# Indeks Dokumentasi Resmi TrustCheck AI

Direktori ini berisi seluruh pedoman, rancangan arsitektur, spesifikasi teknis, dan status roadmap pengembangan project **TrustCheck AI** yang disusun dengan penomoran otomatis berurutan (*logical reading order*).

---

## 📚 Daftar Dokumen

1. [**01-prd.md**](file:///d:/laragon/www/app_trustcheck_laravel12/docs/01-prd.md) — **Product Requirements Document (PRD)**
   *Berisi latar belakang produk, objektif bisnis, positioning aplikasi, arsitektur sistem, strategi agregasi scraping berlapis, dan ruang lingkup MVP.*
2. [**02-design.md**](file:///d:/laragon/www/app_trustcheck_laravel12/docs/02-design.md) — **Design Philosophy & UI/UX Guidelines**
   *Berisi panduan rancangan visual bergaya Modern Enterprise (clean & minimalis), palet warna resmi Tailwind CSS v4, tipografi, serta aturan larangan desain (anti-glassmorphism).*
3. [**03-api-guide.md**](file:///d:/laragon/www/app_trustcheck_laravel12/docs/03-api-guide.md) — **Panduan Konfigurasi AI & Scraping Provider**
   *Berisi cara mendapatkan dan mengonfigurasi API Key untuk berbagai provider LLM (OpenAI, Gemini, Claude, OpenRouter, Custom Base URL) serta mesin scraping eksternal.*
4. [**04-tasks.md**](file:///d:/laragon/www/app_trustcheck_laravel12/docs/04-tasks.md) — **Roadmap & Task Checklist Production**
   *Daftar periksa rinci pengerjaan proyek dari Fase 1 (MVP) hingga Fase 6 (Pemantauan Real-Time & Reliability) yang kini telah 100% tuntas.*
5. [**05-queue-worker-production.md**](file:///d:/laragon/www/app_trustcheck_laravel12/docs/05-queue-worker-production.md) — **Panduan Konfigurasi Queue Worker Production**
   *Pedoman pengaturan sistem antrean latar belakang (*background job worker*) pada Linux server menggunakan Supervisor atau Laravel Horizon.*
6. [**06-design-concept-login-dashboard.md**](file:///d:/laragon/www/app_trustcheck_laravel12/docs/06-design-concept-login-dashboard.md) — **Konsep Desain Halaman Login & Dasbor (Modern Enterprise UI/UX)**
   *Panduan filosofis visual agar tampilan portal autentikasi dan dasbor kelola tidak kaku, responsif penuh, dan menghindari kesan stereotip AI template.*
7. [**07-deployment-guide-vps-shared-hosting.md**](file:///d:/laragon/www/app_trustcheck_laravel12/docs/07-deployment-guide-vps-shared-hosting.md) — **Panduan Lengkap Deployment Production (Cloud VPS & Shared Hosting)**
   *Langkah demi langkah peluncuran aplikasi ke server produksi, mulai dari Nginx + Supervisor di Cloud VPS hingga strategi pemisahan folder core dan pemrosesan antrean di Shared Hosting.*

---

> **Catatan:** Seluruh pengembang dan AI Agent (Gemini) wajib menjadikan dokumen-dokumen ini beserta `GEMINI.md` di root direktori sebagai patokan utama (*Single Source of Truth*).
