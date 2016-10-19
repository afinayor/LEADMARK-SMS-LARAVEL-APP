<table class="table table-striped table-hover">

	<tbody>
		<tr>
			<td style="font-weight: 900">Subject</td><td>{{$value->subject}}</td>
		</tr>
        <tr>
            <td style="font-weight: 900">Body</td><td class="wordwrap">{{$value->content}}</td>
        </tr>
        <tr>
            <td style="font-weight: 900">Recipients</td><td class="wordwrap">{{$value->recipients}}</td>
        </tr>
        <tr>
            <?php
            $time = date('Y/m/d H:i',$value->sending_date_time);
            ?>
            <td style="font-weight: 900">Sending Time</td><td>{{$time}}</td>
        </tr>
        <tr>
            <td style="font-weight: 900">Schedule Method</td><td>{{ucfirst($value->method)}}</td>
        </tr>
        <tr>
            <td style="font-weight: 900">Date</td><td>{{$value->created_at}}</td>
        </tr>
        <tr>
            <td style="font-weight: 900">Status</td><td>{{$value->status}}</td>
        </tr>
	</tbody>
</table>
<button class="btn btn-success" onclick="ajaxLoad('{{route('listQueues')}}')">Go Back</button>