<?php $__env->startSection('panel'); ?>
    <section>
        <div class="container-fluid p-0">
            <div class="row gy-4">
                <div class="col-lg-auto">
                    <div class="card sticky-item">
                        <div class="card-body">
                            <div class="nav nav-style-two flex-column nav-pills gap-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <?php $__currentLoopData = $plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" id="v-pills-<?php echo e(strtolower(str_replace(' ', '-', $plugin['name']))); ?>-tab" data-bs-toggle="pill" href="#v-pills-<?php echo e(strtolower(str_replace(' ', '-', $plugin['name']))); ?>" role="tab" aria-controls="v-pills-<?php echo e(strtolower(str_replace(' ', '-', $plugin['name']))); ?>" aria-selected="<?php echo e($loop->first ? 'true' : 'false'); ?>" tabindex="<?php echo e($loop->index); ?>">
                                        <?php echo e(__($plugin['name'])); ?>

                                        <span><i class="las la-angle-right"></i></span>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="tab-content vertical-tab-content" id="v-pills-tabContent">
                        <?php $__currentLoopData = $plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade <?php echo e($loop->first ? 'active show' : ''); ?>" id="v-pills-<?php echo e(strtolower(str_replace(' ', '-', $plugin['name']))); ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo e(strtolower(str_replace(' ', '-', $plugin['name']))); ?>-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title"><?php echo e(__($plugin['name'])); ?></h4>
                                    </div>

                                    <div class="card-body">
                                        <form id="setting-form" action="<?php echo e(route('admin.plugin.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" value="<?php echo e($plugin->code); ?>" name="code">
                                            <div class="row g-3">
                                                <div class="mb-3 col-lg-12">
                                                    <label for="api_key" class="form-label"><?php echo app('translator')->get('Api Key'); ?></label>
                                                    <input type="text" name="api_key" value="<?php echo e(getArrayValue($plugin['short_key'], 'api_key')); ?>" class="form-control" id="api_key" placeholder="<?php echo app('translator')->get('Enter Api Key'); ?>">
                                                </div>

                                                <div class="mb-3 col-lg-12">
                                                    <label for="status" class="form-label"><?php echo app('translator')->get('Status'); ?></label>
                                                    <select class="form-select" name="status" id="status" required>
                                                        <?php $__currentLoopData = \App\Enums\Status::toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($status); ?>" <?php if($status == (int)$plugin['status']): ?> selected <?php endif; ?>><?php echo e(replaceInputTitle($key)); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <button class="i-btn btn--primary btn--lg"><?php echo app('translator')->get('Submit'); ?></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/admin/plugin/index.blade.php ENDPATH**/ ?>