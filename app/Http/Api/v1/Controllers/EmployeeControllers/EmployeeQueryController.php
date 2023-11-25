<?php

namespace App\Http\Api\v1\Controllers\EmployeeControllers;

use App\Http\Api\v1\Controllers\Controller;
use App\Http\Services\EmployeeService\EmployeeService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
class EmployeeQueryController extends Controller
{

    public function __construct(readonly private EmployeeService $employeeService)
    {

    }

    #[OA\Get(
        path: '/api/v1/employee',
        operationId: 'getemployees',
        description: 'Fetches a list of all employees available.',
        summary: 'Get list of Employees',
        tags: ['Employee'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Success',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/EmployeeListResponse'
                )
            ),
        ]
    )]

    public function indexEmployee(): JsonResponse
    {
        $company = $this->employeeService->index();

        return response()->json(['data' => $company], 200);
    }

    #[OA\Get(
        path: '/api/v1/employee/{id}',
        operationId: 'getEmployeeById',
        description: 'Fetches information about a specific employee by its ID',
        summary: 'Get employee',
        tags: ['Employee'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'The ID of the employee',
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
                    ref: '#/components/schemas/EmployeeSuccessResponse'
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

    public function viewEmployee(int $id): JsonResponse
    {
        $company = $this->employeeService->view($id);

        return response()->json(['data'=>$company], 200);
    }
}
