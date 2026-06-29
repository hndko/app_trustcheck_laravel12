<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #0F172A;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            border-bottom: 2px solid #2563EB;
            padding-bottom: 15px;
            margin-bottom: 25px;
            width: 100%;
        }
        .logo {
            font-size: 20px;
            font-weight: bold;
            color: #2563EB;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .subtitle {
            font-size: 10px;
            color: #64748B;
            margin-top: 4px;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 25px;
        }
        .meta-table td {
            vertical-align: top;
        }
        .score-box {
            background-color: #EFF6FF;
            border: 1px solid #BFDBFE;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            width: 160px;
        }
        .score-number {
            font-size: 32px;
            font-weight: bold;
            color: #1D4ED8;
            margin: 5px 0;
        }
        .risk-badge {
            background-color: #16A34A;
            color: #FFFFFF;
            padding: 4px 8px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 4px;
            text-transform: uppercase;
        }
        .risk-medium { background-color: #D97706; }
        .risk-high { background-color: #DC2626; }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #0F172A;
            border-left: 4px solid #2563EB;
            padding-left: 8px;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .summary-box {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: justify;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table-data th, .table-data td {
            border: 1px solid #E2E8F0;
            padding: 8px 10px;
            text-align: left;
        }
        .table-data th {
            background-color: #F1F5F9;
            font-weight: bold;
            color: #334155;
            width: 30%;
        }
        .footer {
            margin-top: 40px;
            border-top: 1px solid #E2E8F0;
            padding-top: 10px;
            font-size: 9px;
            color: #64748B;
            text-align: center;
        }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td>
                <div class="logo">TrustCheck AI</div>
                <div class="subtitle">AI Company Reputation & Due Diligence Search Engine</div>
            </td>
            <td style="text-align: right;">
                <strong>LAPORAN DUE DILIGENCE RESMI</strong><br>
                <span class="subtitle">Diperbarui: {{ $generatedAt }}</span>
            </td>
        </tr>
    </table>

    <table class="meta-table">
        <tr>
            <td>
                <h1 style="font-size: 22px; margin: 0 0 5px 0;">{{ $company->name }}</h1>
                <p style="color: #475569; margin: 0;"><strong>Situs Resmi:</strong> {{ $company->website ?: '-' }}</p>
                <p style="color: #475569; margin: 0;"><strong>Industri:</strong> {{ $company->industry ?: 'Umum' }}</p>
                <p style="color: #475569; margin: 0;"><strong>Kantor Pusat:</strong> {{ $company->head_office ?: '-' }}</p>
            </td>
            <td style="width: 180px; text-align: right;">
                <div class="score-box">
                    <div style="font-size: 10px; font-weight: bold; color: #3b82f6;">TRUST SCORE AI</div>
                    <div class="score-number">{{ $company->trust_score }}/100</div>
                    <div>
                        @php
                            $badgeClass = '';
                            if ($company->risk_level === 'MEDIUM RISK') $badgeClass = 'risk-medium';
                            if ($company->risk_level === 'HIGH RISK') $badgeClass = 'risk-high';
                        @endphp
                        <span class="risk-badge {{ $badgeClass }}">{{ $company->risk_level }}</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Ringkasan Eksekutif Kecerdasan Buatan</div>
    <div class="summary-box">
        {{ $company->ai_summary ?: 'Tidak ada ringkasan yang tersedia untuk perusahaan ini.' }}
    </div>

    <div class="section-title">Profil & Data Operasional</div>
    <table class="table-data">
        <tr>
            <th>Nama Perusahaan</th>
            <td>{{ $company->name }}</td>
        </tr>
        <tr>
            <th>Situs Web Resmi</th>
            <td>{{ $company->website ?: '-' }}</td>
        </tr>
        <tr>
            <th>Email Kontak</th>
            <td>{{ $company->email ?: '-' }}</td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>{{ $company->phone ?: '-' }}</td>
        </tr>
        <tr>
            <th>Tahun Berdiri</th>
            <td>{{ $company->founded_year ?: '-' }}</td>
        </tr>
        <tr>
            <th>Skala Karyawan</th>
            <td>{{ $company->employees_count ?: '-' }}</td>
        </tr>
    </table>

    @if($company->metric)
    <div class="section-title">Rincian Penilaian Reputasi</div>
    <table class="table-data">
        <tr>
            <th>Reputasi Website & Domain</th>
            <td>{{ $company->metric->website_score }} / 100</td>
        </tr>
        <tr>
            <th>Sentimen Ulasan Publik</th>
            <td>{{ $company->metric->review_score }} / 100</td>
        </tr>
        <tr>
            <th>Sentimen Liputan Berita</th>
            <td>{{ $company->metric->news_score }} / 100</td>
        </tr>
        <tr>
            <th>Jejak Digital & Transparansi</th>
            <td>{{ $company->metric->digital_presence_score }} / 100</td>
        </tr>
    </table>
    @endif

    <div class="footer">
        <strong>Pernyataan Sanggahan Hukum (Disclaimer):</strong> Dokumen ini disajikan oleh TrustCheck AI sebagai agregator informasi publik dan bukan merupakan nasihat hukum, saran investasi, atau rekomendasi kontrak komersial. Karena data diekstraksi secara otomatis dari sumber terbuka publik, ketidakakuratan dapat terjadi jika situs sumber mengalami perubahan. Anda dapat melakukan verifikasi mandiri melalui daftar referensi sumber tautan yang kami sediakan di bagian laporan.
        <br><br>
        &copy; {{ date('Y') }} TrustCheck AI Enterprise Portal. All Rights Reserved.
    </div>

</body>
</html>
