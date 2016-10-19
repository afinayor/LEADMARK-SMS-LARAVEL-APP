<?php

namespace leadmark\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use leadmark\Http\Requests;
use leadmark\Models\Templates;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class TemplatesController extends Controller
{
    public $user_id;
    public function __construct(){
        $this->user_id = Auth::User()->id;
        date_default_timezone_set('Africa/Lagos');
    }
    public function index(){
        return view('email.template');
    }
    public function listTemplates(){
        Session::put('t_list_search_type', Input::has('by') ? Input::get('type') : (Session::has('t_list_search_type') ? Session::get('t_list_search_type') : 'name'));
        Session::put('t_list_search', Input::has('ok') ? Input::get('search') : (Session::has('t_list_search') ? Session::get('t_list_search') : ''));
        $list = Templates::where(Session::get('t_list_search_type'), 'like', '%' . Session::get('t_list_search') . '%')
            ->where('user_id',Auth::User()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('email.template.list',compact('list'));
    }
    public function postTempDel(Request $request){
        $ids = Input::get('values');
        if(empty($ids)){
            return array(
                'fail' => true,
                'errors' => "No Template Clicked");
        }
        $values = explode(',',$ids);
        $temps = Templates::find($values);
        foreach($temps as $temp){

            $temp->delete();
        }
        $request->session()->flash('info','Your templates have been deleted');
        return "success";
    }
    public function newTemplate(){
        return view('email.newTemplate');
    }
    public function postNewTemplate(Request $request){
        $this->validate($request,[
            'name' => 'required|max:255',
            'content'   =>  'required'
        ]);
        $template = new Templates();
        $template->user_id = $this->user_id;
        $template->name = $request->input('name');
        $template->content = $request->input('content');
        $template->save();
        return redirect()->route('emailTemplates')->with('info','Your Template Has Been Successfully Added');
    }
    public function editTemplate($template_id){
        $template = new Templates();
        $data = $template::find($template_id);
        return view('email.newTemplate',compact('data'));
    }
    public function posteditTemplate(Request $request){
        $this->validate($request,[
            'id' => 'required',
            'name' => 'required|max:255',
            'content'   =>  'required'
        ]);
        $temp = new Templates();
        $template = $temp::findOrFail($request->input('id'));
        $template->name = $request->input('name');
        $template->content = $request->input('content');
        $template->save();
        return redirect()->route('emailTemplates')->with('info','Your Template Has Been Successfully Updated');
    }
    public function viewTemplate($template_id){
        $temp = new Templates();
        $template = $temp::findOrFail($template_id);

        return view('email.template.details',compact('template'));
    }
    public function duplicateTemplate($template_id){
        $temp = new Templates();
        $newTemp = new Templates();
        $template = $temp::findOrFail($template_id);
        $newTemp->user_id = $this->user_id;
        $newTemp->name = $template->name." (copy)";
        $newTemp->content = $template->content;
        $newTemp->save();

        return redirect()->route('emailTemplates')->with('info','Your Template Has Been Successfully Duplicated');
    }
}
