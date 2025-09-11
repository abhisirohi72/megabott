<?php
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::TESTIMONIAL, \App\Enums\Frontend\Content::FIXED);
    $enhancementContents = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::TESTIMONIAL, \App\Enums\Frontend\Content::ENHANCEMENT);
?>

<section class="testimonial pb-120 pt-120">
    <div class="container-fluid container-wrapper">
        <div class="row gy-4 justify-content-center mb-60">
            <div class="col-lg-8">
                <div class="section-title text-center mb-0">
                    <h2><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h2>
                    <p><?php echo e(getArrayValue($fixedContent?->meta, 'sub_heading')); ?></p>
                </div>
            </div>
        </div>

        <div class="row mb-30">
            <div class="d-flex w-100 align-items-center flex-row justify-content-between flex-wrap gap-lg-5 gap-4">
                <div class="review-badge">
                    <ul>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <?php if($i <= (int)getArrayValue($fixedContent?->meta, 'avg_rating')): ?>
                                <li><i class="bi bi-star-fill"></i></li>
                            <?php else: ?>
                                <li><i class="bi bi-star"></i></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ul>
                    <span><?php echo e(getArrayValue($fixedContent?->meta, 'total_reviews')); ?> <?php echo e(getArrayValue($fixedContent?->meta, 'title')); ?></span>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button class="icon-btn btn-xl primary-soft hover circle review-prev">
                        <i class="bi bi-arrow-left"></i>
                    </button>

                    <button class="icon-btn btn-xl primary-soft hover circle review-next">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="swiper review-slider">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $enhancementContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enhancementContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <div class="review-card">
                            <span class="quote-icon"><i class="bi bi-quote"></i></span>
                            <p><?php echo e(getArrayValue($enhancementContent->meta, 'testimonial')); ?></p>
                            <div class="reviewer">
                                <h6><?php echo e(getArrayValue($enhancementContent->meta, 'name')); ?></h6>
                                <span><?php echo e(getArrayValue($enhancementContent->meta, 'designation')); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/testimonial.blade.php ENDPATH**/ ?>