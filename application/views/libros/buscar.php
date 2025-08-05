<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda - LibroNet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        .book-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .book-cover {
            height: 200px;
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
        }
        .genre-badge {
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .search-highlight {
            background-color: #fff3cd;
            padding: 2px 4px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('libros') ?>">
                <i class="fas fa-book-open me-2"></i>LibroNet
            </a>
            
            <div class="navbar-nav ms-auto">
                <form class="d-flex me-3" action="<?= base_url('libros/buscar') ?>" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Buscar libros..." 
                           value="<?= $termino ?>" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
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
        <!-- Search Results Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="fas fa-search text-primary me-2"></i>Resultados de Búsqueda</h2>
                        <?php if($termino): ?>
                            <p class="text-muted">Buscando: "<strong><?= $termino ?></strong>"</p>
                        <?php endif; ?>
                    </div>
                    <a href="<?= base_url('libros') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Volver al Catálogo
                    </a>
                </div>
            </div>
        </div>

        <!-- Results Count -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Se encontraron <strong><?= count($libros) ?></strong> libro(s) 
                    <?php if($termino): ?>
                        que coinciden con tu búsqueda
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Search Results -->
        <div class="row">
            <?php if(empty($libros)): ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No se encontraron resultados</h4>
                    <?php if($termino): ?>
                        <p class="text-muted">No hay libros que coincidan con "<strong><?= $termino ?></strong>"</p>
                        <p class="text-muted">Intenta con otros términos de búsqueda</p>
                    <?php else: ?>
                        <p class="text-muted">No hay libros disponibles en la biblioteca</p>
                    <?php endif; ?>
                    <a href="<?= base_url('libros/agregar') ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Agregar Libro
                    </a>
                </div>
            <?php else: ?>
                <?php foreach($libros as $libro): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card book-card h-100">
                            <div class="book-cover">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">
                                    <?php if($termino): ?>
                                        <?= str_ireplace($termino, '<span class="search-highlight">' . $termino . '</span>', $libro->titulo) ?>
                                    <?php else: ?>
                                        <?= $libro->titulo ?>
                                    <?php endif; ?>
                                </h6>
                                <p class="card-text text-muted small">
                                    <?php if($termino): ?>
                                        <?= str_ireplace($termino, '<span class="search-highlight">' . $termino . '</span>', $libro->autor) ?>
                                    <?php else: ?>
                                        <?= $libro->autor ?>
                                    <?php endif; ?>
                                </p>
                                <span class="genre-badge mb-2"><?= $libro->genero ?></span>
                                <p class="card-text small text-muted">Año: <?= $libro->anio ?></p>
                                
                                <?php if(!empty($libro->descripcion)): ?>
                                    <p class="card-text small">
                                        <?php if($termino): ?>
                                            <?= str_ireplace($termino, '<span class="search-highlight">' . $termino . '</span>', substr($libro->descripcion, 0, 100)) ?>...
                                        <?php else: ?>
                                            <?= substr($libro->descripcion, 0, 100) ?>...
                                        <?php endif; ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="mt-auto">
                                    <div class="btn-group w-100" role="group">
                                        <a href="<?= base_url('libros/ver/' . $libro->id) ?>" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('libros/editar/' . $libro->id) ?>" class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('libros/eliminar/' . $libro->id) ?>" class="btn btn-outline-danger btn-sm" 
                                           onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Search Suggestions -->
        <?php if($termino && empty($libros)): ?>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-lightbulb me-2"></i>Sugerencias de búsqueda</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Intenta buscar por:</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Palabras más cortas</li>
                                <li><i class="fas fa-check text-success me-2"></i>Sinónimos o términos relacionados</li>
                                <li><i class="fas fa-check text-success me-2"></i>Nombre del autor</li>
                                <li><i class="fas fa-check text-success me-2"></i>Género literario</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 