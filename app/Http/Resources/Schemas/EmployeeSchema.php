<?php

namespace App\Http\Resources\Schemas;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
#[OA\Schema(
    required: [
        'name',
        'position',
        'companyId'
    ]
)]
class EmployeeSchema extends JsonResource
{

    #[OA\Property(
        maxLength: 64,
        example: 'John'
    )]
    public string $name;

    #[OA\Property(
        maxLength: 64,
        example: 'admin'
    )]
    public string $position;

    #[OA\Property(
        maxLength: 64,
        example: 2
    )]
    public string $companyId;

}
