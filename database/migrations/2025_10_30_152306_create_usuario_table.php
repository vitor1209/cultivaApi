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
        Schema::create('usuario', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('email')->nullable();
            $table->string('nome')->nullable();
            $table->string('password', 100)->nullable();
            $table->string('telefone', 15)->nullable();
            $table->date('datanasc')->nullable();
            $table->text('foto')->nullable();
            $table->text('banner')->nullable();
            $table->string('Tipo_usuario', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};


//   Schema::table('users', function (Blueprint $table) {
//             $table->enum('role', ['consumidor', 'produtor'])->default('consumidor');
//         });