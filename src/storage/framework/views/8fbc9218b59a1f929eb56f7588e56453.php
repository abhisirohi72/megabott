<?php
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::FEATURE, \App\Enums\Frontend\Content::FIXED);
    $enhancementContents = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::FEATURE, \App\Enums\Frontend\Content::ENHANCEMENT);
?>
<section class="market-analytic pt-120 pb-120">
    <div class="container-fluid container-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-10">
                <div class="section-title text-center">
                    <h2><?php echo e(__(getArrayValue($fixedContent?->meta, 'heading'))); ?></h2>
                    <p><?php echo e(__(getArrayValue($fixedContent?->meta, 'sub_heading'))); ?></p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-4 align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-9 col-11 pe-lg-5">
                <div class="market-analysis" data-aos="zoom-in">
                    <img src="<?php echo e(displayImage(getArrayValue($fixedContent?->meta, 'blue_theme_main_image'), '418x542')); ?>" alt="<?php echo e(__('market-analysis')); ?>">
                </div>
            </div>
            <div class="col-lg-8 ps-lg-5">
                <div class="row g-4 analytic-card-wrapper">
                    <div class="analytic-wrapper">
                        <?php $__currentLoopData = $enhancementContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enhancementContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="analytic-card">
                                <span class="analytic-icon">
                                     <?php echo  getArrayValue($enhancementContent->meta, 'icon') ?>
                                </span>

                                <div class="analytic-content">
                                    <h5><?php echo e(__(getArrayValue($enhancementContent->meta, 'title'))); ?></h5>
                                    <p><?php echo e(__(getArrayValue($enhancementContent->meta, 'details'))); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/feature.blade.php ENDPATH**/ ?>