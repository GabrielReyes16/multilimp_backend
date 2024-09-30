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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id(); // Agregar auto-incremento al campo id
            $table->string('ruc')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('cod_unidad')->nullable();
            $table->string('departamento')->nullable();
            $table->string('provincia')->nullable();
            $table->string('distrito')->nullable();
            $table->string('direccion')->nullable();
            $table->string('logo')->nullable();
            $table->string('correo')->nullable();
            $table->string('web')->nullable();
            $table->text('direcciones')->nullable(); // Cambiado a 'text' para cadenas largas
            $table->string('telefono')->nullable();
            $table->integer('estado')->nullable();
            $table->timestamps(); // Esto crea created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
};
