@extends('componentes.menu')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Area Docente</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <i class="fas fa-calendar"></i>
                Este semestre
            </button>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-sm">
                                <span class="avatar-title bg-primary-subtle rounded">
                                    <i class="fas fa-chalkboard-teacher text-primary"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Grupos Oficiales</h6>
                            <h2 class="card-title mb-0">4</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-sm">
                                <span class="avatar-title bg-success-subtle rounded">
                                    <i class="fas fa-user-graduate text-success"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Total Estudiantes</h6>
                            <h2 class="card-title mb-0">120</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-sm">
                                <span class="avatar-title bg-info-subtle rounded">
                                    <i class="fas fa-tasks text-info"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Tareas por Calificar</h6>
                            <h2 class="card-title mb-0">15</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-sm">
                                <span class="avatar-title bg-warning-subtle rounded">
                                    <i class="fas fa-comments text-warning"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Mensajes Nuevos</h6>
                            <h2 class="card-title mb-0">7</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Tareas Pendientes de Calificar -->
        <div class="col-12 col-xl-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tareas Pendientes de Calificar</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Tarea</th>
                                    <th>Fecha Entrega</th>
                                    <th>Estudiantes</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Programación Avanzada</td>
                                    <td>Proyecto Final</td>
                                    <td>15/10/2024</td>
                                    <td>30/35</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Calificar</a></td>
                                </tr>
                                <tr>
                                    <td>Bases de Datos</td>
                                    <td>Diseño ER</td>
                                    <td>20/10/2024</td>
                                    <td>28/40</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Calificar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna derecha -->
        <div class="col-12 col-xl-4">
            <!-- Accesos Rápidos -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Accesos Rápidos</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-book me-2"></i>Gestionar Cursos
                        </a>
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-clipboard-list me-2"></i>Crear Tarea
                        </a>
                        <a href="#" class="btn btn-info text-white">
                            <i class="fas fa-comments me-2"></i>Foro de Discusión
                        </a>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Rendimiento -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Rendimiento por Curso</h5>
                </div>
                <div class="card-body">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar-sm {
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-title {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .bg-primary-subtle { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1); }
    .bg-info-subtle { background-color: rgba(13, 202, 240, 0.1); }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1); }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('performanceChart').getContext('2d');
    var performanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Prog. Avanzada', 'Bases de Datos', 'Redes', 'IA'],
            datasets: [{
                label: 'Promedio del Curso',
                data: [85, 78, 82, 88],
                backgroundColor: [
                    '#0d6efd',
                    '#198754',
                    '#0dcaf0',
                    '#ffc107'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
});
</script>
@endpush
@endsection