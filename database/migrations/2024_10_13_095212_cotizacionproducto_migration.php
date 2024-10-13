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
        Schema::create('cotizacion_productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('descripcion', 10000)->nullable();
            $table->string('medida')->nullable();
            $table->string('p_cliente')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('precio_unitario')->nullable();
            $table->string('total')->nullable();
            $table->string('id_cotizacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizacion_productos');
    }
};
