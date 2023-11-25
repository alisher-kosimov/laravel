<?php

namespace App\Http\Resources\RequestBodies;

use OpenApi\Attributes as OA;
#[OA\RequestBody(
    request: 'EmployeeRequestBody',
    description: 'employee request body',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/EmployeeRequestBody'
            )
        )
    ]
)]
#[OA\Schema(
    required: [
        'name',
        'position',
        'companyId'
    ]
)]
class EmployeeRequestBody
{
    #[OA\Property(
        example: 'John'
    )]
    public string $name;

    #[OA\Property(
        example: 'Admin'
    )]
    public string $position;

    #[OA\Property(
        example: 2
    )]
    public string $companyId;

}
