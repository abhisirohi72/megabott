<?php
   $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::ABOUT, \App\Enums\Frontend\Content::FIXED);
   $enhancementContents = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::ABOUT, \App\Enums\Frontend\Content::ENHANCEMENT);
?>

<section class="about-us pt-120 pb-120">
    <div class="container-fluid container-wrapper">
        <div class="about-wrapper" data-aos="zoom-in">
            <div class="row gx-xl-5 gy-5 align-items-start">
                <div class="col-xl-6">
                    <div class="about-content">
                        <div class="section-title title-secondary text-start mb-0">
                            <h2><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h2>
                            <p><?php echo e(getArrayValue($fixedContent?->meta, 'sub_heading')); ?></p>
                        </div>
                    </div>
                    <div class="about-countdown">
                        <div class="row g-sm-5 g-3 justify-content-center">
                            <div class="col-sm-4 col-6">
                                <div class="about-card bg--info text-white">
                                    <h5 class="text-white"><?php echo e(getArrayValue($fixedContent?->meta, 'first_item_count')); ?></h5>
                                    <span><?php echo e(getArrayValue($fixedContent?->meta, 'first_item_title')); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-4 col-6">
                                <div class="about-card bg--primary">
                                    <h5><?php echo e(getArrayValue($fixedContent?->meta, 'second_item_count')); ?></h5>
                                    <span><?php echo e(getArrayValue($fixedContent?->meta, 'second_item_title')); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-4 col-6">
                                <div class="about-card bg--warning">
                                    <h5><?php echo e(getArrayValue($fixedContent?->meta, 'third_item_count')); ?></h5>
                                    <span><?php echo e(getArrayValue($fixedContent?->meta, 'third_item_title')); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <ul>
                        <?php $__currentLoopData = $enhancementContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enhancementContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <span> <?php echo getArrayValue($enhancementContent->meta, 'icon') ?></span>
                            <?php echo e(getArrayValue($enhancementContent->meta, 'title')); ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/about.blade.php ENDPATH**/ ?>