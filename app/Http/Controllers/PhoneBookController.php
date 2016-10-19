<?php

namespace leadmark\Http\Controllers;

use Illuminate\Http\Request;

use leadmark\Http\Requests;
use Auth;
use leadmark\Models\User;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Support\Facades\Validator;
use leadmark\Models\Contacts;
use leadmark\Models\Contact_groups;

class PhoneBookController extends Controller
{
    public function __construct(){
        Session::put('phonebook.default','1');
    }
    public function index(){
//        Session::flush();
        $groups = Contact_groups::all()->where('user_id',Auth::User()->id);
        return view('phonebook.index',[ 'groups' => $groups]);
    }
    public function getList()
    {

        $groups = Contact_groups::all()->where('user_id',Auth::User()->id);
        Session::put('current_tab','1');
        Session::put('phonebook_group', Input::has('test') ? Input::get('group') : (Session::has('phonebook_group') ? Session::get('phonebook_group') : '*'));
        Session::put('phonebook_search_type', Input::has('by') ? Input::get('type') : (Session::has('phonebook_search_type') ? Session::get('phonebook_search_type') : 'name'));
        Session::put('phonebook_search', Input::has('ok') ? Input::get('search') : (Session::has('phonebook_search') ? Session::get('phonebook_search') : ''));
        Session::put('phonebook_field', Input::has('field') ? Input::get('field') : (Session::has('phonebook_field') ? Session::get('phonebook_field') : 'name'));
        Session::put('phonebook_sort', Input::has('sort') ? Input::get('sort') : (Session::has('phonebook_sort') ? Session::get('phonebook_sort') : 'asc'));
        $phonebooks = Contacts::where('contact_groups_id',(Session::get('phonebook_group') !== '*')?'=':'<>',(Session::get('phonebook_group') !== '*')?Session::get('phonebook_group'):'*')
            ->where(Session::get('phonebook_search_type'), 'like', '%' . Session::get('phonebook_search') . '%')
            ->where('user_id',Auth::User()->id)
//            ->orwhere('email','like','%' . Session::get('phonebook_search') . '%')
//            ->orwhere('phone','like','%' . Session::get('phonebook_search') . '%')
            ->orderBy(Session::get('phonebook_field'), Session::get('phonebook_sort'))->paginate(20);
        return view('phonebook.list', ['contacts' => $phonebooks, 'groups' => $groups]);
    }
    public function genForm(){

        $number = Input::has('no') ? Input::get('no'):2;
        $last = Input::get('last');
        $content = "";
        for($i=0;$i<$number;$i++){
            ++$last;
            $content .= '
        <div class="col-md-6">
            <div class="panel panel-info p_id_unique">
            <div id="panel_'.$last.'" class="panel-heading">
                <h3 class="panel-title">Contact '.$last.'</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-4 form-group" id="form-name_'.$last.'-error">
                        <label for="" class="control-label">Name</label>

                        <div class="">
                            <input name="name_'.$last.'" type="text" class="form-control" id="" placeholder="">
                        </div>
                        <span id="name_'.$last.'-error" class="help-block"></span>
                    </div>
                    <div class="col-md-4 form-group" id="form-phone_'.$last.'-error">
                        <label for="" class="control-label">Phone</label>

                        <div class="">
                            <input name="phone_'.$last.'" type="text" class="form-control" id="" placeholder="">
                        </div>
                        <span id="phone_'.$last.'-error" class="help-block"></span>
                    </div>
                    <div class="col-md-4 form-group" id="form-email_'.$last.'-error">
                        <label for="" class="control-label">Email</label>

                        <div class="">
                            <input name="email_'.$last.'" type="text" class="form-control" id="" placeholder="">
                        </div>
                        <span id="email_'.$last.'-error" class="help-block"></span>
                    </div>
                    <div class="col-md-12 form-group" id="form-birthday_'.$last.'-error">
                            <label for="" class="control-label">Birthday</label>

                            <div class="">
                                <input type="text" class="datepicker form-control" name="birthday_'.$last.'"  placeholder="">
                            </div>
                            <span id="birthday_'.$last.'-error" class="help-block"></span>
                        </div>
                    <div class="col-md-12 form-group" id="form-info_'.$last.'-error">
                        <label for="" class="control-label">Info</label>

                        <div class="">
                            <textarea name="info_'.$last.'" class="form-control" id="" placeholder=""></textarea>
                        </div>
                        <span id="info_'.$last.'-error" class="help-block"></span>
                    </div>
                </div>

            </div>
        </div>
        </div>';
        }

        return $content;
    }
    public function add_multiple(Request $request){
        $group_name = Input::get('group');
        $group = Contact_groups::all()->Where('name',$group_name);
        if($group->count() == 0){
            $new_group = new Contact_groups();
            $new_group->name = $group_name;
            $new_group->user_id = Auth::User()->id;
            $new_group->save();
            $group_id = Contact_groups::all()->Where('name',$group_name)->first()->id;
        }else{
            $group_id = $group->first()->id;
        }

        $no = Input::get('no_of_contacts');
        $rules = array('group'=>'required|max:50');
        for($x=1;$x<=$no;$x++){
            $name = "name_".$x;
            $email = "email_".$x;
            $phone = "phone_".$x;
            $birthday = "birthday_".$x;
            $info = "info_".$x;
            $rules[$name] = 'max:200';
            $rules[$email] = 'max:200|email';
            $rules[$phone] = 'digits_between:10,15';
            $rules[$birthday] = 'max:11';
            $rules[$info] = 'max:750';
        }



        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $val = 0;
        for($l=1;$l<=$no;$l++){
            $name = "name_".$l;
            $email = "email_".$l;
            $phone = "phone_".$l;
            $birthday = "birthday_".$l;
            $info = "info_".$l;


            if((Input::get($name) != "") || (Input::get($email) != "") || (Input::get($phone) != "") || (Input::get($birthday) != "") || (Input::get($info) != "")){
                $val++;
                $contact = new Contacts();
                $contact->name = Input::get($name);
                $contact->phone = Input::get($phone);
                $contact->email = Input::get($email);
                $contact->birthday = Input::get($birthday);
                $contact->info = Input::get($info);
                $contact->contact_groups_id = $group_id;
                $contact->user_id = Auth::User()->id;
                $contact->save();
            }

        }

        $request->session()->flash('info',$val.' contacts have been saved');
        Session::put('phonebook.default','4');
        return ['url' => 'phonebook/list'];
//        return redirect()->route('phonebook')->with('info','Your contacts have been saved');

    }

    public function groups(){
        $groups = Contact_groups::all()->where('user_id',Auth::User()->id);
        return view('phonebook/groups',['groups'=>$groups]);
    }
    public function updategroup($group_id){
        $group = Contact_groups::where('id',$group_id)
            ->where('user_id',Auth::User()->id)->first();
        if(!$group){
            abort(404);
        }
        return view('phonebook/updategroup',['group'=>$group]);

    }
    public function updatecontact($contact_id){
        $contact = Contacts::where('id',$contact_id)
            ->where('user_id',Auth::User()->id)->first();
        if(!$contact){
            abort(404);
        }
        $groups = Contact_groups::all()->where('user_id',Auth::User()->id);
        return view('phonebook/updatecontact',['contact'=>$contact,'groups'=>$groups]);

    }

    public function deletegroup(Request $request , $group_id){
        $group = Contact_groups::where('id',$group_id)
            ->where('user_id',Auth::User()->id)->first();
        if(!$group){
            abort(404);
        }
//        update all contacts with this group. Change them to group no group
        $contacts = $group->contacts;
        foreach($contacts as $contact){
            $contact->contact_groups_id = '0';
            $contact->user_id = '0';
            $contact->save();
        }
        $group->delete();
        $request->session()->flash('info','Group has been successfully deleted');
        Session::put('phonebook.default','3');
        return 'success';
    }
    public function deletecontact(Request $request , $contact_id){
        $contact = Contacts::where('id',$contact_id)
            ->where('user_id',Auth::User()->id)->first();
        if(!$contact){
            abort(404);
        }
//       We not deleting directly. Will just change the group so no user can see it
        $contact->user_id = '0';
        $contact->contact_groups_id = '0';
        $contact->save();

        $request->session()->flash('info','Contact has been successfully deleted');
        Session::put('phonebook.default','1');
        return 'success';
    }

    public function update_group(Request $request){
        $id = Input::get('id');
        $group = Contact_groups::where('id',$id)
            ->where('user_id',Auth::User()->id)->first();
        if(!$group){
            abort(404);
        }
        $validator = Validator::make(Input::all(), ['name' => 'required|max:100']);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $group->name = Input::get('name');
        $group->save();

        $request->session()->flash('info','The group has been successfully updated');
        Session::put('phonebook.default','3');

        return ['url' => 'phonebook/list'];

    }
    public function update_contact(Request $request){
        $id = Input::get('id');
        $contact = Contacts::where('id',$id)
            ->where('user_id',Auth::User()->id)->first();
        if(!$contact){
            abort(404);
        }
        $validator = Validator::make(Input::all(), [
            'name' => 'max:200',
            'email' =>  'max:200|email',
            'phone' =>  'digits_between:10,15',
            'birthday' => 'max:11',
            'info'  =>  'max:750',
            'group' =>  'required'

        ]);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $contact->name = Input::get('name');
        $contact->phone = Input::get('phone');
        $contact->email = Input::get('email');
        $contact->birthday = Input::get('birthday');
        $contact->info = Input::get('info');
        $contact->contact_groups_id = Input::get('group');
        $contact->save();
        Session::put('phonebook.default','1');
        return redirect()->route('phonebook')->with('info','The contact has been successfully updated');
    }
    public function addgroup(){
        return view('phonebook.create');
    }

    public function creategroup(Request $request){

        $validator = Validator::make(Input::all(), ['name' => 'required|max:100']);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $group = new Contact_groups();
        $group->name = Input::get('name');
        $group->user_id = Auth::User()->id;
        $group->save();
        Session::put('phonebook.default','3');
        return redirect()->route('phonebook')->with('info','Group has been successfully added');
    }
}
