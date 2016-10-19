@if(Session::has('info'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{Session::get('info')}}</strong>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{Session::get('error')}}</strong>
    </div>
@endif