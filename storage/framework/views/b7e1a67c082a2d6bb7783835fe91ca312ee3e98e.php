<h1 class="page-header">Product List
    <div class="pull-right">
        <a href="javascript:ajaxLoad('product/create')" class="btn btn-primary pull-right"><i
                    class="glyphicon glyphicon-plus-sign"></i> New</a>
    </div>
</h1>
<div class="col-sm-7 form-group">
    <div class="input-group">
        <input class="form-control" id="search" value="<?php echo e(Session::get('product_search')); ?>"
               onkeydown="if (event.keyCode == 13) ajaxLoad('<?php echo e(url('product/list')); ?>?ok=1&search='+this.value)"
               placeholder="Search..."
               type="text">

        <div class="input-group-btn">
            <button type="button" class="btn btn-default"
                    onclick="ajaxLoad('<?php echo e(url('product/list')); ?>?ok=1&search='+$('#search').val())"><i
                        class="glyphicon glyphicon-search"></i>
            </button>
        </div>
    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="50px" style="text-align: center">No</th>
        <th>
            <a href="javascript:ajaxLoad('product/list?field=name&sort=<?php echo e(Session::get("product_sort")=="asc"?"desc":"asc"); ?>')">
                Name
            </a>
            <i style="font-size: 12px"
               class="glyphicon  <?php echo e(Session::get('product_field')=='name'?(Session::get('product_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):''); ?>">
            </i>
        </th>
        <th>
            <a href="javascript:ajaxLoad('product/list?field=unitprice&sort=<?php echo e(Session::get("product_sort")=="asc"?"desc":"asc"); ?>')">
                Unitprice
            </a>
            <i style="font-size: 12px"
               class="glyphicon  <?php echo e(Session::get('product_field')=='unitprice'?(Session::get('product_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):''); ?>">
            </i>
        </th>
        <th width="140px"></th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;?>
    <?php foreach($products as $key=>$product): ?>
        <tr>
            <td align="center"><?php echo e($i++); ?></td>
            <td><?php echo e($product->name); ?></td>
            <td align="right">$ <?php echo e($product->unitprice); ?></td>
            <td style="text-align: center">
                <a class="btn btn-primary btn-xs" title="Edit"
                   href="javascript:ajaxLoad('product/update/<?php echo e($product->id); ?>')">
                    <i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a class="btn btn-danger btn-xs" title="Delete"
                   href="javascript:if(confirm('Are you sure want to delete?')) ajaxLoad('product/delete/<?php echo e($product->id); ?>')">
                    <i class="glyphicon glyphicon-trash"></i> Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="pull-right"><?php echo str_replace('/?','?',$products->render()); ?></div>
<div class="row">
    <i class="col-sm-12">
        Total: <?php echo e($products->total()); ?> records
    </i>
</div>
<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'));
    });
</script>