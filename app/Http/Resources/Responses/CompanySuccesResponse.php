<?php

namespace App\Http\Resources\Responses;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ["data"]
)]
class CompanySuccesResponse extends JsonResource
{
    #[OA\Property(
        ref: '#/components/schemas/CompanySchema'
    )]
    public object $data;
}
