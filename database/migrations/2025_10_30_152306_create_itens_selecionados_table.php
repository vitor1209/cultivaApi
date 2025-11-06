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
        Schema::create('itens_selecionados', function (Blueprint $table) {
            $table->integer('fk_produto_id')->nullable()->index('fk_itens_selecionados_2');
            $table->integer('fk_pedido_id')->nullable()->index('fk_itens_selecionados_3');
            $table->integer('id')->primary();
            $table->integer('quantidade_item_total')->nullable();
            $table->decimal('preco_item_total', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_selecionados');
    }
};
