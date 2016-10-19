<?php
namespace leadmark\Http;

use Auth;
use Log;
use Hash;
use leadmark\Models\User;

class CustomValidator{

    public function validatePassword($attribute,$value,$parameters,$validator){

        $password = Auth::User()->password;
        $userPassword = Hash::make($value);
//        Log::info('The password from the database is '.$password.' while user input is '. $userPassword. ' ||| '.$value);
        if(Hash::check($value,$password)){
            return true;
        }
        return false;
    }
}