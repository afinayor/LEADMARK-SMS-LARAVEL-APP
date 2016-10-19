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
            <td style="font-weight: 900">Type</td><td>{{$value->type}}</td>
        </tr>
        <tr>
            <td style="font-weight: 900">Date</td><td>{{$value->created_at}}</td>
        </tr>
	</tbody>
</table>
<button class="btn btn-success" onclick="ajaxLoad('{{route('listSmsMessages')}}')">Go Back</button>