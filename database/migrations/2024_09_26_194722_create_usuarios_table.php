<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Campo de nombre
            $table->string('email')->unique(); // Correo electrónico (único)
            $table->string('password'); // Contraseña
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Clave foránea
            $table->string('phone', 15)->nullable(); // Número de teléfono (opcional)
            $table->date('birthdate')->nullable(); // Fecha de nacimiento
            $table->boolean('estado')->default(true);
            $table->timestamps(); // Timestamps de creación y actualización
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
