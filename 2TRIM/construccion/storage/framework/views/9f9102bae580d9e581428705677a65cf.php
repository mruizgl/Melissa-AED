<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form method="POST" action="<?php echo e(url('/register')); ?>">
        <?php echo csrf_field(); ?>
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Registrar</button>
    </form>

    <p><a href="<?php echo e(url('/login')); ?>">Ya tengo una cuenta</a></p>

  
</body>
</html>
<?php /**PATH /home/dam/Melissa-AED/construccion/resources/views/register.blade.php ENDPATH**/ ?>