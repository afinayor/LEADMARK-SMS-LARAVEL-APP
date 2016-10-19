<?php

namespace leadmark\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_groups extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contact_groups';

    /**
     * belongs to users relationship
     **/
    public function user(){
        return $this->belongsTo('leadmark\Models\User');
    }

    public function contacts(){
        return $this->hasMany('leadmark\Models\Contacts');
    }
    public function get_groups($user_id){
        $groups = $this::all()->where('user_id',$user_id);
        return $groups;
    }
    public function group_contacts_phone($groups=array()){
        $group_numbers = "";
        $group_contacts = $this::find($groups);
        foreach($group_contacts as $group){

            $contacts = $group->contacts;
            foreach($contacts as $contact){

                $phone = $contact->phone;
                if(!empty($phone)){
                    $group_numbers .= ','.$phone;
                }
            }

        }
        return $group_numbers;
    }

}
