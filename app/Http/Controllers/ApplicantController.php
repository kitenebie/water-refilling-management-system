<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reseller_request;
use App\Models\LogInModel;

class ApplicantController extends Controller
{
    //
    private $constructApplicant;
    private $constructreseller_request;
    function __construct()
    {
        if(session()->get(env('USER_SESSION_KEY'))){   
            $this->constructApplicant = new LogInModel();
            $this->constructreseller_request = new reseller_request();
            return $this;
        }else{ 
            return view('log-in');
        }
    }

    function applicantRequest(){
        if(session()->get(env('USER_SESSION_KEY')) && session()->get(env('USER_SESSION_AUTHENTICATION_ID')) == env('USER_CREDINTIAL_ADMIN')){
            $reqData = $this->constructApplicant->getALLrequest();
            return view('applicant', compact('reqData'));
        }else{
            return view('log-in');
        }
    }

    function RequestNotification($rsID){
        $Data = $this->constructApplicant->getResellerID($rsID);
        return view('applicant', compact('Data'));
    }

    function AcceptApplicant($ID){
        $this->constructApplicant->ApprovalRequest($ID);
        $this->constructreseller_request->DeleteRequest($ID);
        echo '<h1><a href="http://127.0.0.1:8000/applicant">APPROVEED SEND EMAIL</a></h1>';
    }

    function DeclineApplicant($id){
        $this->constructApplicant->DeclineRequest($id);
        $this->constructreseller_request->DeleteRequest($id);
        echo '<h1><a href="http://127.0.0.1:8000/applicant">DECLINED SEND EMAIL</a></h1>';
    }
}

