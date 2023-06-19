<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    /**
     * @var DepartmentService
     */
    protected $deService;
    public function __construct(DepartmentService $deService)
    {
        $this->deService = $deService;
    }

    public function create(DepartmentRequest $request)
    {
        $department = $this->deService->create($request);
        return response()->json([$department], 200);
    }

    public function get()
    {
        $departments = $this->deService->get();
        return response()->json([$departments], 200);
    }

    public function getById($id)
    {
        $department = $this->deService->getById($id);
        if ($department === null) {
            return response()->json(["message" => "id not found"], 200);
        }
        return response()->json([$department], 200);
    }


    public function edit($id, DepartmentRequest $request)
    {
        $check = $this->deService->edit($id, $request);
        if ($check === false) {
            return response()->json([
                'message' => 'update false'
            ], 500);
        }
        return response()->json(['message' => 'update success'], 200);
    }
}
