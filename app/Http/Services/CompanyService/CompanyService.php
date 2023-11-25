<?php

namespace App\Http\Services\CompanyService;


use App\Http\DTO\CompanyDTO\CompanyDTO;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{

    public function index(): Collection
    {
        return Company::all();
    }

    public function view(int $id): Company
    {
        return Company::findorfail($id);
    }

    public function create(CompanyDTO $companyDTO): Company
    {
        $company = new Company();
        $company->company_name = $companyDTO->companyName;
        $company->location = $companyDTO->location;
        $company -> save();

        return $company;
    }

    public function update(int $id, CompanyDTO $companyDTO)
    {
        $company = Company::findorfail($id);
        $company->company_name = $companyDTO->companyName;
        $company->location = $companyDTO->location;
        $company -> save();

        return $company;
    }

    public function delete(int $id): void
    {
        $book = Company::findorfail($id);
        $book->delete();
    }

}
