<?php

use App\Models\Company;
use App\Models\DataCorrection;

it('returns status up with database and ai provider metrics from health check endpoint', function () {
    $response = $this->get('/up');
    $response->assertStatus(200);
    $response->assertJson([
        'status' => 'UP',
        'services' => [
            'database' => ['status' => 'OK'],
            'ai_provider' => ['status' => 'OK'],
        ],
    ]);
});

it('allows user to store data correction report for a company', function () {
    $company = Company::create([
        'name' => 'PT Koreksi Sampel Tbk',
        'slug' => 'pt-koreksi-sampel-tbk',
        'status' => 'completed',
        'trust_score' => 75,
        'risk_level' => 'MEDIUM RISK',
    ]);

    $response = $this->post(route('company.correction', $company->id), [
        'reporter_name' => 'Budi Verifikator',
        'reporter_email' => 'budi@example.com',
        'correction_details' => 'Tahun berdiri seharusnya 2015 bukan 2012, tercantum di situs resmi perusahaan.',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('data_corrections', [
        'company_id' => $company->id,
        'reporter_name' => 'Budi Verifikator',
        'status' => 'pending',
    ]);
});
