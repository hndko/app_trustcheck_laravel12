# DESIGN — Login & Dasbor Portal Kelola TrustCheck AI

Version : 1.0

---

# Design Philosophy

Portal Kelola dan Dasbor Analitik TrustCheck AI harus terasa seperti aplikasi bisnis tingkat enterprise yang digunakan oleh pengelola sistem, auditor, dan administrator utama.

Tujuan utama adalah memberikan rasa:
- Trust & Secure
- Professional
- Fast & Responsive
- Clean & Scannable
- Objective
- Minimal & High Readability

Jangan sampai tampak seperti:
- AI Chatbot konvensional
- Crypto / NFT Dashboard yang berlebihan
- Dashboard gaming dengan lampu neon bercahaya
- Glassmorphism UI (kaca buram berlebihan)
- Animasi melompat atau berputar yang tidak perlu

Produk harus terasa seperti kombinasi antara:
- Stripe Dashboard
- Linear App
- Cloudflare Enterprise Console
- GitHub Admin Portal

---

# Design Principles

1. **Information First**
   Data analisis, statistik skor, dan status sistem lebih penting daripada elemen dekoratif.
2. **Scannable Hierarchy**
   Metrik utama (KPI) harus langsung terbaca dalam 1 detik pertama menggunakan tipografi tegas.
3. **Professional Contrast**
   Menggunakan mode gelap matang (`#0F172A` background, `#1E293B` surface/card) dengan batas garis tipis (`#334155`).
4. **Zero Layout Shift**
   Interaksi hover, focus input, dan pembukaan menu tidak boleh menggeser tata letak halaman.

---

# Visual Style & Spesifikasi Teknis

- Style: Modern Enterprise Flat Design
- Border: `1px solid #334155` (Soft & Defined)
- Shadow: `shadow-sm` hingga `shadow-md` (Sangat halus)
- Background Utama: `#0F172A` (Slate 900)
- Surface / Card: `#1E293B` (Slate 800)
- Input Background: `#0F172A` dengan border `#334155`
- Primary Accent: Blue 600 (`#2563EB`), Hover: `#1D4ED8`
- Text Primary: `#F8FAFC` (Slate 50)
- Text Secondary: `#94A3B8` (Slate 400)
- Text Muted: `#64748B` (Slate 500)

---

# Grid & Layout System

## Desktop
- Sidebar Static Width: `256px` (`w-64`)
- Content Area: `grow` (Sisa lebar layar)
- Grid Top KPI: `4 Columns` (`grid-cols-4`)

## Tablet
- Sidebar: Collapsible / Drawer
- Grid Top KPI: `2 Columns` (`grid-cols-2`)

## Mobile
- Sidebar: Off-canvas Drawer (Meluncur dari kiri atas tombol Hamburger)
- Grid Top KPI: `1 Column` (`grid-cols-1`)
- Padding Container: `16px` (`p-4`)

---

# Spesifikasi Halaman Login (`/login`)

## Layout
- Struktur: 2 Kolom pada Desktop (50% Brand Panel Kiri, 50% Form Kanan).
- Mobile: 1 Kolom berpusat (*Centered Card*), panel kiri disembunyikan otomatis.

## Brand Panel Kiri
- Latar Belakang: Gradasi `#0F172A` ke `#1E293B` dengan pola dot grid halus (*radial gradient*).
- Konten: Logo Brand, Quote Misi Enterprise Due Diligence, dan status keamanan aktif.

## Form Card Kanan
- Batas Card: Border `#334155`, Radius `16px` (`rounded-2xl`).
- Input Field: Tinggi `48px`, padding horizontal `16px`, fokus border biru `#2563EB`.
- Tombol Masuk: Solid Blue `#2563EB`, berikon panah kanan, transisi hover halus, dan indikator *loading state* saat proses login.

---

# Spesifikasi Halaman Dasbor Analitik (`/portal-kelola`)

## 1. Header & Navigasi Utama
- **Desktop Sidebar:**
  - Menampilkan Logo "TrustCheck Kelola".
  - Menu Navigasi bersudut membulat (`rounded-xl`), ikon Lucide di kiri.
  - State Aktif: Latar solid biru `#2563EB`, teks putih tebal.
  - State Hover: Latar `#334155`, teks putih.
  - Panel Status AI: Berada di footer sidebar, menampilkan driver LLM aktif secara *real-time*.
- **Mobile Header:**
  - Bar atas setinggi `64px` (`h-16`).
  - **Tombol Hamburger:** Di kiri atas untuk membuka sidebar drawer dengan efek gelap transparan (*backdrop overlay*).
  - Profil Pengguna ringkas di sudut kanan.

## 2. Top KPI Banner (Kartu Indikator Utama)
Terdiri dari 4 kartu bersudut `16px` (`rounded-2xl`) dengan border tipis `#334155`:
1. **Total Entitas Diproses:** Angka besar (`text-3xl font-black`), dilampiri indikator hijau jumlah selesai.
2. **Rata-Rata Trust Score:** Angka besar berakhiran `/100`, ikon perisai biru/hijau.
3. **Estimasi Token AI:** Angka format ribuan/jutaan, ikon CPU oranye.
4. **Efisiensi Cache TTL:** Indikator penghematan kuota API LLM.

Setiap kartu memiliki ikon kecil di sudut kanan atas dalam kotak bersudut `12px` berlatar transparan `20%` warna aksen.

## 3. Distribusi Tingkat Risiko (Risk Breakdown Bar)
- Judul Section: Tipografi jelas berikon pie-chart.
- Grid 3 Kolom (Low, Medium, High Risk).
- Menampilkan persentase proporsional dalam *Progress Bar* bergaris tipis (`h-2 rounded-full`) berlatar `#1E293B`.
- Warna: Low (`#10B981`), Medium (`#F59E0B`), High (`#EF4444`).

## 4. Log Aktivitas Analisis Terkini (Activity Table)
- **Container Card:** Latar `#1E293B`, border `#334155`, dengan header pemisah tabel.
- **Header Tabel:** Latar `#0F172A`, teks `#94A3B8` huruf kapital kecil (`text-xs uppercase font-bold`).
- **Pill Badges Status:**
  - Selesai: `bg-[#10B981]/20 text-[#10B981]`
  - Proses: `bg-[#F59E0B]/20 text-[#FBBF24]`
  - Gagal: `bg-[#EF4444]/20 text-[#EF4444]`
- **Risk Level Badges:** Teks tebal bersudut `6px` dengan warna senada tingkat risiko.
- **Responsivitas Tabel:** Dilengkapi `overflow-x-auto` sehingga dapat digeser horizontal dengan mulus pada ponsel tanpa memotong layar.
