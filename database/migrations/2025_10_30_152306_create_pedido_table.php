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
        Schema::create('pedido', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->dateTime('data_hora')->nullable();
            $table->decimal('preco_final', 10)->nullable();
            $table->boolean('status')->nullable();
            $table->text('observacoes')->nullable();
            $table->string('forma_pagamento')->nullable();
            $table->text('avaliacao')->nullable();
            $table->integer('fk_entrega_id')->nullable()->index('fk_pedido_2');
            $table->integer('fk_usuario_id')->nullable()->index('fk_pedido_3');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};
