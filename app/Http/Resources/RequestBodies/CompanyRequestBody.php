<?php

namespace App\Http\Resources\RequestBodies;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'CompanyRequestBody',
    description: 'company request body',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/CompanyRequestBody'
            )
        )
    ]
)]
#[OA\Schema(
    required: [
        'companyName',
        'location',
    ]
)]
class CompanyRequestBody
{
    #[OA\Property(
        example: 'Google'
    )]
    public string $companyName;

    #[OA\Property(
        example: 'Moscow'
    )]
    public string $location;

}
