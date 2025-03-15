<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo app('translator')->get('quickadmin.qa_dashboard'); ?></div>

                <div class="panel-body">
                    <?php echo app('translator')->get('quickadmin.qa_dashboard_text'); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel-fms\resources\views/home.blade.php ENDPATH**/ ?>