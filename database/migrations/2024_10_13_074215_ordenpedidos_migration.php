<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orden_pedidos', function (Blueprint $table) {
            $table->id(); // Si quieres que Laravel maneje automáticamente el ID
            $table->string('id_op');
            $table->unsignedBigInteger('id_empresa')->nullable();
            $table->date('fecha_orden_pedido')->nullable();
            $table->date('fecha_programacion')->nullable();
            $table->string('tipo_envio')->nullable();
            $table->string('id_proveedor');
            $table->string('contacto_proveedor')->nullable();
            $table->string('nota_pedido')->nullable();
            $table->date('fecha_recepcion')->nullable();
            $table->string('tipo_pago')->nullable();
            $table->string('nota_pago', 1000)->nullable();
            $table->string('etiquetado', 1000)->nullable();
            $table->string('embalaje', 1000)->nullable();
            $table->string('observaciones', 1000)->nullable();
            $table->decimal('total_proveedor', 10, 2)->nullable();
            $table->unsignedBigInteger('id_transporte')->nullable();
            $table->string('contacto_transporte')->nullable();
            $table->string('cot_transporte')->nullable();
            $table->string('flete')->nullable();
            $table->string('t_departamento')->nullable();
            $table->string('t_provincia')->nullable();
            $table->string('t_distrito')->nullable();
            $table->string('t_direccion')->nullable();
            $table->string('transporte_nota')->nullable();
            $table->string('t_factura')->nullable();
            $table->string('t_grt')->nullable();
            $table->date('t_fecha_pago')->nullable();
            $table->string('estado_op')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('retorno_mercaderia')->nullable();
            $table->string('cargo_oea')->nullable();
            $table->string('nota_op', 5000)->nullable();
            $table->unsignedBigInteger('id_seguimiento');
            $table->timestamps();

            // Aquí puedes definir claves foráneas si es necesario
            // $table->foreign('id_seguimiento')->references('id')->on('seguimientos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orden_pedidos');
    }
};
