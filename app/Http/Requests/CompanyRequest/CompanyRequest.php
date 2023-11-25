<?php

namespace App\Http\Requests\CompanyRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'companyName' => 'required|string|max:64',
            'location' => 'required|string|max:64',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => 422,
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
