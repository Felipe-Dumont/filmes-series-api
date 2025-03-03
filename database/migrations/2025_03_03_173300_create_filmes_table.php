<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // título do filme/série
            $table->text('descricao'); // descrição do filme/série
            $table->string('diretor')->nullable(); // diretor, caso tenha
            $table->integer('ano')->nullable(); // ano de lançamento
            $table->string('poster')->nullable(); // URL do poster
            $table->timestamps(); // created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('filmes');
    }

};
