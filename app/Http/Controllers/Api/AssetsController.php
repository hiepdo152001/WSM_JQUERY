<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AssetsService;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    /**
     * @var AssetsService
     */
    protected $assetsService;

    public function __construct(AssetsService $assetsService)
    {
        $this->assetsService = $assetsService;
    }

    public function create(Request $request)
    {

        $assets = $this->assetsService->create($request);
        if ($assets === null) {
            return response()->json([], 500);
        }
        return response()->json([
            $assets
        ], 200);
    }

    public function edit($id, Request $request)
    {
        $assets = $this->assetsService->edit($id, $request->all());
        if (!$assets) {
            return response()->json([], 500);
        }
        return response()->json([], 200);
    }

    public function getById($id)
    {
        $asset = $this->assetsService->getById($id);
        if ($asset === null) {
            return response()->json([], 404);
        }
        return response()->json([$asset], 200);
    }

    public function getByUserId($id)
    {
        $assets = $this->assetsService->getByUserId($id);
        if ($assets === null) {
            return response()->json([], 404);
        }
        return response()->json([$assets], 200);
    }
}
