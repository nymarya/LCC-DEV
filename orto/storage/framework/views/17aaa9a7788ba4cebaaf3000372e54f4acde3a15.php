<body class="login-page bg-indigo">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">Fisio<b>CENTRO</b></a>
    </div>
    <?php if($errors): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div><?php echo e($error); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <div class="card">
        <div class="body">
                <div class="msg">
                    Selecionar perfil
                </div>
                <div class="input-group">
                    <?php $__empty_1 = true; $__currentLoopData = $ativos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perfil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <form role="form" method="POST" action="<?php echo e(route('perfis:trocar')); ?>">
                            <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="perfil_id" value="<?php echo e($perfil->id); ?>">

                            <button type="submit" style="white-space: normal" class="btn btn-warning btn-flat btn-block no-margin-bottom">
                                    <?php echo e($perfil->papel->verbose); ?>

                                    <?php if($perfil->papel->hospital_id): ?>
                                        (<?php echo e($perfil->papel->hospital->sigla); ?>)
                                    <?php endif; ?>
                            </button>
                        </form>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center">
                            Não há perfis disponíveis.
                        </p>

                        <form class="text-center" action="<?php echo e(route('logout')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <button class="btn btn-default btn-flat">Sair</button>
                        </form>
                    <?php endif; ?>

                </div>
        </div>
    </div>
</div>

<?php echo $__env->make('layouts.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>