<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reseña - <?= $libro->titulo ?> - SanabriaCod</title>
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23667eea'><path d='M21,4H3A2,2 0 0,0 1,6V19A2,2 0 0,0 3,21H21A2,2 0 0,0 23,19V6A2,2 0 0,0 21,4M3,19V6H8V19H3M10,19V6H21V19H10Z'/></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
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
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .brand-logo {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Estilos para el sistema de estrellas */
        .rating-container {
            text-align: center;
            margin: 20px 0;
        }
        .stars {
            display: inline-block;
            font-size: 2rem;
            cursor: pointer;
            color: #ddd;
            transition: color 0.2s ease;
        }
        .stars:hover,
        .stars.active {
            color: #ffc107;
        }
        .stars.selected {
            color: #ffc107;
        }
        .rating-text {
            margin-top: 10px;
            font-size: 1.1rem;
            color: #6c757d;
        }
        .book-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }
        .book-cover {
            width: 120px;
            height: 160px;
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            border-radius: 10px;
            margin: 0 auto 15px;
        }
        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }
        .character-count {
            font-size: 0.85rem;
            color: #6c757d;
            text-align: right;
            margin-top: 5px;
        }
        .character-count.warning {
            color: #ffc107;
        }
        .character-count.danger {
            color: #dc3545;
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <!-- Book Info -->
                    <div class="book-info">
                        <div class="book-cover">
                            <?php if($libro->imagen && file_exists('./uploads/libros/' . $libro->imagen)): ?>
                                <img src="<?= base_url('uploads/libros/' . $libro->imagen) ?>" 
                                     alt="<?= $libro->titulo ?>">
                            <?php else: ?>
                                <i class="fas fa-book"></i>
                            <?php endif; ?>
                        </div>
                        <h3 class="mb-2"><?= $libro->titulo ?></h3>
                        <p class="text-muted mb-1">por <?= $libro->autor ?></p>
                        <span class="badge bg-primary"><?= ucfirst($libro->genero) ?></span>
                    </div>

                    <div class="text-center mb-4">
                        <h2><i class="fas fa-star text-warning me-2"></i>Escribir Reseña</h2>
                        <p class="text-muted">Comparte tu opinión sobre este libro con otros lectores</p>
                    </div>

                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i><?= $error ?>
                        </div>
                    <?php endif; ?>

                    <?php if($resena_existente): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Ya tienes una reseña para este libro. 
                            <a href="<?= base_url('resenas/editar/' . $resena_existente->id) ?>" class="alert-link">
                                Haz clic aquí para editarla
                            </a>
                        </div>
                    <?php else: ?>
                        <?= form_open('resenas/guardar', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                            <input type="hidden" name="libro_id" value="<?= $libro->id ?>">
                            
                            <!-- Sistema de Calificación -->
                            <div class="rating-container">
                                <label class="form-label fw-bold">Tu Calificación:</label>
                                <div class="stars" data-rating="0">
                                    <i class="fas fa-star" data-value="1"></i>
                                    <i class="fas fa-star" data-value="2"></i>
                                    <i class="fas fa-star" data-value="3"></i>
                                    <i class="fas fa-star" data-value="4"></i>
                                    <i class="fas fa-star" data-value="5"></i>
                                </div>
                                <div class="rating-text" id="rating-text">Selecciona una calificación</div>
                                <input type="hidden" name="calificacion" id="calificacion-input" required>
                            </div>

                            <!-- Título de la Reseña -->
                            <div class="mb-3">
                                <label for="titulo" class="form-label">
                                    <i class="fas fa-heading me-1"></i>Título de tu Reseña *
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="titulo" 
                                       name="titulo" 
                                       value="<?= isset($form_data['titulo']) ? $form_data['titulo'] : '' ?>"
                                       placeholder="Ej: Excelente libro, muy recomendado" 
                                       maxlength="100"
                                       required>
                                <div class="character-count" id="titulo-count">0/100</div>
                                <div class="invalid-feedback">
                                    Por favor ingresa un título para tu reseña.
                                </div>
                            </div>

                            <!-- Comentario -->
                            <div class="mb-3">
                                <label for="comentario" class="form-label">
                                    <i class="fas fa-comment me-1"></i>Tu Comentario *
                                </label>
                                <textarea class="form-control" 
                                          id="comentario" 
                                          name="comentario" 
                                          rows="6" 
                                          placeholder="Comparte tu opinión sobre el libro, qué te gustó, qué no, si lo recomendarías, etc..."
                                          maxlength="1000"
                                          required><?= isset($form_data['comentario']) ? $form_data['comentario'] : '' ?></textarea>
                                <div class="character-count" id="comentario-count">0/1000</div>
                                <div class="invalid-feedback">
                                    Por favor escribe tu comentario sobre el libro.
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= base_url('libros/ver/' . $libro->id) ?>" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-times me-1"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-custom" id="submit-btn" disabled>
                                    <i class="fas fa-star me-1"></i>Publicar Reseña
                                </button>
                            </div>
                        <?= form_close() ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sistema de calificación con estrellas
        const stars = document.querySelectorAll('.stars .fa-star');
        const ratingText = document.getElementById('rating-text');
        const calificacionInput = document.getElementById('calificacion-input');
        const submitBtn = document.getElementById('submit-btn');
        
        const ratingDescriptions = {
            1: 'No me gustó nada',
            2: 'No me gustó mucho',
            3: 'Me gustó regular',
            4: 'Me gustó mucho',
            5: '¡Me encantó!'
        };
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = parseInt(this.dataset.value);
                setRating(value);
            });
            
            star.addEventListener('mouseenter', function() {
                const value = parseInt(this.dataset.value);
                highlightStars(value);
                ratingText.textContent = ratingDescriptions[value];
            });
        });
        
        document.querySelector('.stars').addEventListener('mouseleave', function() {
            const currentRating = parseInt(calificacionInput.value) || 0;
            highlightStars(currentRating);
            ratingText.textContent = currentRating > 0 ? ratingDescriptions[currentRating] : 'Selecciona una calificación';
        });
        
        function setRating(value) {
            calificacionInput.value = value;
            highlightStars(value);
            ratingText.textContent = ratingDescriptions[value];
            updateSubmitButton();
        }
        
        function highlightStars(value) {
            stars.forEach((star, index) => {
                if (index < value) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
        
        // Contador de caracteres
        function updateCharacterCount(inputId, countId, maxLength) {
            const input = document.getElementById(inputId);
            const count = document.getElementById(countId);
            
            input.addEventListener('input', function() {
                const length = this.value.length;
                const remaining = maxLength - length;
                
                count.textContent = `${length}/${maxLength}`;
                
                // Cambiar color según el límite
                count.className = 'character-count';
                if (remaining <= 50 && remaining > 20) {
                    count.classList.add('warning');
                } else if (remaining <= 20) {
                    count.classList.add('danger');
                }
                
                updateSubmitButton();
            });
        }
        
        updateCharacterCount('titulo', 'titulo-count', 100);
        updateCharacterCount('comentario', 'comentario-count', 1000);
        
        // Validar formulario antes de enviar
        function updateSubmitButton() {
            const titulo = document.getElementById('titulo').value.trim();
            const comentario = document.getElementById('comentario').value.trim();
            const calificacion = parseInt(calificacionInput.value);
            
            const isValid = titulo.length >= 5 && 
                           comentario.length >= 20 && 
                           calificacion >= 1 && 
                           calificacion <= 5;
            
            submitBtn.disabled = !isValid;
        }
        
        // Validación del formulario
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        
        // Inicializar estado del botón
        updateSubmitButton();
    </script>
</body>
</html> 