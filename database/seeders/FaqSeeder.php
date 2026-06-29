<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat pertanyaan umum (FAQ) awal TrustCheck AI.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu TrustCheck AI dan bagaimana cara kerjanya?',
                'answer' => 'TrustCheck AI adalah mesin pencari uji kelayakan (due diligence) berbasis kecerdasan buatan. Sistem kami mengumpulkan data publik dari situs resmi, berita, review konsumen, dan database domain, lalu menganalisisnya secara objektif menggunakan AI untuk menghasilkan Trust Score (0-100).',
                'order' => 1,
            ],
            [
                'question' => 'Apakah TrustCheck AI memberikan opini atau penilaian subjektif?',
                'answer' => 'Tidak. TrustCheck AI bertindak murni sebagai agregator fakta publik. Model AI kami dilarang keras membuat klaim subjektif atau menghakimi sebuah entitas. Seluruh laporan disusun dengan bahasa netral berdasarkan fakta yang ditemukan di internet.',
                'order' => 2,
            ],
            [
                'question' => 'Bagaimana cara membandingkan 2 atau 3 perusahaan sekaligus?',
                'answer' => 'Anda dapat memanfaatkan fitur Komparasi Reputasi dengan memilih tombol "Bandingkan" pada daftar entitas populer di beranda, atau mengklik menu "Komparasi" di navigasi atas untuk memilih perusahaan yang ingin dibandingkan secara berdampingan.',
                'order' => 3,
            ],
            [
                'question' => 'Mengapa data hasil analisis disimpan dalam cache selama 7 hari?',
                'answer' => 'Untuk menjaga kecepatan respons yang instan dan efisiensi kuota pemrosesan AI, hasil analisis sebuah perusahaan disimpan (caching) selama 7 hari. Setelah 7 hari, pencarian berikutnya akan memicu pembaruan data otomatis dari sumber langsung.',
                'order' => 4,
            ],
            [
                'question' => 'Bagaimana jika saya menemukan informasi atau fakta yang kurang akurat?',
                'answer' => 'Karena data diekstraksi secara otomatis dari sumber terbuka publik, ketidakakuratan dapat terjadi jika situs sumber mengalami perubahan. Anda dapat melakukan verifikasi mandiri melalui daftar referensi sumber tautan yang kami sediakan di bagian bawah laporan.',
                'order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(['question' => $faq['question']], $faq);
        }
    }
}
