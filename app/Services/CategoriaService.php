<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class CategoriaService
{
    public function __construct(
        protected Categoria $categoria
    )
    {}

    // Criar uma nova categoria
    public function create(array $data): Categoria | MessageBag
    {
        $validator = Validator::make($data, [
            'nome' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $categoria = $this->categoria->create($data);

        return $categoria;
    }

    // Listar todas as categorias
    public function list(): Collection
    {
        $categorias = $this->categoria->all();
        return $categorias;
    }

    // Mostrar os detalhes de uma categoria
    public function show(int $id): Categoria | array
    {
        $categoria = $this->categoria->find($id);
        if ($categoria) {
            return $categoria;
        }

        return ['errors' => 'Categoria não encontrada'];
    }

    // Editar uma categoria
    public function update(int $id, array $data): Categoria | array
    {
        $categoria = $this->categoria->find($id);
        if (!$categoria) {
            return ['errors' => 'Categoria não encontrada'];
        }

        $categoria->update($data);
        return $categoria;
    }

    // Deletar uma categoria
    public function delete(int $id): array
    {
        $categoria = $this->categoria->find($id);
        if (!$categoria) {
            return ['errors' => 'Categoria não encontrada'];
        }

        $categoria->delete();
        return ['message' => 'Categoria deletada com sucesso'];
    }
}
