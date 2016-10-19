<?php

namespace leadmark\Http\Controllers;

use Illuminate\Http\Request;

use leadmark\Http\Requests;

class LoginController extends Controller
{
    private $data = array();
    public function index()
    {

        $data['title'] = " Login - Leadmark - No 1 Marketing app";


        return view('authn.signin',$data);

    }
}
