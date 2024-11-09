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
        // Crear la tabla users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('foto')->nullable();
            $table->string('tabla')->nullable();
            $table->enum('rol', ['admin', 'user']); // Campo rol
            $table->rememberToken();
            $table->timestamps();
        });

        // Crear la tabla permisos_procesos
        Schema::create('permisos_procesos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Nombre del permiso
            $table->timestamps();
        });

        // Crear la tabla permisos_configuraciones
        Schema::create('permisos_configuraciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Nombre del permiso
            $table->timestamps();
        });

        // Crear tabla pivote user_permiso_proceso
        Schema::create('user_permiso_proceso', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('permiso_proceso_id')->constrained('permisos_procesos')->onDelete('cascade'); // Referencia explícita
            $table->primary(['user_id', 'permiso_proceso_id']); // Llave primaria compuesta
        });

        // Crear tabla pivote user_permiso_configuracion
        Schema::create('user_permiso_configuracion', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('permiso_configuracion_id')->constrained('permisos_configuraciones')->onDelete('cascade'); // Referencia explícita
            $table->primary(['user_id', 'permiso_configuracion_id']); // Llave primaria compuesta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permiso_configuracion');
        Schema::dropIfExists('user_permiso_proceso');
        Schema::dropIfExists('permisos_configuraciones');
        Schema::dropIfExists('permisos_procesos');
        Schema::dropIfExists('users');
    }
};
