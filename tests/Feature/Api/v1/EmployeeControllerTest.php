<?php

namespace Tests\Feature\Api\v1;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexEmployee()
    {
        $company = Company::factory()->create();
        $employees = Employee::factory()->count(5)->create(['company_id' => $company->company_id]);

        $response = $this->get('/api/v1/employee');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');

        $response = $this->get('/api/v1/nonexistent-endpoint');
        $response->assertStatus(404);
    }

    public function testViewEmployee()
    {
        $company = Company::factory()->create();
        $employee = Employee::factory(['company_id' => $company->company_id])->create();

        $response = $this->get("/api/v1/employee/{$employee->id}");

        $response->assertStatus(200)
            ->assertJsonFragment($employee->toArray());

        $response = $this->get('/api/v1/employee/9999');
        $response->assertStatus(404);
    }



    public function testCreateEmployee()
    {
        $company = Company::factory()->create();

        $employeeData = [
            'name' => 'John Doe',
            'position' => 'Developer',
            'companyId' => $company->company_id,
        ];

        $response = $this->post('/api/v1/employee', $employeeData);

        $response->assertStatus(201)
            ->assertJson(['data' => [
                'name' => 'John Doe',
                'position' => 'Developer',
                'company_id' => $company->company_id,
            ]]);

        $response = $this->get('/api/v1/nonexistent-endpoint');
        $response->assertStatus(404);
    }



    public function testUpdateEmployee()
    {
        $company = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company->company_id]);

        $updatedData = [
            'name' => 'Updated Name',
            'position' => 'Updated Position',
            'companyId' => $company->company_id,
        ];

        $response = $this->call('PUT', "/api/v1/employee/{$employee->employee_id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson(['data' => [
                'name' => $updatedData['name'],
                'position' => $updatedData['position'],
                'company_id' => $updatedData['companyId'],
            ]]);
    }

    public function testDeleteEmployee()
    {
        $company = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company->company_id]);

        $response = $this->delete("/api/v1/employee/{$employee->employee_id}");

        $response->assertStatus(204);

        $response = $this->get('/api/v1/employee/999');
        $response->assertStatus(404);
    }
}
