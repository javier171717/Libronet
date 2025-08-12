<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leer: <?= $libro->titulo ?> - SanabriaCod</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        .reading-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            margin: 20px 0;
        }
        .book-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }
        .book-content {
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: justify;
            color: #333;
        }
        .book-content p {
            margin-bottom: 1.5rem;
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
        .reading-controls {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .font-size-controls {
            background: rgba(255,255,255,0.9);
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
                <a href="<?= base_url('libros/ver/' . $libro->id) ?>" class="btn btn-custom me-2">
                    <i class="fas fa-arrow-left me-1"></i>Volver al Libro
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
        <div class="reading-container">
            <!-- Book Header -->
            <div class="book-header">
                <h1 class="mb-2"><?= $libro->titulo ?></h1>
                <p class="lead text-muted">por <?= $libro->autor ?></p>
                <span class="badge bg-primary"><?= ucfirst($libro->genero) ?></span>
                <p class="text-muted mt-2">Año: <?= $libro->anio ?></p>
            </div>

            <!-- Book Content -->
            <div class="book-content" id="bookContent">
                <?= nl2br($libro->contenido_completo) ?>
            </div>
        </div>
    </div>

    <!-- Reading Controls -->
    <div class="reading-controls">
        <div class="font-size-controls">
            <button class="btn btn-sm btn-outline-secondary" onclick="changeFontSize(-1)">
                <i class="fas fa-minus"></i>
            </button>
            <span class="mx-2" id="fontSize">16px</span>
            <button class="btn btn-sm btn-outline-secondary" onclick="changeFontSize(1)">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentFontSize = 16;
        
        function changeFontSize(delta) {
            currentFontSize += delta;
            if (currentFontSize < 12) currentFontSize = 12;
            if (currentFontSize > 24) currentFontSize = 24;
            
            document.getElementById('bookContent').style.fontSize = currentFontSize + 'px';
            document.getElementById('fontSize').textContent = currentFontSize + 'px';
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                if (e.key === '=' || e.key === '+') {
                    e.preventDefault();
                    changeFontSize(1);
                } else if (e.key === '-') {
                    e.preventDefault();
                    changeFontSize(-1);
                }
            }
        });
    </script>
</body>
</html> 