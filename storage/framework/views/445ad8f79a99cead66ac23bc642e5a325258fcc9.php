<?php /*extending the main template*/ ?>




<?php $__env->startSection('content'); ?>

    <!-- PASSWORD RESET -->
    <div class="login-page login-area-bg">
        <section class="login-bg">

            <h1 class="login-area-logo">Zenda <i class="icon-pencil"></i></h1>

            <div class="login-section login-area section">
                <div class="container">
                    <div class="form-box-inner">


                        <div class="row">


                            <div class="form-box col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2 xs-offset-0">
                                <div class="form-box-inner">
                                    <h2 class="title text-center">Change Password</h2>
                                    <p class="text-center" style="margin-top: -25px; margin-bottom: 25px;">Please enter your current password, then your new password.</p>

                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-container">
                                                <form action="<?php echo e(route('change_password')); ?>" method="post">
                                                    <div class="form-group password <?php echo e($errors->has('current_password') ? ' error has-error ' : ''); ?>">
                                                        <label class="sr-only" for="c_password">Your Current Password</label>
                                                        <input id="c_password" name="current_password" value="<?php echo e(Request::old('current_password') ?: ''); ?>" type="password" class="form-control" placeholder="Current Password">
                                                        <?php if($errors->has('current_password')): ?>
                                                            <span class="help-block">
                                                        <?php echo e($errors->first('current_password')); ?>

                                                    </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="form-group password <?php echo e($errors->has('new_password') ? ' error has-error ' : ''); ?>">
                                                        <label class="sr-only" for="new_password">New Password</label>
                                                        <input id="new_password" name="new_password" value="<?php echo e(Request::old('new_password') ?: ''); ?>" type="password" class="form-control" placeholder="New Password">
                                                        <?php if($errors->has('new_password')): ?>
                                                            <span class="help-block">
                                                        <?php echo e($errors->first('new_password')); ?>

                                                    </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="form-group password <?php echo e($errors->has('new_password_confirmation') ? ' error has-error ' : ''); ?>">
                                                        <label class="sr-only" for="confirm_password">Confirm Password</label>
                                                        <input id="confirm_password" name="new_password_confirmation" type="password" class="form-control" placeholder="Confirm New Password">
                                                        <?php if($errors->has('new_password_confirmation')): ?>
                                                            <span class="help-block">
                                                        <?php echo e($errors->first('new_password_confirmation')); ?>

                                                    </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <input name="_token" value="<?php echo e(Session::token()); ?>" type="hidden"/>
                                                    <button type="submit" class="btn btn-block login-area-btn">Change Password</button>
                                                </form>
                                                <p class="lead text-center">Take Me Back to the <a href="login.html">Login</a> Page</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- PASSWORD RESET END -->




<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>