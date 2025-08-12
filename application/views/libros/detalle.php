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
        /* Estilos para los botones de acción */
        .action-buttons .btn {
            min-height: 45px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .action-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .action-buttons .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
        }
        .action-buttons .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
            border: none;
            color: #212529;
        }
        .action-buttons .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
            background: transparent;
        }
        .action-buttons .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
        }
        /* Espaciado uniforme para los botones */
        .action-buttons .row {
            margin-bottom: 1.5rem !important;
        }
        .action-buttons .row:last-child {
            margin-bottom: 0 !important;
        }
        .action-buttons .col-md-4 {
            margin-bottom: 1rem;
        }
        .action-buttons .col-md-4:last-child {
            margin-bottom: 0;
        }
        /* Asegurar que los tres botones principales tengan el mismo tamaño */
        .action-buttons .row:first-of-type .col-md-4 {
            display: flex;
            align-items: stretch;
        }
        .action-buttons .row:first-of-type .col-md-4 .btn {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
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
        
        /* Estilos para la sección de reseñas */
        .stars {
            font-size: 1.1rem;
        }
        .stars .fas {
            color: #ffc107;
        }
        .stars .far {
            color: #dee2e6;
        }
        .resenas-recientes .card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .resenas-recientes .card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .like-button {
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        .like-button:hover {
            transform: translateY(-1px);
        }
        .like-button.active {
            background-color: #667eea;
            border-color: #667eea;
            color: white;
        }
        .like-button.active:hover {
            background-color: #5a6fd8;
            border-color: #5a6fd8;
        }
        .bg-light {
            background-color: #f8f9fa !important;
        }
        .bg-light:hover {
            background-color: #e9ecef !important;
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
                <a href="<?= base_url('libros') ?>" class="btn btn-custom me-2">
                    <i class="fas fa-arrow-left me-1"></i>Volver al Catálogo
                </a>
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
                                <?php $esFavorito = isset($mis_favoritos_ids) ? in_array($libro->id, $mis_favoritos_ids) : false; ?>
                                <?php if($esFavorito): ?>
                                    <a href="<?= base_url('favoritos/eliminar/' . $libro->id) ?>" class="btn btn-outline-danger mb-2">
                                        <i class="fas fa-star me-1"></i>Quitar de Favoritos
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('favoritos/agregar/' . $libro->id) ?>" class="btn btn-outline-success mb-2">
                                        <i class="fas fa-star me-1"></i>Agregar a Favoritos
                                    </a>
                                <?php endif; ?>
                                <?php if($libro->usuario_id == $usuario->id): ?>
                                    <a href="<?= base_url('libros/editar/' . $libro->id) ?>" class="btn btn-outline-warning mb-2">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>
                                    <a href="<?= base_url('libros/eliminar/' . $libro->id) ?>" class="btn btn-outline-danger" 
                                       onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?')">
                                        <i class="fas fa-trash me-1"></i>Eliminar
                                    </a>
                                <?php endif; ?>
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
                    <div class="text-center mt-4 pt-4 border-top action-buttons">
                        <!-- Botón Volver al Catálogo centrado -->
                        <div class="mb-4">
                            <a href="<?= base_url('libros') ?>" class="btn btn-custom">
                                <i class="fas fa-arrow-left me-1"></i>Volver al Catálogo
                            </a>
                        </div>
                        
                        <!-- Botones principales en fila centrada -->
                        <div class="row justify-content-center mb-4">
                            <?php if(!empty($libro->contenido_completo)): ?>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <a href="<?= base_url('libros/leer/' . $libro->id) ?>" class="btn btn-success w-100">
                                        <i class="fas fa-book-open me-1"></i>Leer Libro
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="col-md-4 col-sm-6 mb-3">
                                <a href="<?= base_url('favoritos') ?>" class="btn btn-warning w-100">
                                    <i class="fas fa-star me-1"></i>Mis Favoritos
                                </a>
                            </div>
                            
                            <div class="col-md-4 col-sm-6 mb-3">
                                <a href="<?= base_url('libros/agregar') ?>" class="btn btn-success w-100">
                                    <i class="fas fa-plus me-1"></i>Agregar Otro Libro
                                </a>
                            </div>
                        </div>
                        
                        <!-- Botón Editar (si es el propietario) -->
                        <?php if($libro->usuario_id == $usuario->id): ?>
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-sm-6">
                                    <a href="<?= base_url('libros/editar/' . $libro->id) ?>" class="btn btn-custom w-100">
                                        <i class="fas fa-edit me-1"></i>Editar Libro
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sección de Reseñas -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3><i class="fas fa-star text-warning me-2"></i>Reseñas y Comentarios</h3>
                            <div>
                                <?php if(!$resena_usuario): ?>
                                    <a href="<?= base_url('resenas/agregar/' . $libro->id) ?>" class="btn btn-custom me-2">
                                        <i class="fas fa-plus me-1"></i>Escribir Reseña
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('resenas/editar/' . $resena_usuario->id) ?>" class="btn btn-warning me-2">
                                        <i class="fas fa-edit me-1"></i>Editar Mi Reseña
                                    </a>
                                <?php endif; ?>
                                <a href="<?= base_url('libros/resenas/' . $libro->id) ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-list me-1"></i>Ver Todas
                                </a>
                            </div>
                        </div>

                        <!-- Estadísticas de Reseñas -->
                        <?php if($estadisticas && $estadisticas->total_resenas > 0): ?>
                            <div class="row mb-4">
                                <div class="col-md-3 text-center">
                                    <div class="bg-light p-3 rounded">
                                        <h4 class="text-primary mb-1"><?= number_format($estadisticas->promedio_calificacion, 1) ?></h4>
                                        <div class="stars text-warning">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php if($i <= round($estadisticas->promedio_calificacion)): ?>
                                                    <i class="fas fa-star"></i>
                                                <?php else: ?>
                                                    <i class="far fa-star"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </div>
                                        <small class="text-muted">Promedio</small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="bg-light p-3 rounded">
                                        <h4 class="text-success mb-1"><?= $estadisticas->total_resenas ?></h4>
                                        <small class="text-muted">Total Reseñas</small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="bg-light p-3 rounded">
                                        <h4 class="text-warning mb-1"><?= $estadisticas->cinco_estrellas ?></h4>
                                        <small class="text-muted">5 Estrellas</small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="bg-light p-3 rounded">
                                        <h4 class="text-info mb-1"><?= $estadisticas->cuatro_estrellas ?></h4>
                                        <small class="text-muted">4 Estrellas</small>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Lista de Reseñas Recientes -->
                        <?php if(!empty($resenas)): ?>
                            <div class="resenas-recientes">
                                <h5 class="mb-3">Reseñas Recientes:</h5>
                                <?php foreach($resenas as $resena): ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h6 class="card-title mb-1"><?= $resena->titulo ?></h6>
                                                    <small class="text-muted">por <?= $resena->nombre_usuario ?></small>
                                                </div>
                                                <div class="text-end">
                                                    <div class="stars text-warning">
                                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                                            <?php if($i <= $resena->calificacion): ?>
                                                                <i class="fas fa-star"></i>
                                                            <?php else: ?>
                                                                <i class="far fa-star"></i>
                                                            <?php endif; ?>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <small class="text-muted"><?= date('d/m/Y', strtotime($resena->fecha_creacion)) ?></small>
                                                </div>
                                            </div>
                                            <p class="card-text"><?= character_limiter($resena->comentario, 150) ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button class="btn btn-sm btn-outline-primary like-button <?= $usuario_dio_like[$resena->id] ? 'active' : '' ?>" 
                                                        data-resena-id="<?= $resena->id ?>" 
                                                        onclick="toggleLike(<?= $resena->id ?>)">
                                                    <i class="fas fa-thumbs-up me-1"></i>
                                                    <span class="like-count" id="likes-<?= $resena->id ?>">
                                                        <?= $likes_resena[$resena->id] ?? 0 ?>
                                                    </span>
                                                </button>
                                                <small class="text-muted">
                                                    <a href="<?= base_url('libros/resenas/' . $libro->id) ?>" class="text-decoration-none">
                                                        Ver reseña completa →
                                                    </a>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-star text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                                <h5 class="text-muted mt-3">No hay reseñas aún</h5>
                                <p class="text-muted">Sé el primero en compartir tu opinión sobre este libro</p>
                                <a href="<?= base_url('resenas/agregar/' . $libro->id) ?>" class="btn btn-custom">
                                    <i class="fas fa-plus me-1"></i>Escribir Primera Reseña
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para manejar likes -->
    <script>
        function toggleLike(resenaId) {
            const likeButton = document.querySelector(`[data-resena-id="${resenaId}"]`);
            const likeCount = document.getElementById(`likes-${resenaId}`);
            
            // Obtener la URL base dinámicamente
            const baseUrl = window.location.protocol + '//' + window.location.host + '/Libronet/';
            
            fetch(baseUrl + 'resenas/toggle_like', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'resena_id=' + resenaId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar contador de likes
                    likeCount.textContent = data.total_likes;
                    
                    // Cambiar estado del botón
                    if (data.action === 'added') {
                        likeButton.classList.add('active');
                    } else {
                        likeButton.classList.remove('active');
                    }
                    
                    // Mostrar mensaje temporal
                    showMessage(data.message, 'success');
                } else {
                    showMessage('Error: ' + data.error, 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Error al procesar la solicitud', 'danger');
            });
        }
        
        function showMessage(message, type) {
            // Crear elemento de mensaje
            const messageDiv = document.createElement('div');
            messageDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            messageDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            messageDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(messageDiv);
            
            // Remover mensaje después de 3 segundos
            setTimeout(() => {
                if (messageDiv.parentNode) {
                    messageDiv.remove();
                }
            }, 3000);
        }
    </script>
</body>
</html> 