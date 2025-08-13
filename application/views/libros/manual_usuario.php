<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual de Usuario - SanabriaCod</title>
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
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
        }
        .step-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
        }
        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .step-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 20px;
        }
        .feature-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 20px;
        }
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .manual-section {
            background: #f8f9fa;
            padding: 40px 0;
        }
        .manual-section:nth-child(even) {
            background: white;
        }
        .step-content {
            padding: 30px;
        }
        .step-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .step-description {
            color: #6c757d;
            line-height: 1.6;
        }
        .step-tips {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin-top: 15px;
            border-radius: 0 8px 8px 0;
        }
        .step-tips h6 {
            color: #1976d2;
            margin-bottom: 10px;
        }
        .step-tips ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
        .step-tips li {
            color: #424242;
        }
        .navigation-buttons {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .nav-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            margin: 5px;
            transition: all 0.3s ease;
        }
        .nav-btn:hover {
            transform: scale(1.1);
            color: white;
        }
        .progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 1001;
            transition: width 0.3s ease;
        }
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
        }
    </style>
</head>
<body>
    <!-- Progress Bar -->
    <div class="progress-bar" id="progressBar"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <div class="navbar-brand-container text-center flex-grow-1">
                <a class="navbar-brand brand-logo" href="<?= base_url('libros') ?>">
                    <i class="fas fa-code me-2"></i>SanabriaCod
                </a>
            </div>
            
            <div class="navbar-nav ms-auto">
                <a href="<?= base_url('libros') ?>" class="btn btn-outline-primary me-2">
                    <i class="fas fa-home me-1"></i>Inicio
                </a>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-info me-2">
                    <i class="fas fa-chart-line me-1"></i>Dashboard
                </a>
                <a href="<?= base_url('favoritos') ?>" class="btn btn-outline-warning me-2">
                    <i class="fas fa-star me-1"></i>Mis Favoritos
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-3">Manual de Usuario</h1>
            <p class="lead mb-4">Aprende a usar tu biblioteca virtual paso a paso</p>
            <a href="<?= base_url('libros') ?>" class="btn btn-custom btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Volver al Catálogo
            </a>
        </div>
    </section>

    <!-- Manual Content -->
    <div class="manual-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card step-card">
                        <div class="step-content text-center">
                            <div class="step-number">1</div>
                            <h3 class="step-title">Navegación Básica</h3>
                            <div class="feature-icon">
                                <i class="fas fa-compass"></i>
                            </div>
                            <p class="step-description">
                                La biblioteca virtual SanabriaCod te ofrece una interfaz intuitiva y fácil de usar. 
                                En la parte superior encontrarás la barra de navegación con acceso a todas las funcionalidades.
                            </p>
                            <div class="step-tips">
                                <h6><i class="fas fa-lightbulb me-2"></i>Consejos:</h6>
                                <ul>
                                    <li>Usa el botón "Inicio" para regresar al catálogo principal</li>
                                    <li>El Dashboard te muestra estadísticas de tu biblioteca</li>
                                    <li>Accede a tus libros favoritos desde "Mis Favoritos"</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="manual-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card step-card">
                        <div class="step-content text-center">
                            <div class="step-number">2</div>
                            <h3 class="step-title">Búsqueda de Libros</h3>
                            <div class="feature-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <p class="step-description">
                                Encuentra rápidamente los libros que te interesan usando la barra de búsqueda 
                                ubicada en la parte superior derecha de la pantalla.
                            </p>
                            <div class="step-tips">
                                <h6><i class="fas fa-lightbulb me-2"></i>Consejos:</h6>
                                <ul>
                                    <li>Escribe el título, autor o género del libro</li>
                                    <li>La búsqueda es instantánea y sensible a mayúsculas/minúsculas</li>
                                    <li>Usa palabras clave específicas para resultados más precisos</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="manual-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card step-card">
                        <div class="step-content text-center">
                            <div class="step-number">3</div>
                            <h3 class="step-title">Filtrado por Géneros</h3>
                            <div class="feature-icon">
                                <i class="fas fa-filter"></i>
                            </div>
                            <p class="step-description">
                                Explora libros por categorías usando los botones de géneros ubicados 
                                debajo del título principal. Esto te ayuda a encontrar lecturas específicas.
                            </p>
                            <div class="step-tips">
                                <h6><i class="fas fa-lightbulb me-2"></i>Consejos:</h6>
                                <ul>
                                    <li>Haz clic en "Todos" para ver todos los libros</li>
                                    <li>Los géneros disponibles incluyen: Novela, Ciencia Ficción, Fantasía, Misterio, Romance, Biografía y Ensayo</li>
                                    <li>Puedes combinar filtros con la búsqueda para resultados más específicos</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="manual-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card step-card">
                        <div class="step-content text-center">
                            <div class="step-number">4</div>
                            <h3 class="step-title">Gestión de Favoritos</h3>
                            <div class="feature-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="step-description">
                                Marca tus libros favoritos para acceder rápidamente a ellos. 
                                Cada libro tiene un botón de estrella que puedes activar o desactivar.
                            </p>
                            <div class="step-tips">
                                <h6><i class="fas fa-lightbulb me-2"></i>Consejos:</h6>
                                <ul>
                                    <li>Haz clic en la estrella para agregar/quitar de favoritos</li>
                                    <li>Accede a todos tus favoritos desde "Mis Favoritos" en el navbar</li>
                                    <li>Los favoritos se guardan automáticamente en tu cuenta</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="manual-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card step-card">
                        <div class="step-content text-center">
                            <div class="step-number">5</div>
                            <h3 class="step-title">Agregar Nuevos Libros</h3>
                            <div class="feature-icon">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <p class="step-description">
                                Contribuye a la biblioteca agregando nuevos libros. 
                                Accede a esta función desde el menú desplegable de tu perfil.
                            </p>
                            <div class="step-tips">
                                <h6><i class="fas fa-lightbulb me-2"></i>Consejos:</h6>
                                <ul>
                                    <li>Haz clic en tu nombre en el navbar para abrir el menú</li>
                                    <li>Selecciona "Agregar Libro" del menú desplegable</li>
                                    <li>Completa todos los campos obligatorios (título, autor, género, año)</li>
                                    <li>Puedes subir una imagen de portada para hacer tu libro más atractivo</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="manual-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card step-card">
                        <div class="step-content text-center">
                            <div class="step-number">6</div>
                            <h3 class="step-title">Editar y Eliminar Libros</h3>
                            <div class="feature-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <p class="step-description">
                                Solo puedes editar o eliminar los libros que hayas agregado tú mismo. 
                                Los botones de edición y eliminación aparecen solo en tus propios libros.
                            </p>
                            <div class="step-tips">
                                <h6><i class="fas fa-lightbulb me-2"></i>Consejos:</h6>
                                <ul>
                                    <li>Haz clic en el ícono de lápiz para editar</li>
                                    <li>Haz clic en el ícono de papelera para eliminar</li>
                                    <li>Se te pedirá confirmación antes de eliminar un libro</li>
                                    <li>Las ediciones se guardan automáticamente</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="manual-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card step-card">
                        <div class="step-content text-center">
                            <div class="step-number">7</div>
                            <h3 class="step-title">Dashboard y Estadísticas</h3>
                            <div class="feature-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <p class="step-description">
                                Accede a tu Dashboard para ver estadísticas detalladas de tu biblioteca, 
                                incluyendo el total de libros, géneros más populares y actividad reciente.
                            </p>
                            <div class="step-tips">
                                <h6><i class="fas fa-lightbulb me-2"></i>Consejos:</h6>
                                <ul>
                                    <li>El Dashboard se actualiza en tiempo real</li>
                                    <li>Revisa las estadísticas regularmente para conocer tus preferencias</li>
                                    <li>Usa esta información para descubrir nuevos géneros</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="manual-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card step-card">
                        <div class="step-content text-center">
                            <div class="step-number">8</div>
                            <h3 class="step-title">Vista Detallada de Libros</h3>
                            <div class="feature-icon">
                                <i class="fas fa-eye"></i>
                            </div>
                            <p class="step-description">
                                Haz clic en el ícono del ojo para ver información detallada de cada libro, 
                                incluyendo descripción completa, información del autor y más detalles.
                            </p>
                            <div class="step-tips">
                                <h6><i class="fas fa-lightbulb me-2"></i>Consejos:</h6>
                                <ul>
                                    <li>La vista detallada muestra toda la información disponible del libro</li>
                                    <li>Puedes agregar/quitar de favoritos desde esta vista</li>
                                    <li>Si es tu libro, también verás opciones de edición y eliminación</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="navigation-buttons">
        <button class="nav-btn" onclick="scrollToTop()" title="Ir arriba">
            <i class="fas fa-arrow-up"></i>
        </button>
        <button class="nav-btn" onclick="scrollToBottom()" title="Ir abajo">
            <i class="fas fa-arrow-down"></i>
        </button>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
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
                        <a href="https://github.com/javier171717" class="text-white me-3" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/javier-jimenez-a184a816b" class="text-white me-3" target="_blank"><i class="fab fa-linkedin"></i></a>
                        <a href="https://wa.me/573215821483?text=Hola,%20me%20interesa%20tu%20trabajo%20como%20desarrollador" class="text-white" target="_blank"><i class="fab fa-whatsapp"></i></a>
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
    <script>
        // Progress bar functionality
        window.addEventListener('scroll', () => {
            const scrollTop = document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / scrollHeight) * 100;
            document.getElementById('progressBar').style.width = scrollPercent + '%';
        });

        // Navigation functions
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function scrollToBottom() {
            window.scrollTo({
                top: document.documentElement.scrollHeight,
                behavior: 'smooth'
            });
        }

        // Add smooth scrolling to all internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html> 