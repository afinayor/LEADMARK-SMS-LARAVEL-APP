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
            <?php
            $time = date('Y/m/d H:i',$value->sending_date_time);
            ?>
            <td style="font-weight: 900">Sending Time</td><td><?php echo e($time); ?></td>
        </tr>
        <tr>
            <td style="font-weight: 900">Schedule Method</td><td><?php echo e(ucfirst($value->method)); ?></td>
        </tr>
        <tr>
            <td style="font-weight: 900">Date</td><td><?php echo e($value->created_at); ?></td>
        </tr>
        <tr>
            <td style="font-weight: 900">Status</td><td><?php echo e($value->status); ?></td>
        </tr>
	</tbody>
</table>
<button class="btn btn-success" onclick="ajaxLoad('<?php echo e(route('listQueues')); ?>')">Go Back</button>