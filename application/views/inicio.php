<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SanabriaCod - Tu Biblioteca Virtual</title>
    
    <!-- Favicon y meta tags para SanabriaCod -->
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💻</text></svg>">
    <meta name="description" content="SanabriaCod - Tu biblioteca virtual personal desarrollada con pasión por el código">
    <meta name="author" content="SanabriaCod">
    <meta name="keywords" content="biblioteca virtual, libros, SanabriaCod, desarrollo web">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .hero-section {
            padding: 80px 0;
            text-align: center;
            color: white;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 50px;
            opacity: 0.9;
        }
        
        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .auth-tabs {
            display: flex;
            background: #f8f9fa;
        }
        
        .auth-tab {
            flex: 1;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
            font-weight: 600;
            color: #6c757d;
        }
        
        .auth-tab.active {
            background: white;
            color: #667eea;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .auth-content {
            padding: 40px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .features {
            margin-top: 60px;
            color: white;
        }
        
        .feature-card {
            text-align: center;
            padding: 30px 20px;
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .feature-text {
            opacity: 0.8;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-floating > .form-control {
            height: 60px;
        }
        
        .form-floating > label {
            padding: 20px 15px;
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
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">
                <i class="fas fa-book-open me-3"></i>
                <span class="brand-logo">SanabriaCod</span>
            </h1>
            <p class="hero-subtitle">Tu biblioteca virtual personal</p>
            
            <!-- Auth Container -->
            <div class="auth-container">
                <div class="auth-tabs">
                    <button class="auth-tab active" onclick="showTab('registro')">
                        <i class="fas fa-user-plus me-2"></i>Registrarse
                    </button>
                    <button class="auth-tab" onclick="showTab('login')">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                    </button>
                </div>
                
                <div class="auth-content">
                    <!-- Tab de Registro -->
                    <div id="registro-tab">
                        <?php if($this->session->flashdata('error_registro')): ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('error_registro'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($this->session->flashdata('mensaje')): ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('mensaje'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?php echo base_url('auth/guardar_registro'); ?>" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
                                        <label for="nombre">Nombre completo</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                                        <label for="email">Correo electrónico</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                        <label for="password">Contraseña</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required>
                                        <label for="confirm_password">Confirmar contraseña</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Tab de Login -->
                    <div id="login-tab" style="display: none;">
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?php echo base_url('auth/iniciar_sesion'); ?>" method="post">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="login_email" name="email" placeholder="Correo electrónico" required>
                                <label for="login_email">Correo electrónico</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="login_password" name="password" placeholder="Contraseña" required>
                                <label for="login_password">Contraseña</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Features Section -->
    <div class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="feature-title">Búsqueda Avanzada</div>
                        <div class="feature-text">Encuentra libros por título, autor o género</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="feature-title">Gestión Completa</div>
                        <div class="feature-text">Agrega, edita y elimina libros fácilmente</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="feature-title">Acceso Móvil</div>
                        <div class="feature-text">Accede desde cualquier dispositivo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showTab(tabName) {
            // Ocultar todas las tabs
            document.getElementById('registro-tab').style.display = 'none';
            document.getElementById('login-tab').style.display = 'none';
            
            // Remover clase active de todos los tabs
            document.querySelectorAll('.auth-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Mostrar la tab seleccionada
            document.getElementById(tabName + '-tab').style.display = 'block';
            
            // Agregar clase active al tab clickeado
            event.target.classList.add('active');
        }
        
        // Validación de contraseñas
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (password !== confirmPassword) {
                this.setCustomValidity('Las contraseñas no coinciden');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html> 