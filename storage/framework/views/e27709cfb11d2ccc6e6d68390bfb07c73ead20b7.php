<div class="row">
    <div class="col-sm-7">
        <input class="form-control input-control pull-left" id="search" value="<?php echo e(Session::get('email_lists_search')); ?>"
               onkeydown="if (event.keyCode == 13) ajaxLoad('<?php echo e(url('email/lists/getlist')); ?>?ok=1&search='+this.value)"
               placeholder="Search..."
               type="text">
        <select  onchange="ajaxLoad('<?php echo e(url('email/lists/getlist')); ?>?by=1&type='+this.value)" class="form-control slectinput-control" id="contact-group">
            <option <?php echo e((Session::get('email_lists_search_type') == 'name') ? 'selected' : ''); ?> value="name">Name</option>
            <option <?php echo e((Session::get('email_lists_search_type') == 'description') ? 'selected' : ''); ?> value="description">Description</option>


        </select>
        <button type="button" class="btn btn-primary btn-search"
                onclick="ajaxLoad('<?php echo e(url('email/lists/getlist')); ?>?ok=1&search='+$('#search').val())"><i
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
            <?php foreach($lists as $temp): ?>
                <tr>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input value="<?php echo e($temp->id); ?>"  type="checkbox" aria-label="check" name="check[]" class="checkbox">
                            </label>
                        </div>
                    </td>
                    <td><a href="<?php echo e(route('listDashboard',['list_id'=>$temp->id])); ?>" ><?php echo e($temp->name); ?></a></td>
                    <td><?php echo e($temp->created_at->diffForHumans()); ?></td>
                    <td><?php echo e($temp->updated_at->diffForHumans()); ?></td>
                    <td class="text-right">
                        <a href="<?php echo e(route('duplicateList',['list_id'=>$temp->id])); ?>" class="btn btn-warning btn-xs btn-rounded" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="fa fa-copy"></i></a>
                        <a href="<?php echo e(route('editList',['list_id'=>$temp->id])); ?>" class="btn btn-success btn-xs btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="javascript:deleteList('<?php echo e($temp->id); ?>')" class="btn btn-danger btn-xs btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i
                                    class="fa fa-times"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- // Progress table -->

    <div class="panel-footer padding-none text-center">

        <div class="row">
            <i class="col-sm-12">
                Total: <?php echo e($lists->total()); ?> records
            </i>
        </div>

    </div>
</div>
<div class="pull-left">
    <a href="" id="picked" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete All Selected"><i
                class="fa fa-times"></i></a>Delete all selected
</div>
<div class="pull-right"><?php echo str_replace('/?','?',$lists->render()); ?></div>
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
            swal('No Email List Was Selected');
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
            text: "This will permanently delete all suscribers under this list along with the list.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function() {

            var filename = '<?php echo e(route('postListDel')); ?>';
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
                                    'Please pick a list to proceed',
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