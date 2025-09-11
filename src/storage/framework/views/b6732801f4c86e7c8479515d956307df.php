<?php
    $googleLoginActive = getArrayValue($setting?->social_login, 'google.status') == \App\Enums\Status::ACTIVE->value;
    $facebookLoginActive = getArrayValue($setting?->social_login, 'facebook.status') == \App\Enums\Status::ACTIVE->value;
?>

<?php if($googleLoginActive || $facebookLoginActive): ?>
    <div class="another-singup">
        <div class="or"><?php echo e(__('OR')); ?></div>
        <h6><?php echo e(__('Sign Up with')); ?></h6>
        
        <div class="form-social-two">
            <?php $__currentLoopData = $setting?->social_login; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key == "google"): ?>
                    <?php if($googleLoginActive): ?>
                        <a href="<?php echo e(route('google.login')); ?>" class="<?php echo e($key); ?>"><i class="bi bi-<?php echo e($key); ?>"></i><?php echo e(__(ucfirst($key))); ?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if($facebookLoginActive): ?>
                        <a href="<?php echo e(route('facebook.login')); ?>" class="<?php echo e($key); ?>"><i class="bi bi-<?php echo e($key); ?>"></i><?php echo e(__(ucfirst($key))); ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
       
    </div>
<?php endif; ?>


<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/partials/social-auth.blade.php ENDPATH**/ ?>