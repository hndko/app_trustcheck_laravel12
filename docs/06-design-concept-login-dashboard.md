# Konsep Desain Halaman Login & Dasbor (Modern Enterprise UI/UX)

Dokumen ini merinci pedoman dan rancangan visual (*design concept*) khusus untuk halaman **Login Autentikasi (`/login`)** dan **Dasbor Analitik (`/portal-kelola`)** pada ekosistem TrustCheck AI. Tujuan utama konsep ini adalah memastikan antarmuka terasa manusiawi, elegan, profesional, dan **tidak terlihat seperti produk template AI konvensional**.

---

## 1. Filosofi & Pendekatan Visual ("Anti-AI Stereotype")

Kebanyakan antarmuka yang dihasilkan oleh AI konvensional memiliki ciri khas yang kaku dan klise, seperti penggunaan warna neon ungu/biru gelap bercahaya, ilustrasi robot/sirkuit otak, efek kaca berlebihan (*heavy glassmorphism*), serta animasi berputar yang tidak fungsional. 

Untuk menghindari kesan tersebut, TrustCheck AI mengadopsi standar **Modern SaaS Enterprise** sekelas **Stripe, Linear, Cloudflare, dan GitHub**:
- **Human-Centric & Trustworthy:** Fokus pada kebersihan tipografi (*high legibility*), proporsi spasi bernapas (*generous whitespace*), dan hierarki visual yang jelas.
- **Flat & Clean Border:** Batas elemen (*border*) menggunakan garis tipis terdefinisi (`#334155` pada mode gelap) dengan bayangan halus (`shadow-sm` hingga `shadow-md`), menghindari efek blur berlebihan.
- **Micro-Interactions yang Fungsional:** Respons antarmuka saat kursor melintas (*hover*) atau tombol ditekan transisinya mulus maksimal 150ms–300ms (*ease-in-out*), tanpa efek melompat atau bergetar.
- **Full Responsiveness (Mobile-First):** Seluruh elemen beradaptasi sempurna dari layar ponsel kecil (320px) hingga layar monitor ekstensif (1440px+).

---

## 2. Konsep Desain Halaman Login (`/login`)

Halaman autentikasi dirancang sebagai pintu gerbang profesional yang memberikan ketenangan dan rasa aman bagi admin pengelola.

### A. Komponen Tata Letak (Layout)
- **Struktur Dua Kolom (Desktop):**
  - **Kolom Kiri (Visual Brand Panel - 50% Lebar):** Menampilkan latar belakang gradasi halus biru malam (`#0F172A` ke `#1E293B`) dengan pola geometris grid tipis. Diperkaya dengan *quote* atau pernyataan misi produk yang memperkuat positioning due diligence profesional.
  - **Kolom Kanan (Form Card - 50% Lebar):** Area formulir masuk yang bersih dengan kontras tinggi sehingga memudahkan fokus pengguna.
- **Struktur Satu Kolom (Mobile/Tablet):** Kolom kiri disembunyikan secara otomatis, menyisakan formulir masuk di tengah layar (*centered card*) dengan *padding* kompak (`p-6`).

### B. Spesifikasi Elemen Formulir
- **Input Field:** Menggunakan sudut membulat sedang (`rounded-xl`), latar belakang input sedikit lebih gelap (`bg-[#0F172A]`) dengan border tipis. Saat fokus (*focus state*), border berubah menjadi biru utama (`#2563EB`) disertai *ring shadow* halus tanpa menggeser posisi layout.
- **Tombol Masuk (Primary Action):** Berwarna biru solid (`bg-[#2563EB]`) dengan teks putih tebal. Dilengkapi indikator loading interaktif saat diproses (mencegah klik ganda).
- **Pesan Kesalahan (Error Feedback):** Muncul secara alami di bawah kolom input atau dalam toast alert merah (`bg-[#EF4444]/10 border-[#EF4444]`) dalam Bahasa Indonesia baku yang jelas dan tidak menyalahkan pengguna.

---

## 3. Konsep Desain Dasbor Analitik (`/portal-kelola`)

Dasbor dirancang sebagai pusat kendali operasional yang menyajikan data secara padat, mudah dicerna (*scannable*), dan responsif.

### A. Struktur Navigasi (Responsif Drawer)
- **Desktop Navigation:** *Sidebar* statis di sisi kiri (`w-64`) yang menampilkan logo brand, tautan modul utama, dan panel status performa AI.
- **Mobile Navigation:** *Sidebar* disembunyikan secara default dan digantikan oleh **Tombol Hamburger** di *header* atas. Ketika ditekan, navigasi meluncur dari kiri (*off-canvas drawer*) dengan transisi halus didampingi *backdrop overlay* gelap.

### B. Komponen Utama Dasbor
1. **Top KPI Banner (Kartu Indikator Utama):**
   - Grid responsif (`grid-cols-1 sm:grid-cols-2 lg:grid-cols-4`) yang merangkum metrik krusial: Total Entitas, Rata-Rata Trust Score, Estimasi Token AI, dan Efisiensi Cache.
   - Angka ditampilkan dalam ukuran tipografi besar (`text-3xl font-black`) bergaya bersih tanpa grafik speedometer atau *gauge* yang memenuhi layar.
2. **Distribusi Tingkat Risiko (Risk Breakdown Bar):**
   - Menggunakan *Progress Bar* vertikal/horizontal bergaya minimalis bergaris tipis untuk membedakan proporsi *Low Risk* (Hijau), *Medium Risk* (Kuning/Oranye), dan *High Risk* (Merah).
3. **Tabel Log Aktivitas Analisis Terkini:**
   - Dibungkus dalam kontainer ber-border tipis dengan *overflow-x-auto* agar tabel tidak merusak layout pada layar ponsel.
   - Status pengerjaan ditampilkan menggunakan *pill badge* lembut (`bg-[color]/20 text-[color] font-bold`) yang elegan.

---

## 4. Panduan Ekstensi Modul Baru (Contoh: Kelola Provider AI)

Ketika menambahkan fitur baru seperti halaman **Kelola Provider AI (`/portal-kelola/providers`)**, konsistensi desain dipertahankan melalui:
- **Card Switcher Interaktif:** Pemilihan provider utama tidak menggunakan *dropdown* membosankan, melainkan jajaran kartu interaktif (*radio cards*) berikon **Lucide** dengan batas warna dinamis saat aktif.
- **Tabbed Configuration Area:** Formulir input API Key dan parameter model dikelompokkan dalam tab rapi berbasis Alpine.js, mencegah halaman menjadi terlalu panjang (*scroll fatigue*).
- **Keamanan Visual:** Kolom sensitif seperti API Key secara default menggunakan tipe `password` dengan penjelasan panduan singkat di bawah input.
