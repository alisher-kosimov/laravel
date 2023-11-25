<?php

namespace App\Http\Api\v1\Controllers\CompanyControllers;

use App\Http\Api\v1\Controllers\Controller;
use App\Http\DTO\CompanyDTO\CompanyDTO;
use App\Http\Requests\CompanyRequest\CompanyRequest;
use App\Http\Services\CompanyService\CompanyService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
class CompanyCommandController extends Controller
{
    public function __construct(readonly private CompanyService $companyService)
    {

    }

    #[OA\Post(
        path: '/api/v1/company',
        operationId: 'addCompany',
        summary: 'Create a company',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/CompanyRequestBody'
            )
        ),
        tags: ['Company'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Success',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/CompanySuccesResponse'
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Unprocessable Content',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/UnprocessableEntityResponse'
                )
            ),
        ]
    )]

    public function createCompany(CompanyRequest $request): JsonResponse
    {
        $companyDto = new CompanyDTO();
        $companyDto->buildFromArray($request->validated());

        $company = $this->companyService->create($companyDto);

        return response()->json(['data' => $company], 201);
    }

    #[OA\Put(
        path: '/api/v1/company/{id}',
        operationId: 'updateCompany',
        summary: 'Update specific company',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/CompanyRequestBody'
            )
        ),
        tags: ['Company'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'company ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer'
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Success',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/CompanySuccesResponse'
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Unprocessable Content',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/UnprocessableEntityResponse'
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Not Found',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/NotFoundResponse'
                )
            ),
        ]
    )]

    public function updateCompany(CompanyRequest $request, int $id): JsonResponse
    {
        $companyDTO = new CompanyDTO();
        $companyDTO->buildFromArray($request->validated());

        $company = $this->companyService->update($id, $companyDTO);

        return response()->json(['data' => $company], 200);
    }

    #[OA\Delete(
        path: '/api/v1/company/{id}',
        operationId: 'deleteCompany',
        summary: 'Delete specific Company',
        tags: ['Company'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'company ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer'
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: 'it is deleted successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/NoContentResponse'
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Not Found',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/NotFoundResponse'
                )
            ),
        ]
    )]

    public function deleteCompany(int $id): JsonResponse
    {
        $this->companyService->delete($id);

        return response()->json(['message'=> 'it is deleted successfully'], 204);
    }
}
