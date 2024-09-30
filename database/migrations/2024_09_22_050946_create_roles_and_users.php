<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesAndUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Crear la tabla roles primero, ya que users depende de esta
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del rol, e.g., Admin, Usuario, etc.
            $table->string('description')->nullable(); // Descripción opcional del rol
            $table->timestamps();
        });

        // Crear la tabla users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Campo "name" obligatorio
            $table->string('email')->nullable()->unique(); // Campo "email" opcional y único
            $table->timestamp('email_verified_at')->nullable(); // Campo para verificación de email
            $table->string('password'); // Contraseña obligatoria
            $table->string('remember_token', 100)->nullable(); // Token de "recordar" para sesiones
            $table->timestamps(); // created_at y updated_at
            $table->string('nombre'); // Campo adicional "nombre"
            $table->string('apellido'); // Campo adicional "apellido"
            $table->string('foto')->nullable(); // Campo opcional para almacenar una foto
            $table->longText('tabla')->nullable(); // Campo opcional "tabla"
            // Relación con la tabla roles
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar la tabla users primero porque depende de roles
        Schema::dropIfExists('users');
        // Luego eliminar la tabla roles
        Schema::dropIfExists('roles');
    }
}
