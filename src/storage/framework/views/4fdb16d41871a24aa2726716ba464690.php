<?php
    $pages = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::PAGE, \App\Enums\Frontend\Content::ENHANCEMENT);
    $contact = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::CONTACT, \App\Enums\Frontend\Content::FIXED);
    $fixedSocialContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::SOCIAL, \App\Enums\Frontend\Content::FIXED);
    $fixedContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::FOOTER, \App\Enums\Frontend\Content::FIXED);
    $enhancementContents = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::FOOTER, \App\Enums\Frontend\Content::ENHANCEMENT);
?>

<footer class="footer">
    <div class="container-fluid container-footer">
        <div class="footer-content">
            <div class="row g-0">
                <div class="col-lg-8 order-lg-1 order-2">
                    <div class="footer-left">
                        <div class="row g-4">
                            <div class="col-md-4 col-sm-6">
                                <div class="footer-nav">
                                    <h6><?php echo e(__('Important Link')); ?></h6>
                                    <ul>
                                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($menu->name == 'Home'): ?>
                                                <li><a href="<?php echo e(route('home')); ?>"><?php echo e($menu->name); ?></a></li>
                                            <?php elseif($menu->name == 'Trade'): ?>
                                                <li><a href="<?php echo e(route('trade')); ?>"><?php echo e($menu->name); ?></a></li>
                                            <?php elseif($menu->children->isEmpty()): ?>
                                                <li><a href="<?php echo e(route('dynamic.page', $menu->url)); ?>"><?php echo e($menu->name); ?></a></li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="footer-nav">
                                    <h6><?php echo e(__('Quick Link')); ?></h6>
                                    <ul>
                                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(route('policy', ['slug' => slug(getArrayValue($page->meta, 'name')), 'id' => $page->id])); ?>"><?php echo e(__(getArrayValue($page->meta, 'name'))); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('contact')); ?>"><?php echo e(__('Contact')); ?></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="footer-nav">
                                    <h6><?php echo e(__('Contact & social')); ?></h6>
                                    <div class="contact-info">
                                        <a href="mailto:<?php echo e(getArrayValue($contact?->meta, 'email')); ?>" class="contact-info-item">
                                            <i class="bi bi-envelope"></i> <?php echo e(getArrayValue($contact?->meta, 'email')); ?>

                                        </a>

                                        <a href="tel:<?php echo e(getArrayValue($contact?->meta, 'phone')); ?>" class="contact-info-item">
                                            <i class="bi bi-telephone"></i> <?php echo e(getArrayValue($contact?->meta, 'phone')); ?>

                                        </a>

                                        <span class="contact-info-item">
                                            <i class="bi bi-geo-alt"></i> <?php echo e(getArrayValue($contact?->meta, 'address')); ?>

                                        </span>

                                        <ul class="footer-social">
                                            <li><a href="<?php echo e(getArrayValue($fixedSocialContent?->meta, 'facebook_url')); ?>"><?php echo  getArrayValue($fixedSocialContent?->meta, 'facebook_icon') ?></a></li>
                                            <li><a href="<?php echo e(getArrayValue($fixedSocialContent?->meta, 'twitter_url')); ?>"><?php echo  getArrayValue($fixedSocialContent?->meta, 'twitter_icon') ?></a></li>
                                            <li><a href="<?php echo e(getArrayValue($fixedSocialContent?->meta, 'instagram_url')); ?>"><?php echo  getArrayValue($fixedSocialContent?->meta, 'instagram_icon') ?></a></li>
                                            <li><a href="<?php echo e(getArrayValue($fixedSocialContent?->meta, 'tiktok_url')); ?>"><?php echo  getArrayValue($fixedSocialContent?->meta, 'tiktok_icon') ?></a></li>
                                            <li><a href="<?php echo e(getArrayValue($fixedSocialContent?->meta, 'telegram_url')); ?>"><?php echo  getArrayValue($fixedSocialContent?->meta, 'telegram_icon') ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 order-lg-2 order-1">
                    <div class="footer-right">
                        <a href="<?php echo e(route('home')); ?>" class="logo-wrapper">
                            <img src="<?php echo e(displayImage(getArrayValue($setting?->logo, 'white'), "592x89")); ?>" alt="footer-logo">
                        </a>
                        <p><?php echo e(getArrayValue($fixedContent?->meta, 'news_letter_title')); ?></p>
                        <form class="subscribe-form newsletter-form">
                            <div class="input-wrapper">
                                <input type="email" id="email_subscribe" placeholder="<?php echo e(__('Your Email Address')); ?>" required>
                                <button type="submit" class="news-button i-btn btn--dark">
                                    <span class="d-md-block d-none">Submit</span>
                                    <span class="d-md-none"><i class="bi bi-send-fill"></i></span>
                                </button>
                            </div>
                        </form>

                        <div class="payment-logos mt-30">
                            <img src="<?php echo e(displayImage(getArrayValue($fixedContent?->meta, 'payment'), "583x83")); ?>" alt="<?php echo e(__('payment logo')); ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container-fluid container-wrapper">
            <div class="text-center fs-14 fw-light">
                <p><?php echo e(getArrayValue($fixedContent?->meta, 'copy_right_text')); ?></p>
            </div>
        </div>
    </div>
</footer>
<?php $__env->startPush('script-push'); ?>
    <script>
        'use strict';
        $(document).on('submit', '.subscribe-form', function(e) {
            e.preventDefault();
            const email = $("#email_subscribe").val();
            if (email) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    url: "<?php echo e(route('subscribe')); ?>",
                    method: "POST",
                    data: {
                        email: email
                    },
                    success: function(response) {
                        notify('success', response.success);
                        $("#email_subscribe").val('');
                    },
                    error: function(response) {
                        const errorMessage = response.responseJSON ? response.responseJSON.error : "An error occurred.";
                        notify('error', errorMessage);
                    }
                });
            } else {
                notify('error', "Please Input Your Email");
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/blue_theme/partials/footer.blade.php ENDPATH**/ ?>