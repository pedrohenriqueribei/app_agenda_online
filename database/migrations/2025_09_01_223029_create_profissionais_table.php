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
        Schema::create('profissionais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf', 20)->unique();
            $table->string('email')->unique();
            $table->date('data_nascimento')->nullable();
            $table->string('telefone')->nullable();
            $table->string('foto')->nullable(); // caminho da imagem
            $table->string('especialidade')->nullable();
            $table->string('estado_civil')->nullable();
            $table->enum('sexo', ['M', 'F', 'O', 'N'])->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password');
            $table->softDeletes(); // para SoftDeletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profissionais');
    }
};
