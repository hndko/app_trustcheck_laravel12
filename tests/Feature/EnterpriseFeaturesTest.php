<?php

use App\Models\Company;

it('renders comparison matrix page successfully', function () {
    $company1 = Company::create([
        'name' => 'PT Entitas Pertama',
        'slug' => 'pt-entitas-pertama',
        'status' => 'completed',
        'trust_score' => 90,
        'risk_level' => 'LOW RISK',
    ]);

    $company2 = Company::create([
        'name' => 'PT Entitas Kedua',
        'slug' => 'pt-entitas-kedua',
        'status' => 'completed',
        'trust_score' => 75,
        'risk_level' => 'MEDIUM RISK',
    ]);

    $response = $this->get('/compare?companies=' . $company1->id . ',' . $company2->id);
    $response->assertStatus(200);
    $response->assertSee('PT Entitas Pertama');
    $response->assertSee('PT Entitas Kedua');
    $response->assertSee('Matriks Perbandingan');
});

it('renders admin panel dashboard successfully', function () {
    $response = $this->get('/admin');
    $response->assertStatus(200);
    $response->assertSee('Dasbor Analitik');
    $response->assertSee('Total Entitas Diproses');
});

it('downloads official due diligence pdf report', function () {
    $company = Company::create([
        'name' => 'PT Entitas Laporan PDF',
        'slug' => 'pt-entitas-laporan-pdf',
        'status' => 'completed',
        'trust_score' => 88,
        'risk_level' => 'LOW RISK',
        'ai_summary' => 'Ringkasan uji kelayakan untuk unduhan PDF.',
    ]);

    $response = $this->get('/company/' . $company->id . '/pdf');
    $response->assertStatus(200);
    $response->assertHeader('content-type', 'application/pdf');
});
