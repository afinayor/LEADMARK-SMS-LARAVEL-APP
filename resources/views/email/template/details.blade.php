<div style="border: 1px solid #979797;">
{!!$template->content!!}
</div>
<a href="{{route('editTemplate',['template_id'=>$template->id])}}"><button class="btn btn-primary">Edit Template</button></a>
<button class="btn btn-success" onclick="ajaxLoad('{{route('listTemplates')}}')">Go Back</button>