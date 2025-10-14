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
        Schema::create('clinicas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cnpj', 18)->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('telefone', 15)->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado', 2)->nullable(); // Ex: SP, RJ
            $table->string('cep', 10)->nullable();
            $table->string('responsavel')->nullable();
            $table->string('logo')->nullable(); // caminho da imagem
            $table->softDeletes(); // permite exclusão lógica

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinicas');
    }
};
