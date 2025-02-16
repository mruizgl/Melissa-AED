<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tableros</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/home.css')); ?>">
    <meta name="author" content="Melissa Ruiz">
</head>
<body>

    <main>
        <h2>Mis Tableros</h2>

        <?php if($tableros->isEmpty()): ?>
            <p>No tienes tableros creados. ¡Crea uno!</p>
        <?php else: ?>
            <ul>
                <?php $__currentLoopData = $tableros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tablero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <strong><?php echo e($tablero['nombre']); ?></strong><br> 
                        <em><?php echo e(date('d/m/Y H:i:s', $tablero['fecha'])); ?></em>
                        <br>
                        <a href="<?php echo e(url('/tableros/' . $tablero['id'])); ?>">Ver Tablero</a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
        
        <div>
            <a href="<?php echo e(url('/tableros/create')); ?>">Crear Tablero</a>
        </div>

        <?php if($isAdmin): ?>
            <hr>
            <h2>Gestión de Admin</h2>
            <ul>
                <li><a href="<?php echo e(route('users.index')); ?>">Gestionar Usuarios</a></li>
                <li><a href="<?php echo e(url('/admin/figuras/create')); ?>">Gestionar Figuras</a></li>
            </ul>
        <?php endif; ?>

        <a href="<?php echo e(url('/')); ?>">Cerrar Sesión</a>
       
    </main>
</body>
</html>
<?php /**PATH /home/dam/Melissa-AED/construccion/resources/views/home.blade.php ENDPATH**/ ?>