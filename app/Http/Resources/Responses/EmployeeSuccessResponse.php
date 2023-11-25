<?php

namespace App\Http\Resources\Responses;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ["data"]
)]

class EmployeeSuccessResponse extends JsonResource
{

    #[OA\Property(
        ref: '#/components/schemas/EmployeeSchema'
    )]
    public object $data;
}
