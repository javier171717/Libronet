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
                        
                        <form action="<?php echo base_url('auth/guardar_registro'); ?>" method="post" id="registro-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control" 
                                               id="nombre" 
                                               name="nombre" 
                                               placeholder="Nombre completo" 
                                               maxlength="50"
                                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                                               title="Solo se permiten letras y espacios. Ingresa tu nombre completo."
                                               required>
                                        <label for="nombre">Nombre completo</label>
                                        <div class="form-text">Máximo 50 caracteres. Solo letras y espacios.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" 
                                               class="form-control" 
                                               id="email" 
                                               name="email" 
                                               placeholder="Correo electrónico" 
                                               required>
                                        <label for="email">Correo electrónico</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" 
                                               class="form-control" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Contraseña" 
                                               minlength="8"
                                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$"
                                               title="Mínimo 8 caracteres, debe contener al menos una mayúscula, una minúscula y un número"
                                               required>
                                        <label for="password">Contraseña</label>
                                        <div class="form-text">Mínimo 8 caracteres, una mayúscula, una minúscula y un número.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" 
                                               class="form-control" 
                                               id="confirm_password" 
                                               name="confirm_password" 
                                               placeholder="Confirmar contraseña" 
                                               required>
                                        <label for="confirm_password">Confirmar contraseña</label>
                                        <div class="form-text">Debe coincidir con la contraseña anterior.</div>
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
                        
                        <!-- Área para mostrar mensajes de validación en tiempo real -->
                        <div id="login-message" style="display: none;">
                        </div>
                        
                        <form action="<?php echo base_url('auth/iniciar_sesion'); ?>" method="post" id="login-form">
                            <div class="form-floating">
                                <input type="email" 
                                       class="form-control" 
                                       id="login_email" 
                                       name="email" 
                                       placeholder="Correo electrónico" 
                                       required>
                                <label for="login_email">Correo electrónico</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" 
                                       class="form-control" 
                                       id="login_password" 
                                       name="password" 
                                       placeholder="Contraseña" 
                                       required>
                                <label for="login_password">Contraseña</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg" id="login-btn">
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
        
        // Validación del nombre en tiempo real
        document.getElementById('nombre').addEventListener('input', function() {
            const nombre = this.value.trim();
            
            // Validar longitud
            if (nombre.length > 50) {
                this.setCustomValidity('El nombre no puede superar los 50 caracteres');
                return;
            }
            
            // Validar que solo contenga letras y espacios
            if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/.test(nombre)) {
                this.setCustomValidity('Solo se permiten letras y espacios');
                return;
            }
            
            // Validar que tenga al menos 2 palabras
            const palabras = nombre.split(' ').filter(p => p.length > 0);
            if (nombre.length > 0 && palabras.length < 2) {
                this.setCustomValidity('Ingresa tu nombre completo (nombre y apellido)');
                return;
            }
            
            this.setCustomValidity('');
        });
        
        // Validación de contraseña en tiempo real
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            
            if (password.length < 8) {
                this.setCustomValidity('La contraseña debe tener al menos 8 caracteres');
                return;
            }
            
            if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(password)) {
                this.setCustomValidity('Debe contener al menos una mayúscula, una minúscula y un número');
                return;
            }
            
            this.setCustomValidity('');
            
            // Revalidar confirmación de contraseña
            const confirmPassword = document.getElementById('confirm_password');
            if (confirmPassword.value && confirmPassword.value !== password) {
                confirmPassword.setCustomValidity('Las contraseñas no coinciden');
            } else if (confirmPassword.value === password) {
                confirmPassword.setCustomValidity('');
            }
        });
        
        // Validación del formulario antes de enviar
        document.getElementById('registro-form').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            // Validaciones finales
            if (nombre.length === 0) {
                alert('El nombre es obligatorio');
                e.preventDefault();
                return;
            }
            
            if (nombre.length > 50) {
                alert('El nombre no puede superar los 50 caracteres');
                e.preventDefault();
                return;
            }
            
            const palabras = nombre.split(' ').filter(p => p.length > 0);
            if (palabras.length < 2) {
                alert('Ingresa tu nombre completo (nombre y apellido)');
                e.preventDefault();
                return;
            }
            
            if (password !== confirmPassword) {
                alert('Las contraseñas no coinciden');
                e.preventDefault();
                return;
            }
            
            if (password.length < 8) {
                alert('La contraseña debe tener al menos 8 caracteres');
                e.preventDefault();
                return;
            }
            
            if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(password)) {
                alert('La contraseña debe contener al menos una mayúscula, una minúscula y un número');
                e.preventDefault();
                return;
            }
        });
        
        // Validación de login en tiempo real
        let loginTimeout;
        
        function validateLogin() {
            const email = document.getElementById('login_email').value.trim();
            const password = document.getElementById('login_password').value;
            const messageDiv = document.getElementById('login-message');
            const loginBtn = document.getElementById('login-btn');
            
            // Limpiar timeout anterior
            clearTimeout(loginTimeout);
            
            // Si ambos campos están vacíos, ocultar mensaje
            if (!email && !password) {
                messageDiv.style.display = 'none';
                return;
            }
            
            // Validar después de 1 segundo de pausa en escritura
            loginTimeout = setTimeout(function() {
                // Si ambos campos tienen contenido, validar
                if (email && password) {
                    // Mostrar loading
                    showLoginMessage('Validando credenciales...', 'info');
                    
                    // Hacer petición AJAX
                    fetch('<?php echo base_url('auth/validar_credenciales'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: 'email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.valid) {
                            showLoginMessage(data.message, 'success');
                            loginBtn.disabled = false;
                        } else {
                            showLoginMessage(data.message, 'danger');
                            loginBtn.disabled = true;
                        }
                    })
                    .catch(error => {
                        showLoginMessage('Error al validar credenciales', 'danger');
                        loginBtn.disabled = true;
                    });
                } else {
                    // Si falta algún campo
                    if (email && !password) {
                        showLoginMessage('Ingresa tu contraseña', 'warning');
                        loginBtn.disabled = true;
                    } else if (!email && password) {
                        showLoginMessage('Ingresa tu correo electrónico', 'warning');
                        loginBtn.disabled = true;
                    }
                }
            }, 1000);
        }
        
        function showLoginMessage(message, type) {
            const messageDiv = document.getElementById('login-message');
            messageDiv.className = 'alert alert-' + type;
            messageDiv.textContent = message;
            messageDiv.style.display = 'block';
        }
        
        // Agregar eventos a los campos de login
        document.getElementById('login_email').addEventListener('input', validateLogin);
        document.getElementById('login_password').addEventListener('input', validateLogin);
        
        // Prevenir envío del formulario si las credenciales no son válidas
        document.getElementById('login-form').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('login-btn');
            if (loginBtn.disabled) {
                e.preventDefault();
                showLoginMessage('Corrige los errores antes de continuar', 'danger');
            }
        });
    </script>
</body>
</html> 