<div class="form-group">
    <label for="" class="control-label">Send SMS Every</label>

    <div class="col-sm-3">
        <input type="text" class="form-control" name="frequency_no" id="" placeholder="Select No Of Times" required="required" value="1">
    </div>
    <div class="col-sm-4">
        <select name="frequency_type" id="inputID" class="form-control">
        	<option value="days">Day</option>
            <option value="weeks">Week</option>
            <option value="months">Month</option>
        </select>
    </div>
    {{--<div class="col-sm-1">--}}
        {{----}}
    {{--</div>--}}
    <div class="col-sm-4">
        <span>at</span>
        <input type="text" name="time_of_day" style="width:90%" class="form-control time" id="" placeholder="Time of day to send out SMS" required="required" >
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label for="start-date" class="control-label">Start Date</label>

        <div class="">
            <input type="text" name="start_date" class="form-control pickdate" required="required" id="start-date" placeholder="Click to pick a date">
        </div>
    </div>
    <div class="form-group col-sm-6">
        <label for="end-date" class="control-label">End Date</label>

        <div class="">
            <input type="text" name="end_date" class="form-control pickdate" required="required" id="end-date" placeholder="Click to pick a date">
        </div>
    </div>
</div>