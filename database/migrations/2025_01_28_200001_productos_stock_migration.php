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
        Schema::create('producto_stock', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('marca')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('categoria')->nullable();
            $table->integer('stock')->nullable();
            $table->string('almacen')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('isActive')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_stock');
    }
};
