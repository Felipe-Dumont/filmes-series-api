<?php

namespace App\Http\Controllers;

use App\Services\FilmeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    public function __construct(
        protected FilmeService $filmeService
    ) { }

    public function create(Request $request): JsonResponse
    {
        $data = $request->all();
        return response()->json($this->filmeService->create($data));
    }

    public function list(): JsonResponse
    {
        return response()->json($this->filmeService->list());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->filmeService->show($id));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->all();
        return response()->json($this->filmeService->update($id, $data));
    }

    public function delete($id): JsonResponse
    {
        return response()->json($this->filmeService->delete($id));
    }
}
