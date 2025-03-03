<?php

namespace App\Services;

use App\Models\Filme;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class FilmeService
{
    public function __construct(
        protected Filme $filme
    )
    {}

    // Criar um novo filme/série
    public function create(array $data): Filme | MessageBag
    {
        $validator = Validator::make($data, [
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'diretor' => 'nullable|string|max:255',
            'ano' => 'nullable|integer',
            'poster' => 'nullable|string|url',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $result = $this->filme->create($data);

        return $result;
    }

    // Listar todos os filmes
    public function list(): Collection
    {
        $filmes = $this->filme->all();
        return $filmes;
    }

    // Mostrar os detalhes de um filme
    public function show(int $id): Filme | array
    {
        $filme = $this->filme->find($id);

        if ($filme) {
            return $filme;
        }

        return ['errors' => 'Filme não encontrado'];
    }

    // Editar um filme
    public function update(int $id, array $data): Filme | array
    {
        $filme = $this->filme->find($id);

        if (!$filme) {
            return ['errors' => 'Filme não encontrado'];
        }

        $filme->update($data);
        return $filme;
    }

    // Deletar um filme
    public function delete(int $id): array
    {
        $filme = $this->filme->find($id);
        if (!$filme) {
            return ['errors' => 'Filme não encontrado'];
        }

        $filme->delete();
        return ['message' => 'Filme deletado com sucesso'];
    }
}
