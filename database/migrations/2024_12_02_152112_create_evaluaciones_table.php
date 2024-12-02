<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->constrained('grupos')->onDelete('cascade'); // Relacionamos con el grupo
            $table->enum('tipo', ['autoevaluacion', 'evaluacion_cruzada', 'evaluacion_pares']);
            $table->date('fecha_limite')->nullable();
            $table->foreignId('docente_id')->constrained('usuarios')->onDelete('cascade');  // Relacionamos con docentes (usuarios)
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
        Schema::dropIfExists('evaluaciones');
    }
}
