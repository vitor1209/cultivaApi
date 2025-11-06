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
        Schema::table('produto', function (Blueprint $table) {
            $table->foreign(['fk_horta_id'], 'FK_produto_2')->references(['id'])->on('horta')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['fk_unidade_medida_id'], 'FK_produto_3')->references(['id'])->on('unidade_medida')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto', function (Blueprint $table) {
            $table->dropForeign('FK_produto_2');
            $table->dropForeign('FK_produto_3');
        });
    }
};
