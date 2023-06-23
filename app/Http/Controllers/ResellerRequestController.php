<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reseller_request;

class ResellerRequestController extends Controller
{
    //
    private $constructreseller_request;
    function __construct()
    {
        if(session()->get(env('USER_SESSION_KEY'))){  
            $this->constructreseller_request = new reseller_request();
            return $this;
        }else{ 
            return view('log-in');
        }
    }

}
