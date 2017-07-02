<h2 class="page-header">New Product</h2>

<form id="frm" class="form-horizontal" action="" method="post" role="form">
    <?php echo $__env->make("product._form", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</form>
