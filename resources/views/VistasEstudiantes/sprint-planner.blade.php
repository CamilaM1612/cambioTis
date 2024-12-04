@extends('layouts.menu')

@section('content')
<div class="container">
    <h2>Proyectos y Sprints</h2>

    <!-- Selector de proyectos -->
    <div class="mb-3">
        <label for="proyecto-select" class="form-label">Selecciona un proyecto:</label>
        <select id="proyecto-select" class="form-control">
            <option value="">-- Selecciona un proyecto --</option>
            @foreach ($equipos as $equipo)
                @foreach ($equipo->proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                @endforeach
            @endforeach
        </select>
    </div>

    <!-- Botón para crear un sprint, inicialmente oculto -->
    <div id="crear-sprint-container" style="display: none;">
        <button type="button" id="crear-sprint-btn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearSprintModal">
            <i class="bi bi-plus-circle"></i> Crear Sprint
        </button>
    </div>

    <!-- Tabla de sprints -->
    <div id="sprints-container" class="mt-4">
        <h4>Sprints del proyecto</h4>
        <table class="table" id="sprints-table" style="display: none;">
            <thead>
                <tr>
                    <th scope="col">Sprint</th>
                    <th scope="col">Fecha de Inicio</th>
                    <th scope="col">Fecha de Entrega</th>
                    <th scope="col">Duración (días)</th>
                    <th scope="col">Objetivos</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal para crear un sprint -->
<div class="modal fade" id="crearSprintModal" tabindex="-1" aria-labelledby="crearSprintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearSprintModalLabel">Crear Sprint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sprints.store') }}" method="POST">
                    @csrf

                    <!-- Campo oculto para pasar el proyecto_id -->
                    <input type="hidden" id="proyecto-id-input" name="proyecto_id">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Sprint</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="objetivo" class="form-label">Objetivo del Sprint</label>
                        <textarea class="form-control" name="objetivo"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" name="fecha_fin" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Sprint</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const proyectoSelect = document.getElementById('proyecto-select');
    const crearSprintContainer = document.getElementById('crear-sprint-container');
    const proyectoIdInput = document.getElementById('proyecto-id-input');
    const sprintsTable = document.getElementById('sprints-table');
    const sprintsTableBody = sprintsTable.querySelector('tbody');

    proyectoSelect.addEventListener('change', function () {
        const proyectoId = this.value;

        if (proyectoId) {
            // Mostrar el botón para crear sprint
            crearSprintContainer.style.display = 'block';
            proyectoIdInput.value = proyectoId;

            // Fetch para obtener los sprints
            fetch(`/sprints/${proyectoId}`)
                .then(response => response.json())
                .then(sprints => {
                    sprintsTableBody.innerHTML = ''; // Limpiar la tabla
                    sprintsTable.style.display = 'table'; // Mostrar la tabla

                    sprints.forEach(sprint => {
                        // Calcular la duración del sprint
                        const inicio = new Date(sprint.fecha_inicio);
                        const fin = new Date(sprint.fecha_fin);
                        const duracion = Math.ceil((fin - inicio) / (1000 * 60 * 60 * 24));

                        // Crear fila
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td><a href="/sprints/${sprint.id}">${sprint.nombre}</a></td>
                            <td>${new Date(sprint.fecha_inicio).toLocaleDateString()}</td>
                            <td>${new Date(sprint.fecha_fin).toLocaleDateString()}</td>
                            <td>${duracion} días</td>
                            <td>${sprint.objetivo || 'N/A'}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarSprintModal-${sprint.id}">
                                    <i class="bi bi-pencil"></i> Editar
                                </button>
                                <form action="/sprints/${sprint.id}" method="POST" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este sprint?');">
                                        <i class="bi bi-trash3"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        `;
                        sprintsTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error:', error));
        } else {
            // Ocultar el botón y limpiar la tabla
            crearSprintContainer.style.display = 'none';
            proyectoIdInput.value = '';
            sprintsTable.style.display = 'none';
            sprintsTableBody.innerHTML = '';
        }
    });
</script>
@endsection
