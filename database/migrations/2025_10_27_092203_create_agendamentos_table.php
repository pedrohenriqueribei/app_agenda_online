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
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();

            //profissionais
            $table->foreignId('profissional_id')
                ->constrained('profissionais')
                ->cascadeOnDelete();

            //paciente
            $table->foreignId('usuario_id')
                ->nullable()
                ->constrained('pacientes')
                ->cascadeOnDelete();
            
            //clinica
            $table->foreignId('clinica_id')
                ->constrained('clinicas')
                ->cascadeOnDelete();

            //atributos (colunas)
            $table->date('data');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->string('status', 20)->default('pendente'); // pendente, confirmado, cancelado
            $table->string('modalidade', 30)->default('presencial')->nullable();
            $table->string('especie', 30)->default('particular')->nullable();
            $table->text('observacoes')->nullable();

            $table->timestamps();

            $table->unique(['profissional_id', 'clinica_id',  'data', 'hora_inicio'], 'agendamento_unico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
