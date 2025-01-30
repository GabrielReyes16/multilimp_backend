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
        Schema::create('facturaciones', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->string('factura')->nullable();
            $table->date('fecha_factura')->nullable();
            $table->string('grr')->nullable();
            $table->decimal('retencion', 10, 2)->nullable();
            $table->decimal('detraccion', 10, 2)->nullable();
            $table->string('forma_envio')->nullable();
            $table->integer('estado')->nullable()->default(1);
            $table->timestamps();
            $table->foreign('id_venta')->references('id')->on('seguimientos');
        });

        Schema::create('refacturaciones', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_facturacion');
            $table->unsignedBigInteger('id_venta');
            $table->string('factura')->nullable();
            $table->date('fecha_factura')->nullable();
            $table->string('grr')->nullable();
            $table->decimal('retencion', 10, 2)->nullable();
            $table->decimal('detraccion', 10, 2)->nullable();
            $table->string('forma_envio')->nullable();
            $table->integer('estado')->nullable()->default(1);
            $table->timestamps();
            $table->foreign('id_facturacion')->references('id')->on('facturaciones');
            $table->foreign('id_venta')->references('id')->on('seguimientos');
        });

    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('facturaciones');
        Schema::dropIfExists('refacturaciones');
    }
};
