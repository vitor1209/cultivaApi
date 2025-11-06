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
        Schema::create('produto', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nome')->nullable();
            $table->decimal('preco_unit', 10)->nullable();
            $table->integer('quantidade_estoque')->nullable();
            $table->text('descricao')->nullable();
            $table->date('validade')->nullable();
            $table->double('quant_unit_medida', null, 0)->nullable();
            $table->integer('fk_horta_id')->nullable()->index('fk_produto_2');
            $table->integer('fk_unidade_medida_id')->nullable()->index('fk_produto_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto');
    }
};
