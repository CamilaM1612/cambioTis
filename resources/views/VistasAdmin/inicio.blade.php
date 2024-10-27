@extends('componentes.menu')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Area Administrativa</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <i class="fas fa-calendar"></i>
                Este año académico
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
                                    <i class="fas fa-users text-primary"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Total Usuarios</h6>
                            <h2 class="card-title mb-0">1,250</h2>
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
                                    <i class="fas fa-chalkboard-teacher text-success"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Cursos Activos</h6>
                            <h2 class="card-title mb-0">45</h2>
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
                                    <i class="fas fa-exclamation-triangle text-info"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Reportes Pendientes</h6>
                            <h2 class="card-title mb-0">8</h2>
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
                                    <i class="fas fa-server text-warning"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">Uso del Sistema</h6>
                            <h2 class="card-title mb-0">78%</h2>
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
                    <h5 class="card-title mb-0">Actividad Reciente</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Acción</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Juan Pérez (Docente)</td>
                                    <td>Creó nuevo curso: "Inteligencia Artificial"</td>
                                    <td>15/10/2024</td>
                                    <td><span class="badge bg-success">Aprobado</span></td>
                                </tr>
                                <tr>
                                    <td>María López (Estudiante)</td>
                                    <td>Solicitó cambio de grupo</td>
                                    <td>14/10/2024</td>
                                    <td><span class="badge bg-warning">Pendiente</span></td>
                                </tr>
                                <tr>
                                    <td>Carlos Gómez (Admin)</td>
                                    <td>Actualizó políticas de privacidad</td>
                                    <td>13/10/2024</td>
                                    <td><span class="badge bg-info">Completado</span></td>
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
                    <h5 class="card-title mb-0">Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>Agregar Usuario
                        </a>
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-cog me-2"></i>Configuración del Sistema
                        </a>
                        <a href="#" class="btn btn-info text-white">
                            <i class="fas fa-file-alt me-2"></i>Generar Reportes
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Distribución de Usuarios</h5>
                </div>
                <div class="card-body">
                    <canvas id="userDistributionChart"></canvas>
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
    var ctx = document.getElementById('userDistributionChart').getContext('2d');
    var userDistributionChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Estudiantes', 'Docentes', 'Administrativos'],
            datasets: [{
                data: [70, 20, 10],
                backgroundColor: [
                    '#0d6efd',
                    '#198754',
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