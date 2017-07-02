<?php if(Session::has('info')): ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo e(Session::get('info')); ?></strong>
    </div>
<?php endif; ?>
<?php if(Session::has('error')): ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo e(Session::get('error')); ?></strong>
    </div>
<?php endif; ?>