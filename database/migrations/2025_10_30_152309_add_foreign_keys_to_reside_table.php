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
        Schema::table('reside', function (Blueprint $table) {
            $table->foreign(['fk_usuario_id'], 'FK_reside_1')->references(['id'])->on('usuario')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['fk_endereco_id'], 'FK_reside_2')->references(['id'])->on('endereco')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reside', function (Blueprint $table) {
            $table->dropForeign('FK_reside_1');
            $table->dropForeign('FK_reside_2');
        });
    }
};
