<?php

namespace App\Http\Resources\Schemas;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
#[OA\Schema(
    required: [
        'companyName',
        'location',
    ]
)]
class CompanySchema extends JsonResource
{
    #[OA\Property(
        maxLength: 64,
        example: 'Google'
    )]
    public string $companyName;

    #[OA\Property(
        maxLength: 64,
        example: 'Moscow'
    )]
    public string $location;
}
