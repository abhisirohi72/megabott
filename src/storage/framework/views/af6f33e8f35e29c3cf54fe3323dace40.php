<?php $__env->startSection('content'); ?>
<div class="main-content" data-simplebar>
    <h3 class="page-title mb-4"><?php echo e(__('Settings')); ?></h3>
    <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
        <?php echo csrf_field(); ?>
    </form>

    <div class="i-card-sm">
        <div class="row gy-5">
            <div class="col-xl-2 col-lg-3">
                <div class="nav-style-three nav-sidebar">
                    <ul class="nav nav-tabs d-flex flex-column justify-content-start gap-lg-4 gap-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-one" aria-selected="true" role="tab">
                                <i class="bi bi-shield-check"></i><?php echo e(__('Security')); ?>

                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-two" aria-selected="false" role="tab" tabindex="-1">
                                <i class="bi bi-info-circle"></i><?php echo e(__('General')); ?>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-10 col-lg-9 ps-lg-4">
                <div id="myTabContent3" class="tab-content">
                    <div class="tab-pane fade active show" id="tab-one" role="tabpanel">
                        <h5 class="subtitle"><?php echo e(__('Security Management')); ?></h5>

                        <div class="user-form">
                            <?php if(Auth::user()->two_factor_confirmed_at || session('two_factor_confirmed')): ?>
                                <form method="POST" action="<?php echo e(route('two-factor.disable')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <div class="switch-wrapper">
                                        <div class="text">
                                            <h6><?php echo e(__('Two Factor Authentication')); ?></h6>
                                            <p><?php echo e(__('Authenticating With Two Factor Authentication')); ?></p>
                                        </div>
                                        <div class="button">
                                            <button type="submit" class="i-btn btn--md btn--primary-outline capsuled"><?php echo app('translator')->get('Disable'); ?></button>
                                        </div>
                                    </div>
                                </form>
                            <?php elseif(Auth::user()->two_factor_secret): ?>
                                <form method="POST" action="<?php echo e(route('two-factor.confirm')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="switch-wrapper">
                                        <?php echo Auth::user()->twoFactorQrCodeSvg() ?>
                                        <input type="text" id="code" name="code" placeholder="<?php echo e(__('Enter code')); ?>" required>
                                        <button type="submit" class="i-btn btn--md btn--primary-outline capsuled"><?php echo app('translator')->get('Confirm'); ?></button>
                                    </div>
                                </form>
                                <?php session(['two_factor_confirmed' => true]) ?>
                            <?php else: ?>
                                <form method="POST" action="<?php echo e(route('two-factor.enable')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="switch-wrapper">
                                        <div class="text">
                                            <h6><?php echo e(__('Two Factor Authentication')); ?></h6>
                                            <p><?php echo e(__('Authenticating With Two Factor Authentication')); ?></p>
                                        </div>
                                        <div class="button">
                                            <button type="submit" class="i-btn btn--md btn--primary-outline capsuled"><?php echo app('translator')->get('Enable'); ?></button>
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>

                        <div class="user-form">
                            <h5 class="subtitle mt-4"><?php echo e(__("Ensure your account is using a long, random password to stay secure.")); ?></h5>
                            <form method="POST" action="<?php echo e(route('password.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-inner">
                                            <label for="current_password"><?php echo e(__('Current Password')); ?> <sup class="text-danger">*</sup></label>
                                            <input type="password" id="current_password" name="current_password" placeholder="<?php echo e(__('Enter Current Password')); ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-inner">
                                            <label for="password"><?php echo e(__('New Password')); ?> <sup class="text-danger">*</sup></label>
                                            <input type="password" id="password" name="password" placeholder="<?php echo e(__('Enter New Password')); ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-inner">
                                            <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?> <sup class="text-danger">*</sup></label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="<?php echo e(__('Enter Confirm Password')); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="i-btn btn--primary btn--lg"><?php echo e(__('Save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-two" role="tabpanel">
                        <h5 class="subtitle"><?php echo e(__('Profile Information')); ?></h5>
                        <form method="post" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>
                            <div class="user-settings mb-5">
                                <div class="row align-items-center g-4">
                                    <div class="col-lg-4">
                                        <div class="user">
                                            <div class="image">
                                                <div class="image-upload">
                                                    <input type="file" name="image">
                                                </div>
                                                <div class="upload-overlay">
                                                    <h6><?php echo e(__('Upload')); ?></h6>
                                                    <i class="bi bi-camera"></i>
                                                </div>
                                                <img src="<?php echo e(displayImage(Auth::user()->image)); ?>" alt="<?php echo e(__('Profile image')); ?>">
                                            </div>
                                            <div class="content">
                                                <h6><?php echo e(Auth::user()->name); ?></h6>
                                                <p><?php echo e(__('Email Address:')); ?> <?php echo e(Auth::user()->email); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 text-lg-end text-start">
                                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-1 g-3">
                                            <div class="col">
                                                <div class="bg--dark p-3 rounded-2 text-start">
                                                    <p class="fs-14 mb-1 "><?php echo e(__('Primary Balance')); ?></p>
                                                    <h6 class="mb-0"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(Auth::user()->wallet->primary_balance)); ?></h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="bg--dark p-3 rounded-2 text-start">
                                                    <p class="fs-14 mb-1 "><?php echo e(__('Investment Balance')); ?></p>
                                                    <h6 class="mb-0"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(Auth::user()->wallet->investment_balance)); ?></h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="bg--dark p-3 rounded-2 text-start">
                                                    <p class="fs-14 mb-1 "><?php echo e(__('Trade Balance')); ?></p>
                                                    <h6 class="mb-0"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(Auth::user()->wallet->trade_balance)); ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user-form">
                                <h5 class="subtitle"><?php echo e(__("Update your account's profile information and email address")); ?></h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label for="first_name"><?php echo e(__('First Name')); ?> <sup class="text-danger">*</sup></label>
                                            <input type="text" id="first_name" name="first_name" value="<?php echo e(Auth::user()->first_name); ?>" placeholder="<?php echo e(__('First Name')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label for="last_name"><?php echo e(__('Last Name')); ?> <sup class="text-danger">*</sup></label>
                                            <input type="text" id="last_name" name="last_name" value="<?php echo e(Auth::user()->last_name); ?>" placeholder="<?php echo e(__('Last Name')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label for="email"><?php echo e(__('Email')); ?> <sup class="text-danger">*</sup></label>
                                            <input type="email" id="email" name="email" value="<?php echo e(Auth::user()->email); ?>" placeholder="<?php echo e(__('Enter Email')); ?>">
                                        </div>

                                        <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                                            <div>
                                                <p class="small mt-2 text-muted">
                                                    <?php echo e(__('Your email address is unverified.')); ?>

                                                    <button form="send-verification"  class="text-decoration-none text-muted">
                                                        <?php echo e(__('Resend verification')); ?>

                                                    </button>
                                                </p>

                                                <?php if(session('status') === 'verification-link-sent'): ?>
                                                    <p class="mt-2 text-success">
                                                        <?php echo e(__('A new verification link has been sent to your email address.')); ?>

                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label for="phone"><?php echo e(__('Phone')); ?> <sup class="text-danger">*</sup></label>
                                            <input type="text" id="phone" name="phone" value="<?php echo e(Auth::user()->phone); ?>" placeholder="<?php echo e(__('Enter Phone')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-inner">
                                            <label for="address"><?php echo e(__('Address')); ?> </label>
                                            <input type="text" id="address" name="meta[address][address]" value="<?php echo e(getArrayValue(Auth::user()->meta, 'address.address')); ?>"  placeholder="<?php echo e(__('Enter address')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label for="country"><?php echo e(__('Country')); ?></label>
                                            <select id="country" name="meta[address][country]">
                                                <option value=""><?php echo e(__('Select')); ?></option>
                                                <?php $__currentLoopData = getCountryList(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e(getArrayValue($country, 'code')); ?>" <?php echo e(getArrayValue(Auth::user()->meta, 'address.country') == getArrayValue($country, 'code') ? 'selected' : ''); ?>><?php echo e(getArrayValue($country, 'name')); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label for="city"><?php echo e(__('City')); ?></label>
                                            <input type="text" id="city" name="meta[address][city]" value="<?php echo e(getArrayValue(Auth::user()->meta, 'address.city')); ?>"  placeholder="<?php echo e(__('Enter City')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label for="postcode"><?php echo e(__('Postcode')); ?></label>
                                            <input type="text" id="postcode" name="meta[address][postcode]" value="<?php echo e(getArrayValue(Auth::user()->meta, 'address.postcode')); ?>" placeholder="<?php echo e(__('Enter Postcode')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label for="state"><?php echo e(__('State')); ?></label>
                                            <input type="text" id="state" name="meta[address][state]" value="<?php echo e(getArrayValue(Auth::user()->meta, 'address.state')); ?>" placeholder="<?php echo e(__('Enter State')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="i-btn btn--primary btn--lg"><?php echo e(__('Update')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/user/setting.blade.php ENDPATH**/ ?>