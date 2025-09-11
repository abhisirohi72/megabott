<?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::INVESTMENT->name)) == 1): ?>
    <?php
        $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::PRICING_PLAN, \App\Enums\Frontend\Content::FIXED);
    ?>

    <section class="plan pb-120 pt-120">
        <div class="container-fluid container-wrapper">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-10">
                    <div class="section-title text-center">
                        <h2><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h2>
                        <p> <?php echo e(getArrayValue($fixedContent?->meta, 'sub_heading')); ?> </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center g-4">
                <?php echo $__env->make('user.partials.investment.blue_plan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </section>
    <?php echo $__env->make('user.partials.investment.plan_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/pricing_plan.blade.php ENDPATH**/ ?>