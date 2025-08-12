<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro - SanabriaCod</title>
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
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .book-preview {
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
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
                <a href="<?= base_url('libros') ?>" class="btn btn-custom me-2">
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
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <div class="text-center mb-4">
                        <h2><i class="fas fa-edit text-warning me-2"></i>Editar Libro</h2>
                        <p class="text-muted">Modifica la información del libro "<?= $libro->titulo ?>"</p>
                    </div>

                    <?php if(validation_errors()): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= validation_errors() ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <!-- Form -->
                        <div class="col-md-8">
                            <?= form_open_multipart('libros/actualizar/' . $libro->id, ['class' => 'needs-validation', 'novalidate' => '']) ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="titulo" class="form-label">
                                            <i class="fas fa-book me-1"></i>Título del Libro *
                                        </label>
                                        <input type="text" class="form-control" id="titulo" name="titulo" 
                                               value="<?= set_value('titulo', $libro->titulo) ?>" required>
                                        <div class="invalid-feedback">
                                            Por favor ingresa el título del libro.
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="autor" class="form-label">
                                            <i class="fas fa-user me-1"></i>Autor *
                                        </label>
                                        <input type="text" class="form-control" id="autor" name="autor" 
                                               value="<?= set_value('autor', $libro->autor) ?>" required>
                                        <div class="invalid-feedback">
                                            Por favor ingresa el nombre del autor.
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="genero" class="form-label">
                                            <i class="fas fa-tags me-1"></i>Género *
                                        </label>
                                        <select class="form-select" id="genero" name="genero" required>
                                            <option value="">Selecciona un género</option>
                                            <option value="novela" <?= set_select('genero', 'novela', $libro->genero == 'novela') ?>>Novela</option>
                                            <option value="ciencia-ficcion" <?= set_select('genero', 'ciencia-ficcion', $libro->genero == 'ciencia-ficcion') ?>>Ciencia Ficción</option>
                                            <option value="fantasia" <?= set_select('genero', 'fantasia', $libro->genero == 'fantasia') ?>>Fantasía</option>
                                            <option value="misterio" <?= set_select('genero', 'misterio', $libro->genero == 'misterio') ?>>Misterio</option>
                                            <option value="romance" <?= set_select('genero', 'romance', $libro->genero == 'romance') ?>>Romance</option>
                                            <option value="biografia" <?= set_select('genero', 'biografia', $libro->genero == 'biografia') ?>>Biografía</option>
                                            <option value="ensayo" <?= set_select('genero', 'ensayo', $libro->genero == 'ensayo') ?>>Ensayo</option>
                                            <option value="poesia" <?= set_select('genero', 'poesia', $libro->genero == 'poesia') ?>>Poesía</option>
                                            <option value="teatro" <?= set_select('genero', 'teatro', $libro->genero == 'teatro') ?>>Teatro</option>
                                            <option value="historia" <?= set_select('genero', 'historia', $libro->genero == 'historia') ?>>Historia</option>
                                            <option value="filosofia" <?= set_select('genero', 'filosofia', $libro->genero == 'filosofia') ?>>Filosofía</option>
                                            <option value="otros" <?= set_select('genero', 'otros', $libro->genero == 'otros') ?>>Otros</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor selecciona un género.
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="anio" class="form-label">
                                            <i class="fas fa-calendar me-1"></i>Año de Publicación *
                                        </label>
                                        <input type="number" class="form-control" id="anio" name="anio" 
                                               value="<?= set_value('anio', $libro->anio) ?>" min="1000" max="<?= date('Y') ?>" required>
                                        <div class="invalid-feedback">
                                            Por favor ingresa un año válido.
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="imagen" class="form-label">
                                        <i class="fas fa-image me-1"></i>Imagen del Libro
                                    </label>
                                    <?php if($libro->imagen): ?>
                                        <div class="mb-2">
                                            <img src="<?= base_url('uploads/libros/' . $libro->imagen) ?>" 
                                                 alt="Imagen actual" class="img-thumbnail" style="max-width: 200px;">
                                            <p class="text-muted small">Imagen actual</p>
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control" id="imagen" name="imagen" 
                                           accept="image/*">
                                    <div class="form-text">
                                        Formatos permitidos: JPG, PNG, GIF, WEBP. Tamaño máximo: 2MB
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">
                                        <i class="fas fa-align-left me-1"></i>Descripción
                                    </label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" 
                                              placeholder="Describe brevemente el contenido del libro..."><?= set_value('descripcion', $libro->descripcion) ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="contenido_completo" class="form-label">
                                        <i class="fas fa-book-open me-1"></i>Contenido Completo del Libro
                                    </label>
                                    <textarea class="form-control" id="contenido_completo" name="contenido_completo" rows="10" 
                                              placeholder="Pega aquí el texto completo del libro..."><?= set_value('contenido_completo', $libro->contenido_completo) ?></textarea>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Opcional: Si tienes el texto completo del libro, puedes agregarlo aquí para que otros puedan leerlo.
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="<?= base_url('libros/ver/' . $libro->id) ?>" class="btn btn-custom me-md-2">
                                        <i class="fas fa-times me-1"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save me-1"></i>Guardar Cambios
                                    </button>
                                </div>
                            <?= form_close() ?>
                        </div>

                        <!-- Preview -->
                        <div class="col-md-4">
                            <div class="book-preview">
                                <i class="fas fa-book fa-3x mb-3"></i>
                                <h5 id="preview-titulo"><?= $libro->titulo ?></h5>
                                <p class="mb-2" id="preview-autor">por <?= $libro->autor ?></p>
                                <span class="badge bg-light text-dark" id="preview-genero"><?= ucfirst($libro->genero) ?></span>
                                <p class="mt-2 mb-0" id="preview-anio">Año: <?= $libro->anio ?></p>
                            </div>
                            
                            <div class="mt-3">
                                <h6>Información del Libro:</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-clock me-2"></i>Agregado: 
                                        <?php 
                                        if (isset($libro->fecha_agregado) && !empty($libro->fecha_agregado)) {
                                            echo date('d/m/Y', strtotime($libro->fecha_agregado));
                                        } else {
                                            echo 'Fecha no disponible';
                                        }
                                        ?>
                                    </li>
                                    <li><i class="fas fa-id me-2"></i>ID: <?= $libro->id ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
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

        // Live preview
        document.getElementById('titulo').addEventListener('input', function() {
            document.getElementById('preview-titulo').textContent = this.value || '<?= $libro->titulo ?>';
        });

        document.getElementById('autor').addEventListener('input', function() {
            document.getElementById('preview-autor').textContent = 'por ' + (this.value || '<?= $libro->autor ?>');
        });

        document.getElementById('genero').addEventListener('change', function() {
            document.getElementById('preview-genero').textContent = this.value ? this.value.charAt(0).toUpperCase() + this.value.slice(1) : '<?= ucfirst($libro->genero) ?>';
        });

        document.getElementById('anio').addEventListener('input', function() {
            document.getElementById('preview-anio').textContent = 'Año: ' + (this.value || '<?= $libro->anio ?>');
        });
    </script>
</body>
</html> 