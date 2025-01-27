<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tablero</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/edit.css')); ?>">
    <meta name="author" content="Melissa Ruiz">
</head>
<body>
    <header>
        <h1>Editar Tablero</h1>
        <nav>
            <a href="<?php echo e(url('/home')); ?>">Volver</a>
        </nav>
    </header>

    <h2>Tablero: <?php echo e($tablero->nombre); ?></h2>
    
    <form action="<?php echo e(url('tableros/add-figure')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="tablero_id" value="<?php echo e($tablero->id); ?>">
        <input type="hidden" id="selected_cell" name="posicion" value="">

        <div class="tablero">
            <?php for($row = 0; $row < 4; $row++): ?>
                <?php for($col = 0; $col < 7; $col++): ?>
                    <div class="casilla" onclick="selectCell(this, '<?php echo e($row * 7 + $col); ?>')">
                        <?php
                            $figura = $figurasEnTablero->where('posicion', $row * 7 + $col)->first();
                        ?>
                        <?php if($figura): ?>
                            <img src="data:image/png;base64,<?php echo e(base64_encode($figura->imagen)); ?>" alt="<?php echo e($figura->tipo_imagen); ?>" style="max-width:100%; height:auto;">
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            <?php endfor; ?>
        </div>

        <h3>Selecciona una Figura:</h3>
        <div class="figura-selection">
            <?php $__currentLoopData = $figuras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $figura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="figura-button">
                    <input type="radio" name="figura_id" value="<?php echo e($figura->id); ?>" required>
                    <img src="data:image/png;base64,<?php echo e(base64_encode($figura->imagen)); ?>" alt="<?php echo e($figura->tipo_imagen); ?>" style="max-width:50px; max-height:50px;">
                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <button type="submit">Guardar</button>
    </form>

    <script>
        function selectCell(cell, position) {
            const previousSelected = document.querySelector('.casilla.selected');
            if (previousSelected) {
                previousSelected.classList.remove('selected');
            }
            cell.classList.add('selected');
            document.getElementById('selected_cell').value = position; 
        }
    </script>
</body>
</html>
<?php /**PATH /home/dam/Melissa-AED/construccion/resources/views/tableros/edit.blade.php ENDPATH**/ ?>