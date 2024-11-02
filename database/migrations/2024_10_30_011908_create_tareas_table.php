<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sprint_id')->constrained()->onDelete('cascade'); // Eliminar tareas si el sprint es eliminado
            $table->foreignId('usuario_id')->nullable()->constrained()->onDelete('set null'); // Permitir que el usuario sea nulo y no eliminar la tarea
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['Pendiente', 'En Proceso', 'Completado', 'Bloqueado', 'Revisar'])->default('Pendiente');
            $table->enum('prioridad', ['Alta', 'Media', 'Baja'])->default('Media');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_entrega')->nullable();
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
        Schema::dropIfExists('tareas');
    }
}
