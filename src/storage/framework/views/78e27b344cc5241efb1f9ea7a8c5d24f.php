<?php $__env->startSection('content'); ?>
    <?php echo $__env->make(getActiveTheme().'.partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="privacy-policy pt-110 pb-110">
        <div class="container mt-5">
            <?php echo getArrayValue($content?->meta, 'descriptions') ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getActiveTheme().'.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/policy.blade.php ENDPATH**/ ?>