<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    protected $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    // Criar uma nova categoria
    public function create(Request $request)
    {
        $data = $request->all();
        $result = $this->categoriaService->create($data);
        return response()->json($result);
    }

    // Listar todas as categorias
    public function list()
    {
        $result = $this->categoriaService->list();
        return response()->json($result);
    }

    // Mostrar detalhes de uma categoria
    public function show($id)
    {
        $result = $this->categoriaService->show($id);
        return response()->json($result);
    }

    // Editar uma categoria
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $result = $this->categoriaService->update($id, $data);
        return response()->json($result);
    }

    // Deletar uma categoria
    public function delete($id)
    {
        $result = $this->categoriaService->delete($id);
        return response()->json($result);
    }
}
