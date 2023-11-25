<?php

namespace App\Http\Resources\Responses;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
#[OA\Schema(
    required: ["data"]
)]

class EmployeeListResponse extends JsonResource
{
    #[OA\Property(
        type: "array",
        items: new OA\Items(
            ref: '#/components/schemas/EmployeeSchema'
        )
    )]
    public array $data;

}
