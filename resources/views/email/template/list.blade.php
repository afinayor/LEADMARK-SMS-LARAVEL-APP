<div class="row">
    <div class="col-sm-7">
        <input class="form-control input-control pull-left" id="search" value="{{ Session::get('t_list_search') }}"
               onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('email/templates/list')}}?ok=1&search='+this.value)"
               placeholder="Search..."
               type="text">
        <select  onchange="ajaxLoad('{{url('email/templates/list')}}?by=1&type='+this.value)" class="form-control slectinput-control" id="contact-group">
            <option {{(Session::get('t_list_search_type') == 'name') ? 'selected' : ''}} value="name">Name</option>
            <option {{(Session::get('t_list_search_type') == 'content') ? 'selected' : ''}} value="content">Content</option>


        </select>
        <button type="button" class="btn btn-primary btn-search"
                onclick="ajaxLoad('{{url('email/templates/list')}}?ok=1&search='+$('#search').val())"><i
                    class="glyphicon glyphicon-search"></i> Search
        </button>

    </div>




</div>
<div class="panel panel-default">
    <!-- Progress table -->

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th width="20">
                    <div class="checkbox">
                        <label>
                            <input id="select_all" type="checkbox" aria-label="check all">
                        </label>
                    </div>
                </th>
                <th>Name</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody id="responsive-table-body">
            @foreach($list as $temp)
                <tr>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input value="{{$temp->id}}"  type="checkbox" aria-label="check" name="check[]" class="checkbox">
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:ajaxLoad('{{route('viewTemplate',['template_id'=>$temp->id])}}')" >{{$temp->name}}</a></td>
                    <td>{{$temp->created_at->diffForHumans()}}</td>
                    <td>{{$temp->updated_at->diffForHumans()}}</td>
                    <td class="text-right">
                        <a href="{{route('duplicateTemplate',['template_id'=>$temp->id])}}" class="btn btn-warning btn-xs btn-rounded" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="fa fa-copy"></i></a>
                        <a href="{{route('editTemplate',['template_id'=>$temp->id])}}" class="btn btn-success btn-xs btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="javascript:deleteList('{{$temp->id}}')" class="btn btn-danger btn-xs btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i
                                    class="fa fa-times"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- // Progress table -->

    <div class="panel-footer padding-none text-center">

        <div class="row">
            <i class="col-sm-12">
                Total: {{$list->total()}} records
            </i>
        </div>

    </div>
</div>
<div class="pull-left">
    <a href="" id="picked" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete All Selected"><i
                class="fa fa-times"></i></a>Delete all selected
</div>
<div class="pull-right">{!! str_replace('/?','?',$list->render()) !!}</div>
<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'));
    });
    $(function(){
        $('[data-toggle = "tooltip"]').tooltip();
    });
    $('#picked').click(function(e){
        e.preventDefault();
        var no = $('.checkbox :checked').length;
        if(no == 0){
            swal('No Template Was Checked');
            return false;
        }
        var values = "";
        $('.checkbox :checked').each(function(){
            var val = $(this).val();
            values += val+',';
        });
        deleteList(values);
        return false;
    });

    function deleteList(values){
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function() {

            var filename = '{{route('postTempDel')}}';
            var data = "values="+values;
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: filename,
                data:data,
                contentType: false,
                success: function (data) {
                    if(data){
                        if(data.fail){
                            swal(
                                    'Empty Message',
                                    'Please pick a template to proceed',
                                    'warning'
                            );
                        }
                        location.reload();
                    }
//                    $('.loading').hide();

                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });

        });

    }
</script>