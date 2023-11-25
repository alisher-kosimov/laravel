<?php

namespace App\Http\Services\EmployeeService;

use App\Http\DTO\EmployeeDTO\EmployeeDTO;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeService
{
    public function index(): Collection
    {
        return Employee::all();
    }

    public function view(int $id): Employee
    {
        return Employee::findorfail($id);
    }

    public function create(EmployeeDTO $employeeDTO): Employee
    {
        $employee = new Employee();
        $employee->name = $employeeDTO->name;
        $employee->position = $employeeDTO->position;
        $employee->company_id = $employeeDTO->companyId;
        $employee -> save();

        return $employee;
    }

    public function update(int $id, EmployeeDTO $employeeDTO)
    {
        $employee = Employee::findorfail($id);
        $employee->name = $employeeDTO->name;
        $employee->position = $employeeDTO->position;
        $employee->company_id = $employeeDTO->companyId;
        $employee -> save();

        return $employee;
    }

    public function delete(int $id): void
    {
        $book = Employee::findorfail($id);
        $book->delete();
    }


}
