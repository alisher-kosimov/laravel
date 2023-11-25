<?php

namespace App\Http\Resources\Responses;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    description: "No Content"
)]
class NoContentResponse extends JsonResource
{
    #[OA\Property(
        description: "No Content"
    )]
    public object $data;
}
