<?php if(Session::has('info')): ?>
    <script>
        swal(
                'Good job!',
                "<?php echo e(Session::get('info')); ?>",
                'success')
    </script>
<?php endif; ?>
<?php if(Session::has('signininfo')): ?>
    <script>
        swal(
                'Welcome <?php echo e(Auth::User()->getUsername()); ?>',
                "<?php echo e(Session::get('signininfo')); ?>",
                'success')
    </script>
<?php endif; ?>
<?php if(Session::has('error')): ?>
    <script>
        swal(
                'Error',
                "<?php echo e(Session::get('error')); ?>",
                'warning')
    </script>
<?php endif; ?>

