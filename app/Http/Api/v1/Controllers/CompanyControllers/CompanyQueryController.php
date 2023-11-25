<?php

namespace App\Http\Api\v1\Controllers\CompanyControllers;

use App\Http\Api\v1\Controllers\Controller;
use App\Http\Services\CompanyService\CompanyService;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
class CompanyQueryController extends Controller
{
    public function __construct(readonly private CompanyService $companyService)
    {

    }

    #[OA\Get(
        path: '/api/v1/company',
        operationId: 'getcompanies',
        description: 'Fetches a list of all companies available.',
        summary: 'Get list of Companies',
        tags: ['Company'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Success',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/CompanyListResponse'
                )
            ),
        ]
    )]

    public function indexCompany(): JsonResponse
    {
     $company = $this->companyService->index();

     return response()->json(['data' => $company], 200);
    }

    #[OA\Get(
        path: '/api/v1/company/{id}',
        operationId: 'getCompanyById',
        description: 'Fetches information about a specific company by its ID',
        summary: 'Get company',
        tags: ['Company'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'The ID of the company',
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
                response: 404,
                description: 'Not Found',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/NotFoundResponse'
                )
            ),
        ]
    )]

    public function viewCompany(int $id): JsonResponse
    {
        $company = $this->companyService->view($id);

        return response()->json(['data'=>$company], 200);
    }

}
