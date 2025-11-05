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
        Schema::table('enderecos', function (Blueprint $table) {
            
            $table->renameColumn('usuario_id', 'paciente_id');

        });

        Schema::table('agendamentos', function (Blueprint $table) {
            
            $table->renameColumn('usuario_id', 'paciente_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->renameColumn('paciente_id', 'usuario_id');
        });

        Schema::table('agendamentos', function (Blueprint $table) {
            $table->renameColumn('paciente_id', 'usuario_id');
        });
    }
};
