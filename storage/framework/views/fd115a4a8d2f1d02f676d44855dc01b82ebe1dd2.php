<?php /*extending the main template*/ ?>




<?php $__env->startSection('content'); ?>


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder" style="display:inline-block ;margin-top: 20px;">
                    <div class="row">
                        <a href="<?php echo e(route('profile',['username'=>Auth::User()->username])); ?>"><img src="<?php echo e(asset('images/profile-photos/'.Auth::User()->profile_pic)); ?>" alt="<?php echo e(Auth::User()->username); ?>" class="img-circle img-responsive img-raised"></a>
                   </div>
                    <div class="row">


                            <h2 style="text-align: center"><?php echo e(Auth::User()->getName()); ?></h2>
                        <h6 class="l-title"><?php echo e(Auth::User()->title); ?></h6>



                    </div>


                </div>
            </div>
        </div>
    </div>
    <?php /*Normal contents*/ ?>
    <section>
        <div class="container">


            <div class="row">
                <div class="col-md-9 col-sm-8 col-md-push-3"> <!--=======  col-md-8 START =========-->

                    <h2 class="shortcodes-title">Edit Profile</h2>
                    <div class="general">
                        <form action="<?php echo e(route('update_profile')); ?>" method="post" role="form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo e($errors->has('first_name') ? ' error has-error ' : ''); ?> ">
                                        <label for="First_Name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="First_Name" value="<?php echo e(Auth::User()->first_name ?: Request::old('first_name')); ?>" placeholder="First Name">
                                        <?php if($errors->has('first_name')): ?>
                                            <span class="help-block">
                                                        <?php echo e($errors->first('first_name')); ?>

                                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo e($errors->has('last_name') ? ' error has-error ' : ''); ?> ">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo e(Auth::User()->last_name ?: Request::old('last_name')); ?>" placeholder="Last Name">
                                        <?php if($errors->has('last_name')): ?>
                                            <span class="help-block">
                                                        <?php echo e($errors->first('last_name')); ?>

                                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo e($errors->has('phone') ? ' error has-error ' : ''); ?> ">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo e(Auth::User()->phone ?: Request::old('phone')); ?>" placeholder="Phone No">
                                        <?php if($errors->has('phone')): ?>
                                            <span class="help-block">
                                                        <?php echo e($errors->first('phone')); ?>

                                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo e($errors->has('birthday') ? ' error has-error ' : ''); ?> ">
                                        <label for="birthday">Birthday</label>
                                        <input type="text" class="datepicker form-control" name="birthday" id="birthday" value="<?php echo e(Auth::User()->birthday ?: Request::old('birthday')); ?>" placeholder="Your Birthday">
                                        <?php if($errors->has('birthday')): ?>
                                            <span class="help-block">
                                                        <?php echo e($errors->first('birthday')); ?>

                                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group <?php echo e($errors->has('title') ? ' error has-error ' : ''); ?> ">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo e(Auth::User()->title ?: Request::old('title')); ?>" placeholder="E.g CEO at XYZ Group of Companies">
                                <?php if($errors->has('title')): ?>
                                    <span class="help-block">
                                                        <?php echo e($errors->first('title')); ?>

                                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group <?php echo e($errors->has('address') ? ' error has-error ' : ''); ?> ">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo e(Auth::User()->address ?: Request::old('address')); ?>" placeholder="Address">
                                <?php if($errors->has('address')): ?>
                                    <span class="help-block">
                                                        <?php echo e($errors->first('address')); ?>

                                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group <?php echo e($errors->has('website') ? ' error has-error ' : ''); ?> ">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" name="website" id="website" value="<?php echo e(Auth::User()->website ?: Request::old('website')); ?>" placeholder="Website Address E.g  http://www.leadmark.com.ng">
                                <?php if($errors->has('website')): ?>
                                    <span class="help-block">
                                                        <?php echo e($errors->first('website')); ?>

                                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group <?php echo e($errors->has('facebook') ? ' error has-error ' : ''); ?> ">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo e(Auth::User()->facebook ?: Request::old('facebook')); ?>" placeholder="Facebook Username">
                                        <?php if($errors->has('facebook')): ?>
                                            <span class="help-block">
                                                        <?php echo e($errors->first('facebook')); ?>

                                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php echo e($errors->has('twitter') ? ' error has-error ' : ''); ?> ">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo e(Auth::User()->twitter ?: Request::old('twitter')); ?>" placeholder="Twitter Username">
                                        <?php if($errors->has('twitter')): ?>
                                            <span class="help-block">
                                                        <?php echo e($errors->first('twitter')); ?>

                                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php echo e($errors->has('google') ? ' error has-error ' : ''); ?> ">
                                        <label for="google">Google+</label>
                                        <input type="text" class="form-control" name="google" id="google" value="<?php echo e(Auth::User()->google_plus ?: Request::old('google')); ?>" placeholder="Google+ Username">
                                        <?php if($errors->has('google')): ?>
                                            <span class="help-block">
                                                        <?php echo e($errors->first('google')); ?>

                                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php echo e($errors->has('linkedin') ? ' error has-error ' : ''); ?> ">
                                        <label for="linkedin">Linkedin</label>
                                        <input type="text" class="form-control" name="linkedin" id="linkedin" value="<?php echo e(Auth::User()->linkedin ?: Request::old('linkedin')); ?>" placeholder="Linkedin Username">
                                        <?php if($errors->has('linkedin')): ?>
                                            <span class="help-block">
                                                        <?php echo e($errors->first('linkedin')); ?>

                                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php echo e($errors->has('instagram') ? ' error has-error ' : ''); ?> ">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo e(Auth::User()->instagram ?: Request::old('instagram')); ?>" placeholder="Instagram Username">
                                        <?php if($errors->has('instagram')): ?>
                                            <span class="help-block">
                                                        <?php echo e($errors->first('instagram')); ?>

                                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group <?php echo e($errors->has('image') ? ' error has-error ' : ''); ?> ">
                                <img src="<?php echo e(asset('images/profile-photos/'.Auth::User()->profile_pic)); ?>" class="img-responsive img-thumbnail" alt="Update Profile Picture">
                                <label for="profile_pics" class="control-label">Profile Picture</label>

                                     <input type="file" name="image" class="form-control" id="profile_pics" placeholder="Choose Image">
                                <?php if($errors->has('image')): ?>
                                    <span class="help-block">
                                                        <?php echo e($errors->first('image')); ?>

                                                    </span>
                                <?php endif; ?>
                            </div>

                            <input name="_token" value="<?php echo e(Session::token()); ?>" type="hidden"/>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/bootstrap-datepicker.js')); ?>"></script>
    <script>
        if($('.datepicker').length != 0){
            $('.datepicker').datepicker({
                weekStart:1
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>