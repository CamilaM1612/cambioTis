<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    public function up()
    {
        Schema::create('docente', function (Blueprint $table) {
            $table->id(); // Crea una columna de ID autoincremental
            $table->string('name'); // Columna para el nombre
            $table->string('email')->unique(); // Columna para el correo electrónico
            $table->string('phone')->nullable(); // Columna para el teléfono
            $table->timestamps(); // Crea las columnas created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('docente');
    }
}
