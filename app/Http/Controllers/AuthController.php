<?php

namespace leadmark\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use leadmark\Http\Requests;
use leadmark\Models\User;
use leadmark\Models\Users_Assets;
class AuthController extends Controller
{
    //
    public function getSignup(){
        return view('authn.register');
    }


    public function postSignup(Request $request){
        $this->validate($request,[
            'email'      =>  'email|required|max:100|unique:users',
            'phone'      =>  'digits_between:10,15|required|unique:users',
            'username'   =>  'alpha_dash|required|max:100|unique:users',
            'password'   =>  'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
            'profile_pic' => 'userprofile.png'

        ]);
        $data = User::all()->where('username',$request->input('username'))->first();
        $id = $data->id;
        Users_Assets::create([
           'user_id' => $id ,
            'sms_unit' => '3',
            'email_unit' => '3',
            'landing_page' => '3'
        ]);

        return redirect()
            ->route('home')
            ->with('info','You have successfully Created An Account.');
    }

    public function getSignin(){
        return view('authn.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt($request->only(['username','password'],$request->has('remember')))){
            return redirect()->back()->with('error','Could not sign you in with those details');
        }
        return redirect()->route('home')->with('signininfo','You are now signed in');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with('info','You have successfully logged out');
    }
}
