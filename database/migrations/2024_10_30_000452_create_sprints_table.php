<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprints', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del sprint
            $table->text('objetivo')->nullable(); // Objetivo del sprint
            $table->date('fecha_inicio'); // Fecha de inicio
            $table->date('fecha_fin'); // Fecha de fin
            $table->foreignId('equipo_id')->constrained('equipos'); // Referencia al equipo
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
        Schema::dropIfExists('sprints');
    }
}
