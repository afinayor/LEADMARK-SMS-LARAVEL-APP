<!DOCTYPE html>
<html>
<head>
    <title><?php echo e(isset($title) ? $title : "LeadMark"); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Leadmark">
    <meta name="keywords" content="leadmark">
    <meta name="author" content="Mayor">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/etlinefont.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/flexslider.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/owl.carousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/owl.theme.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/animate.css')); ?>">
    <?php /*<link rel="stylesheet" type="text/css" href="/css/material-kit.css">*/ ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">



    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>


    <!-- FAVICON -->
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon/favicon.ico')); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo e(asset('images/favicon/apple-touch-icon-144-precomposed.png')); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo e(asset('images/favicon/apple-touch-icon-114-precomposed.png')); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo e(asset('images/favicon/apple-touch-icon-72-precomposed.png')); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo e(asset('images/favicon/apple-touch-icon-57-precomposed.png')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('sweetalert\dist\sweetalert2.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('head'); ?>
</head>
<body>
    <?php echo $__env->make('partials.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>
<!-- PRELOADER -->
<div class="site-loader">
    <span></span>
    <p>Loading</p>
</div>
<!-- PRELOADER END -->

<?php /*including the footer*/ ?>
    <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php /*including the modals*/ ?>
    <?php echo $__env->make('partials.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php /*including default scripts*/ ?>
    <?php echo $__env->make('partials.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('partials.flashdata', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php /*For extra scripts*/ ?>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>