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
        Schema::create('administradores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf', 14)->nullable();
            $table->string('email')->unique();
            $table->string('telefone',15)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('foto')->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->string('cargo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes(); // para SoftDeletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administradores');
    }
};
