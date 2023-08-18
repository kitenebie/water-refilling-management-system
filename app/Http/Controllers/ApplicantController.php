<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reseller_request;
use App\Models\LogInModel;
use Illuminate\Support\Str;

class ApplicantController extends Controller
{
    //
    private $constructApplicant;
    private $constructreseller_request;
    function __construct()
    {
            $this->constructApplicant = new LogInModel();
            $this->constructreseller_request = new reseller_request();
            return $this;
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

    function AcceptApplicant($ID, $mail){
        $token = Str::random(26);
        $url = env('URL_WEB_EMAIL');
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_POSTFIELDS => http_build_query([
                    "recipient" => $mail,
                    "subject"   => 'ACCOUNT VERIFICATION SECURITY',
                    "body"      => 'Hi '.$mail.','.PHP_EOL.
                    PHP_EOL.PHP_EOL.
                    'Your account has been approved by the admin. You can now activate your account by clicking the following link:'.
                    PHP_EOL.
                    'http://127.0.0.1:8000/Activate-my-account-Token/'. $token.
                    PHP_EOL.
                    'Once you have activated your account, you will be able to log in and start using the service.'.
                    PHP_EOL.PHP_EOL.
                    'If you have any questions, please do not hesitate to contact us.'.
                    PHP_EOL.PHP_EOL.
                    'Thank you,'.PHP_EOL.
                    'Jonel Water Refilling Station'
                ])
            ]);
            curl_exec($ch);
            $this->constructApplicant->ApprovalRequest($ID, $token);
            $this->constructreseller_request->DeleteRequest($ID);
            return back()->with('success', 'sent!');
         }

    function ActivateWithToken($Token){
        $this->constructApplicant->ApprovalRequestToken($Token);
        return redirect('log-in')->with('Can_Login', 'success');
    }

    function DeclineApplicant($ID, $mail){
        // echo '<h1><a href="http://127.0.0.1:8000/applicant">DECLINED SEND EMAIL</a></h1>';
        $url = env('URL_WEB_EMAIL');
        $ch = curl_init($url);
        curl_setopt_array($ch, [
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_POSTFIELDS => http_build_query([
              "recipient" => $mail,
              "subject"   => 'ACCOUNT VERIFICATION SECURITY',
              "body"      => 'Hi '.$mail.','.PHP_EOL.
              PHP_EOL.PHP_EOL.
              'We are writing to inform you that your account has been rejected. We apologize for any inconvenience this may cause.'.
              PHP_EOL.PHP_EOL.
              'If you have any questions, please do not hesitate to contact us.'.
              PHP_EOL.PHP_EOL.
              'Thank you,'.PHP_EOL.
              'Jonel Water Refilling Station'
           ])
        ]);
        curl_exec($ch);
        $this->constructApplicant->DeclineRequest($ID);
        $this->constructreseller_request->DeleteRequest($ID);
        return back()->with('Deleted', 'deleted!');
     }

    }


