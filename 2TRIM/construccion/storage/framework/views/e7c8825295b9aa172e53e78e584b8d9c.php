<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tablero</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/create.css')); ?>">
    <meta name="author" content="Melissa Ruiz">
</head>
<body>
    <header class="header">
        <h1>Crear Tablero</h1>
    </header>

    <main class="main-container">
        <form method="POST" action="<?php echo e(url('/tableros')); ?>" class="form-container">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre del Tablero:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <button type="submit" class="form-button">Crear Tablero</button>
        </form>

        <?php if($errors->any()): ?>
            <div class="error-container">
                <strong>Error:</strong>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <nav class="nav-links">
            <a href="<?php echo e(url('/home')); ?>" class="link">Volver a Mis Tableros</a>
            <a href="<?php echo e(url('/')); ?>" class="link">Cerrar Sesión</a>
        </nav>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH /home/dam/Melissa-AED/construccion/resources/views/tableros/create.blade.php ENDPATH**/ ?>