<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddressFee;

class LandingPage extends Controller
{
    //* create a contructior
    private $construct;
    function __construct(){
            $this->construct = new AddressFee();
            return $this;
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
        session()->forget(env('USER_SESSION_KEY'));
        session()->forget(env('USER_SESSION_AUTHENTICATION_ID'));
        return view('log-in');
    }

    function sign_up(){
        $addresses = $this->construct->Address();
        return view('sign-up', compact('addresses'));
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
        if(session()->get(env('USER_SESSION_KEY'))){
            session()->forget(env('USER_SESSION_KEY'));
            session()->forget(env('USER_SESSION_AUTHENTICATION_ID'));
            return view('log-in');
        }else{
            return view('log-in');
        }
    }

    // function loader(){
    //     return view('loading');
    // }
}
