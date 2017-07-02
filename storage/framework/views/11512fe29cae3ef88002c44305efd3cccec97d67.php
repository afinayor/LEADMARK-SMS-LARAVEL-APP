<div class="form-group">
    <label for="" class="control-label">Send SMS On</label>

    <div class="">
        <select name="date_value" id="inputID" class="form-control">
        	<?php foreach($dates as $date): ?>
                <option value="<?php echo e($date->date); ?>"><?php echo e($date->date_name); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

</div>
<div class="form-group">
    <label for="" class="control-label">Time Of Day TO Send SMS</label>

    <div class="">
        <input type="text" name="date_time" class="form-control time" id="" placeholder="Click to pick a time" required="required">
    </div>
</div>


<a class="btn btn-primary" data-toggle="modal" href="#modal-add">Add New Date</a>
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Your Date</h4>
            </div>
            <form id="form-add" action="" method="post" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Title of Date</label>
                        <input type="text" class="form-control" name="name" id="datename" placeholder="Click To Pick a Date" >
                    </div>
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="text" class="form-control pickdate" name="date" id="datevalue" placeholder="Click To Pick a Date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="save-date" type="submit" class="btn btn-primary">Save Date</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->