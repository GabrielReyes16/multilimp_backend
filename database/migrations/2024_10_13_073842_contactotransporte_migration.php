<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacto_transportes', function (Blueprint $table) {
            $table->id(); // Cambia a auto-incremental
            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('cargo')->nullable();
            $table->string('id_transporte')->nullable();
            $table->integer('estado')->nullable();
            $table->timestamps(); // Para 'created_at' y 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacto_transportes');
    }
};
