<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasEvaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_evaluacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preguntas_evaluacion_id')->constrained('preguntas_evaluacion')->onDelete('cascade'); // Pregunta de la evaluación
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade'); // Usuario que responde
            $table->text('respuesta'); // Respuesta escrita (puede ser texto libre)
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
        Schema::dropIfExists('respuestas_evaluacion');
    }
}
