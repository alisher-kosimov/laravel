<?php

namespace Tests\Feature\Api\v1;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CompanyControllersTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexCompany()
    {
        $company = Company::factory()->count(5)->create();

        $response = $this->get('/api/v1/company');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');

        $response = $this->get('/api/v1/nonexistent-endpoint');
        $response->assertStatus(404);
    }

    public function testViewCompany()
    {
        $company = Company::factory()->create();

        $response = $this->get("/api/v1/company/{$company->id}");

        $response->assertStatus(200)
            ->assertJson(['data' => [$company->toArray()]]);

        $response = $this->get('/api/v1/company/9999');
        $response->assertStatus(404);
    }

    public function testCreateCompany()
    {
        $companyData = [
            'companyName' => 'Test Company',
            'location' => 'Test location',
        ];

        $response = $this->post('/api/v1/company', $companyData);

        $response->assertStatus(201)
            ->assertJson(['data' => [
                'company_name' => $companyData['companyName'],
                'location' => $companyData['location'],
            ]]);

        $response = $this->get('/api/v1/nonexistent-endpoint');
        $response->assertStatus(404);

    }

    public function testUpdateCompany()
    {
        $company = Company::factory()->create();

        $updatedData = [
            'companyName' => 'Update Company',
            'location' => 'Update location',
        ];

      $response = $this->call('PUT', "/api/v1/company/{$company->company_id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'company_id' => $company->company_id,
                    'company_name' => $updatedData['companyName'],
                    'location' => $updatedData['location'],
                ]
            ]);
    }

    public function testDeleteCompany()
    {
        $company = Company::factory()->create();

        $response = $this->delete("/api/v1/company/{$company->company_id}");

        $response->assertStatus(204);

        $response = $this->get('/api/v1/company/999');
        $response->assertStatus(404);
    }
}
