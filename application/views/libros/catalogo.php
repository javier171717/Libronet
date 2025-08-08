<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SanabriaCod - Biblioteca Virtual</title>
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
            padding: 60px 0;
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
            border-radius: 10px 10px 0 0;
            overflow: hidden;
        }
        
        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
        }
        .search-box {
            background: rgba(255,255,255,0.1);
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            color: white;
        }
        .search-box::placeholder {
            color: rgba(255,255,255,0.8);
        }
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
        }
        .genre-badge {
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .brand-logo {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .social-links a {
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            color: #667eea !important;
            transform: translateY(-2px);
        }
        
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand brand-logo" href="<?= base_url('libros') ?>">
                <i class="fas fa-code me-2"></i>SanabriaCod
            </a>
            
            <div class="navbar-nav ms-auto">
                <form class="d-flex me-3" action="<?= base_url('libros/buscar') ?>" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Buscar libros..." aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-info me-2">
                    <i class="fas fa-chart-line me-1"></i>Dashboard
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-3">Bienvenido a SanabriaCod</h1>
            <p class="lead mb-4">Tu biblioteca virtual personal</p>
            
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="stats-card p-3 text-center">
                        <i class="fas fa-books fa-2x mb-2"></i>
                        <h4><?= $total_libros ?></h4>
                        <p class="mb-0">Libros Disponibles</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Géneros -->
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="mb-3">Filtrar por Género:</h5>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= base_url('libros') ?>" class="btn btn-outline-primary btn-sm">Todos</a>
                    <a href="<?= base_url('libros/genero/novela') ?>" class="btn btn-outline-primary btn-sm">Novela</a>
                    <a href="<?= base_url('libros/genero/ciencia-ficcion') ?>" class="btn btn-outline-primary btn-sm">Ciencia Ficción</a>
                    <a href="<?= base_url('libros/genero/fantasia') ?>" class="btn btn-outline-primary btn-sm">Fantasía</a>
                    <a href="<?= base_url('libros/genero/misterio') ?>" class="btn btn-outline-primary btn-sm">Misterio</a>
                    <a href="<?= base_url('libros/genero/romance') ?>" class="btn btn-outline-primary btn-sm">Romance</a>
                    <a href="<?= base_url('libros/genero/biografia') ?>" class="btn btn-outline-primary btn-sm">Biografía</a>
                    <a href="<?= base_url('libros/genero/ensayo') ?>" class="btn btn-outline-primary btn-sm">Ensayo</a>
                </div>
            </div>
        </div>

        <!-- Mensajes Flash -->
        <?php if($this->session->flashdata('mensaje')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= $this->session->flashdata('mensaje') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Catálogo de Libros -->
        <div class="row">
            <?php if(empty($libros)): ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-books fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay libros disponibles</h4>
                    <p class="text-muted">¡Sé el primero en agregar un libro a la biblioteca!</p>
                    <a href="<?= base_url('libros/agregar') ?>" class="btn btn-custom">
                        <i class="fas fa-plus me-2"></i>Agregar Libro
                    </a>
                </div>
            <?php else: ?>
                <?php foreach($libros as $libro): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card book-card h-100">
                            <div class="book-cover">
                                <?php if($libro->imagen && file_exists('./uploads/libros/' . $libro->imagen)): ?>
                                    <img src="<?= base_url('uploads/libros/' . $libro->imagen) ?>" 
                                         alt="<?= $libro->titulo ?>" class="img-fluid">
                                <?php else: ?>
                                    <i class="fas fa-book"></i>
                                <?php endif; ?>
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
                                        <?php if($libro->usuario_id == $usuario->id): ?>
                                            <a href="<?= base_url('libros/editar/' . $libro->id) ?>" class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('libros/eliminar/' . $libro->id) ?>" class="btn btn-outline-danger btn-sm" 
                                               onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-2 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center text-md-start">
                    <h5 class="brand-logo mb-3">
                        <i class="fas fa-code me-2"></i>SanabriaCod
                    </h5>
                    <p class="text-muted">Tu biblioteca virtual personal desarrollada con pasión por el código.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h6 class="mb-3">Funcionalidades</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-search me-2"></i>Búsqueda avanzada</li>
                        <li><i class="fas fa-plus me-2"></i>Gestión de libros</li>
                        <li><i class="fas fa-mobile-alt me-2"></i>Acceso móvil</li>
                    </ul>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <h6 class="mb-3">Desarrollado por</h6>
                    <p class="text-muted mb-2">SanabriaCod</p>
                    <div class="social-links">
                        <a href="https://github.com/javier171717" class="text-white me-3"><i class="fab fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/javier-jimenez-a184a816b" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
                        <a href="https://wa.me/573215821483?text=Hola,%20me%20interesa%20tu%20biblioteca%20virtual" class="text-white"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 SanabriaCod - Biblioteca Virtual. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 