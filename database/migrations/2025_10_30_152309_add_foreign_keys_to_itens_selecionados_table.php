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
        Schema::table('itens_selecionados', function (Blueprint $table) {
            $table->foreign(['fk_produto_id'], 'FK_itens_selecionados_2')->references(['id'])->on('produto')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['fk_pedido_id'], 'FK_itens_selecionados_3')->references(['id'])->on('pedido')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itens_selecionados', function (Blueprint $table) {
            $table->dropForeign('FK_itens_selecionados_2');
            $table->dropForeign('FK_itens_selecionados_3');
        });
    }
};
