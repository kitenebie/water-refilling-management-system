<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogInModel;

class LandingPage extends Controller
{
    //* create a contructior
    private $construct;
    function __contructor(){
        return $this->construct = new LogInModel();
    }
    //* Home Page redirect
    function HomePage(){
        return view('index');
    }

    function about_us(){
        return view('About');
    }

    function feature(){
        return view('features');
    }

    function login(){
        return view('log-in');
    }

    function sign_up(){
        return view('sign-up');
    }

    function privacy(){
        return view('privacy');
    }

    function terms(){
        return view('terms');
    }

    function contact()    {
        return view('contact');
    }

    function logout(){
        session()->forget(env('USER_SESSION_KEY'));
        session()->forget(env('USER_SESSION_AUTHENTICATION_ID'));
        return view('log-in');
    }

}
