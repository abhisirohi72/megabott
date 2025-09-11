<?php
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::BLOG, \App\Enums\Frontend\Content::FIXED);
    $enhancementContents = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::BLOG, \App\Enums\Frontend\Content::ENHANCEMENT, 4);
?>

<section class="blog-section pt-120">
    <div class="container-fluid container-wrapper">
        <div class="section-title title-fluid">
            <div class="title-left">
                <h2 class="mb-0"><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h2>
            </div>

            <div class="title-right">
                <p><?php echo e(getArrayValue($fixedContent?->meta, 'sub_heading')); ?></p>
                <div class="d-flex align-items-center justify-content-between">
                    <a href=" <?php echo e(getArrayValue($fixedContent?->meta, 'blue_theme_btn_url')); ?>" class="i-btn btn--primary btn--lg pill w-fit-content">
                        <?php echo e(getArrayValue($fixedContent?->meta, 'blue_theme_btn_name')); ?>

                    </a>

                    <div class="d-flex align-items-center gap-3">
                        <button class="icon-btn btn-lg primary-soft hover circle button-prev">
                            <i class="bi bi-arrow-left"></i>
                        </button>

                        <button class="icon-btn btn-lg primary-soft hover circle button-next">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="swiper blog-slider">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $enhancementContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enhancementContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <a href="<?php echo e(route('blog.detail', $enhancementContent->id)); ?>" class="blog-card">
                            <div class="row gy-2 align-items-center">
                                <div class="col-12">
                                    <picture>
                                        <img src="<?php echo e(displayImage(getArrayValue($enhancementContent->meta, 'thumb_image'), '800x500')); ?>" alt="" />
                                    </picture>
                                </div>

                                <div class="col-12">
                                    <div class="blog-caption">
                                        <span class="fs-14 text-primary fw-medium"><?php echo e(showDateTime($enhancementContent->created_at, 'd')); ?> , <?php echo e(showDateTime($enhancementContent->created_at, 'M Y')); ?></span>
                                        <h4><?php echo e(getArrayValue($enhancementContent->meta, 'title')); ?></h4>
                                        <p><?php echo e(strip_tags(getArrayValue($enhancementContent?->meta, 'description'))); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/blog.blade.php ENDPATH**/ ?>