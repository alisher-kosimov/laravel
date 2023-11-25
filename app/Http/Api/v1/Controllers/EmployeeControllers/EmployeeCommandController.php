<?php

namespace App\Http\Api\v1\Controllers\EmployeeControllers;

use App\Http\Api\v1\Controllers\Controller;
use App\Http\DTO\EmployeeDTO\EmployeeDTO;
use App\Http\Requests\EmployeeRequest\EmployeeRequest;
use App\Http\Services\EmployeeService\EmployeeService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
class EmployeeCommandController extends Controller
{

    public function __construct(readonly private EmployeeService $employeeService)
    {

    }

    #[OA\Post(
        path: '/api/v1/employee',
        operationId: 'addEmployee',
        summary: 'Create a employee',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/EmployeeRequestBody'
            )
        ),
        tags: ['Employee'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Success',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/EmployeeSuccessResponse'
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

    public function createEmployee(EmployeeRequest $request): JsonResponse
    {
        $employeeDto = new EmployeeDTO();
        $employeeDto->buildFromArray($request->validated());

        $employee = $this->employeeService->create($employeeDto);

        return response()->json(['data' => $employee], 201);
    }

    #[OA\Put(
        path: '/api/v1/employee/{id}',
        operationId: 'updateEmployee',
        summary: 'Update specific employee',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/EmployeeRequestBody'
            )
        ),
        tags: ['Employee'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'employee ID',
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

    public function updateEmployee(EmployeeRequest $request, int $id): JsonResponse
    {
        $employeeDto = new EmployeeDTO();
        $employeeDto->buildFromArray($request->validated());

        $employee = $this->employeeService->update($id, $employeeDto);

        return response()->json(['data' => $employee], 200);
    }

    #[OA\Delete(
        path: '/api/v1/employee/{id}',
        operationId: 'deleteEmployee',
        summary: 'Delete specific Employee',
        tags: ['Employee'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'employee ID',
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

    public function deleteEmployee(int $id): JsonResponse
    {
        $this->employeeService->delete($id);

        return response()->json(['message'=> 'it is deleted successfully'], 204);
    }

}
