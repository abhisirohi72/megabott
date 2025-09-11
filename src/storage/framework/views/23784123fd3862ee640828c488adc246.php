<?php
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::PROCESS, \App\Enums\Frontend\Content::FIXED);
    $enhancementContents = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::PROCESS, \App\Enums\Frontend\Content::ENHANCEMENT);
?>
<section class="process-section pt-120 pb-120">
    <div class="container-fluid container-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-10">
                <div class="section-title text-center">
                    <h2><?php echo e(getArrayValue($fixedContent?->meta, 'blue_theme_heading')); ?></h2>
                    <p><?php echo e(getArrayValue($fixedContent?->meta, 'blue_theme_sub_heading')); ?></p>
                </div>
            </div>
        </div>

        <div class="row gx-lg-5 gy-5 align-items-center">
            <div class="col-lg-12">
                <div class="d-flex flex-row gap-xl-5 gap-4 process-wrapper">
                    <?php $__currentLoopData = $enhancementContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enhancementContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="process-card" data-aos="fade-up">
                            <div class="serial-number"><?php echo e($loop->iteration); ?></div>
                            <span class="icon-btn primary-solid btn-xxl circle">
                                <?php echo getArrayValue($enhancementContent->meta, 'icon') ?>
                            </span>
                            <div class="process-content">
                                <h4><?php echo e(getArrayValue($enhancementContent->meta, 'title')); ?></h4>
                                <p><?php echo e(getArrayValue($enhancementContent->meta, 'details')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/process.blade.php ENDPATH**/ ?>