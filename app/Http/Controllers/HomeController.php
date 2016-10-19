<?php

namespace leadmark\Http\Controllers;

use Illuminate\Http\Request;

use leadmark\Http\Requests;

class HomeController extends Controller
{
    private $data = array();
    public function index()
    {

        $data['title'] = " Home - Leadmark - No 1 Marketing app";


        return view('front.home',$data);

    }
}
