<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyMetric;
use App\Models\CompanyNews;
use App\Models\CompanySource;
use App\Models\SearchHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. PT Telkom Indonesia (Persero) Tbk
        $telkom = Company::create([
            'name' => 'PT Telkom Indonesia (Persero) Tbk',
            'slug' => Str::slug('PT Telkom Indonesia (Persero) Tbk'),
            'website' => 'https://www.telkom.co.id',
            'industry' => 'Telekomunikasi & Teknologi Informasi',
            'head_office' => 'Bandung, Jawa Barat',
            'email' => 'corporate_comm@telkom.co.id',
            'phone' => '+62 22 4521510',
            'founded_year' => '1856',
            'employees_count' => '20,000+ Karyawan',
            'trust_score' => 94,
            'risk_level' => 'LOW RISK',
            'ai_summary' => 'PT Telkom Indonesia (Persero) Tbk memiliki reputasi publik yang sangat kuat dan stabil sebagai Badan Usaha Milik Negara (BUMN) terdepan di sektor digital telekomunikasi. Mayoritas informasi publik dan ulasan mitra kerja menunjukkan tingkat profesionalisme, kepatuhan hukum, dan stabilitas finansial yang sangat tinggi. Tidak ditemukan indikasi publik mengenai penipuan maupun risiko kepatuhan bisnis yang signifikan.',
            'status' => 'completed',
        ]);

        CompanyMetric::create([
            'company_id' => $telkom->id,
            'review_score' => 92,
            'news_score' => 95,
            'website_score' => 98,
            'digital_presence_score' => 94,
            'positive_topics' => ['Stabilitas Finansial', 'Layanan Profesional', 'Infrastruktur Luas', 'Kepatuhan Regulasi', 'Kemitraan Strategis'],
            'negative_topics' => ['Birokrasi Internal', 'Waktu Respons Kendala Teknis'],
            'website_health' => [
                'https' => true,
                'ssl' => 'Valid (DigiCert Inc)',
                'domain_age' => '28 Tahun (Terverifikasi WHOIS)',
                'security' => 'Tinggi (WAF & Security Headers Aktif)',
                'performance' => 'Sangat Cepat (96/100)',
            ],
        ]);

        CompanySource::create([
            'company_id' => $telkom->id,
            'source_name' => 'Official Website & WHOIS',
            'source_url' => 'https://www.telkom.co.id',
            'status' => 'Verified',
            'confidence_score' => 99,
            'last_updated' => 'Hari ini',
            'summary' => 'Domain resmi aktif sejak 1996, kepemilikan terverifikasi atas nama PT Telekomunikasi Indonesia Tbk dengan sertifikasi SSL tingkat enterprise.',
        ]);

        CompanySource::create([
            'company_id' => $telkom->id,
            'source_name' => 'Google Public Reviews & Glassdoor',
            'source_url' => 'https://www.glassdoor.com',
            'status' => 'Verified',
            'confidence_score' => 92,
            'last_updated' => 'Kemarin',
            'summary' => 'Lebih dari 4.500 ulasan publik mencatat budaya kerja profesional dan stabilitas kontrak usaha yang sangat baik bagi vendor maupun pegawai.',
        ]);

        CompanySource::create([
            'company_id' => $telkom->id,
            'source_name' => 'Liputan Media Berita Nasional',
            'source_url' => 'https://www.kompas.com',
            'status' => 'Verified',
            'confidence_score' => 95,
            'last_updated' => '2 hari yang lalu',
            'summary' => 'Meliputi ekspansi pusat data (data center) secara nasional dan kolaborasi transformasi digital dengan berbagai industri ekosistem bisnis.',
        ]);

        CompanyNews::create([
            'company_id' => $telkom->id,
            'title' => 'Telkom Perluas Jaringan Cloud & Data Center untuk Mendukung Ekonomi Digital',
            'url' => 'https://www.kompas.com',
            'source' => 'Kompas Tekno',
            'published_date' => '3 hari yang lalu',
            'summary' => 'Upaya strategis perusahaan dalam memperkuat infrastruktur cloud nasional mendapatkan apresiasi positif dari para pelaku industri enterprise.',
            'sentiment' => 'Positive',
        ]);

        CompanyNews::create([
            'company_id' => $telkom->id,
            'title' => 'Laporan Kinerja Keuangan Kuartal Terakhir Menunjukkan Pertumbuhan Pendapatan Data',
            'url' => 'https://www.bisnis.com',
            'source' => 'Bisnis Indonesia',
            'published_date' => '1 minggu yang lalu',
            'summary' => 'Segmen enterprise dan konektivitas digital menyumbang kontribusi terbesar dalam mempertahankan profitabilitas perusahaan.',
            'sentiment' => 'Positive',
        ]);


        // 2. PT GoTo Gojek Tokopedia Tbk
        $goto = Company::create([
            'name' => 'PT GoTo Gojek Tokopedia Tbk',
            'slug' => Str::slug('PT GoTo Gojek Tokopedia Tbk'),
            'website' => 'https://www.gotocompany.com',
            'industry' => 'E-Commerce & Layanan On-Demand',
            'head_office' => 'Jakarta Selatan, DKI Jakarta',
            'email' => 'corporate.affairs@gotocompany.com',
            'phone' => '+62 21 50849000',
            'founded_year' => '2010 (Merger 2021)',
            'employees_count' => '10,000+ Karyawan',
            'trust_score' => 88,
            'risk_level' => 'LOW RISK',
            'ai_summary' => 'PT GoTo Gojek Tokopedia Tbk adalah entitas teknologi publik raksasa di Indonesia. Berdasarkan ekstraksi data publik, perusahaan menunjukkan standar tata kelola perusahaan terbuka (GCG) yang transparan serta ekosistem digital yang sangat luas. Ditemukan beberapa diskusi publik terkait dinamika fluktuasi saham dan penyesuaian tarif layanan, namun tidak ditemukan catatan hitam mengenai legalitas usaha maupun penipuan kontrak vendor.',
            'status' => 'completed',
        ]);

        CompanyMetric::create([
            'company_id' => $goto->id,
            'review_score' => 85,
            'news_score' => 89,
            'website_score' => 96,
            'digital_presence_score' => 98,
            'positive_topics' => ['Inovasi Ekosistem', 'Pembayaran Mitra Lancar', 'Transparansi GCG', 'Dukungan Teknologi Tinggi'],
            'negative_topics' => ['Penyesuaian Komisi Mitra', 'Respons Customer Service Mitra'],
            'website_health' => [
                'https' => true,
                'ssl' => 'Valid (Amazon / Cloudflare)',
                'domain_age' => '14 Tahun (Terverifikasi)',
                'security' => 'Sangat Tinggi (Enterprise Protections)',
                'performance' => 'Cepat (92/100)',
            ],
        ]);

        CompanySource::create([
            'company_id' => $goto->id,
            'source_name' => 'Bursa Efek Indonesia & Keterbukaan Informasi',
            'source_url' => 'https://www.idx.co.id',
            'status' => 'Verified',
            'confidence_score' => 99,
            'last_updated' => 'Hari ini',
            'summary' => 'Laporan keuangan berkala dan keterbukaan informasi disampaikan tepat waktu sesuai regulasi pasar modal Indonesia.',
        ]);

        CompanyNews::create([
            'company_id' => $goto->id,
            'title' => 'GoTo Fokus Mencapai Profitabilitas Berkelanjutan melalui Efisiensi Operasional',
            'url' => 'https://www.cnbcindonesia.com',
            'source' => 'CNBC Indonesia',
            'published_date' => '5 hari yang lalu',
            'summary' => 'Manajemen menegaskan komitmen untuk memperkuat margin EBITDA yang disesuaikan pada tahun berjalan.',
            'sentiment' => 'Neutral',
        ]);


        // 3. Populate Popular Searches
        SearchHistory::create(['query' => 'PT Telkom Indonesia', 'search_count' => 142]);
        SearchHistory::create(['query' => 'PT GoTo Gojek Tokopedia', 'search_count' => 98]);
        SearchHistory::create(['query' => 'PT Bank Central Asia Tbk', 'search_count' => 125]);
        SearchHistory::create(['query' => 'PT Astra International Tbk', 'search_count' => 87]);
        SearchHistory::create(['query' => 'PT Pertamina (Persero)', 'search_count' => 110]);
    }
}
