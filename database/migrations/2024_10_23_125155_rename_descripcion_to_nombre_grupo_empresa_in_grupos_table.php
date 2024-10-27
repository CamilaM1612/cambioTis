<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDescripcionToNombreGrupoEmpresaInGruposTable extends Migration
{
    public function up()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->renameColumn('nombre', 'nombre_grupo_empresa');
        });
    }

    public function down()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->renameColumn('nombre_grupo_empresa', 'nombre');
        });
    }
}
