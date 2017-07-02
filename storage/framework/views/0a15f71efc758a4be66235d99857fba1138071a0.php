<?php /*extending the main template*/ ?>




<?php $__env->startSection('content'); ?>


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder">
                    <div class="title-text">

                        <h2>HOME</h2>

                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>

                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php /*Normal contents*/ ?>
    <section>
        <div class="container">


           <h1>Home Page</h1>
        </div>
    </section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>