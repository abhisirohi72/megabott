<?php
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::FAQ, \App\Enums\Frontend\Content::FIXED);
    $enhancementContents = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::FAQ, \App\Enums\Frontend\Content::ENHANCEMENT);
?>
<section class="faqs pt-120 pb-120">
    <div class="container-fluid container-wrapper">
        <div class="faqs-wrapper">
            <div class="row gx-lg-5 gy-5">
                <div class="col-lg-6 pe-lg-5">
                    <div class="section-title text-start">
                        <h2><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h2>
                        <p><?php echo e(getArrayValue($fixedContent?->meta, 'sub_heading')); ?></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion-wrapper">
                        <div class="accordion" id="faq-accordion">
                            <?php $__currentLoopData = $enhancementContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enhancementContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-<?php echo e($loop->iteration); ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-<?php echo e($loop->iteration); ?>" aria-expanded="false" aria-controls="collapse-<?php echo e($loop->iteration); ?>">
                                            <?php echo e(getArrayValue($enhancementContent->meta, 'question')); ?>

                                        </button>
                                    </h2>
                                    <div id="collapse-<?php echo e($loop->iteration); ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?php echo e($loop->iteration); ?>">
                                        <div class="accordion-body">
                                            <p>
                                                <?php echo e(getArrayValue($enhancementContent->meta, 'answer')); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/faq.blade.php ENDPATH**/ ?>