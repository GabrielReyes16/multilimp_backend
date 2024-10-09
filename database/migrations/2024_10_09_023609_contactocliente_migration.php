<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_clientes', function (Blueprint $table) {
            $table->id(); // Campo id
            $table->string('nombre', 255)->nullable(); // Campo nombre
            $table->string('telefono', 255)->nullable(); // Campo telefono
            $table->string('correo', 255)->nullable(); // Campo correo
            $table->string('cargo', 255)->nullable(); // Campo cargo
            $table->string('id_cliente', 255)->nullable(); // Campo id_cliente
            $table->integer('estado')->nullable(); // Campo estado
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacto_clientes');
    }
};
