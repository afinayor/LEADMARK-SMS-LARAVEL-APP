<?php

namespace leadmark\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use leadmark\Http\Requests;
use leadmark\Classes\Sms;
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

class SmsController extends Controller
{
    public $groups,$user_id;
    public function __construct(){
        $contactGroup = new Contact_groups();
        $this->user_id = Auth::User()->id;
        $this->groups = $contactGroup->get_groups($this->user_id);
        date_default_timezone_set('Africa/Lagos');
    }
    public function compose($message_id=null){
        if($message_id != null){
            $message = messages::findOrFail($message_id);
        }
        $groups = $this->groups;
        return view('sms.compose',compact('groups','message'));
    }
    public function saverecipients(){
        $validator = Validator::make(Input::all(), ['recipients' => 'required']);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $group = Input::get('group');
        $numbers = Input::get('recipients');
        if(Input::get('new') == 'true'){
            $newGroup = Input::get('group');
            $cGroup = new Contact_groups();
            $cGroup->user_id = $this->user_id;
            $cGroup->name = $newGroup;
            $cGroup->save();
            $group = $cGroup->id;
        }
        $numbersArray = explode(',',$numbers);
        foreach($numbersArray as $number){
            $contact = new Contacts();
            $contact->phone = $number;
            $contact->contact_groups_id = $group;
            $contact->user_id = $this->user_id;
            $contact->save();
        }

        return array(
            'fail' => false,
            'errors' => $validator->getMessageBag()->toArray()
        );
    }
    public function savedraft(Request $request){
        $validator = Validator::make($request->all(), ['subject' => 'required|max:100',
            'body' => 'required']);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray(),
                'val' => $request->all(),
            );
        }

        $sms = new Sms();
        $no = ceil(strlen(Input::get('body')/160));
        $sms->addMessage($this->user_id,null,'draft',time(),'Not Sent',$no,Input::get('subject'),Input::get('body'),Input::get('recipients'));


        return array(
            'fail' => false,
            'values' => Input::all(),

        );
    }
    public function sendSMS(Request $request){
        $groups= Input::get('group');
        $req = empty($groups) ? 'required' : '';


        $this->validate($request,[
            'subject' => "required|max:100",
            'recipients' => $req,
            'body' => 'required'
        ]);

//        print_r($groups);
        $contactGroups = new Contact_groups();
        $SMS = new Sms();
        $recipients = Input::get('recipients');
        if(!empty($groups)) {
            $group_numbers = $contactGroups->group_contacts_phone($groups);
            $recipients .= $group_numbers;
        }

        $result = $SMS->ProcessSMS($this->user_id,null,time(),'standard',false,Input::get('subject'),$recipients,Input::get('body'));
        if(!$result->ifError){
            $units = $result->unitCharged;
            return redirect()->route('compose')->with('info','Your SMS Was Successfully Sent. '.$units.' Units Used.');
        }else{
            $request->session()->flash('error',$result->getError());
            return redirect()->route('compose')->withInput();
        }
    }

    public function scheduleSMS(Request $request){
        $groups= Input::get('group');
        $req = empty($groups) ? 'required' : '';

        $validator = Validator::make(Input::all(), ['subject' => "required|max:100",
            'recipients' => $req,
            'body' => 'required']);

        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $contactGroups = new Contact_groups();
        $sms = new Sms();
        $recipients = Input::get('recipients');
        if(!empty($groups)) {
            $group_numbers = $contactGroups->group_contacts_phone($groups);
            $recipients .= $group_numbers;
        }



      $no = ceil(strlen(Input::get('body')/160));
      $msg_id = $sms->addMessage($this->user_id,null,'schedule',time(),'Not Sent',$no,Input::get('subject'),Input::get('body'),$recipients);
        $request->session()->flash('info','Message Has Been Saved');
        $cMSG = $msg_id;
        return array(
            'fail' => false,
            'url' => route('scheduler',['msg' => $cMSG])
        );
    }
    public function scheduler($msg){


        $msgs = messages::findOrFail($msg);
        if($msgs->user_id != $this->user_id){
            abort(404,'Unautorized Access');
        }
        
        return view('sms.scheduler',compact('msgs'));
    }
    public function autoscheduler(Request $request){
        $groups= Input::get('group');
        $req = empty($groups) ? 'required' : '';

        $validator = Validator::make(Input::all(), ['subject' => "required|max:100",
            'recipients' => $req,
            'body' => 'required']);

        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $contactGroups = new Contact_groups();
        $sms = new Sms();
        $recipients = Input::get('recipients');
        if(!empty($groups)) {
            $group_numbers = $contactGroups->group_contacts_phone($groups);
            $recipients .= $group_numbers;
        }



        $no = ceil(strlen(Input::get('body')/160));
        $msg_id = $sms->addMessage($this->user_id,null,'autoschedule',time(),'Not Sent',$no,Input::get('subject'),Input::get('body'),$recipients);
        $request->session()->flash('info','Message Has Been Saved');
        $cMSG = $msg_id;
        return array(
            'fail' => false,
            'url' => route('autoscheduleSMS',['msg' => $cMSG])
        );
    }
    public function autoscheduleSMS($msg){

        $msgs = messages::findOrFail($msg);
        if($msgs->user_id != $this->user_id){
            abort(404,'Unautorized Access');
        }

        return view('sms.autoscheduler',compact('msgs'));
    }
    public function postSchedule(Request $request){
        $inputNo = Input::get('No');
        $rules = [];
        $gets = [];
        for($i=1;$i<=$inputNo;$i++){
            $key = "schedule-".$i;
            $value= "max:17";
            $gets[] = $key;
            $rules[$key] = $value;
        }
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $msg = new messages();
        $msgValues = $msg::find(Input::get('msg_id'));
        $num = 0;
        foreach($gets as $get){
            $value = Input::get($get);
            if(!empty($value)){
                $queue = new queues();
                $queue->user_id = $this->user_id;
                $queue->campaign_id = Input::get('cam_id');
                $queue->subject = $msgValues->subject;
                $queue->content = $msgValues->content;
                $queue->recipients = $msgValues->recipients;
                $date_time = date_create($value);
                $timestamp = date_timestamp_get($date_time);
                $queue->sending_date_time = $timestamp;
                $queue->method = "schedule";
                $queue->status = "not sent";
                $queue->save();
                $num++;
            }

        }

        $request->session()->flash('info',"$num Messages Successfully Scheduled.");

        return array(
            'fail' => false,
            'msg' => "Messages Successfully Scheduled.",
        );



    }
    public function autogetBirthday(){
        return view('sms.autoscheduler.birthday');
    }
    public function autogetDates(){
        $dates = DB::table('special_dates')->where('user_id',$this->user_id)->orWhere('user_id','0')->get();
        return view('sms.autoscheduler.dates',compact('dates'));
    }
    public function autogetFrequency(){

        return view('sms.autoscheduler.frequency');
    }
    public function adddate(){

        $validator = Validator::make(Input::all(), [
            'name' => 'required',
            'date' => 'required']);

        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray(),
                );
        }

        $sdate = new special_dates();

        $sdate->user_id = $this->user_id;
        $sdate->date_name = Input::get('name');
        $sdate->date = Input::get('date');
        $sdate->save();


        return array(
            'fail' => false,
            'msg' => 'success'
        );

    }
    public function schedulebirthday(Request $request){
        $validator = Validator::make(Input::all(), [
            'birthday_time' => 'required']);

        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray(),
            );
        }

        $autoSave = new autoscheduler();
        $autoBirthday = new auto_birthday();


        $autoSave->user_id = $this->user_id;
        $autoSave->campaign_id = null;
        $autoSave->message_id = Input::get('msg_id');
        $autoSave->type = 'birthday';
        $autoSave->status = 'active';
        $autoSave->save();
        $auto_id = $autoSave->id;

        $autoBirthday->autoschedule_id = $auto_id;
        $autoBirthday->time = Input::get('birthday_time');
        $autoBirthday->save();

        $request->session()->flash('info',"Your Message Has Been Auto Scheduled");
        return array(
            'fail' => false,
        );

    }
    public function schedulefrequency(Request $request){
        $validator = Validator::make(Input::all(), [
            'frequency_no' => 'required',
            'frequency_type' => 'required',
            'time_of_day' => 'required',
            'start_date' => 'required',
            'end_date' => 'required']);

        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray(),
            );
        }

        $autoSave = new autoscheduler();
        $autofrequency = new auto_frequency();


        $autoSave->user_id = $this->user_id;
        $autoSave->campaign_id = null;
        $autoSave->message_id = Input::get('msg_id');
        $autoSave->type = 'frequency';
        $autoSave->status = 'active';
        $autoSave->save();
        $auto_id = $autoSave->id;

        $autofrequency->autoschedule_id = $auto_id;
        $autofrequency->no_frequency = Input::get('frequency_no');
        $autofrequency->frequency_type = Input::get('frequency_type');
        $autofrequency->time = Input::get('time_of_day');
        $autofrequency->start_date = Input::get('start_date');
        $autofrequency->end_date = Input::get('end_date');
        $list = $this->get_dates(Input::get('frequency_no'),Input::get('frequency_type'),Input::get('start_date'),Input::get('end_date'));
        $autofrequency->date_list = $list;
        $autofrequency->save();

        $request->session()->flash('info',"Your Message Has Been Auto Scheduled");
        return array(
            'fail' => false,
        );

    }
    private function get_dates($no,$type,$startDate,$endDate){

            $start = date_create_from_format("Y/m/d", $startDate);
            $end = date_create_from_format("Y/m/d", $endDate);

            $value = [];
            for ($i = date_timestamp_get($start); $i <= date_timestamp_get($end); $i = date_timestamp_get(date_add($start, date_interval_create_from_date_string("$no $type")))) {
                $value[] = date("Y/m/d", $i);
            }

            $p = json_encode($value);

            return $p;

    }
    public function scheduledates(Request $request){
        $validator = Validator::make(Input::all(), [
            'date_value' => 'required',
            'date_time' => 'required'
        ]);

        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray(),
            );
        }

        $autoSave = new autoscheduler();
        $autoDate = new auto_date();


        $autoSave->user_id = $this->user_id;
        $autoSave->campaign_id = null;
        $autoSave->message_id = Input::get('msg_id');
        $autoSave->type = 'dates';
        $autoSave->status = 'active';
        $autoSave->save();
        $auto_id = $autoSave->id;

        $autoDate->autoschedule_id = $auto_id;
        $autoDate->date = Input::get('date_value');
        $autoDate->time  = Input::get('date_time');;
        $autoDate->save();

        $request->session()->flash('info',"Your Message Has Been Auto Scheduled");
        return array(
            'fail' => false,
        );

    }

}
