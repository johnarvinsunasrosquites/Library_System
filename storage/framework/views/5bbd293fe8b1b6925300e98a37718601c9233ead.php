<?php $request = app('Illuminate\Http\Request'); ?>


<?php $__env->startSection('content'); ?>
    <h3 class="page-title">Subscriptions</h3>

    <?php if(empty(env('PUB_STRIPE_API_KEY')) || empty(env('STRIPE_API_KEY'))): ?>
        <div class="alert alert-danger">
            <p>
                Please specify <strong>PUB_STRIPE_API_KEY</strong> and <strong>STRIPE_API_KEY</strong> in your <strong>.env</strong> file!
            </p>
        </div>
    <?php else: ?>
        <?php $__empty_1 = true; $__currentLoopData = $roles->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                <div class="panel <?php if($plan->id == $user_role): ?> panel-success <?php endif; ?>">
                                    <div class="panel-heading text-center">
                                        <h3 style="text-transform: uppercase;"><?php echo e($plan->title); ?> plan</h3>
                                        <?php if($plan->id == $user_role): ?>
                                            Your current plan
                                        <?php endif; ?>
                                    </div>
                                    <div class="panel-body text-center">
                                        <p style="font-size:24px"><strong>$<?php echo e($plan->price); ?> / month</strong></p>
                                    </div>
                                    <div class="panel-footer text-center">
                                        <?php if (! ($plan->id == $user_role)): ?>
                                            <?php echo e(Form::open(['route' => ['admin.subscriptions.update', $plan->id], 'method' => 'PUT', 'id' => 'role-' . $plan->id])); ?>

                                            <script
                                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                    data-key="<?php echo e(env('PUB_STRIPE_API_KEY')); ?>"
                                                    data-amount="<?php echo e($plan->price * 100); ?>"
                                                    data-currency="usd"
                                                    data-name="<?php echo e(env('APP_NAME')); ?>"
                                                    data-label="Subscribe now!"
                                                    data-description="Subscription"
                                                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                    data-locale="auto"
                                                    data-zip-code="false"
                                            >
                                            </script>
                                            <?php echo e(Form::close()); ?>

                                            <?php else: ?>
                                                <?php echo e(Form::open(['route' => ['admin.subscriptions.destroy', $plan->id], 'method' => 'DELETE', 'id' => 'role-' . $plan->id])); ?>

                                                <button class="btn btn-warning">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                    Unsubscribe
                                                </button>
                                                <?php echo e(Form::close()); ?>

                                                <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="alert alert-danger">
                <p>You haven't entered prices for plans, please enter them in <strong>Roles</strong></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel-fms\resources\views/admin/subscriptions/index.blade.php ENDPATH**/ ?>