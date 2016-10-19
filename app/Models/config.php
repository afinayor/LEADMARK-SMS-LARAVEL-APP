<?php

namespace leadmark\Models;

use Illuminate\Database\Eloquent\Model;
//        for now will update the balance whenever the sms class is called Later
//        remember to update using the scheduller
use GuzzleHttp\Client;
class config extends Model
{
    //
    public $AppUnit,$sms_username,$sms_password;

    public $timestamps = false;

//    ('http://www.estoresms.com/smsapi.php',array('username'=>"$username",
//'password'=>"$password",'balance'=>'true')


    public function getAppUnit(){
//
//        $client = new Client();
//
//        $val1  = config::where('title','sms_username')->get()->first();
//        $username = $val1->value;
//
//        $val2 = config::where('title','sms_password')->get()->first();
//
//        $password = $val2->value;
//
//        $result = $client->request('GET', 'http://www.estoresms.com/smsapi.php', [
//            'query' => ['username' => $username,'password'=>$password,'balance'=>'true']
//        ]);
//        $unit = $result->getBody();
//
//        $sms_unit = $this::find(1);
//        $sms_unit->value = $unit;
//        $sms_unit->save();

        $unit = config::where('title','sms_unit')->get()->first();

        return $unit->value;
    }
    public function changeAppUnit($value){
        $unit = config::where('title','sms_unit')->get()->first();
        $unit->value = $value;
        $unit->save();
        return true;
    }

    public function getSms_Username(){
        $unit = config::where('title','sms_username')->get()->first();

        return $unit->value;
    }
    public function getSms_Password(){
        $unit = config::where('title','sms_password')->get()->first();

        return $unit->value;
    }

    public function getConfig($title){
        $value = config::where('title',$title)->get()->first();

        return $value->value;
    }

}
