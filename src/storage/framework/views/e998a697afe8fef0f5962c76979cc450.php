<?php
    $fixedCryptoCoinContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::CRYPTO_COIN, \App\Enums\Frontend\Content::FIXED);
?>


<?php $__env->startSection('content'); ?>
<main>
    <div class="form-section white img-adjust">
        <div class="linear-center"></div>
        <div class="container-fluid px-0">
            <div class="row justify-content-center align-items-center gy-5">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 col-sm-10 position-relative">
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

                    <div class="form-wrapper">
                        <p><?php echo e(__('Forgot your password? Enter your email, and we’ll send a link to reset it.')); ?></p>
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
                        <form method="POST" action="<?php echo e(route('password.email')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="email"><?php echo e(__('Email')); ?></label>
                                        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('Enter Email')); ?>" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="i-btn btn--lg btn--primary w-100" type="submit"><?php echo e(__('Email Password Reset Link')); ?></button>
                                </div>
                            </div>

                            <div class="have-account">
                                <p class="mb-0"><?php echo e(__('Remembered your password?')); ?> <a href="<?php echo e(route('login')); ?>"><?php echo e(__('Sign In')); ?></a> <?php echo e(__('here')); ?>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/auth/forgot-password.blade.php ENDPATH**/ ?>