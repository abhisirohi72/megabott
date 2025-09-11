<div class="table-container rounded-4">
    <table class="table align-middle table-hover">
        <thead>
        <tr>
            <th scope="col"><?php echo e(__('Name')); ?></th>
            <th scope="col"><?php echo e(__('Pair Price')); ?></th>
            <th scope="col"><?php echo e(__('Daily Change')); ?></th>
            <th scope="col"><?php echo e(__('Daily High')); ?></th>
            <th scope="col"><?php echo e(__('Daily Low')); ?></th>
            <th scope="col"><?php echo e(__('Total Volume')); ?></th>
            <th scope="col"><?php echo e(__('Market Cap')); ?></th>
            <th scope="col"><?php echo e(__('Total Supply')); ?></th>
            <th scope="col"><?php echo e(__('Action')); ?></th>
        </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $currencyExchanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exchange): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td data-label="<?php echo e(__('Name')); ?>">
                        <a href="<?php echo e(route('user.trade.binary', $exchange->crypto_id)); ?>" class="our-currency-item">
                            <div class="d-flex align-center gap-3">
                                <div class="avatar-md">
                                    <img class="img-fluid"
                                         src="<?php echo e($exchange->file); ?>"
                                         alt="<?php echo e(__($exchange->name)); ?>" />
                                </div>
                                <div class="content">
                                    <h5 class="fs-14"><?php echo e(__($exchange->name)); ?></h5>
                                    <span class="fs-12 text-muted"><?php echo e(strtoupper($exchange->symbol)); ?> <?php echo e(__('Coin')); ?></span>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td data-label="<?php echo e(__('Pair Price')); ?>">
                        <div class="amount">
                            <?php echo e(getCurrencySymbol()); ?><?php echo e(getArrayValue($exchange->meta, 'current_price')); ?>

                        </div>
                    </td>
                    <td data-label="<?php echo e(__('Daily Change')); ?>">
                        <div class="rate">
                            <p><?php echo e(shortAmount(getArrayValue($exchange->meta, 'price_change_24h'))); ?>%</p>
                        </div>
                    </td>
                    <td data-label="<?php echo e(__('Daily High')); ?>">
                        <div class="high">
                            <p><?php echo e(shortAmount(getArrayValue($exchange->meta, 'high_24h'))); ?>%</p>
                        </div>
                    </td>
                    <td data-label="<?php echo e(__('Daily Low')); ?>">
                        <div class="low">
                            <p><?php echo e(shortAmount(getArrayValue($exchange->meta, 'low_24h'))); ?>%</p>
                        </div>
                    </td>
                    <td data-label="<?php echo e(__('Total Volume')); ?>">
                        <div class="total_volume">
                            <p><?php echo e(shortAmount(getArrayValue($exchange->meta, 'total_volume'))); ?>%</p>
                        </div>
                    </td>
                    <td data-label="<?php echo e(__('Market Cap')); ?>">
                        <div class="total_volume">
                            <p><?php echo e(shortAmount(getArrayValue($exchange->meta, 'market_cap'))); ?></p>
                        </div>
                    </td>
                    <td data-label="<?php echo e(__('Total Supply')); ?>">
                        <div class="total_volume">
                            <p><?php echo e(shortAmount(getArrayValue($exchange->meta, 'total_supply'))); ?></p>
                        </div>
                    </td>

                    <td data-label="<?php echo e(__('Action')); ?>">
                        <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 1): ?>
                            <div class="action">
                                <?php if(getArrayValue($setting->system_configuration, 'binary_trade.value') == \App\Enums\Status::ACTIVE->value): ?>
                                    <a href="<?php echo e(route('user.trade.binary', $exchange->crypto_id)); ?>" class="i-btn btn--primary btn--sm pill"><?php echo e(__('Trade')); ?></a>
                                <?php endif; ?>
                                <?php if(getArrayValue($setting->system_configuration, 'practice_trade.value') == \App\Enums\Status::ACTIVE->value): ?>
                                    <a href="<?php echo e(route('user.trade.practice', $exchange->crypto_id)); ?>" class="i-btn btn--dark btn--sm pill"><?php echo e(__('Practice')); ?></a>
                                <?php endif; ?>
                                <?php if(getArrayValue($setting->system_configuration, 'binary_trade.value') != \App\Enums\Status::ACTIVE->value && getArrayValue($setting->system_configuration, 'practice_trade.value') != \App\Enums\Status::ACTIVE->value): ?>
                                    <span><?php echo e(__('N/A')); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <span><?php echo e(__('N/A')); ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/partials/blue_cryptos.blade.php ENDPATH**/ ?>