<div style="border: 1px solid #979797;">
<?php echo $template->content; ?>

</div>
<a href="<?php echo e(route('editTemplate',['template_id'=>$template->id])); ?>"><button class="btn btn-primary">Edit Template</button></a>
<button class="btn btn-success" onclick="ajaxLoad('<?php echo e(route('listTemplates')); ?>')">Go Back</button>