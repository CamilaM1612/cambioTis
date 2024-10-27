<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project; // Asegúrate de importar tu modelo de Project

class StudentController extends Controller
{
    public function projects()
{
    $projects = Project::all(); // Asegúrate de tener el modelo Project
    return view('VistasEstudiantes.projects', compact('projects'));
}

    public function showProject($id)
    {
        $project = Project::findOrFail($id);
        return view('VistasEstudiantes.projectDetail', compact('project'));
    }

    public function submitProject(Request $request, $id)
    {
        // Lógica para enviar el proyecto
        // ...
    }
}
