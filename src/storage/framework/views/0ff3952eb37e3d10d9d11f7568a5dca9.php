<?php if($analytics->status == \App\Enums\Status::ACTIVE): ?>

    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(getArrayValue($analytics?->short_key, 'api_key')); ?>"></script>
    <script>
        "use strict";
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag("js", new Date());
        gtag("config", "<?php echo e(getArrayValue($analytics?->short_key, 'api_key')); ?>");
    </script>
<?php endif; ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/partials/google_analytics.blade.php ENDPATH**/ ?>