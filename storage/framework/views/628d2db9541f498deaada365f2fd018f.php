<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form id="formulario" method="POST" action="">
    <?php echo csrf_field(); ?>
        <p><label for="">Nombre</label> <input type="text" name="name"></p>
        <p><label for="">Email</label> <input type="text" name="email"></p>

        <button type="button" onclick="saveUser()">Guardar</button>
    </form>
    lista de usuarios
    <table class="table">
        <thead>
            <th>nombre</th>
            <th>correo</th>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>
</body>
</html>

<script>
    function saveUser(){
        document.getElementById('formulario').action="<?php echo e(route('usuario.guardar')); ?>";
        document.getElementById('formulario').submit();
    }
</script><?php /**PATH C:\Users\Acer\OneDrive\Escritorio\laravel\usuario\resources\views/users.blade.php ENDPATH**/ ?>