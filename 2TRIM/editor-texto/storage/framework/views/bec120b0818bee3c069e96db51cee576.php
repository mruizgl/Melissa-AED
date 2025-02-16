<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
</head>

<body>
    <h1>Bienvenido, <?php echo e($usuario); ?></h1>

    <!-- Listado de archivos privados -->
    <h2>Tus Ficheros Privados</h2>
    <ul>
        <?php $__empty_1 = true; $__currentLoopData = $privados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><a href="<?php echo e(route('editFile', ['file' => basename($file)])); ?>"><?php echo e(basename($file)); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>No tienes ficheros privados guardados.</li>
        <?php endif; ?>
    </ul>

    <!-- Listado de archivos compartidos -->
    <h2>Ficheros Compartidos</h2>
    <ul>
        <?php $__empty_1 = true; $__currentLoopData = $compartidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><a href="<?php echo e(route('editFile', ['file' => basename($file)])); ?>"><?php echo e(basename($file)); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>No hay archivos compartidos disponibles.</li>
        <?php endif; ?>
    </ul>

    <h2>Crear Nuevo Fichero</h2>
    <form action="<?php echo e(route('createFile')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label for="file_name">Nombre del Fichero:</label>
        <input type="text" name="file_name" required>

        <label for="file_type">Tipo:</label>
        <input type="radio" id="private" name="file_type" value="private" checked>
        <label for="private">Privado</label>
        <input type="radio" id="shared" name="file_type" value="shared">
        <label for="shared">Compartido</label>

        <button type="submit">Crear Fichero</button>
    </form>

    <a href="/logout">Cerrar Sesión</a>
</body>

</html>
<?php /**PATH /home/dam/Melissa-AED/editor-texto/resources/views/home.blade.php ENDPATH**/ ?>