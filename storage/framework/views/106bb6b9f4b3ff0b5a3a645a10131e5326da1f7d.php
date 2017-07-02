<?php /*extending the main template*/ ?>




<?php $__env->startSection('content'); ?>


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder" style="display:inline-block ;margin-top: 20px;">
                    <div class="row">
                    <img src="<?php echo e(asset("images\\profile-photos\\$user->profile_pic")); ?>" alt="<?php echo e($user->username); ?>" class="img-circle img-responsive img-raised">
                   </div>
                    <div class="row">


                            <h2 style="text-align: center"><?php echo e($user->getName()); ?></h2>
                        <h6 class="l-title"><?php echo e($user->title); ?></h6>
                        <h6 class="social-big2 ">
                            <?php if($user->facebook): ?>
                                <span><a href="http://www.facebook.com/<?php echo e($user->facebook); ?>" class="facebook"><i class="fa fa-facebook"></i></a></span>
                            <?php endif; ?>
                            <?php if($user->twitter): ?>
                                    <span><a href="http://www.twitter.com/<?php echo e($user->twitter); ?>" class="twitter"><i class="fa fa-twitter"></i></a></span>
                            <?php endif; ?>
                            <?php if($user->linkedin): ?>
                                    <span><a href="http://www.linkedin.com/<?php echo e($user->linkedin); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a></span>
                            <?php endif; ?>
                            <?php if($user->instagram): ?>
                                    <span><a href="http://www.instagram.com/<?php echo e($user->instagram); ?>" class="instagram"><i class="fa fa-instagram"></i></a></span>
                            <?php endif; ?>
                            <?php if($user->google_plus): ?>
                                    <span><a href="http://www.googleplus.com/<?php echo e($user->google_plus); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a></span>
                            <?php endif; ?>
                        </h6>


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

                    <h2 class="section-title">Profile</h2>

                    <p for=""><b>Username: </b> <?php echo e($user->username); ?></p>
                    <p for=""><b>Email: </b> <?php echo e($user->email); ?></p>
                    <p for=""><b>Phone: </b> <?php echo e($user->phone); ?></p>
                    <p for=""><b>Website: </b> <a href="<?php echo e($user->website); ?>"><?php echo e($user->website); ?></a></p>
                    <p for=""><b>Address: </b> <?php echo e($user->address); ?></p>

                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>