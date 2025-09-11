<header class="d-header">
    <div class="container-fluid px-0">
        <div class="row align-items-cener">
            <div class="col-lg-5 col-6 d-flex align-items-center">
                <div class="d-header-left">
                    <div class="sidebar-button" id="dash-sidebar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-6">
                <div class="d-header-right">

                    <div class="i-dropdown user-dropdown dropdown">
                        <div class="user-dropdown-meta dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <div class="user-img">
                                <img src="<?php echo e(displayImage(Auth::user()->image, '400x400')); ?>" alt="<?php echo e(__('Profile image')); ?>">
                            </div>
                            <div class="user-dropdown-info">
                                <p><?php echo e(Auth::user()->name); ?></p>
                            </div>
                        </div>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span><?php echo e(__('Welcome')); ?> <?php echo e(Auth::user()->name); ?>!</span>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo e(route('user.wallet.index')); ?>">
                                    <?php echo e(__('Wallet Top-Up')); ?>

                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Log Out')); ?>

                                </a>

                                <form id="logout-form" method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/user/partials/top-bar.blade.php ENDPATH**/ ?>