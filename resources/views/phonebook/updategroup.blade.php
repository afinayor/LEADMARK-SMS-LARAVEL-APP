<h2>Update Group {{$group->name}}</h2>
<div class="general">
<form id="updategroup" action="{{route('updategroup')}}" method="post" role="form">


	<div id="form-name-error" class="form-group">
		<label for="name">Name</label>
		<input type="text" class="form-control" name="name" id="" value="{{$group->name}}">
        <span id="name-error" class="help-block"></span>
    </div>

    <input name="id" value="{{$group->id}}" type="hidden"/>
    <input name="_token" value="{{Session::get('_token')}}" type="hidden"/>


    <a href="javascript:ajaxLoad('phonebook/groups','groups')"><button   type="button" class="btn btn-warning">Go Back</button></a>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<script>

    $("#updategroup").submit(function (event) {
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
                    $('#updategroup input, #fullform textarea').each(function () {
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