<?php
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::SERVICE, \App\Enums\Frontend\Content::FIXED);
    $enhancementContents = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::SERVICE, \App\Enums\Frontend\Content::ENHANCEMENT);
?>

<section class="service-section pt-120 pb-120">
    <div class="container-fluid container-wrapper">
        <div class="row gy-5 gx-4 align-items-center">
            <div class="col-lg-6">
                <div class="section-title text-start mb-0">
                    <h2><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h2>
                    <p><?php echo e(getArrayValue($fixedContent?->meta, 'sub_heading')); ?></p>
                    <ul class="service-list">
                        <?php $__currentLoopData = $enhancementContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enhancementContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <span><?php echo e($loop->iteration); ?></span> <?php echo e(getArrayValue($enhancementContent->meta, 'title')); ?>

                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="d-flex justify-content-lg-end justify-content-center">
                    <div class="service-img">
                        <img src="<?php echo e(displayImage(getArrayValue($fixedContent?->meta, 'blue_theme_image'), '550x525')); ?>" alt="<?php echo e(__('Service Image')); ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/service.blade.php ENDPATH**/ ?>