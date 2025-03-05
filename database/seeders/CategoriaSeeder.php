<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nome' => 'Ação'],
            ['nome' => 'Comédia'],
            ['nome' => 'Drama'],
            ['nome' => 'Ficção Científica'],
            ['nome' => 'Terror'],
            ['nome' => 'Romance'],
            ['nome' => 'Documentário']
        ];

        foreach ($categories as $category) {
            Categoria::create($category);
        }
    }
}
