<h2>Contact List</h2>
<div class="general">
    <div class="row">
            <div class="col-sm-7">
                    <input class="form-control input-control pull-left" id="search" value="{{ Session::get('phonebook_search') }}"
                           onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('phonebook/list')}}?ok=1&search='+this.value)"
                           placeholder="Search..."
                           type="text">
                <select  onchange="ajaxLoad('{{url('phonebook/list')}}?by=1&type='+this.value)" class="form-control slectinput-control" id="contact-group">
                    <option {{(Session::get('phonebook_search_type') == 'name') ? 'selected' : ''}} value="name">Name</option>
                    <option {{(Session::get('phonebook_search_type') == 'email') ? 'selected' : ''}} value="email">Email</option>
                    <option {{(Session::get('phonebook_search_type') == 'phone') ? 'selected' : ''}} value="phone">Phone</option>
                    <option {{(Session::get('phonebook_search_type') == 'info') ? 'selected' : ''}} value="info">Info</option>
                </select>
                <button type="button" class="btn btn-primary btn-search"
                        onclick="ajaxLoad('{{url('phonebook/list')}}?ok=1&search='+$('#search').val())"><i
                            class="glyphicon glyphicon-search"></i> Search
                </button>

            </div>
        <div class="col-sm-5">

            <select  onchange="ajaxLoad('{{url('phonebook/list')}}?test=1&group='+this.value)" class="form-control input-control pull-right" id="contact-group">
                <option {{(Session::get('phonebook_group') == '*') ? 'selected' : ''}} value="*">All Groups</option>
            @foreach($groups as $group)
                <option
                        {{(Session::get('phonebook_group') == $group->id) ? 'selected' : ''}}
                        value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
            </select>

        </div>



    </div>
</div>
<div class="table-responsive">
    <table style="margin-top: 10px" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="50px" style="text-align: center">No</th>
        <th>
            <a href="javascript:ajaxLoad('phonebook/list?field=name&sort={{Session::get("phonebook_sort")=="asc"?"desc":"asc"}}')">
                Name
            </a>
            <i style="font-size: 12px"
               class="glyphicon  {{ Session::get('phonebook_field')=='name'?(Session::get('phonebook_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
            </i>
        </th>
        <th width="90px">
            Phone
        </th>
        <th width="140px">
            <a href="javascript:ajaxLoad('phonebook/list?field=email&sort={{Session::get("phonebook_sort")=="asc"?"desc":"asc"}}')">
                Email
            </a>
            <i style="font-size: 12px"
               class="glyphicon  {{ Session::get('phonebook_field')=='email'?(Session::get('phonebook_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
            </i>
            </th>
        <th width="90px">
            Contact Group
        </th>
        <th>
            Info
        </th>
        <th>
            Actions
        </th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;?>
    @foreach($contacts as $key=>$contact)
        <tr>
            <td align="center">{{$i++}}</td>
            <td>{{$contact->name}}</td>
            <td>{{$contact->phone}}</td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->contact_groups->name}}</td>
            <td>{{$contact->info}}</td>
            <td>
                <a href="javascript:ajaxLoad('phonebook/updatecontact/{{$contact->id}}')">
                    <button type="button" data-toggle="tooltip" data-placement="top" title="Edit Contact" class="btn btn-success btn-simple btn-xs btn-rounded">
                        <i class="fa fa-edit"></i>
                    </button>
                </a>
                <a href="javascript:confirmdelete('phonebook/deletecontact/{{$contact->id}}','This contact will be deleted.')">
                    <button type="button"data-toggle="tooltip" data-placement="top" title="Remove" class="btn btn-danger btn-simple btn-xs btn-rounded">
                        <i class="fa fa-times"></i>
                    </button>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="pull-right">{!! str_replace('/?','?',$contacts->render()) !!}</div>
<div class="row">
    <i class="col-sm-12">
        Total: {{$contacts->total()}} records
    </i>
</div>
<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'));
    });
</script>