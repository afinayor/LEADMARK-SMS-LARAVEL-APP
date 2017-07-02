<div class="row">

  <?php if((sizeof($file_info) > 0) || (sizeof($directories) > 0)): ?>

  <?php foreach($directories as $key => $dir_name): ?>
  <?php echo $__env->make('laravel-filemanager::folders', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php endforeach; ?>

  <?php foreach($file_info as $key => $file): ?>
  <?php echo $__env->make('laravel-filemanager::item', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php endforeach; ?>

  <?php else: ?>
  <div class="col-md-12">
    <p><?php echo e(Lang::get('laravel-filemanager::lfm.message-empty')); ?></p>
  </div>
  <?php endif; ?>

</div>
