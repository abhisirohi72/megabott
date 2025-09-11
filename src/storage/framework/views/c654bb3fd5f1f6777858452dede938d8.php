<?php if(is_array($setting?->seo_setting)): ?>
    <meta name="title" Content="<?php echo e(getArrayValue($setting->appearance, 'site_title').' - '. @$setTitle); ?>">
    <meta name="description" content="<?php echo e(getArrayValue($setting->seo_setting,'description')); ?>">
    <meta name="keywords" content="<?php echo e(implode(',',\Illuminate\Support\Arr::get($setting->seo_setting,'keywords'))); ?>">
    <link rel="shortcut icon" href="<?php echo e(displayImage(getArrayValue($setting->seo_setting, 'image'))); ?>" type="image/x-icon">

    <link rel="apple-touch-icon" href="<?php echo e(displayImage(getArrayValue($setting->logo, 'white'), "592x89")); ?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php echo e(getArrayValue($setting->appearance, 'site_title').' - '. @$setTitle); ?>">

    <meta itemprop="name" content="<?php echo e(getArrayValue($setting->appearance, 'site_title').' - '. @$setTitle); ?>">
    <meta itemprop="description" content="<?php echo e(getArrayValue($setting->seo_setting,'description')); ?>">
    <meta itemprop="image" content="<?php echo e(displayImage(getArrayValue($setting->seo_setting, 'image'))); ?>">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e(getArrayValue($setting->seo_setting,'title')); ?>">
    <meta property="og:description" content="<?php echo e(getArrayValue($setting->seo_setting,'description')); ?>">
    <meta property="og:image" content="<?php echo e(displayImage(getArrayValue($setting->seo_setting, 'image'))); ?>"/>
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
<?php endif; ?>
<?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/partials/seo.blade.php ENDPATH**/ ?>