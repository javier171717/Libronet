<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Favoritos - SanabriaCod</title>
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23667eea'><path d='M21,4H3A2,2 0 0,0 1,6V19A2,2 0 0,0 3,21H21A2,2 0 0,0 23,19V6A2,2 0 0,0 21,4M3,19V6H8V19H3M10,19V6H21V19H10Z'/></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        .brand-logo {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
        /* Mejoras para las tarjetas de libros */
        .card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .btn-sm {
            min-height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
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
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand brand-logo" href="<?= base_url('libros') ?>">
                <i class="fas fa-code me-2"></i>SanabriaCod
            </a>
            <div class="navbar-nav ms-auto">
                <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-info me-2">
                    <i class="fas fa-chart-line me-1"></i>Dashboard
                </a>
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i><?= $usuario->nombre ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('auth/salir') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0"><i class="fas fa-star text-warning me-2"></i>Mis Favoritos</h3>
            <a href="<?= base_url('libros') ?>" class="btn btn-custom me-2">
                <i class="fas fa-arrow-left me-1"></i>Volver al Catálogo
            </a>
        </div>

        <div class="row">
            <?php if (empty($libros)): ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-star fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No tienes libros favoritos aún</h4>
                </div>
            <?php else: ?>
                <?php foreach ($libros as $libro): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title mb-1"><?= $libro->titulo ?></h6>
                                <p class="text-muted small mb-2"><?= $libro->autor ?></p>
                                <span class="badge bg-primary mb-3"><?= $libro->genero ?></span>
                                <div class="mt-auto d-flex gap-2">
                                    <a href="<?= base_url('libros/ver/' . $libro->id) ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('favoritos/eliminar/' . $libro->id) ?>" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-star"></i> Quitar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 