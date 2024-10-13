<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('op_productos', function (Blueprint $table) {
            $table->id(); // Cambia a auto-incremental
            $table->string('codigo')->nullable();
            $table->text('descripcion')->nullable(); // Usa text para grandes descripciones
            $table->string('medida')->nullable();
            $table->string('p_cliente')->nullable();
            $table->string('almacen')->nullable();
            $table->string('cantidad')->nullable();
            $table->decimal('precio_unitario', 10, 4)->nullable(); // Cambia a decimal para precios
            $table->decimal('total', 10, 4)->nullable(); // Cambia a decimal para total
            $table->string('id_orden_pedido')->nullable();
            $table->string('id_seguimiento')->nullable();
            $table->timestamps(); // Para 'created_at' y 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('op_productos');
    }
};
