<!-- HEADER -->
<header id="topnav" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div id="logo">
                <a class="navbar-brand" href="#home"><h2>Zenda <i class="icon-pencil"></i></h2></a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="nav navbar-nav" id="nav">
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
                <?php if(Auth::check()): ?>
                        <li class="login-bg-color dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Acccount <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(route('profile',['username'=>Auth::user()->username])); ?>">My Profile</a></li>
                                <li><a href="<?php echo e(route('update_profile')); ?>">Update Profile</a></li>
                                <li><a href="<?php echo e(route('change_password')); ?>">Change Password</a></li>
                                <li><a href="<?php echo e(route('signout')); ?>">Sign Out</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="<?php echo e(route('signup')); ?>">Sign Up</a></li>
                        <li class="login-bg-color"><a href="<?php echo e(route('signin')); ?>">Sign In</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>
<!-- HEADER END -->
