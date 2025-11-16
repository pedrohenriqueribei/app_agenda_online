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
        Schema::create('prontuario_psicologico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('profissional_id')->constrained('profissionais')->onDelete('cascade');
            $table->text('avaliacao_demanda')->nullable();
            $table->text('definicao_objetivos')->nullable();
            $table->string('status')->default('aberto')->nullable();
            $table->timestamps();
        });

        Schema::create('registros_evolucao', function(Blueprint $table){
            $table->id();
            $table->foreignId('prontuario_psicologico_id')->constrained('prontuario_psicologico')->onDelete('cascade');
            $table->text('descricao');
            $table->timestamp('data_registro')->useCurrent();
            $table->timestamps();
        });

        Schema::create('registros_encaminhamento', function(Blueprint $table) {
            $table->id();
            $table->foreignId('prontuario_psicologico_id')->constrained('prontuario_psicologico')->onDelete('cascade');
            $table->text('descricao');
            $table->string('tipo');
            $table->timestamp('data_registro')->useCurrent();
            $table->timestamps();
        });

        Schema::create('registros_documentos', function(Blueprint $table){
            $table->id();
            $table->foreignId('prontuario_psicologico_id')->constrained('prontuario_psicologico')->onDelete('cascade');
            $table->text('finalidade');
            $table->string('destinatario');
            $table->timestamp('data_registro')->useCurrent();
            $table->timestamp('data_emissao')->nullable();
            $table->timestamps();
        });

        Schema::create('registros_instrumentos', function(Blueprint $table){
            $table->id();
            $table->foreignId('prontuario_psicologico_id')->constrained('prontuario_psicologico')->onDelete('cascade');
            $table->timestamp('data_registro')->useCurrent();
            $table->text('instrumento_avaliacao_psi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_evolucao');
        Schema::dropIfExists('registros_encaminhamento');
        Schema::dropIfExists('registros_documentos');
        Schema::dropIfExists('registros_instrumentos');
        Schema::dropIfExists('prontuario_psicologico');
    }
};
