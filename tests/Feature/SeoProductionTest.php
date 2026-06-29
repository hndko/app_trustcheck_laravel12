<?php

use App\Models\Company;

it('generates valid sitemap xml containing completed companies', function () {
    $company = Company::create([
        'name' => 'PT SEO Sampel Indonesia',
        'slug' => 'pt-seo-sampel-indonesia',
        'status' => 'completed',
        'trust_score' => 90,
        'risk_level' => 'LOW RISK',
    ]);

    $response = $this->get('/sitemap.xml');
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/xml');
    $response->assertSee(route('search.index'));
    $response->assertSee(route('search.result', $company->id));
});

it('renders dynamic open graph and seo meta tags on company report page', function () {
    $company = Company::create([
        'name' => 'PT Meta Tes Tbk',
        'slug' => 'pt-meta-tes-tbk',
        'status' => 'completed',
        'trust_score' => 88,
        'risk_level' => 'LOW RISK',
        'ai_summary' => 'Analisis reputasi perusahaan sangat baik dan terpercaya.',
    ]);

    $response = $this->get(route('search.result', $company->id));
    $response->assertStatus(200);
    $response->assertSee('property="og:title"', false);
    $response->assertSee('Trust Score PT Meta Tes Tbk: 88/100 (LOW RISK)');
    $response->assertSee('name="description"', false);
});
