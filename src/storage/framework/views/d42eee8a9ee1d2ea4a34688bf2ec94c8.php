<div class="marquee">
    <ul class="marquee-items">
           <?php $__currentLoopData = $cryptoCurrencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="marquee-item">
                <div class="marquee-item-img">
                    <img src="<?php echo e($currency->file); ?>" alt="<?php echo e(__($currency->name)); ?>" />
                </div>
                <h6><?php echo e(__($currency->pair)); ?></h6>
                <span><?php echo e(getArrayValue($currency->meta, 'current_price')); ?> (<?php echo e(getArrayValue($currency->meta, 'price_change_24h')); ?>%)</span>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>

<header class="header-area style-1">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="header-left">
            <button class="header-item-btn sidebar-btn d-lg-none d-block">
                <i class="bi bi-bars"></i>
            </button>
            <div class="header-logo">
                <a href="<?php echo e(route('home')); ?>"><img alt="image" class="img-fluid" src="<?php echo e(displayImage(getArrayValue($setting?->logo, 'white'), "592x89")); ?>" /></a>
            </div>
        </div>

        <div class="main-nav">
            <div class="mobile-logo-area d-xl-none d-flex justify-content-between align-items-center">
                <div class="mobile-logo-wrap">
                    <img alt="image" src="<?php echo e(displayImage(getArrayValue($setting?->logo, 'white'), "592x89")); ?>" />
                </div>
                <div class="menu-close-btn">
                    <i class="bi bi-x-lg"></i>
                </div>
            </div>

            <ul class="menu-list">
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($menu->name == 'Home'): ?>
                        <li class="menu-item-has-children">
                            <a href="<?php echo e(route('home')); ?>" class="drop-down <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>"><?php echo e($menu->name); ?></a>
                        </li>
                    <?php elseif($menu->name == 'Trade'): ?>

                        <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 1): ?>
                            <li class="menu-item-has-children">
                                <a href="<?php echo e(route('trade')); ?>" class="drop-down <?php echo e(request()->routeIs('trade') ? 'active' : ''); ?>"><?php echo e($menu->name); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php elseif($menu->children->isEmpty()): ?>
                        <li><a href="<?php echo e(route('dynamic.page', $menu->url)); ?>"><?php echo e($menu->name); ?></a></li>
                    <?php elseif($menu->children->isNotEmpty()): ?>
                        <li class="menu-item-has-children">
                            <a href="<?php echo e($menu->url); ?>" class="drop-down"><?php echo e($menu->name); ?></a>
                            <i class="bi bi-chevron-down dropdown-icon"></i>
                            <ul class="sub-menu">
                                <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e($subMenu->url); ?>"><?php echo e($subMenu->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(route('contact')); ?>" class="<?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>"><?php echo e(__('Contact')); ?></a></li>
            </ul>
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="i-btn btn--md d-xl-none d-flex capsuled btn--primary-outline"><?php echo app('translator')->get('Sign In'); ?></a>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('user.dashboard')); ?>" class="i-btn btn--md d-xl-none d-flex capsuled btn--primary-outline"><?php echo app('translator')->get('Dashboard'); ?></a>
            <?php endif; ?>
        </div>

        <div class="nav-right">
            <?php if(getArrayValue($setting?->system_configuration, 'language.value') == \App\Enums\Status::ACTIVE->value): ?>
                <div class="dropdown-language">
                    <select class="language">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lang->code); ?>" <?php if(session('lang') == $lang->code): ?> selected <?php endif; ?>><?php echo e($lang?->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="i-btn btn--md d-xl-flex d-none capsuled btn--primary-outline"><?php echo app('translator')->get('Sign In'); ?></a>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('user.dashboard')); ?>" class="i-btn btn--md d-xl-flex d-none capsuled btn--primary-outline"><?php echo app('translator')->get('Dashboard'); ?></a>
            <?php endif; ?>
            <div class="sidebar-btn d-xl-none d-flex">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </div>
</header>
<?php $__env->startPush('script-push'); ?>
    <script>
        "use strict";
        $(document).ready(function () {
            $('.language').on('change', function () {
                const languageCode = $(this).val();
                changeLanguage(languageCode);
            });

            function changeLanguage(languageCode) {
                $.ajax({
                    url: "<?php echo e(route('home')); ?>/language-change/" + languageCode,
                    method: 'GET',
                    success: function (response) {
                        notify('success', response.message);
                        location.reload();
                    },
                    error: function (error) {
                        console.error('Error changing language', error);
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/partials/header.blade.php ENDPATH**/ ?>