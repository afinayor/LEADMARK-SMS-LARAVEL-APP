<?php /*extending the main template*/ ?>




<?php $__env->startSection('content'); ?>


    <!-- LOGIN FORM -->
    <div class="login-page login-area-bg">
        <section class="login-bg">

            <h1 class="login-area-logo">Zenda <i class="icon-pencil"></i></h1>

            <div class="login-section login-area section">
                <div class="container">
                    <div class="row">
                        <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                            <div class="form-box-inner">

                                <h2 class="title text-center">Log in to Zenda</h2>


                                <div class="row">


                                    <div class="form-container col-md-5 col-sm-12 col-xs-12">
                                        <form class="login-form" method="post" action="<?php echo e(route('signin')); ?>">
                                            <div class="form-group email <?php echo e($errors->has('username') ? ' error has-error ' : ''); ?>">
                                                <label class="sr-only" for="login-email">Username</label>
                                                <input name="username" value="<?php echo e(Request::old('username') ?: ''); ?>" id="login-email" type="text" class="form-control login-email" placeholder="Username">
                                                <?php if($errors->has('username')): ?>
                                                    <span class="help-block">
                                                        <?php echo e($errors->first('username')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group password <?php echo e($errors->has('password') ? ' error has-error ' : ''); ?>">
                                                <label class="sr-only" for="login-password">Password</label>
                                                <input name="password" id="login-password" type="password" class="form-control login-password" placeholder="Password">
                                                <?php if($errors->has('password')): ?>
                                                    <span class="help-block">
                                                        <?php echo e($errors->first('password')); ?>

                                                    </span>
                                                <?php endif; ?>
                                                <p class="forgot-password"><a href="reset-password.html">Forgot password?</a></p>
                                            </div>
                                            <input name="_token" value="<?php echo e(Session::token()); ?>" type="hidden"/>
                                            <button type="submit" class="btn btn-block login-area-btn">Log in</button>
                                            <div class="checkbox remember">
                                                <label>
                                                    <input name="remember" type="checkbox"> Remember me </label>
                                            </div>
                                            <p class="lead">Don't have an account?  <a class="signup-link" href="<?php echo e(route('signup')); ?>">Create at here</a></p>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- LOGIN FORM END -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>