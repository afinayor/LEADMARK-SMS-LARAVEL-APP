<?php /*extending the main template*/ ?>




<?php $__env->startSection('content'); ?>

    <!-- SIGNUP FORM -->
    <div class="signup-page login-area-bg">
        <section class="signup-page">

            <h1 class="login-area-logo">Zenda <i class="icon-pencil"></i></h1>

            <div class="signup-section login-area section">
                <div class="container">
                    <div class="row">
                        <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                            <div class="form-box-inner">

                                <h2 class="title text-center">Sign up now</h2>
                                <p class="intro text-center">It Just Take Only 2 Minutes!</p>


                                <div class="row">


                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <form class="signup-form" method="post" action="<?php echo e(route('signup')); ?>">
                                            <div class="form-group singup-email-id <?php echo e($errors->has('email') ? ' error has-error ' : ''); ?>">
                                                <label class="sr-only" for="signup-email">Your email</label>
                                                <input name="email" id="signup-email" value="<?php echo e(Request::old('email') ?: ''); ?>" type="email" class="form-control login-email" placeholder="Your email">
                                                <?php if($errors->has('email')): ?>
                                                    <span class="help-block">
                                                        <?php echo e($errors->first('email')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group email <?php echo e($errors->has('username') ? ' error has-error ' : ''); ?>">
                                                <label class="sr-only" for="signup-email">Username</label>
                                                <input name="username" id="signup-email" value="<?php echo e(Request::old('username') ?: ''); ?>" type="text" class="form-control login-email" placeholder="Username">
                                                <?php if($errors->has('username')): ?>
                                                    <span class="help-block">
                                                        <?php echo e($errors->first('username')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group phone <?php echo e($errors->has('phone') ? ' error has-error ' : ''); ?>">
                                                <label class="sr-only" for="signup-phone">Phone</label>
                                                <input name="phone" id="signup-phone" value="<?php echo e(Request::old('phone') ?: ''); ?>" type="text" class="form-control login-email" placeholder="Phone No">
                                                <?php if($errors->has('phone')): ?>
                                                    <span class="help-block">
                                                        <?php echo e($errors->first('phone')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group password <?php echo e($errors->has('password') ? ' error has-error ' : ''); ?>">
                                                <label class="sr-only" for="signup-password">Your password</label>
                                                <input name="password" id="signup-password" value="<?php echo e(Request::old('password') ?: ''); ?>" type="password" class="form-control login-password" placeholder="Password">
                                                <?php if($errors->has('password')): ?>
                                                    <span class="help-block">
                                                        <?php echo e($errors->first('password')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group password <?php echo e($errors->has('password_confirmation') ? ' error has-error ' : ''); ?>">
                                                <label class="sr-only" for="signup-conf-password">Confirm password</label>
                                                <input name="password_confirmation" value="<?php echo e(Request::old('password_confirmation') ?: ''); ?>" id="signup-conf-password" type="password" class="form-control login-password" placeholder="Confirm Password">
                                                <?php if($errors->has('password_confirmation')): ?>
                                                    <span class="help-block">
                                                        <?php echo e($errors->first('password_confirmation')); ?>

                                                    </span>
                                                <?php endif; ?>


                                            </div>
                                            <button type="submit" class="btn btn-block login-area-btn">Sign up</button>
                                            <p class="note">By signing up, You agree to our <a href="" data-toggle="modal" data-target="#myModal1">Terms & Conditions</a> and <a href="" data-toggle="modal" data-target="#myModal2">Privacy Policy</a>.</p>
                                            <p class="lead">Already have an account? <a class="login-link" id="login-link" href="<?php echo e(route('signin')); ?>">Log in</a></p>
                                            <input name="_token" value="<?php echo e(Session::token()); ?>" type="hidden"/>
                                        </form>
                                    </div>


                                    <div class="social-btns col-md-5 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-sm-offset-0">
                                        <div class="divider"><span>Or</span></div>
                                        <ul class="list-unstyled social-login">
                                            <li><button class="facebook-btn btn" type="button"><i class="fa fa-facebook"></i>Log in with Facebook</button></li>
                                            <li><button class="twitter-btn btn" type="button"><i class="fa fa-twitter"></i>Log in with Twitter</button></li>
                                            <li><button class="google-btn btn" type="button"><i class="fa fa-google-plus"></i>Log in with Google+</button></li>
                                            <li><button class="linkedin-btn btn" type="button"><i class="fa fa-linkedin"></i>Log in with Linkedin</button></li>
                                            <li><button class="pinterest-btn btn" type="button"><i class="fa fa-pinterest"></i>Log in with Pinterest</button></li>
                                        </ul>
                                        <p class="note">You can Trust us, We Will Never Share Your Information with others & Never Mess up with Your Account.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- SIGNUP FORM END -->




<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>