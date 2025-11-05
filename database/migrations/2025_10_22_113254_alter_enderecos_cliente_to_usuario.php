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
            // Remove a chave estrangeira antiga (cliente_id)
            $table->dropForeign(['cliente_id']);
            $table->dropColumn('cliente_id');

            // Cria a coluna como nullablere
            $table->unsignedBigInteger('usuario_id')->nullable();

            // Define a chave estrangeira
            $table->foreign('usuario_id')
                  ->references('id')->on('pacientes')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enderecos', function (Blueprint $table) {
            // Remove a chave estrangeira nova (usuario_id)
            $table->dropForeign(['usuario_id']);
            $table->dropColumn('usuario_id');

            // Recria a coluna cliente_id
            $table->unsignedBigInteger('cliente_id');

            // Aplica a chave estrangeira
            $table->foreign('cliente_id')
                ->references('id')->on('clientes')
                ->onDelete('cascade');
        });
    }
};
