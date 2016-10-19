<div id="groups">
	<h2>Manage Groups
		<div class="pull-right">
			<a href="javascript:ajaxLoad('phonebook/creategroup','groups')" class="btn btn-primary pull-right"><i
						class="glyphicon glyphicon-plus-sign"></i> New Group</a>
		</div></h2>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
			<tr>
				<th>#</th><th>Name</th><th>No Of Contacts</th><th>Date Created</th><th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php $i=1?>
			@foreach($groups as $group)
				<tr>
					<td>{{$i++}}</td>
					<td>{{$group->name}}</td>
					<td>{{$group->contacts->count()}}</td>
					<td>{{$group->created_at}}</td>
					<td>
						<a href="javascript:ajaxLoad('phonebook/updategroup/{{$group->id}}','groups')">
							<button type="button" data-toggle="tooltip" data-placement="top" title="Edit Group" class="btn btn-success btn-simple btn-xs">
								<i class="fa fa-edit"></i>
							</button>
						</a>
						<a href="javascript:confirmdelete('phonebook/deletegroup/{{$group->id}}','All contacts under this group will also be deleted and cant be reverted.')">
							<button type="button"data-toggle="tooltip" data-placement="top" title="Remove" class="btn btn-danger btn-simple btn-xs">
								<i class="fa fa-times"></i>
							</button>
						</a>
					</td>
				</tr>

			@endforeach
			</tbody>
		</table>
	</div>
</div>


