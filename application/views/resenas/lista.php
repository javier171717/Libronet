<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas - <?= $libro->titulo ?> - SanabriaCod</title>
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23667eea'><path d='M21,4H3A2,2 0 0,0 1,6V19A2,2 0 0,0 3,21H21A2,2 0 0,0 23,19V6A2,2 0 0,0 21,4M3,19V6H8V19H3M10,19V6H21V19H10Z'/></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
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
        .brand-logo {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Estilos para las reseñas */
        .review-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        .review-author {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .review-date {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .review-rating {
            text-align: right;
        }
        .stars {
            color: #ffc107;
            font-size: 1.2rem;
        }
        .review-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .review-content {
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .review-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        .like-button {
            background: none;
            border: 2px solid #e9ecef;
            border-radius: 20px;
            padding: 8px 16px;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .like-button:hover {
            border-color: #667eea;
            color: #667eea;
        }
        .like-button.liked {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }
        .like-count {
            font-weight: 600;
        }
        .stats-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }
        .rating-distribution {
            margin-top: 20px;
        }
        .rating-bar {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .rating-label {
            width: 80px;
            text-align: right;
            margin-right: 15px;
        }
        .rating-progress {
            flex: 1;
            height: 8px;
            background: rgba(255,255,255,0.3);
            border-radius: 4px;
            overflow: hidden;
        }
        .rating-fill {
            height: 100%;
            background: #ffc107;
            transition: width 0.3s ease;
        }
        .rating-count {
            width: 50px;
            text-align: left;
            margin-left: 15px;
            font-size: 0.9rem;
        }
        .no-reviews {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        .no-reviews i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        .review-actions-user {
            display: flex;
            gap: 10px;
        }
        .btn-edit {
            background: #ffc107;
            border: none;
            color: #212529;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .btn-edit:hover {
            background: #e0a800;
            transform: translateY(-1px);
        }
        .btn-delete {
            background: #dc3545;
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-1px);
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
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="mb-2">
                            <i class="fas fa-star text-warning me-2"></i>Reseñas de "<?= $libro->titulo ?>"
                        </h1>
                        <p class="text-muted mb-0">por <?= $libro->autor ?></p>
                    </div>
                    <a href="<?= base_url('resenas/agregar/' . $libro->id) ?>" class="btn btn-custom">
                        <i class="fas fa-plus me-1"></i>Escribir Reseña
                    </a>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <?php if($estadisticas && $estadisticas->total_resenas > 0): ?>
            <div class="stats-container">
                <div class="row text-center">
                    <div class="col-md-3">
                        <h3 class="mb-1"><?= number_format($estadisticas->promedio_calificacion, 1) ?></h3>
                        <div class="stars">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if($i <= round($estadisticas->promedio_calificacion)): ?>
                                    <i class="fas fa-star"></i>
                                <?php else: ?>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <p class="mb-0">Calificación Promedio</p>
                    </div>
                    <div class="col-md-3">
                        <h3 class="mb-1"><?= $estadisticas->total_resenas ?></h3>
                        <p class="mb-0">Total de Reseñas</p>
                    </div>
                    <div class="col-md-3">
                        <h3 class="mb-1"><?= $estadisticas->cinco_estrellas ?></h3>
                        <p class="mb-0">5 Estrellas</p>
                    </div>
                    <div class="col-md-3">
                        <h3 class="mb-1"><?= $estadisticas->cuatro_estrellas ?></h3>
                        <p class="mb-0">4 Estrellas</p>
                    </div>
                </div>

                <!-- Distribución de calificaciones -->
                <div class="rating-distribution">
                    <h5 class="mb-3">Distribución de Calificaciones:</h5>
                    <?php 
                    $rating_labels = [
                        5 => 'cinco_estrellas',
                        4 => 'cuatro_estrellas', 
                        3 => 'tres_estrellas',
                        2 => 'dos_estrellas',
                        1 => 'una_estrella'
                    ];
                    ?>
                    <?php foreach($rating_labels as $stars => $property): ?>
                        <?php 
                        $count = $estadisticas->$property ?? 0;
                        $percentage = $estadisticas->total_resenas > 0 ? ($count / $estadisticas->total_resenas) * 100 : 0;
                        ?>
                        <div class="rating-bar">
                            <div class="rating-label"><?= $stars ?> ⭐</div>
                            <div class="rating-progress">
                                <div class="rating-fill" style="width: <?= $percentage ?>%"></div>
                            </div>
                            <div class="rating-count"><?= $count ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Lista de Reseñas -->
        <?php if(!empty($resenas)): ?>
            <div class="row">
                <div class="col-12">
                    <?php foreach($resenas as $resena): ?>
                        <div class="review-card">
                            <div class="review-header">
                                <div>
                                    <div class="review-author"><?= $resena->nombre_usuario ?></div>
                                    <div class="review-date">
                                        <?= date('d/m/Y H:i', strtotime($resena->fecha_creacion)) ?>
                                    </div>
                                </div>
                                <div class="review-rating">
                                    <div class="stars">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= $resena->calificacion): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="review-title"><?= $resena->titulo ?></div>
                            <div class="review-content"><?= nl2br($resena->comentario) ?></div>

                            <div class="review-actions">
                                <div class="review-actions-user">
                                    <button class="like-button <?= $usuario_dio_like[$resena->id] ? 'liked' : '' ?>" 
                                            data-resena-id="<?= $resena->id ?>" 
                                            onclick="toggleLike(<?= $resena->id ?>)">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span class="like-count" id="likes-<?= $resena->id ?>">
                                            <?= $likes_resena[$resena->id] ?? 0 ?>
                                        </span>
                                    </button>
                                    
                                    <?php if($resena->usuario_id == $usuario->id): ?>
                                        <a href="<?= base_url('resenas/editar/' . $resena->id) ?>" class="btn btn-edit">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                        <a href="<?= base_url('resenas/eliminar/' . $resena->id) ?>" 
                                           class="btn btn-delete"
                                           onclick="return confirm('¿Estás seguro de que quieres eliminar esta reseña?')">
                                            <i class="fas fa-trash me-1"></i>Eliminar
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="no-reviews">
                <i class="fas fa-star"></i>
                <h4>No hay reseñas aún</h4>
                <p class="mb-4">Sé el primero en compartir tu opinión sobre este libro</p>
                <a href="<?= base_url('resenas/agregar/' . $libro->id) ?>" class="btn btn-custom btn-lg">
                    <i class="fas fa-plus me-2"></i>Escribir Primera Reseña
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para manejar likes
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
                        likeButton.classList.add('liked');
                    } else {
                        likeButton.classList.remove('liked');
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
        
        // Función para mostrar mensajes
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