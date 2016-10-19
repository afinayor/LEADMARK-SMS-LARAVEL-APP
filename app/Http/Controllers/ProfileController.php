<?php

namespace leadmark\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use leadmark\Models\User;
use leadmark\Http\Requests;
use Image;

class ProfileController extends Controller
{
    //
    public function index($username){
        $user = User::where('username',$username)->first();
        if(!$user){
            abort(404);
        }
        $data['user'] = $user;
        return view('front.profile',$data);
    }
    public function update(){
        return view('front.editprofile');
    }
    public function postupdate(Request $request){
        $this->validate($request,[
            'first_name'      =>  'max:100|required',
            'last_name'      =>  'max:100',
            'phone'      =>  'digits_between:10,15',
            'birthday'   =>  'max:100',
            'title'   =>  'max:254',
            'address' => 'max:399',
            'website' => 'max:100',
            'facebook' => 'max:50',
            'twitter' => 'max:50',
            'linkedin' => 'max:50',
            'instagram' => 'max:50',
            'google' => 'max:50',
            'image' => 'mimes:jpeg,png,gif',
        ]);
        $update = [
            'first_name'      =>  $request->input('first_name'),
            'last_name'      =>  $request->input('last_name'),
            'phone'      =>  $request->input('phone'),
            'title'   =>  $request->input('title'),
            'birthday'   =>  $request->input('birthday'),
            'address' => $request->input('address'),
            'website' => $request->input('website'),
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'linkedin' => $request->input('linkedin'),
            'instagram' => $request->input('instagram'),
            'google_plus' => $request->input('google'),
        ];
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = Auth::User()->username . '.' . $image->getClientOriginalExtension();
            $imge_path = "images\\profile-photos\\";
            Image::make($image)->resize(300,300)->save(public_path($imge_path.$filename));
            $update['profile_pic'] = $filename;
        }

        Auth::User()->update($update);

        return redirect()->
        route('update_profile')->
        with('info','Your profile has been updated.');
    }
}
