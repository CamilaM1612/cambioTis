<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestaAutoEvaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuesta_auto_evaluacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_evaluacion_id')->constrained('auto_evaluaciones')->onDelete('cascade');
            $table->foreignId('pregunta_id')->constrained('preguntas')->onDelete('cascade');
            $table->integer('respuesta'); // Respuesta del estudiante
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
        Schema::dropIfExists('respuesta_auto_evaluacion');
    }
}
