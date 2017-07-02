<table class="table table-striped table-hover">

	<tbody>
		<tr>
			<td style="font-weight: 900">Subject</td><td><?php echo e($value->subject); ?></td>
		</tr>
        <tr>
            <td style="font-weight: 900">Body</td><td class="wordwrap"><?php echo e($value->content); ?></td>
        </tr>
        <tr>
            <td style="font-weight: 900">Recipients</td><td class="wordwrap"><?php echo e($value->recipients); ?></td>
        </tr>
        <tr>
            <td style="font-weight: 900">Type</td><td><?php echo e($value->type); ?></td>
        </tr>
        <tr>
            <td style="font-weight: 900">Date</td><td><?php echo e($value->created_at); ?></td>
        </tr>
	</tbody>
</table>
<button class="btn btn-success" onclick="ajaxLoad('<?php echo e(route('listSmsMessages')); ?>')">Go Back</button>