<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $libro->titulo ?> - SanabriaCod</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        .book-detail-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .book-cover-large {
            height: 300px;
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            font-weight: bold;
            border-radius: 15px;
        }
        .genre-badge {
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            display: inline-block;
        }
        .info-item {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #2c3e50;
            min-width: 120px;
        }
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
        }
        .brand-logo {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
                <a href="<?= base_url('libros') ?>" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left me-1"></i>Volver al Catálogo
                </a>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
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
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="book-detail-container">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h1 class="mb-2"><?= $libro->titulo ?></h1>
                        <p class="lead text-muted">por <?= $libro->autor ?></p>
                        <span class="genre-badge">
                            <i class="fas fa-tag me-1"></i><?= ucfirst($libro->genero) ?>
                        </span>
                    </div>

                    <div class="row">
                        <!-- Book Cover -->
                        <div class="col-md-4 text-center mb-4">
                            <div class="book-cover-large mb-3">
                                <?php if($libro->imagen && file_exists('./uploads/libros/' . $libro->imagen)): ?>
                                    <img src="<?= base_url('uploads/libros/' . $libro->imagen) ?>" 
                                         alt="<?= $libro->titulo ?>" class="img-fluid" style="max-height: 280px; object-fit: cover;">
                                <?php else: ?>
                                    <i class="fas fa-book"></i>
                                <?php endif; ?>
                            </div>
                            <div class="btn-group-vertical w-100" role="group">
                                <a href="<?= base_url('libros/editar/' . $libro->id) ?>" class="btn btn-outline-warning mb-2">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </a>
                                <a href="<?= base_url('libros/eliminar/' . $libro->id) ?>" class="btn btn-outline-danger" 
                                   onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?')">
                                    <i class="fas fa-trash me-1"></i>Eliminar
                                </a>
                            </div>
                        </div>

                        <!-- Book Details -->
                        <div class="col-md-8">
                            <div class="info-item d-flex">
                                <span class="info-label">
                                    <i class="fas fa-book me-2"></i>Título:
                                </span>
                                <span><?= $libro->titulo ?></span>
                            </div>

                            <div class="info-item d-flex">
                                <span class="info-label">
                                    <i class="fas fa-user me-2"></i>Autor:
                                </span>
                                <span><?= $libro->autor ?></span>
                            </div>

                            <div class="info-item d-flex">
                                <span class="info-label">
                                    <i class="fas fa-tags me-2"></i>Género:
                                </span>
                                <span><?= ucfirst($libro->genero) ?></span>
                            </div>

                            <div class="info-item d-flex">
                                <span class="info-label">
                                    <i class="fas fa-calendar me-2"></i>Año:
                                </span>
                                <span><?= $libro->anio ?></span>
                            </div>

                            <?php if(!empty($libro->descripcion)): ?>
                                <div class="info-item">
                                    <div class="info-label mb-2">
                                        <i class="fas fa-align-left me-2"></i>Descripción:
                                    </div>
                                    <p class="text-muted"><?= nl2br($libro->descripcion) ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="info-item d-flex">
                                <span class="info-label">
                                    <i class="fas fa-clock me-2"></i>Agregado:
                                </span>
                                <span>
                                    <?php 
                                    if (isset($libro->fecha_agregado) && !empty($libro->fecha_agregado)) {
                                        echo date('d/m/Y H:i', strtotime($libro->fecha_agregado));
                                    } else {
                                        echo 'Fecha no disponible';
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center mt-4 pt-4 border-top">
                        <a href="<?= base_url('libros') ?>" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i>Volver al Catálogo
                        </a>
                        
                        <?php if(!empty($libro->contenido_completo)): ?>
                            <a href="<?= base_url('libros/leer/' . $libro->id) ?>" class="btn btn-success me-2">
                                <i class="fas fa-book-open me-1"></i>Leer Libro
                            </a>
                        <?php endif; ?>
                        
                        <a href="<?= base_url('libros/editar/' . $libro->id) ?>" class="btn btn-custom me-2">
                            <i class="fas fa-edit me-1"></i>Editar Libro
                        </a>
                        <a href="<?= base_url('libros/agregar') ?>" class="btn btn-success">
                            <i class="fas fa-plus me-1"></i>Agregar Otro Libro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 