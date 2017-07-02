<h2 xmlns="http://www.w3.org/1999/html">Update Contact</h2>
<div class="general">
<form id="updatecontact" action="<?php echo e(route('updatecontact')); ?>" method="post" role="form">
	<div class="row">
		<div class="col-md-4 form-group" id="form-name-error">
			<label for="" class="control-label">Name</label>

			<div class="">
				<input name="name" type="text" class="form-control" id="" value="<?php echo e($contact->name); ?>" placeholder="">
			</div>
			<span id="name-error" class="help-block"></span>
		</div>
		<div class="col-md-4 form-group" id="form-phone-error">
			<label for="" class="control-label">Phone</label>

			<div class="">
				<input name="phone" type="text" class="form-control" value="<?php echo e($contact->phone); ?>" id="" placeholder="">
			</div>
			<span id="phone-error" class="help-block"></span>
		</div>
		<div class="col-md-4 form-group" id="form-email-error">
			<label for="" class="control-label">Email</label>

			<div class="">
				<input name="email" type="text" class="form-control" value="<?php echo e($contact->email); ?>" id="" placeholder="">
			</div>
			<span id="email-error" class="help-block"></span>
		</div>
		<div class="col-md-6 form-group" id="form-birthday-error">
			<label for="" class="control-label">Birthday</label>

			<div class="">
				<input type="text" class="datepicker form-control" name="birthday" value="<?php echo e($contact->birthday); ?>"  placeholder="">
			</div>
			<span id="birthday-error" class="help-block"></span>
		</div>
		<div class="col-md-6 form-group" id="form-group-error">
			<label for="" class="control-label">Contact Group</label>

			<div class="">
				<select name="group" class="form-control" id="">
					<?php foreach($groups as $group): ?>
					<option <?php echo e(($group->id == $contact->contact_groups_id)?"selected":""); ?> value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<span id="group-error" class="help-block"></span>
		</div>
		<div class="col-md-12 form-group" id="form-info-error">
			<label for="" class="control-label">Info</label>

			<div class="">
				<textarea name="info" class="form-control" id="" placeholder=""><?php echo e($contact->info); ?></textarea>
			</div>
			<span id="info-error" class="help-block"></span>
		</div>
	</div>
    <input name="id" value="<?php echo e($contact->id); ?>" type="hidden"/>
    <input name="_token" value="<?php echo e(Session::get('_token')); ?>" type="hidden"/>


    <a href="javascript:ajaxLoad('phonebook/list')"><button   type="button" class="btn btn-warning">Go Back</button></a>
	<button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
<script>
	if($('.datepicker').length != 0){
            $('.datepicker').datepicker({
				format:"yyyy/mm/dd",
                weekStart:1
            });
        }
	$("#updatecontact").submit(function (event) {
		event.preventDefault();
		$('.loading').show();
		var form = $(this);
		var data = new FormData($(this)[0]);
		var url = form.attr("action");
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
//                    alert(data.fail);
				$('.loading').hide();
				if (data.fail) {
					$('#updatecontact input, #updatecontact textarea').each(function () {
						index = $(this).attr('name');
						if (index in data.errors) {
							$("#form-" + index + "-error").addClass("has-error");
							$("#" + index + "-error").html(data.errors[index]);

						}
						else {
							$("#form-" + index + "-error").removeClass("has-error");
							$("#" + index + "-error").empty();
						}
					});
					$('#focus').focus().select();
				} else {
					$(".has-error").removeClass("has-error");
					$(".help-block").empty();
					$('.loading').hide();
					location.reload();
//                        ajaxLoad(data.url, data.content);
				}
			},
			error: function (xhr, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
		return false;
	});
</script>