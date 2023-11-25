<?php

namespace App\Http\DTO\CompanyDTO;

use App\Http\DTO\BaseDTO;
use Illuminate\Http\Request;


class CompanyDTO extends BaseDTO
{
    public string $companyName;
    public string $location;
    public function build(Request $request): self
    {
        $this->buildFromRequest($request);
        return $this;
    }

}
