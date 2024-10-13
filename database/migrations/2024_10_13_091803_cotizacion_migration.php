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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('id_cotizacion');
            $table->foreignId('id_empresa')->constrained('empresas');
            $table->foreignId('id_cliente')->nullable()->constrained('clientes');
            $table->foreignId('id_contacto_cliente')->nullable()->constrained('contacto_clientes');
            $table->decimal('monto', 10, 2)->nullable();
            $table->string('tipo_pago')->nullable();
            $table->text('nota_pago')->nullable();
            $table->binary('nota_pedido')->nullable();
            $table->string('c_direccion')->nullable();
            $table->string('c_distrito')->nullable();
            $table->string('c_provincia')->nullable();
            $table->string('c_departamento')->nullable();
            $table->binary('c_referencia')->nullable();
            $table->string('estado')->nullable();
            $table->date('fecha_cotizacion');
            $table->date('fecha_entrega')->nullable();
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
        Schema::dropIfExists('cotizaciones');
    }
};
