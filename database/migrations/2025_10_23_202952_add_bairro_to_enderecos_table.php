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
            //adicionar a coluna bairro
            Schema::table('enderecos', function (Blueprint $table) {
                $table->string('bairro', 100)->nullable()->after('complemento');
            });

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enderecos', function (Blueprint $table) {
            //
            Schema::table('enderecos', function (Blueprint $table) {
                $table->dropColumn('bairro');
            });

        });
    }
};
