<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'diretor',
        'ano',
        'poster',
    ];

    // Relacionamento com a categoria
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'filme_categoria');
    }
}
