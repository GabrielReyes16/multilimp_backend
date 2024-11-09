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
        Schema::create('banco_proveedores', function (Blueprint $table) {
            $table->id(); // Campo id
            $table->integer('id_proveedor'); // Campo id_proveedor
            $table->string('numero_cuenta', 255)->nullable(); // Campo numero_cuenta
            $table->string('nombre_banco', 255)->nullable(); // Campo nombre_banco
            $table->boolean('estado')->nullable()->default(1); // Campo estado
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banco_proveedores');
    }
};
