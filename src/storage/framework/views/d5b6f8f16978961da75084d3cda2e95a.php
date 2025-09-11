<div class="d-sidebar" id="user-sidebar">
    <div class="sidebar-logo">
        <a href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(displayImage(getArrayValue($setting->logo, 'dark'), "592x89")); ?>" alt="<?php echo e(__('logo')); ?>">
        </a>
    </div>
    <div class="main-nav sidebar-menu-container" style="overflow:auto;">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <div class="row">
                    <div class="col-md-12">
                        <div id="google_translate_element"></div>
                        <style>
                            #google_translate_element select {
                                background-color: #f0f0f0; /* Default dropdown background */
                                color: #000; /* Default dropdown text color */
                            }

                            /* Highlight the selected value */
                            #google_translate_element select option:checked {
                                background-color: #007bff; /* Selected background color */
                                color: #fff; /* Selected text color */
                            }
                        </style>
                        <script type="text/javascript">
                        function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                        }
                        </script>

                        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </div>
                </div>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link <?php echo e(request()->routeIs('user.dashboard') ? "active" :""); ?>" href="<?php echo e(route('user.dashboard')); ?>" aria-expanded="false">
                    <span><i class="bi bi-speedometer2"></i></span>
                    <p><?php echo e(__('Dashboard')); ?></p>
                </a>
            </li>

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link <?php echo e(request()->routeIs('user.transaction') ? "active" :""); ?>" href="<?php echo e(route('user.transaction')); ?>" aria-expanded="false">
                    <span><i class="bi bi-credit-card-fill"></i></span>
                    <p><?php echo e(__('Transaction')); ?></p>
                </a>
            </li>

            <?php if(getArrayValue($setting->system_configuration, 'investment_reward.value') == \App\Enums\Status::ACTIVE->value && getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::INVESTMENT->name)) == \App\Enums\Status::ACTIVE->value): ?>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-link <?php echo e(request()->routeIs('user.reward') ? "active" :""); ?>" href="<?php echo e(route('user.reward')); ?>" aria-expanded="false">
                        <span><i class="bi bi-award-fill"></i></span>
                        <p><?php echo e(__('Reward Badges')); ?></p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::MATRIX->name)) == 1): ?>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-link collapsed <?php echo e(request()->routeIs(['user.matrix.index', 'user.commission.rewards', 'user.commission.index']) ? 'active' : ''); ?>" data-bs-toggle="collapse" href="#collapseWithdraw" role="button" aria-expanded="false" aria-controls="collapseWithdraw">
                        <span><i class="bi la-money-bill-wave"></i></span>
                        <p><?php echo e(__('Matrix')); ?><small><i class="las la-angle-<?php echo e(request()->routeIs(['user.matrix.index', 'user.commission.rewards','user.commission.index']) ? 'up' : 'down'); ?>"></i></small></p>
                    </a>
                    <div class="side-menu-dropdown collapse <?php echo e(request()->routeIs(['user.matrix.index', 'user.commission.rewards', 'user.commission.index']) ? 'show' : ''); ?>" id="collapseWithdraw">
                        <ul class="sub-menu <?php echo e(request()->routeIs(['user.matrix.index','user.commission.rewards','user.commission.index']) ? 'open-slide' : ''); ?>">
                            <?php $__currentLoopData = ['matrix.index' => 'Scheme', 'commission.rewards' => 'Referral Rewards', 'commission.index' => 'Commissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="sub-menu-item">
                                    <a class="sidebar-menu-link <?php echo e(request()->routeIs("user.$route") ? 'active' : ''); ?>"  href="<?php echo e(route("user.$route")); ?>" aria-expanded="false">
                                        <p><?php echo e(__($label)); ?></p>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::INVESTMENT->name)) == 1): ?>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-link collapsed <?php echo e(request()->routeIs('user.investment.*') ? 'active' : ''); ?>" data-bs-toggle="collapse" href="#collapsePaymentProcessor" role="button" aria-expanded="false" aria-controls="collapsePaymentProcessor">
                        <span><i class="bi bi-wallet-fill"></i></span>
                        <p><?php echo e(__('Investments')); ?>  <small><i class="las la-angle-<?php echo e(request()->routeIs(['user.investment.index','user.investment.funds','user.investment.profit.statistics']) ? "up" : "down"); ?>"></i></small></p>
                    </a>
                    <div class="side-menu-dropdown collapse <?php echo e(request()->routeIs('user.investment.*') ? 'show' : ''); ?>" id="collapsePaymentProcessor">
                        <ul class="sub-menu  <?php echo e(request()->routeIs(['user.investment.index','user.investment.funds','user.investment.profit.statistics']) ? "open-slide" : ""); ?>">
                        <?php $__currentLoopData = ['index' => 'Scheme', 'funds' => 'Funds', 'profit.statistics' => 'Profit Statistics']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="sub-menu-item">
                                <a class="sidebar-menu-link <?php echo e(request()->routeIs("user.investment.$route") ? 'active' : ''); ?>"  href="<?php echo e(route("user.investment.$route")); ?>" aria-expanded="false">
                                    <p><?php echo e(__($label)); ?></p>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>


            <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::STAKING_INVESTMENT->name)) == 1): ?>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-link <?php echo e(request()->routeIs('user.staking-investment.index') ? "active" :""); ?>"  href="<?php echo e(route('user.staking-investment.index')); ?>" aria-expanded="false">
                        <span><i class="bi bi-currency-euro"></i></span>
                        <p><?php echo e(__('Staking Investment')); ?></p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 1): ?>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-link collapsed <?php echo e(request()->routeIs('user.trade.*') ? 'active' : ''); ?>" data-bs-toggle="collapse" href="#collapseTrade" role="button" aria-expanded="false" aria-controls="collapseTrade">
                        <span><i class="bi bi-bar-chart"></i></span>
                        <p><?php echo e(__('Trades')); ?>  <small><i class="las la-angle-<?php echo e(request()->routeIs(['user.investment.index','user.investment.funds','user.investment.profit.statistics']) ? "up" : "down"); ?>"></i></small></p>
                    </a>
                    <div class="side-menu-dropdown collapse <?php echo e(request()->routeIs('user.trade.*') ? 'show' : ''); ?>" id="collapseTrade">
                        <ul class="sub-menu  <?php echo e(request()->routeIs('user.trade.*') ? "open-slide" : ""); ?>">
                            <?php $__currentLoopData = ['index' => 'Trade Now', 'tradelog' => 'History', 'practicelog' => 'Practices']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trade => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="sub-menu-item">
                                    <a class="sidebar-menu-link <?php echo e(request()->routeIs("user.trade.$trade") ? 'active' : ''); ?>"  href="<?php echo e(route("user.trade.$trade")); ?>" aria-expanded="false">
                                        <p><?php echo e(__($label)); ?></p>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link collapsed <?php echo e(request()->routeIs('user.payment.*') ? 'active' : ''); ?>" data-bs-toggle="collapse" href="#collapseDeposit" role="button" aria-expanded="false" aria-controls="collapseTrade">
                    <span><i class="bi bi-wallet2"></i></span>
                    <p><?php echo e(__('Deposit')); ?>  <small><i class="las la-angle-<?php echo e(request()->routeIs(['user.payment.index']) ? "up" : "down"); ?>"></i></small></p>
                </a>
                <div class="side-menu-dropdown collapse <?php echo e(request()->routeIs('user.payment.*') ? 'show' : ''); ?>" id="collapseDeposit">
                    <ul class="sub-menu  <?php echo e(request()->routeIs('user.payment.*') ? "open-slide" : ""); ?>">
                        <?php $__currentLoopData = ['index' => 'Instant', 'commission' => 'Commissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="sub-menu-item">
                                <a class="sidebar-menu-link <?php echo e(request()->routeIs("user.payment.$deposit") ? 'active' : ''); ?>"  href="<?php echo e(route("user.payment.$deposit")); ?>" aria-expanded="false">
                                    <p><?php echo e(__($label)); ?></p>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </li>

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link <?php echo e(request()->routeIs('user.referral.index') ? "active" :""); ?>"  href="<?php echo e(route('user.referral.index')); ?>" aria-expanded="false">
                    <span><i class="bi bi-command"></i></span>
                    <p><?php echo e(__('Referrals')); ?></p>
                </a>
            </li>

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link <?php echo e(request()->routeIs('user.withdraw.index') ? "active" :""); ?>"  href="<?php echo e(route('user.withdraw.index')); ?>" aria-expanded="false">
                    <span><i class="bi bi-wallet"></i></span>
                    <p><?php echo e(__('Cash out')); ?></p>
                </a>
            </li>

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link <?php echo e(request()->routeIs('user.recharge.index') ? "active" :""); ?>"  href="<?php echo e(route('user.recharge.index')); ?>" aria-expanded="false">
                    <span><i class="bi bi-cash"></i></span>
                    <p><?php echo e(__('InstaPIN Recharge')); ?></p>
                </a>
            </li>

            <li class="sidebar-menu-item">
            <a class="sidebar-menu-link <?php echo e(request()->routeIs('profile.edit') ? "active" :""); ?>"  href="<?php echo e(route('profile.edit')); ?>" aria-expanded="false">
                    <span><i class="bi bi-gear"></i></span>
                    <p><?php echo e(__('Settings')); ?></p>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link <?php echo e(request()->routeIs('profile.edit') ? "active" :""); ?>"  href="<?php echo e(route('user.show_liverage')); ?>" aria-expanded="false">
                        <span><i class="bi bi-gift"></i></span>
                        <p>View Leverage</p>
                    </a>
                </li>
        </ul>
    </div>
</div>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/user/partials/side-bar.blade.php ENDPATH**/ ?>