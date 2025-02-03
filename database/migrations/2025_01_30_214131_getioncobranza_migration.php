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
        Schema::create('gestion_cobranzas', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_seguimiento');
            $table->text('historial')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_gestion')->nullable();
            $table->string('documento_url')->nullable();
            $table->integer('estado')->nullable()->default(1);
            $table->timestamps();
            $table->foreign('id_seguimiento')->references('id')->on('seguimientos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestion_cobranzas');
    }
};
