<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Login de Usuario</h2>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <form method="post" action="<?php echo base_url('auth/iniciar_sesion'); ?>">
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>

