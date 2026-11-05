<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); #Cria uma chave primária auto-incrementante
            $table->string('title'); #armazena o título do post como uma coluna VARCHAR
            $table->string('slug')->unique();   #armazena uma versão à URL do título. "unique()" restringe que cada URL seja única.
            $table->text('content'); #armazena um corpo maior do que o VARCHAR
            $table->enum('status', ['draft', 'publish'])->default('draft'); #restringe o status a dois valores possíveis e inadimplem novas postagens para "draft".
            $table->timestamps(); #acrescenta created_at e updated_at, essas são coluna que o Laravel gerencia automaticamente.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
