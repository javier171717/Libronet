<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $genero_actual ? ucfirst($genero_actual) : 'Todos los Géneros' ?> - LibroNet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
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
        .genre-filter {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .genre-btn {
            margin: 2px;
            border-radius: 20px;
        }
        .genre-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('libros') ?>">
                <i class="fas fa-book-open me-2"></i>LibroNet
            </a>
            
            <div class="navbar-nav ms-auto">
                <form class="d-flex me-3" action="<?= base_url('libros/buscar') ?>" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Buscar libros..." aria-label="Search">
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-5 mb-3">
                <?php if($genero_actual): ?>
                    <i class="fas fa-tags me-2"></i><?= ucfirst($genero_actual) ?>
                <?php else: ?>
                    <i class="fas fa-books me-2"></i>Todos los Géneros
                <?php endif; ?>
            </h1>
            <p class="lead mb-4">
                <?php if($genero_actual): ?>
                    Explora nuestra colección de libros de <?= ucfirst($genero_actual) ?>
                <?php else: ?>
                    Explora todos los géneros literarios disponibles
                <?php endif; ?>
            </p>
            
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="bg-white bg-opacity-10 p-3 rounded">
                        <i class="fas fa-books fa-2x mb-2"></i>
                        <h4><?= count($libros) ?></h4>
                        <p class="mb-0">Libros Encontrados</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Genre Filter -->
        <div class="genre-filter">
            <h5 class="text-white mb-3">Filtrar por Género:</h5>
            <div class="d-flex flex-wrap">
                <a href="<?= base_url('libros') ?>" class="btn btn-outline-light genre-btn <?= !$genero_actual ? 'active' : '' ?>">
                    Todos
                </a>
                <a href="<?= base_url('libros/genero/novela') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'novela' ? 'active' : '' ?>">
                    Novela
                </a>
                <a href="<?= base_url('libros/genero/ciencia-ficcion') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'ciencia-ficcion' ? 'active' : '' ?>">
                    Ciencia Ficción
                </a>
                <a href="<?= base_url('libros/genero/fantasia') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'fantasia' ? 'active' : '' ?>">
                    Fantasía
                </a>
                <a href="<?= base_url('libros/genero/misterio') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'misterio' ? 'active' : '' ?>">
                    Misterio
                </a>
                <a href="<?= base_url('libros/genero/romance') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'romance' ? 'active' : '' ?>">
                    Romance
                </a>
                <a href="<?= base_url('libros/genero/biografia') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'biografia' ? 'active' : '' ?>">
                    Biografía
                </a>
                <a href="<?= base_url('libros/genero/ensayo') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'ensayo' ? 'active' : '' ?>">
                    Ensayo
                </a>
                <a href="<?= base_url('libros/genero/poesia') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'poesia' ? 'active' : '' ?>">
                    Poesía
                </a>
                <a href="<?= base_url('libros/genero/teatro') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'teatro' ? 'active' : '' ?>">
                    Teatro
                </a>
                <a href="<?= base_url('libros/genero/historia') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'historia' ? 'active' : '' ?>">
                    Historia
                </a>
                <a href="<?= base_url('libros/genero/filosofia') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'filosofia' ? 'active' : '' ?>">
                    Filosofía
                </a>
                <a href="<?= base_url('libros/genero/otros') ?>" class="btn btn-outline-light genre-btn <?= $genero_actual == 'otros' ? 'active' : '' ?>">
                    Otros
                </a>
            </div>
        </div>

        <!-- Results Count -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <?php if($genero_actual): ?>
                        Mostrando <strong><?= count($libros) ?></strong> libro(s) del género <strong><?= ucfirst($genero_actual) ?></strong>
                    <?php else: ?>
                        Mostrando todos los <strong><?= count($libros) ?></strong> libros disponibles
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Catálogo de Libros -->
        <div class="row">
            <?php if(empty($libros)): ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-books fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">
                        <?php if($genero_actual): ?>
                            No hay libros del género "<?= ucfirst($genero_actual) ?>"
                        <?php else: ?>
                            No hay libros disponibles
                        <?php endif; ?>
                    </h4>
                    <p class="text-muted">
                        <?php if($genero_actual): ?>
                            ¡Sé el primero en agregar un libro de <?= ucfirst($genero_actual) ?>!
                        <?php else: ?>
                            ¡Sé el primero en agregar un libro a la biblioteca!
                        <?php endif; ?>
                    </p>
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
                                <h6 class="card-title"><?= $libro->titulo ?></h6>
                                <p class="card-text text-muted small"><?= $libro->autor ?></p>
                                <span class="genre-badge mb-2"><?= $libro->genero ?></span>
                                <p class="card-text small text-muted">Año: <?= $libro->anio ?></p>
                                
                                <?php if(!empty($libro->descripcion)): ?>
                                    <p class="card-text small"><?= substr($libro->descripcion, 0, 100) ?>...</p>
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

        <!-- Back to Catalog -->
        <div class="text-center mt-5">
            <a href="<?= base_url('libros') ?>" class="btn btn-custom me-2">
                <i class="fas fa-arrow-left me-2"></i>Volver al Catálogo Completo
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 