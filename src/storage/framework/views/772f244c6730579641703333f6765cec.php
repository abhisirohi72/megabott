<?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 1): ?>
    <?php
        $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::CURRENCY_EXCHANGE, \App\Enums\Frontend\Content::FIXED);
    ?>
    <section class="bg--light pt-120 pb-120">
        <div class="container-fluid container-wrapper">
            <div class="section-title title-fluid">
                <div class="title-left">
                    <h2 class="mb-0"><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h2>
                </div>

                <div class="title-right">
                    <p><?php echo e(getArrayValue($fixedContent?->meta, 'sub_heading')); ?></p>
                    <a href="<?php echo e(route('trade')); ?>" class="i-btn btn--primary btn--lg pill w-fit-content"><?php echo e(__('Explore Trades')); ?></a>
                </div>
            </div>
            <?php echo $__env->make(getActiveTheme().'.partials.blue_cryptos', ['currencyExchanges' => $currencyExchanges], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </section>
<?php endif; ?>


<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/component/currency_exchange.blade.php ENDPATH**/ ?>