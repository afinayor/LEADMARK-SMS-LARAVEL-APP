<?php

namespace leadmark\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use leadmark\Http\Requests;
use leadmark\Classes\Sms;
use leadmark\Models\message_history;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use leadmark\Models\Contact_groups;
use leadmark\Models\Contacts;
use leadmark\Models\messages;
use leadmark\Models\queues;
use leadmark\Models\special_dates;
use DB;
use leadmark\Models\autoscheduler;
use leadmark\Models\auto_birthday;
use leadmark\Models\auto_date;
use leadmark\Models\auto_frequency;

class SmsDataController extends Controller
{
    public $groups,$user_id;
    public function __construct(){
        $contactGroup = new Contact_groups();
        $this->user_id = Auth::User()->id;
        $this->groups = $contactGroup->get_groups($this->user_id);
        date_default_timezone_set('Africa/Lagos');
    }
    public function messages(){
        return view('sms.messages');
    }

    public function getlist(){
        Session::put('list_search_type', Input::has('by') ? Input::get('type') : (Session::has('list_search_type') ? Session::get('list_search_type') : 'subject'));
        Session::put('list_search', Input::has('ok') ? Input::get('search') : (Session::has('list_search') ? Session::get('list_search') : ''));
        $msgs = messages::where(Session::get('list_search_type'), 'like', '%' . Session::get('list_search') . '%')
            ->where('user_id',Auth::User()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('sms.messages.list',compact('msgs'));
    }

    public function postMsgDel(Request $request){
        $ids = Input::get('values');
        if(empty($ids)){
            return array(
                'fail' => true,
                'errors' => "No Message Clicked");
        }
        $values = explode(',',$ids);
            $msgs = messages::find($values);
        foreach($msgs as $msg){
            $autoschedulers = $msg->autoschedules;
            foreach($autoschedulers as $schedules){
                $schedules->delete();
            }

            $msg->delete();
        }
        $request->session()->flash('info','Your messages have been deleted');
        return "success";
    }
    public function details($id){
        $msgs = new messages();
        $value = $msgs::find($id);
        if($value == null){
            return array(
                'fail' => true
            );
        }

        return view('sms.messages.details',compact('value'));
    }
    public function smshistory(){
        return view('sms.history');
    }

    public function listHistory(){
        Session::put('history_search_type', Input::has('by') ? Input::get('type') : (Session::has('history_search_type') ? Session::get('history_search_type') : 'subject'));
        Session::put('history_search', Input::has('ok') ? Input::get('search') : (Session::has('history_search') ? Session::get('history_search') : ''));
        $msgs = message_history::where(Session::get('history_search_type'), 'like', '%' . Session::get('history_search') . '%')
            ->where('user_id',Auth::User()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('sms.history.list',compact('msgs'));
    }
    public function postHistDel(Request $request){
        $ids = Input::get('values');
        if(empty($ids)){
            return array(
                'fail' => true,
                'errors' => "No Message Clicked");
        }
        $values = explode(',',$ids);
        $msgs = message_history::find($values);
        foreach($msgs as $msg){

            $msg->delete();
        }
        $request->session()->flash('info','Your messages have been deleted');
        return "success";
    }
    public function historyDetails($id){
        $msgs = new message_history();
        $value = $msgs::find($id);
        if($value == null){
            return array(
                'fail' => true
            );
        }

        return view('sms.history.details',compact('value'));
    }
    public function resend(Request $request){
        $SMS = new Sms();
        $msg = new message_history();
        $id = Input::get('values');

        $data = $msg::find($id);


        $result = $SMS->ProcessSMS($this->user_id,$data->campaign_id,time(),'standard',false,$data->subject,$data->recipients,$data->content);
        if(!$result->ifError){
            $units = $result->unitCharged;
            $request->session()->flash('info','Your SMS Was Successfully Sent. '.$units.' Units Used.');
        }else{
            $request->session()->flash('error',$result->getError());
        }
    }
    public function smsqueues(){
        return view('sms.queues');
    }
    public function listQueues(){
        Session::put('queues_search_type', Input::has('by') ? Input::get('type') : (Session::has('queues_search_type') ? Session::get('queues_search_type') : 'subject'));
        Session::put('queues_search', Input::has('ok') ? Input::get('search') : (Session::has('queues_search') ? Session::get('queues_search') : ''));
        $msgs = queues::where(Session::get('queues_search_type'), 'like', '%' . Session::get('queues_search') . '%')
            ->where('user_id',Auth::User()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('sms.queues.list',compact('msgs'));
    }
    public function queuesDetails($id){
        $msgs = new queues();
        $value = $msgs::find($id);
        if($value == null){
            return array(
                'fail' => true
            );
        }

        return view('sms.queues.details',compact('value'));
    }
    public function postQueuesDel(Request $request){
        $ids = Input::get('values');
        if(empty($ids)){
            return array(
                'fail' => true,
                'errors' => "No Message Clicked");
        }
        $values = explode(',',$ids);
        $msgs = queues::find($values);
        foreach($msgs as $msg){

            $msg->delete();
        }
        $request->session()->flash('info','Your queues have been deleted');
        return "success";
    }

    public function resendQueue(Request $request){
        $SMS = new Sms();
        $msg = new queues();
        $id = Input::get('values');

        $data = $msg::find($id);


        $result = $SMS->ProcessSMS($this->user_id,$data->campaign_id,time(),'standard',false,$data->subject,$data->recipients,$data->content);
        if(!$result->ifError){
            $units = $result->unitCharged;
            $request->session()->flash('info','Your SMS Was Successfully Sent. '.$units.' Units Used.');
        }else{
            $request->session()->flash('error',$result->getError());
        }
    }
}
