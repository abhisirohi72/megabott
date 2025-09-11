<?php
    $fixedCryptoCoinContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::CRYPTO_COIN, \App\Enums\Frontend\Content::FIXED);
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::SIGN_IN, \App\Enums\Frontend\Content::FIXED);
?>

<?php $__env->startSection('content'); ?>
    <main>
        <div class="form-section white img-adjust">
            
            <div class="linear-center"></div>
            <div class="form-bg2">
                
                <img src="<?php echo e(displayImage(getArrayValue($fixedContent?->meta, 'background_image'), "1920x1080")); ?>" alt="<?php echo e(__('Background image')); ?>">
            </div>
            <div class="container-fluid px-0">
                <div class="row justify-content-center align-items-center gy-5">
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 position-relative">
                        <div class="eth-icon">
                            <img src="<?php echo e(displayImage(getArrayValue($fixedCryptoCoinContent?->meta, 'first_crypto_coin'), "450X450")); ?>" alt="image">
                        </div>
                        <div class="bnb-icon">
                            <img src="<?php echo e(displayImage(getArrayValue($fixedCryptoCoinContent?->meta, 'second_crypto_coin'), "450X450")); ?>" alt="image">
                        </div>
                        <div class="ada-icon">
                            <img src="<?php echo e(displayImage(getArrayValue($fixedCryptoCoinContent?->meta, 'third_crypto_coin'), "450X450")); ?>" alt="image">
                        </div>
                        <div class="sol-icon">
                            <img src="<?php echo e(displayImage(getArrayValue($fixedCryptoCoinContent?->meta, 'fourth_crypto_coin'), "450X450")); ?>" alt="image">
                        </div>
                        <div class="form-wrapper2">
                            <h4 class="form-title"><?php echo e(getArrayValue($fixedContent?->meta, 'heading')); ?></h4>
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
                            <form method="POST" action="<?php echo e(route('login')); ?>">
                                <?php echo csrf_field(); ?>

                                <?php if(getArrayValue($setting?->recaptcha_setting, 'login') == \App\Enums\Status::ACTIVE->value): ?>
                                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                <?php endif; ?>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-inner">
                                            <label for="email"><?php echo e(__('Email')); ?></label>
                                            <input type="email" name="email" id="email" value="<?php echo e(env('APP_MODE') == 'demo' ? env('APP_DEMO_USER') : old('email')); ?>" placeholder="<?php echo e(__('Enter Email')); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-inner">
                                            <label for="password"><?php echo e(__('Password')); ?></label>
                                            <input type="password" id="password" name="password" value="<?php echo e(env('APP_MODE') == 'demo' ? env('APP_DEMO_USER_PASS') : ''); ?>" autocomplete="current-password" placeholder="<?php echo e(__('Enter Password')); ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <div class="form-inner mb-sm-0 mb-3">
                                                <div class="form-group">
                                                    <input type="checkbox" id="remember_me" name="remember">
                                                    <label for="remember_me"><?php echo e(__('Remember me')); ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 text-sm-end text-start d-flex justify-content-sm-end justify-content-start">
                                            <?php if(Route::has('password.request')): ?>
                                                <div class="forgot-pass">
                                                    <a href="<?php echo e(route('password.request')); ?>"><?php echo e(__('Forgot your password?')); ?></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="i-btn btn--lg btn--primary w-100" type="submit"><?php echo e(__('Sign In')); ?></button>
                                    </div>
                                </div>
                                <?php echo $__env->make('partials.social-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if(getArrayValue($setting?->system_configuration, 'registration_status.value') == \App\Enums\Status::ACTIVE->value): ?>
                                    <div class="have-account">
                                        <p class="mb-0"><?php echo e(__("Don't have an account?")); ?> <a href="<?php echo e(route('register')); ?>"><?php echo e(__('Sign Up')); ?></a></p>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-left">
                            <a  href="<?php echo e(route('home')); ?>" class="logo" data-cursor="Home">
                                <img src="<?php echo e(displayImage(getArrayValue($setting?->logo, 'white'), "592x89")); ?>" alt="<?php echo e(__('Logo')); ?>">
                            </a>
                            <h1><?php echo e(getArrayValue($fixedContent?->meta, 'title')); ?></h1>
                            <p><?php echo e(getArrayValue($fixedContent?->meta, 'details')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>


<?php if(getArrayValue($setting?->recaptcha_setting, 'login') == \App\Enums\Status::ACTIVE->value): ?>
    <?php $__env->startPush('script-file'); ?>
        <?php echo RecaptchaV3::initJs() ?>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('script-push'); ?>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('<?php echo e(getArrayValue($setting?->recaptcha_setting,'key')); ?>', {action: 'submit'}).then(function(token) {
                    document.getElementById('g-recaptcha-response').value = token;
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>



<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/auth/login.blade.php ENDPATH**/ ?>