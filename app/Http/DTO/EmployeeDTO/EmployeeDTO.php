<?php

namespace App\Http\DTO\EmployeeDTO;

use App\Http\DTO\BaseDTO;
use Illuminate\Http\Request;

class EmployeeDTO extends BaseDTO
{
    public string $name;
    public string $position;
    public int $companyId;
    public function build(Request $request): self
    {
        $this->buildFromRequest($request);
        return $this;
    }
}
