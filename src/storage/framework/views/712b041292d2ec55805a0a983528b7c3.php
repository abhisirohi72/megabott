<?php $__currentLoopData = $investments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $investment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-4 col-md-6">
        <div class="plan-card <?php if($investment->is_recommend): ?> recommend <?php endif; ?>">
            <div class="plan-card-header">
                <div class="plan-title">
                    <div class="icon-btn btn-md primary-solid circle">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <span><?php echo e($investment->name); ?> </span>
                </div>
                <?php if($investment->interest_return_type == \App\Enums\Investment\ReturnType::REPEAT->value): ?>
                    <h6><?php echo e((int)$investment->duration); ?> <?php echo e($investment->timeTable->name ?? ''); ?></h6>
                <?php else: ?>
                    <h6><?php echo e(__('Lifetime')); ?></h6>
                <?php endif; ?>
                <p><?php echo e(__('Interest Rate')); ?>: <?php echo e(shortAmount($investment->interest_rate)); ?><?php echo e(\App\Enums\Investment\InterestType::getSymbol($investment->interest_type)); ?></p>
            </div>

            <?php if($investment->is_recommend): ?>
                <span class="recommend-tag"> <?php echo e(__('Recommend')); ?> </span>
            <?php endif; ?>

            <ul class="pricing-list">
                <li>
                    <i class="bi bi-check2-circle"></i>Investment amount limit : <span> <?php if($investment->type == \App\Enums\Investment\InvestmentRage::RANGE->value): ?>
                            <?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($investment->minimum)); ?>

                            - <?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($investment->maximum)); ?>

                        <?php else: ?>
                            <?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($investment->amount)); ?>

                        <?php endif; ?></span>
                </li>
                <?php if(!empty($investment->meta)): ?>
                    <?php $__currentLoopData = $investment->meta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <i class="bi bi-check2-circle"></i><?php echo e($value); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <li>
                    <i class="bi bi-check2-circle"></i>Total Return :
                    <span><?php if($investment->interest_return_type == \App\Enums\Investment\ReturnType::REPEAT->value): ?>
                            <?php echo e(totalInvestmentInterest($investment)); ?>

                        <?php else: ?>
                            <?php echo app('translator')->get('Unlimited'); ?>
                        <?php endif; ?>

                        <?php if($investment->recapture_type == \App\Enums\Investment\Recapture::HOLD->value): ?>
                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="Hold capital & reinvest">
                                  <i class="bi bi-info-circle me-2 color--primary"></i>
                            </span>
                        <?php endif; ?>
                    </span>
                </li>
            </ul>

            <p class="fs-14 mt-4 text-center terms-policy" role="button" data-bs-toggle="modal" data-bs-target="#termsModal"  data-terms_policy="<?php echo $investment->terms_policy ?>">
                <i class="bi bi-info-circle-fill text-info"></i><?php echo e(__('Terms and Policies')); ?>

            </p>

            <div class="mt-10">
                <button
                    class="i-btn btn--primary btn--xl pill w-100 invest-process"
                    data-bs-toggle="modal"
                    data-bs-target="#investModal"
                    data-name="<?php echo e($investment->name); ?>"
                    data-uid="<?php echo e($investment->uid); ?>"
                ><?php echo e(__('Invest Now')); ?>

                </button>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/user/partials/investment/blue_plan.blade.php ENDPATH**/ ?>