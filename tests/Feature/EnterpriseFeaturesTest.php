<?php

use App\Models\Company;
use App\Models\User;
use Spatie\Permission\Models\Permission;

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

it('redirects unauthenticated user from portal kelola to login', function () {
    $response = $this->get('/portal-kelola');
    $response->assertStatus(302);
    $response->assertRedirect('/login');
});

it('renders portal kelola dashboard successfully for authorized user', function () {
    $permission = Permission::firstOrCreate(['name' => 'access_portal_kelola']);
    $user = User::factory()->create();
    $user->givePermissionTo($permission);

    $response = $this->actingAs($user)->get('/portal-kelola');
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

it('allows authorized user to manage public faqs', function () {
    $permission = Permission::firstOrCreate(['name' => 'access_portal_kelola']);
    $user = User::factory()->create();
    $user->givePermissionTo($permission);

    $response = $this->actingAs($user)->get('/portal-kelola/faq');
    $response->assertStatus(200);
    $response->assertSee('Kelola Pertanyaan Umum (FAQ)');
});
