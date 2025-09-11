<?php $__env->startSection('panel'); ?>
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo e($setTitle); ?></h4>
                </div>

                <div class="card-body">
                    <form action="<?php echo e(route('admin.setting.update_whatsapp')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row g-3 mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="">Token <sup class="text-danger">*</sup></label>
                                <input type="text" name="whatsapp_token" id="whatsapp_token" class="form-control" required="" value="<?php echo e($details->whatsapp_token ?? ''); ?>">
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">API URL<sup class="text-danger">*</sup></label>
                                <input type="text" name="whatsapp_api_url" id="whatsapp_api_url" class="form-control" required="" value="<?php echo e($details->whatsapp_api_url  ?? ''); ?>">
                            </div>
                        </div>
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo e($details->id ?? ''); ?>">
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



<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/admin/setting/whatsapp.blade.php ENDPATH**/ ?>