<?php
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::CHOOSE_US, \App\Enums\Frontend\Content::FIXED);
    $enhancementContents = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::CHOOSE_US, \App\Enums\Frontend\Content::ENHANCEMENT, 4);
?>
<section class="predict-section analytics pt-120 pb-120">
    <div class="banner-blur"></div>
    <div class="container-fluid container-wrapper">
        <div class="row gx-xl-5 gy-5">
            <div class="col-xl-5">
                <div class="row g-4 gy-5 align-items-center">
                    <div class="col-xl-12 col-lg-8">
                        <div class="section-title title-secondary text-start mb-0">
                            <h2><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h2>
                            <p><?php echo e(getArrayValue($fixedContent?->meta, 'sub_heading')); ?></p>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-4">
                        <div class="analytic-img">
                            <img src="<?php echo e(displayImage(getArrayValue($fixedContent?->meta, 'vector_image'), "512x450")); ?>" alt="bitcoin" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="row g-4 analytic-card-wrapper">
                    <?php $__currentLoopData = $enhancementContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enhancementContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 analytic-card-item">
                            <div class="analytic-card" data-aos="zoom-in-right">
                                <span class="analytic-icon">
                                   <?php echo getArrayValue($enhancementContent->meta, 'icon') ?>
                                </span>
                                <div class="analytic-content">
                                    <h5><?php echo e(getArrayValue($enhancementContent->meta, 'title')); ?></h5>
                                    <p><?php echo e(getArrayValue($enhancementContent->meta, 'details')); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/choose_us.blade.php ENDPATH**/ ?>