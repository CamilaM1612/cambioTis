<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('recursos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre'); // Nombre del recurso
        $table->string('ruta'); // Ruta del archivo
        $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade'); // Relación con usuario
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
        Schema::dropIfExists('recursos');
    }
}
