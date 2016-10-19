<?php

namespace leadmark\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use leadmark\Http\Requests;

class ChangepasswordController extends Controller
{
    //
    public function index(){
        return view('authn.changepassword');
    }
    public function update(Request $request){
//        Validator::extend('password',function($attribute,$value,$parameters){
//            return false;
//        });


        $this->validate($request,[
            'current_password' => 'required|password',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        Auth::User()->update([
            'password' => bcrypt($request->input('new_password')),
        ]);

        return redirect()->route('change_password')->with('info','Your password has been updated');
    }
}
