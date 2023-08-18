<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogInModel;

class Member extends Controller
{
    //do something
    private $constructMembers;

    function __construct(){
        return $this->constructMembers = new LogInModel();
    }

    function members(){
        $reqData = $this->constructMembers->getMembers();
        return view('member', compact('reqData'));
    }
}
