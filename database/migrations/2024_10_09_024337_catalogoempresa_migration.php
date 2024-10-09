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
        Schema::create('catalogo_empresas', function (Blueprint $table) {
            $table->id(); // Campo id
            $table->string('codigo', 255)->nullable(); // Campo codigo
            $table->integer('id_empresa'); // Campo id_empresa
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
        Schema::dropIfExists('catalogo_empresas');
    }
};
