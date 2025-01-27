<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tesoreria',function( Blueprint $table){
            $table->id();
            $table->date('fecha_pago')->nullable();
            $table->string('banco')->nullable();
            $table->string('descripcion')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->unsignedBigInteger('id_orden_pedido')->nullable();
            $table->unsignedBigInteger('id_seguimiento')->nullable();
            $table->integer('estado')->nullable()->default(1);
            $table->timestamps();
            $table->foreign('id_orden_pedido')->references('id')->on('orden_pedidos');
            $table->foreign('id_seguimiento')->references('id')->on('seguimientos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tesoreria');
    }
};
