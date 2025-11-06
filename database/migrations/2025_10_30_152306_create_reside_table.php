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
        Schema::create('reside', function (Blueprint $table) {
            $table->integer('fk_usuario_id')->nullable()->index('fk_reside_1');
            $table->integer('fk_endereco_id')->nullable()->index('fk_reside_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reside');
    }
};
