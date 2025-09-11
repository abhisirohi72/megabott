<?php $__env->startSection('panel'); ?>
    <?php echo $__env->make(getActiveTheme().'.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make(getActiveTheme().'.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getActiveTheme().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/layouts/main.blade.php ENDPATH**/ ?>