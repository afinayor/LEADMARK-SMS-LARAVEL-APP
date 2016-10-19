<?php

namespace leadmark\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use leadmark\Http\Requests;
use leadmark\Classes\Sms;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use leadmark\Models\lists;
use leadmark\Models\subscribers;
//use DB;
class ListController extends Controller
{
    public $user_id;
    public function __construct(){

        $this->user_id = Auth::User()->id;

        date_default_timezone_set('Africa/Lagos');
    }
    public function index(){
        return view('email.emailLists');
    }
    public function getLists(){
        Session::put('email_lists_search_type', Input::has('by') ? Input::get('type') : (Session::has('email_lists_search_type') ? Session::get('email_lists_search_type') : 'name'));
        Session::put('email_lists_search', Input::has('ok') ? Input::get('search') : (Session::has('email_lists_search') ? Session::get('email_lists_search') : ''));
        $lists = lists::where(Session::get('email_lists_search_type'), 'like', '%' . Session::get('email_lists_search') . '%')
            ->where('user_id',Auth::User()->id)
            ->where('publish','1')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('email.lists.list',compact('lists'));
    }
    public function createList(){
        return view('email.newList');
    }
    public function postCreateList(Request $request){
        $this->validate($request,[
            'name'  => 'required',
            'display_name' => '',
            'description' => 'required',
            'from_name' => 'required|max:50',
            'from_email' => 'required|email|max:50',
            'reply_to' => 'required|max:50',
            'subject' => 'required',
            'subscription_default' => 'required',
            'suscribe' => 'required',
            'suscribe_email' => 'email',
            'unsuscribe' => 'required',
            'unsuscribe_email' => 'email',

        ]);

        $list = new lists();
        $list->user_id = $this->user_id;
        $list->name = Input::get('name');
        $list->display_name = Input::get('display_name');
        $list->description = Input::get('description');
        $list->from_name = Input::get('from_name');
        $list->from_email = Input::get('from_email');
        $list->reply_email = Input::get('reply_to');
        $list->subject = Input::get('subject');
        $list->suscribe_default = Input::get('subscription_default');
        $list->suscribe = Input::get('suscribe');
        $list->suscribe_email = Input::get('suscribe_email');
        $list->unsuscribe = Input::get('unsuscribe');
        $list->unsuscribe_email = Input::get('unsuscribe_email');
        $list->publish = '1';
        $list->save();

        return redirect()->route('emailLists')->with('info','New List Successfully Added.');
    }
    public function postListDel(Request $request){

            $ids = Input::get('values');
            if(empty($ids)){
                return array(
                    'fail' => true,
                    'errors' => "No Email List Clicked");
            }
            $values = explode(',',$ids);
            $lists = lists::find($values);
            foreach($lists as $list){
//          suscriber deleting taking place here
                $list->publish = '0';
                $list->save();
            }
            $request->session()->flash('info','Your list have been deleted');
            return "success";

    }
    public function duplicateList($list_id){
        $temp = new lists();
        $newTemp = new lists();
        $lists = $temp::findOrFail($list_id);
        $newTemp->user_id = $this->user_id;
        $newTemp->name = $lists->name." (copy)";
        $newTemp->display_name = $lists->display_name;
        $newTemp->description = $lists->description ;
        $newTemp->from_name = $lists->description ;
        $newTemp->from_email = $lists->from_email ;
        $newTemp->reply_email = $lists->reply_email ;
        $newTemp->subject = $lists->subject ;
        $newTemp->suscribe_default = $lists->suscribe_default ;
        $newTemp->suscribe = $lists->suscribe ;
        $newTemp->suscribe_email = $lists->suscribe_email ;
        $newTemp->unsuscribe = $lists->unsuscribe ;
        $newTemp->unsuscribe_email = $lists->unsuscribe_email ;
        $newTemp->publish = '1' ;
        $newTemp->save();

        return redirect()->route('emailLists')->with('info','Your List Has Been Successfully Duplicated');
    }

    public function editList($list_id){
        $lists = new lists();
        $data = $lists::findOrFail($list_id);
        return view('email.newList',compact('data'));
    }
    public function posteditList(Request $request){
        $this->validate($request,[
            'id' => 'required',
            'name'  => 'required',
            'display_name' => '',
            'description' => 'required',
            'from_name' => 'required|max:50',
            'from_email' => 'required|email|max:50',
            'reply_to' => 'required|max:50',
            'subject' => 'required',
            'subscription_default' => 'required',
            'suscribe' => 'required',
            'suscribe_email' => 'email',
            'unsuscribe' => 'required',
            'unsuscribe_email' => 'email',
        ]);
        $lists = new lists();
        $list = $lists::findOrFail($request->input('id'));
        $list->user_id = $this->user_id;
        $list->name = Input::get('name');
        $list->display_name = Input::get('display_name');
        $list->description = Input::get('description');
        $list->from_name = Input::get('from_name');
        $list->from_email = Input::get('from_email');
        $list->reply_email = Input::get('reply_to');
        $list->subject = Input::get('subject');
        $list->suscribe_default = Input::get('subscription_default');
        $list->suscribe = Input::get('suscribe');
        $list->suscribe_email = Input::get('suscribe_email');
        $list->unsuscribe = Input::get('unsuscribe');
        $list->unsuscribe_email = Input::get('unsuscribe_email');
        $list->publish = '1';
        $list->save();
        return redirect()->route('emailLists')->with('info','Your List Has Been Successfully Updated');
    }
    public function listDashboard($list_id){
        $lists = new lists();
        $data = $lists::findOrFail($list_id);
        $this->checkUser($data->user_id);



        return view('email.listDashboard',compact('data'));
    }
    private function checkUser($user_id){
        if($user_id != $this->user_id){
            abort(401,'Unauthorised Access');
            return false;
        }
        return true;
    }
}
