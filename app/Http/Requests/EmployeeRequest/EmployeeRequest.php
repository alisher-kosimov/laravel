<?php

namespace App\Http\Requests\EmployeeRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class EmployeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'position' => 'required|string',
            'companyId' => 'required|exists:companies,company_id',
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
