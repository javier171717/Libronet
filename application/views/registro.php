<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>

    <h2>Registro de usuario</h2>

    <form method="post" action="<?php echo site_url('auth/guardar_registro'); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="correo">Correo:</label>
        <input type="email" name="email" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Registrar</button>
    </form>

</body>
</html>



