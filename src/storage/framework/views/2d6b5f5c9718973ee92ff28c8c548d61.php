<?php
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::CRYPTO_PAIRS, \App\Enums\Frontend\Content::FIXED);
?>

<section class="conversions bg--light pb-120 pt-120">
    <div class="container-fluid container-wrapper">
        <div class="row align-items-center g-xl-5 g-0">
            <div class="col-xl-5">
                <div class="section-title text-start mb-xl-0">
                    <h2><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h2>
                    <p><?php echo e(getArrayValue($fixedContent?->meta, 'sub_heading')); ?></p>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="row g-4 ms-xl-5">
                    <?php $__currentLoopData = $cryptoConversions->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $conversion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $pair = explode('/', $conversion->pair)
                        ?>
                        <div class="col-sm-6">
                            <div class="conversion-card">
                                <div class="conversion-title">
                                    <span>
                                         <img src="<?php echo e($conversion->file); ?>" alt="<?php echo e(__('image')); ?>">
                                    </span>
                                    <h5><?php echo e(strtoupper($conversion->symbol)); ?> <i class="bi bi-arrow-right"></i> <?php echo e(strtoupper($pair[1] ?? 'USDT')); ?></h5>
                                </div>
                                <span>1 <?php echo e(strtoupper($conversion->symbol)); ?> = <?php echo e(getArrayValue($conversion->meta, 'current_price')); ?> <?php echo e(strtoupper($pair[1] ?? 'USDT')); ?></span>
                                <div class="usdt-icon">
                                    <img src="<?php echo e($conversion->file); ?>" alt="<?php echo e(__('image')); ?>">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/crypto_pairs.blade.php ENDPATH**/ ?>