<?php /*extending the main template*/ ?>

<?php $__env->startSection('head'); ?>

    <meta name="_token" content="<?php echo e(csrf_token()); ?>"/>
    <style>
        .loading {
            background: lightgoldenrodyellow url('<?php echo e(asset('images/processing.gif')); ?>') no-repeat center 65%;
            height: 80px;
            width: 100px;
            position: fixed;
            border-radius: 4px;
            left: 50%;
            top: 50%;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }
    </style>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder">
                    <div class="title-text">

                        <h2>ADD NEW LIST</h2>

                        <ol class="breadcrumb">
                            <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li><a href="<?php echo e(route('home')); ?>">Email</a></li>
                            <li><a href="<?php echo e(route('emailLists')); ?>">Lists</a></li>
                            <li class="active">Add List</li>
                        </ol>

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

                    <h2 class="shortcodes-title"><?php echo e((isset($data))?'EDIT LIST':'ADD NEW LIST'); ?> <div class="pull-right">
                            <a href="<?php echo e(route('emailLists')); ?>" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus-sign"></i>LISTS</a>
                        </div></h2>

<div class="general">
    <form action="<?php echo e((!isset($data))?route('postNewList'):route('postEditList')); ?>" method="post" role="form">
    <h3>General Data</h3>
	<div class="form-group <?php echo e($errors->has('name') ? ' error has-error ' : ''); ?>">
		<label for="name">Name *</label>
		<input type="text" class="form-control" name="name" id="name" value="<?php echo e((isset($data->name))? $data->name: Request::old('name')); ?>" placeholder="Name of list">
        <?php if($errors->has('name')): ?>
            <span class="help-block">
                <?php echo e($errors->first('name')); ?>

            </span>
        <?php endif; ?>
    </div>
        <div class="form-group <?php echo e($errors->has('display_name') ? ' error has-error ' : ''); ?>">
            <label for="display_name">Display Name</label>
        <input type="text" class="form-control" name="display_name" id="display_name" value="<?php echo e((isset($data->display_name))? $data->display_name : Request::old('display_name')); ?>" placeholder="Display Name Of List">
            <?php if($errors->has('display_name')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('display_name')); ?>

                </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo e($errors->has('description') ? ' error has-error ' : ''); ?>">
            <label for="description">Description *</label>
            <textarea class="form-control" name="description" id="description"  placeholder="Description"><?php echo e((isset($data->description))? $data->description: Request::old('description')); ?></textarea>
            <?php if($errors->has('description')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('description')); ?>

                </span>
            <?php endif; ?>
        </div>
        <h3>Mail Details</h3>
        <div class="form-group <?php echo e($errors->has('from_name') ? ' error has-error ' : ''); ?>">
            <label for="from_name">From Name *</label>
            <input type="text" class="form-control" name="from_name" id="from_name" value="<?php echo e((isset($data->from_name))? $data->from_name: Request::old('from_name')); ?>" placeholder="Display Name For Sender">
            <?php if($errors->has('from_name')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('from_name')); ?>

                </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo e($errors->has('from_email') ? ' error has-error ' : ''); ?>">
            <label for="from_email">From Email *</label>
            <input type="email" class="form-control" name="from_email" id="from_email" value="<?php echo e((isset($data->from_email))? $data->from_email: Request::old('from_email')); ?>" placeholder="Email Of Sender">
            <?php if($errors->has('from_email')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('from_email')); ?>

                </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo e($errors->has('reply_to') ? ' error has-error ' : ''); ?>">
            <label for="reply_to">Reply To Email *</label>
            <input type="email" class="form-control" name="reply_to" id="reply_to" value="<?php echo e((isset($data->reply_email))? $data->reply_email: Request::old('reply_to')); ?>" placeholder="Email To Reply To">
            <?php if($errors->has('reply_to')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('reply_to')); ?>

                </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo e($errors->has('subject') ? ' error has-error ' : ''); ?>">
            <label for="subject">Subject *</label>
            <input type="text" class="form-control" name="subject" id="subject" value="<?php echo e((isset($data->subject))? $data->subject: Request::old('subject')); ?>" placeholder="Subject Of Mail">
            <?php if($errors->has('subject')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('subject')); ?>

                </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo e($errors->has('subscription_default') ? ' error has-error ' : ''); ?>">
            <label for="subscription_default">Subcription Default</label>
            <select name="subscription_default" id="subscription_default" class="form-control">
                <?php
                $value1 = (isset($data->suscribe_default))? $data->suscribe_default: Request::old('subscription_default');
                ?>
                <option <?php echo e(($value1 == 'suscribed')?'selected':''); ?> value="suscribed">Suscribed</option>
                <option <?php echo e(($value1 == 'unsuscribed')?'selected':''); ?> value="unsuscribed">Unsuscribed</option>
            </select>
            <?php if($errors->has('subscription_default')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('subscription_default')); ?>

                </span>
            <?php endif; ?>
        </div>
        <h3>Notifications</h3>
        <div class="form-group <?php echo e($errors->has('suscribe') ? ' error has-error ' : ''); ?> col-sm-6">
            <label for="suscribe">Notify When Suscribed</label>
            <select name="suscribe" id="suscribe" class="form-control">
                <?php
                $value2 = (isset($data->suscribe))? $data->suscribe: Request::old('suscribe');
                ?>
                <option <?php echo e(($value2 == 'no')?'selected':''); ?> value="no">No</option>
                <option <?php echo e(($value2 == 'yes')?'selected':''); ?> value="yes">Yes</option>
            </select>
            <?php if($errors->has('suscribe')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('suscribe')); ?>

                </span>
            <?php endif; ?>
        </div>

        <div class="form-group <?php echo e($errors->has('suscribe_email') ? ' error has-error ' : ''); ?> col-sm-6">
            <label for="suscribe_email">Suscribe Email</label>
            <input type="email" class="form-control" name="suscribe_email" id="suscribe_email" value="<?php echo e((isset($data->suscribe_email))? $data->suscribe_email: Request::old('suscribe_email')); ?>" placeholder="Email To Notify When List Is Suscribed">
            <?php if($errors->has('suscribe_email')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('suscribe_email')); ?>

                </span>
            <?php endif; ?>
        </div>





        <div class="form-group <?php echo e($errors->has('unsuscribe') ? ' error has-error ' : ''); ?> col-sm-6">
            <label for="unsuscribe">Notify When Unsuscribed</label>
            <select name="unsuscribe" id="unsuscribe" class="form-control">
                <?php
                $value3 = (isset($data->unsuscribe))? $data->unsuscribe: Request::old('unsuscribe');
                ?>
                <option <?php echo e(($value3 == 'no')?'selected':''); ?> value="no">No</option>
                <option <?php echo e(($value3 == 'yes')?'selected':''); ?> value="yes">Yes</option>
            </select>
            <?php if($errors->has('unsuscribe')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('unsuscribe')); ?>

                </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo e($errors->has('unsuscribe_email') ? ' error has-error ' : ''); ?> col-sm-6">
            <label for="unsuscribe_email">Unsuscribe Email</label>
            <input type="email" class="form-control" name="unsuscribe_email" id="unsuscribe_email" value="<?php echo e((isset($data->unsuscribe_email))? $data->unsuscribe_email: Request::old('unsuscribe_email')); ?>" placeholder="Email To Notify When List Is Unsuscribed">
            <?php if($errors->has('unsuscribe_email')): ?>
                <span class="help-block">
                    <?php echo e($errors->first('unsuscribe_email')); ?>

                </span>
            <?php endif; ?>
        </div>
        <?php if(isset($data)): ?>
            <input name="id" value="<?php echo e($data->id); ?>" type="hidden"/>

        <?php endif; ?>
        <input name="_token" value="<?php echo e(Session::token()); ?>" type="hidden"/>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="loading"></div>
                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>