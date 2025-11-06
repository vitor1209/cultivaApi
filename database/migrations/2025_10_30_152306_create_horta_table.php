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
        Schema::create('horta', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nome_horta')->nullable();
            $table->integer('fk_usuario_id')->nullable()->index('fk_horta_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horta');
    }
};
