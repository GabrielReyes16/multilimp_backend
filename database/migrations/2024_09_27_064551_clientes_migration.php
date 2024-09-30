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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Campo id auto-incremental como clave primaria
            $table->string('ruc'); // RUC, valor único
            $table->string('razon_social'); // Razón social del cliente
            $table->string('cod_unidad'); // Código de unidad del cliente
            $table->string('departamento')->nullable(); // Departamento (nullable si puede ser opcional)
            $table->string('provincia')->nullable(); // Provincia (nullable si puede ser opcional)
            $table->string('distrito')->nullable(); // Distrito (nullable si puede ser opcional)
            $table->string('direccion')->nullable(); // Dirección (nullable si puede ser opcional)
            $table->boolean('estado')->nullable(); // Estado (nullable si puede ser opcional, boolean)
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
