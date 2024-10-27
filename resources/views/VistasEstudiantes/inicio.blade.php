@extends('componentes.menu')

@section('content')
<div class="container">
    <h2>Bienvenido, {{ Auth::user()->name }}</h2>
    <a href="{{ route('student.projects') }}" class="btn btn-primary">Proyectos</a>
</div>
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Area personal</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <i class="fas fa-calendar"></i>
                Esta semana
            </button>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-sm">
                                <span class="avatar-title bg-primary-subtle rounded">
                                    <i class="fas fa-book text-primary"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Cursos Activos</h6>
                            <h2 class="card-title mb-0">6</h2>
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
                                    <i class="fas fa-tasks text-success"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Tareas Pendientes</h6>
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
                                <span class="avatar-title bg-info-subtle rounded">
                                    <i class="fas fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Próximos Exámenes</h6>
                            <h2 class="card-title mb-0">2</h2>
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
                                    <i class="fas fa-trophy text-warning"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Promedio General</h6>
                            <h2 class="card-title mb-0">8.5</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tareas Pendientes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Tarea</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Matemáticas</td>
                                    <td>Ejercicios Capítulo 3</td>
                                    <td>15/10/2024</td>
                                    <td><span class="badge bg-warning">Pendiente</span></td>
                                </tr>
                                <tr>
                                    <td>Programación</td>
                                    <td>Proyecto Final</td>
                                    <td>20/10/2024</td>
                                    <td><span class="badge bg-info">En Proceso</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Accesos Rápidos</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-calendar-alt me-2"></i>Ver Calendario
                        </a>
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-book me-2"></i>Mis Cursos
                        </a>
                        <a href="#" class="btn btn-info text-white">
                            <i class="fas fa-envelope me-2"></i>Mensajes
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Progreso del Semestre</h5>
                </div>
                <div class="card-body">
                    <canvas id="progressChart"></canvas>
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
    var ctx = document.getElementById('progressChart').getContext('2d');
    var progressChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Completado', 'En Proceso', 'Pendiente'],
            datasets: [{
                data: [65, 20, 15],
                backgroundColor: [
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
            }
        }
    });
});
</script>
@endpush
@endsection