<h2>Add Multiple Contacts</h2>
<div class="general">
    <div class="row">
        <form id="fullform" action="{{route('phonebook.add_multiple')}}" method="post" role="form">
            <div class="form-group" id="form-group-error">
                <label for="" class="control-label">Save Contacts To New Group</label>

                <div class="">
                    <input name="group" type="text" class="form-control" id="group-field" placeholder="Name of group" required="required">
                </div>
                <span id="group-error" class="help-block"></span>
                <div class="row" id="group-btn">
                    <label for="" class="control-label">Choose Existing Group</label>
                    @foreach($groups as $group)
                        <input style="float: left;text-align: center;margin: 5px" type="button" id="{{$group->name}}" class="btn btn-success col-sm-2" value="{{$group->name}}" >
                    @endforeach
                </div>
            </div>

            <div class="col-md-6">
                <div id="panel_1" class="panel panel-info p_id_unique">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact 1</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-4 form-group" id="form-name_1-error">
                            <label for="name1" class="control-label">Name</label>

                            <div class="">
                                <input name="name_1" type="text" class="form-control" id="name1" placeholder="">
                            </div>
                            <span id="name_1-error" class="help-block"></span>
                        </div>
                        <div class="col-md-4 form-group" id="form-phone_1-error">
                            <label for="" class="control-label">Phone</label>

                            <div class="">
                                <input name="phone_1" type="text" class="form-control" id="" placeholder="">
                            </div>
                            <span id="phone_1-error" class="help-block"></span>
                        </div>
                        <div class="col-md-4 form-group" id="form-email_1-error">
                            <label for="" class="control-label">Email</label>

                            <div class="">
                                <input name="email_1" type="text" class="form-control" id="" placeholder="">
                            </div>
                            <span id="email_1-error" class="help-block"></span>
                        </div>
                        <div class="col-md-12 form-group" id="form-birthday_1-error">
                            <label for="" class="control-label">Birthday</label>

                            <div class="">
                                <input type="text" class="datepicker form-control" name="birthday_1"  placeholder="">
                            </div>
                            <span id="birthday_1-error" class="help-block"></span>
                        </div>
                        <div class="col-md-12 form-group" id="form-info_1-error">
                            <label for="" class="control-label">Info</label>

                            <div class="">
                                <textarea name="info_1" class="form-control" id="" placeholder=""></textarea>
                            </div>
                            <span id="info_1-error" class="help-block"></span>
                        </div>
                    </div>

                </div>
            </div>
            </div>
            <div class="col-md-6">
                <div id="panel_2" class="panel panel-info p_id_unique">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact 2</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-4 form-group" id="form-name_2-error">
                            <label for="" class="control-label">Name</label>

                            <div class="">
                                <input name="name_2" type="text" class="form-control" id="" placeholder="">
                            </div>
                            <span id="name_2-error" class="help-block"></span>
                        </div>
                        <div class="col-md-4 form-group" id="form-phone_2-error">
                            <label for="" class="control-label">Phone</label>

                            <div class="">
                                <input name="phone_2" type="text" class="form-control" id="" placeholder="">
                            </div>
                            <span id="phone_2-error" class="help-block"></span>
                        </div>
                        <div class="col-md-4 form-group" id="form-email_2-error">
                            <label for="" class="control-label">Email</label>

                            <div class="">
                                <input name="email_2" type="text" class="form-control" id="" placeholder="">
                            </div>
                            <span id="email_2-error" class="help-block"></span>
                        </div>

                        <div class="col-md-12 form-group" id="form-birthday_2-error">
                            <label for="" class="control-label">Birthday</label>

                            <div class="">
                                <input type="text" class="datepicker form-control" name="birthday_2"  placeholder="">
                            </div>
                            <span id="birthday_2-error" class="help-block"></span>
                        </div>


                        <div class="col-md-12 form-group" id="form-info_2-error">
                            <label for="" class="control-label">Info</label>

                            <div class="">
                                <textarea name="info_2" class="form-control" id="" placeholder=""></textarea>
                            </div>
                            <span id="info_2-error" class="help-block"></span>
                        </div>
                    </div>

                </div>
            </div>
            </div>
            <input name="no_of_contacts" id="no_of_contacts" value="" type="hidden"/>
            <div id="formcontent"></div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="col-md-12 form-group">
        <label for="" class="control-label">Add More Contact Fields</label>

        <div class="">

            <select onchange="loadform('{{url('phonebook/genForm')}}?no='+this.value)" name="" id="">
                <option>No of contacts to add</option>
                <option value="2">2</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

        </div>
    </div>
</div>