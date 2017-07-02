<div class="form-group required" id="form-name-error">
    <?php /*<?php echo Form::label("name","Name",["class"=>"control-label col-md-3"]); ?>*/ ?>
    <label>Name</label>
    <div class="col-md-6">
        <?php /*<?php echo Form::text("name",null,["class"=>"form-control required","id"=>"focus"]); ?>*/ ?>
        <input type="text" name="name" id="focus" class="form-control" value="" title="" required="required" >

        <span id="name-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-unitprice-error">
    <?php /*<?php echo Form::label("unitprice","Unitprice",["class"=>"control-label col-md-3"]); ?>*/ ?>
<label for="">Unit price</label>
    <div class="col-md-6">
        <?php /*<?php echo Form::text("unitprice",null,["class"=>"form-control required"]); ?>*/ ?>
        <input type="text" name="unitprice" id="inputID" class="form-control" value="" title="" required="required" >

        <span id="unitprice-error" class="help-block"></span>
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-md-push-3">
        <a href="javascript:ajaxLoad('product/list')" class="btn btn-danger"><i
                    class="glyphicon glyphicon-backward"></i>
            Back</a>
 <button type="submit" class="btn btn-primary ">Submit</button>

        <?php /*<?php echo Form::button("<i class='glyphicon glyphicon-floppy-disk'></i> Save",["type" => "submit","class"=>"btn*/ ?>
        <?php /*btn-primary"]); ?>*/ ?>
    </div>
</div>
<script>
    $("#frm").submit(function (event) {
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
                if (data.fail) {
                    $('#frm input.required, #frm textarea.required').each(function () {
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
                    ajaxLoad(data.url, data.content);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
        return false;
    });
</script>