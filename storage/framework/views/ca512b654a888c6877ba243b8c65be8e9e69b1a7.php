<div class="row">
    <div class="col-sm-7">
        <input class="form-control input-control pull-left" id="search" value="<?php echo e(Session::get('queues_search')); ?>"
               onkeydown="if (event.keyCode == 13) ajaxLoad('<?php echo e(url('sms/queues/list')); ?>?ok=1&search='+this.value)"
               placeholder="Search..."
               type="text">
        <select  onchange="ajaxLoad('<?php echo e(url('sms/queues/list')); ?>?by=1&type='+this.value)" class="form-control slectinput-control" id="contact-group">
            <option <?php echo e((Session::get('queues_search_type') == 'subject') ? 'selected' : ''); ?> value="subject">Subject</option>
            <option <?php echo e((Session::get('queues_search_type') == 'content') ? 'selected' : ''); ?> value="content">Body</option>
            <option <?php echo e((Session::get('queues_search_type') == 'recipients') ? 'selected' : ''); ?> value="recipients">Recipients</option>

        </select>
        <button type="button" class="btn btn-primary btn-search"
                onclick="ajaxLoad('<?php echo e(url('sms/queues/list')); ?>?ok=1&search='+$('#search').val())"><i
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
                <th>Subject</th>
                <th width="300px">Body</th>
                <th>Status</th>
                <th>Date</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody id="responsive-table-body">
            <?php foreach($msgs as $msg): ?>
                <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input value="<?php echo e($msg->id); ?>"  type="checkbox" aria-label="check" name="check[]" class="checkbox">
                        </label>
                    </div>
                </td>
                <td><a href="javascript:return false" onclick="ajaxLoad('<?php echo e(route('queuesDetails',['id'=>$msg->id])); ?>')" ><?php echo e($msg->subject); ?></a></td>
                <td><?php echo e(substr($msg->content,0,160)); ?><?php echo e((strlen($msg->content)>160)?'...':''); ?></td>
                <td><?php echo e($msg->status); ?></td>
                <td><?php echo e($msg->created_at->diffForHumans()); ?></td>
                <td class="text-right">
                    <a href="javascript:resend('<?php echo e($msg->id); ?>')" class="btn btn-success btn-xs btn-rounded" data-toggle="tooltip" data-placement="top" title="Resend"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:deleteList('<?php echo e($msg->id); ?>')" class="btn btn-danger btn-xs btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i
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
                Total: <?php echo e($msgs->total()); ?> records
            </i>
        </div>

    </div>
</div>
<div class="pull-left">
    <a href="" id="picked" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete All Selected"><i
                class="fa fa-times"></i></a>Delete all selected
</div>
<div class="pull-right"><?php echo str_replace('/?','?',$msgs->render()); ?></div>
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
            swal('No Message Was Checked');
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
            text: "Selected messages will be deleted and you won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function() {

            var filename = '<?php echo e(route('postQueuesDel')); ?>';
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
                                    'Please pick a message to proceed',
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
    function resend(id){
        swal({
            title: 'Are you sure you want to resend?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Resend SMS'
        }).then(function() {
            var filename = '<?php echo e(route('resendQueue')); ?>';
            var data = "values="+id;
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
                                    'Please pick a message to proceed',
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