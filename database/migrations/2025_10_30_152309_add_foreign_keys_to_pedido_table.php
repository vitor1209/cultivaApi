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
        Schema::table('pedido', function (Blueprint $table) {
            $table->foreign(['fk_entrega_id'], 'FK_pedido_2')->references(['id'])->on('entrega')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['fk_usuario_id'], 'FK_pedido_3')->references(['id'])->on('usuario')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido', function (Blueprint $table) {
            $table->dropForeign('FK_pedido_2');
            $table->dropForeign('FK_pedido_3');
        });
    }
};
