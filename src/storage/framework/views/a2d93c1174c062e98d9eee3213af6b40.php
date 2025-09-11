<?php $__env->startSection('panel'); ?>
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo e($setTitle); ?></h4>
                </div>

                <div class="card-body">
                    <form action="<?php echo e(route('admin.setting.send_mail_notification')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="text-center mb-2">
                            <div class="admin-commission"></div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="">Notification Subject<sup class="text-danger">*</sup></label>
                                <input type="text" name="notification_subject" id="notification_subject" class="form-control" required="">
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">Add Notification<sup class="text-danger">*</sup></label>
                                <input type="text" name="notification" id="notification" class="form-control" required="">
                            </div>
                        </div>
                        <button class="i-btn btn--primary btn--lg"><?php echo e(__('admin.button.save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-push'); ?>
    <script>
        "use strict";
        $(document).ready(function () {
            
        });
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/admin/setting/send_notification.blade.php ENDPATH**/ ?>