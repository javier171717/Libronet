<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SanabriaCod</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .stats-card.secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .stats-card.success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stats-card.warning {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        .chart-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .activity-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .brand-logo {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .recent-book {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        .recent-book:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        /* Estilos para el navbar en móvil */
        @media (max-width: 768px) {
            .navbar-nav .btn {
                width: 100%;
                margin-bottom: 8px;
                min-height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .navbar-nav .dropdown {
                width: 100%;
            }
            .navbar-nav .dropdown .btn {
                width: 100%;
            }
        }
        /* Estilos para el dropdown del usuario */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            border-radius: 10px;
            margin-top: 8px;
        }
        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
        }
        .dropdown-divider {
            margin: 8px 0;
            border-color: #e9ecef;
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand brand-logo" href="<?= base_url('libros') ?>">
                <i class="fas fa-code me-2"></i>SanabriaCod
            </a>
            
            <div class="navbar-nav ms-auto">
                <a href="<?= base_url('libros') ?>" class="btn btn-outline-primary me-2">
                    <i class="fas fa-books me-1"></i>Catálogo
                </a>
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i><?= $usuario->nombre ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('libros/agregar') ?>">
                            <i class="fas fa-plus me-2"></i>Agregar Libro
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('auth/salir') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-5 mb-2">
                    <i class="fas fa-chart-line me-2"></i>Dashboard
                </h1>
                <p class="lead text-muted">Bienvenido, <?= $usuario->nombre ?>. Aquí tienes un resumen de la actividad de la biblioteca.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card p-4 text-center">
                    <i class="fas fa-books fa-2x mb-3"></i>
                    <h3 class="mb-1"><?= $total_libros ?></h3>
                    <p class="mb-0">Total de Libros</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card secondary p-4 text-center">
                    <i class="fas fa-users fa-2x mb-3"></i>
                    <h3 class="mb-1"><?= $total_usuarios ?></h3>
                    <p class="mb-0">Usuarios Registrados</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card success p-4 text-center">
                    <i class="fas fa-calendar-plus fa-2x mb-3"></i>
                    <h3 class="mb-1"><?= $libros_este_mes ?></h3>
                    <p class="mb-0">Libros este Mes</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card warning p-4 text-center">
                    <i class="fas fa-user-edit fa-2x mb-3"></i>
                    <h3 class="mb-1"><?= $libros_usuario ?></h3>
                    <p class="mb-0">Mis Libros</p>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-3">
                <div class="chart-container">
                    <h5 class="mb-3">
                        <i class="fas fa-chart-bar me-2"></i>Libros por Género
                    </h5>
                    <canvas id="generoChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="chart-container">
                    <h5 class="mb-3">
                        <i class="fas fa-chart-line me-2"></i>Actividad Mensual
                    </h5>
                    <canvas id="actividadChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Libros Recientes -->
            <div class="col-lg-6 mb-4">
                <div class="chart-container">
                    <h5 class="mb-3">
                        <i class="fas fa-clock me-2"></i>Libros Más Recientes
                    </h5>
                    <?php if(!empty($libros_recientes)): ?>
                        <?php foreach($libros_recientes as $libro): ?>
                            <div class="recent-book">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><?= $libro->titulo ?></h6>
                                        <p class="text-muted small mb-1"><?= $libro->autor ?></p>
                                        <span class="badge bg-primary"><?= ucfirst($libro->genero) ?></span>
                                    </div>
                                    <small class="text-muted">
                                        <?= date('d/m/Y', strtotime($libro->fecha_agregado)) ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">No hay libros recientes</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Usuarios Más Activos -->
            <div class="col-lg-6 mb-4">
                <div class="chart-container">
                    <h5 class="mb-3">
                        <i class="fas fa-trophy me-2"></i>Usuarios Más Activos
                    </h5>
                    <?php if(!empty($usuarios_activos)): ?>
                        <?php foreach($usuarios_activos as $usuario_activo): ?>
                            <div class="recent-book">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><?= $usuario_activo->nombre ?></h6>
                                        <p class="text-muted small mb-0"><?= $usuario_activo->email ?></p>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success"><?= $usuario_activo->total_libros ?> libros</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">No hay datos de usuarios</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Actividad Reciente -->
        <div class="row">
            <div class="col-12">
                <div class="chart-container">
                    <h5 class="mb-3">
                        <i class="fas fa-history me-2"></i>Actividad Reciente
                    </h5>
                    <?php if(!empty($actividad_reciente)): ?>
                        <?php foreach($actividad_reciente as $actividad): ?>
                            <div class="activity-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-plus-circle text-success me-2"></i>
                                        <strong><?= $actividad->nombre_usuario ?></strong> agregó 
                                        <strong>"<?= $actividad->titulo ?>"</strong>
                                    </div>
                                    <small class="text-muted">
                                        <?= date('d/m/Y H:i', strtotime($actividad->fecha_agregado)) ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">No hay actividad reciente</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gráfico de géneros
        const generoData = <?= json_encode($libros_por_genero) ?>;
        const generoLabels = generoData.map(item => item.genero);
        const generoValues = generoData.map(item => parseInt(item.total));

        new Chart(document.getElementById('generoChart'), {
            type: 'doughnut',
            data: {
                labels: generoLabels,
                datasets: [{
                    data: generoValues,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Gráfico de actividad mensual
        const actividadData = <?= json_encode($libros_por_mes ?? []) ?>;
        const actividadLabels = actividadData.map(item => {
            const [year, month] = item.mes.split('-');
            const date = new Date(year, month - 1);
            return date.toLocaleDateString('es-ES', { month: 'short', year: 'numeric' });
        });
        const actividadValues = actividadData.map(item => parseInt(item.total));

        new Chart(document.getElementById('actividadChart'), {
            type: 'line',
            data: {
                labels: actividadLabels,
                datasets: [{
                    label: 'Libros agregados',
                    data: actividadValues,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html> 