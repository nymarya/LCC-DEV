
<div class="content" style="min-height: 0;padding-bottom: 0; position: relative;">
    <div class="system-alerts">
    <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> <?php echo session('error'); ?>

                <?php session()->forget('error'); ?>
            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> <?php echo session('success'); ?>

                <?php session()->forget('success'); ?>
            </div>
        <?php endif; ?>

        <?php if(session('info')): ?>
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> <?php echo session('info'); ?>

                <?php session()->forget('info'); ?>
            </div>
        <?php endif; ?>

        <?php if(session('warning')): ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> <?php echo session('warning'); ?>

                <?php session()->forget('warning'); ?>
            </div>
        <?php endif; ?>
        <?php if(session('aviso_do_programador')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> <?php echo session('aviso_do_programador'); ?>

                <?php session()->forget('aviso_do_programador'); ?>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->startPush('stylesheets'); ?>
    <LINK rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" >
<?php $__env->stopPush(); ?>
