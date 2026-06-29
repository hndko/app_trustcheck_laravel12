<?php

use App\Models\Company;

it('renders homepage successfully', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('TrustCheck');
});

it('processes company search and redirects to result page', function () {
    $response = $this->post('/search', [
        'query' => 'PT Astra International Tbk',
    ]);

    $company = Company::where('slug', 'pt-astra-international-tbk')->first();
    expect($company)->not->toBeNull();
    expect($company->status)->toBe('completed');

    $response->assertRedirect(route('search.result', $company->id));
});

it('displays due diligence result page properly', function () {
    $company = Company::create([
        'name' => 'PT Sampel Verifikasi',
        'slug' => 'pt-sampel-verifikasi',
        'status' => 'completed',
        'trust_score' => 85,
        'risk_level' => 'LOW RISK',
        'ai_summary' => 'Ringkasan uji kelayakan.',
    ]);

    $response = $this->get(route('search.result', $company->id));
    $response->assertStatus(200);
    $response->assertSee('PT Sampel Verifikasi');
    $response->assertSee('Risiko Rendah');
});
