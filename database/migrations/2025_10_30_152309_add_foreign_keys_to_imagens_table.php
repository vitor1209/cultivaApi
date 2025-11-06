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
        Schema::table('imagens', function (Blueprint $table) {
            $table->foreign(['fk_produto_id'], 'FK_imagens_2')->references(['id'])->on('produto')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('imagens', function (Blueprint $table) {
            $table->dropForeign('FK_imagens_2');
        });
    }
};
