@extends('layouts.menu')

@section('content')
    <div class="container">
        <h2>Mis Tareas por Sprint</h2>

        @if ($tareasPorSprint->isEmpty())
            <p>No tienes tareas asignadas.</p>
        @else
            @foreach ($tareasPorSprint as $sprintId => $tareas)
                <h3>Sprint: {{ $tareas->first()->sprint->nombre }}</h3> <!-- Nombre del sprint -->
               

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Prioridad</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Entrega</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tareas as $tarea)
                                <tr>
                                    <td>{{ $tarea->titulo }}</td>
                                    <td>{{ $tarea->descripcion }}</td>
                                    <td>
                                        <form action="{{ route('tareas.edit', $tarea->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="estado" class="form-select" onchange="this.form.submit()">
                                                <option value="Pendiente"
                                                    {{ $tarea->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="En Proceso"
                                                    {{ $tarea->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso
                                                </option>
                                                <option value="Completado"
                                                    {{ $tarea->estado == 'Completado' ? 'selected' : '' }}>Completado
                                                </option>
                                                <option value="Bloqueado"
                                                    {{ $tarea->estado == 'Bloqueado' ? 'selected' : '' }}>Bloqueado</option>
                                                <option value="Revisar" {{ $tarea->estado == 'Revisar' ? 'selected' : '' }}>
                                                    Revisar</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>{{ $tarea->prioridad }}</td>
                                    <td>{{ $tarea->fecha_inicio }}</td>
                                    <td>{{ $tarea->fecha_entrega }}</td>
                                    <td>
                                        <!-- Puedes agregar otros botones de acción aquí, si es necesario -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
            

        @endif
    </div>
@endsection
