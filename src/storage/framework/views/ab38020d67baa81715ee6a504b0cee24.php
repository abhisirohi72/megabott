<?php $__env->startSection('content'); ?>
    <?php echo $__env->make(getActiveTheme().'.partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="contact-section pt-120">
        <div class="container">
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-6">
                    <div class="address-wrapper" style="background: linear-gradient(90deg,rgba(0,0,0,.9),rgba(0,0,0,0.8)) ,url('assets/images/bg/contact-image.jpg');">
                        <div class="address-item">
                            <div class="icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="content">
                                <h5><?php echo e(__('Email')); ?></h5>
                                <a href="mailto:<?php echo e(__(getArrayValue($fixedContent?->meta, 'email'))); ?>"><?php echo e(__(getArrayValue($fixedContent?->meta, 'email'))); ?></a>
                            </div>
                        </div>
                        <div class="address-item">
                            <div class="icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="content">
                                <h5><?php echo e(__('Phone')); ?></h5>
                                <a href="tel:<?php echo e(getArrayValue($fixedContent?->meta, 'phone')); ?>"><?php echo e(getArrayValue($fixedContent?->meta, 'phone')); ?></a>
                            </div>
                        </div>
                        <div class="address-item">
                            <div class="icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="content">
                                <h5><?php echo e(__('Location')); ?></h5>
                                <p><?php echo e(__(getArrayValue($fixedContent?->meta, 'address'))); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-wrapper contact-form">
                        <div class="subtitle mb-4">
                            <h3><?php echo e(__(getArrayValue($fixedContent?->meta, 'heading'))); ?></h3>
                        </div>
                        <form method="POST" action="<?php echo e(route('contact.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="email"><?php echo e(__('Email')); ?></label>
                                        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('Enter email')); ?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="subject"><?php echo e(__('Subject')); ?></label>
                                        <input type="text" id="subject" name="subject" value="<?php echo e(old('subject')); ?>" placeholder="<?php echo e(__('Enter subject')); ?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="message"><?php echo e(__('Message')); ?></label>
                                        <textarea rows="5" id="message" name="message" placeholder="<?php echo e(__('Write Your Message')); ?>" required> <?php echo e(old('message')); ?> </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="i-btn btn--lg btn--primary w-100" type="submit"><?php echo e(__('Submit')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getActiveTheme().'.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/contact.blade.php ENDPATH**/ ?>