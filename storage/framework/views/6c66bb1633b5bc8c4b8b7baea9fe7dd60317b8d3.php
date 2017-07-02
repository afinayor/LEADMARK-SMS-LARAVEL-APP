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

                        <h2>EMAIL TEMPLATES</h2>

                        <ol class="breadcrumb">
                            <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li><a href="<?php echo e(route('home')); ?>">Email</a></li>
                            <li><a href="<?php echo e(route('emailTemplates')); ?>">Templates</a></li>
                            <li class="active">Create Template</li>
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

                    <h2 class="shortcodes-title"><?php echo e((isset($data))?'EDIT TEMPLATE':'CREATE TEMPLATE'); ?> <div class="pull-right">
                            <a href="<?php echo e(route('emailTemplates')); ?>" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus-sign"></i> TEMPLATES</a>
                        </div></h2>
                        <div class="general">
                            <form action="<?php echo e((!isset($data))?route('postNewTemplate'):route('postEditTemplate')); ?>" method="post" role="form">

                                <div class="form-group <?php echo e($errors->has('name') ? ' error has-error ' : ''); ?>">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" value="<?php echo e((isset($data->name))? $data->name : Request::old('name') ?: ''); ?>" name="name" id="" placeholder="Name of template">
                                    <?php if($errors->has('name')): ?>
                                        <span class="help-block">
                                                        <?php echo e($errors->first('name')); ?>

                                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group <?php echo e($errors->has('content') ? ' error has-error ' : ''); ?>">
                                    <label for="content" class="control-label">Content</label>

                                    <div >
                                        <textarea style="height: 750px;" name="content" class="form-control" id="content"><?php echo (isset($data->content))? $data->content : Request::old('content') ?: ''; ?></textarea>
                                    </div>
                                    <?php if($errors->has('content')): ?>
                                        <span class="help-block">
                                                        <?php echo e($errors->first('content')); ?>

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
    <script src="<?php echo e(asset('tinymce/js/tinymce/tinymce.min.js')); ?>"></script>
    <script>
        var editor_config = {
            path_absolute : "<?php echo e(URL::to('/')); ?>/",
            selector: "#content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
//                var cmsURL = 'laravel-filemanager?field_name=' + field_name;

//                var cmsURL = '<?php echo e(URL::to('laravel-filemanager?field_name=')); ?>' + field_name;
				var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name
                console.log(cmsURL);
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>