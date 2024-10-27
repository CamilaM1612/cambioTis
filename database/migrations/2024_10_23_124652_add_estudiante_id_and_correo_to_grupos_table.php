<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstudianteIdAndCorreoToGruposTable extends Migration
{
    public function up()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->foreignId('estudiante_id')->constrained('users')->onDelete('cascade'); // Relación con la tabla de usuarios (asumiendo que el modelo Usuario es el que almacena los estudiantes)
            $table->string('correo')->nullable(); // Correo del estudiante
        });
    }

    public function down()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropForeign(['estudiante_id']); // Eliminar la clave foránea
            $table->dropColumn(['estudiante_id', 'correo']); // Eliminar las columnas
        });
    }
}
