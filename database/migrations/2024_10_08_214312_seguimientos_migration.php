<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_emision')->nullable();
            $table->string('oce')->nullable();
            $table->string('ocf')->nullable();
            $table->unsignedBigInteger('id_empresa')->nullable();
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->string('catalogo')->nullable();
            $table->date('fecha_form')->nullable();
            $table->date('fecha_max_form')->nullable();
            $table->decimal('monto_venta', 10, 2)->nullable();
            $table->string('siaf')->nullable();
            $table->string('cprovincia')->nullable();
            $table->string('cdistrito')->nullable();
            $table->string('cdepartamento')->nullable();
            $table->string('cdireccion')->nullable();
            // Cambiar tipo de dato de binary a string
            $table->string('creferencia')->nullable();
            $table->string('productos')->nullable();
            $table->string('etapa_siaf')->nullable();
            $table->date('fecha_siaf')->nullable();
            $table->string('factura')->nullable();
            $table->date('fecha_factura')->nullable();
            $table->string('grr')->nullable();
            $table->string('retencion')->nullable();
            $table->string('detraccion')->nullable();
            $table->string('forma_envio')->nullable();
            $table->string('re_factura')->nullable();
            $table->date('re_fecha_factura')->nullable();
            $table->string('re_grr')->nullable();
            $table->string('re_retencion')->nullable();
            $table->string('re_detraccion')->nullable();
            $table->string('re_forma_envio')->nullable();
            $table->text('nota_credito')->nullable();
            $table->string('id_venta');
            $table->string('contacto_cliente')->nullable();
            $table->decimal('op_proveedor', 10, 2)->nullable();
            $table->string('cargo_entrega')->nullable();
            $table->string('peru_compras')->nullable();
            $table->date('fecha_peru_compras')->nullable();
            $table->date('fecha_entrega_oc')->nullable();
            $table->string('contacto_cobrador')->nullable();
            $table->string('monto_retencion')->nullable();
            $table->string('monto_detraccion')->nullable();
            $table->decimal('penalidad', 10, 2)->nullable();
            $table->string('neto_cobrado')->nullable();
            $table->string('estado_moroza')->nullable();
            $table->date('fecha_cobro')->nullable();
            $table->date('proxima_gestion')->nullable();
            $table->integer('estado_activo')->nullable();
            $table->integer('estado_facturacion')->nullable();
            $table->integer('estado_tesoreria')->nullable();
            $table->string('inicio_cobranza')->nullable();
            $table->string('fin_cobranza')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seguimientos');
    }
};
