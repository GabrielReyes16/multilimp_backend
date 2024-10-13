<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacto_proveedores', function (Blueprint $table) {
            $table->id(); // Crea un campo `id` autoincremental
            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('cargo')->nullable();
            $table->unsignedBigInteger('id_cliente')->nullable(); // Cambiado a unsignedBigInteger
            $table->integer('estado')->nullable();
            $table->timestamps();

            // Puedes agregar restricciones de clave foránea si es necesario
            // $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacto_proveedores');
    }
};
