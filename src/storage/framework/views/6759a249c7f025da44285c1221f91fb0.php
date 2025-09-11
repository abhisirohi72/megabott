<?php
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::MATRIX_PLAN, \App\Enums\Frontend\Content::FIXED);
?>
<?php $__currentLoopData = $matrix; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-6">
        <div class="community-card   <?php if($plan->is_recommend): ?> recommend <?php endif; ?>">
            <?php if($plan->is_recommend): ?>
                <span class="recommend-tag"><?php echo e(__('Recommend')); ?></span>
            <?php endif; ?>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="community-card-left">
                        <span><?php echo e($plan->name); ?></span>
                        <h6><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($plan->amount)); ?></h6>
                        <div class="referral-note">
                            <p><?php echo e(__('Straightforward Referral Reward')); ?>: <?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($plan->referral_reward)); ?></p>
                            <p><?php echo e(__('Aggregate Level Commission')); ?>: <?php echo e(getCurrencySymbol()); ?><?php echo e(\App\Services\Investment\MatrixService::calculateAggregateCommission((int)$plan->id)); ?></p>
                            <span><?php echo e(__('Get back')); ?> <span><?php echo e(shortAmount((\App\Services\Investment\MatrixService::calculateAggregateCommission((int)$plan->id) / $plan->amount) * 100)); ?>%</span> <?php echo e(__('of what you invested')); ?></span>
                        </div>

                        <button class="i-btn btn--primary btn--lg pill enroll-matrix-process"
                                data-bs-toggle="modal"
                                data-bs-target="#enrollMatrixModal"
                                data-uid="<?php echo e($plan->uid); ?>"
                                data-name="<?php echo e($plan->name); ?>"
                        ><?php echo e(__('Start Investing Now')); ?></button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="community-card-right">
                        <ul class="community-feature">
                            <?php $__currentLoopData = \App\Services\Investment\MatrixService::calculateTotalLevel($plan->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $matrix = pow(\App\Services\Investment\MatrixService::getMatrixWidth(), $loop->iteration)
                                ?>
                                <li>
                                    <i class="bi bi-check2-circle"></i> <?php echo e(__('Level')); ?>-<?php echo e($loop->iteration); ?> >>
                                    <?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($value->amount)); ?>x<?php echo e($matrix); ?> =
                                    <?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($value->amount * $matrix)); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/user/partials/matrix/blue_plan.blade.php ENDPATH**/ ?>