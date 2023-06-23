<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogInModel;
use App\Models\reseller_request;

class UserRegisterLogin extends Controller
{
    private $construct;
    private $constructReseller;
    function __construct()
    {
        if(session()->get(env('USER_SESSION_KEY'))){  
            $this->construct = new LogInModel();
            $this->constructReseller = new reseller_request();
            return $this;
        }else{ 
            return view('log-in');
        }
    }

    //* Save new user
    function register(Request $request){
        $records = $this->construct->find_username($request->email);
            if(!$records->count() > 0){
                $data = [
                    'reseller_id' => $request->Reseller_ID,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'address' => $request->address,
                    'Birthday' => $request->Birthday,
                    'contact' => $request->contact,
                    'email' => $request->email,
                    'password' => hash("md5",$request->password),
                    'user_authe' => env('USER_CREDINTIAL_RESELLER'),
                    'Status' => env('USER_STATUS_STATE_TWO')
                ];
                $dataReq = [
                    'reseller_id' => $request->Reseller_ID,
                    'status' => env('USER_STATUS_STATE_TWO')
                ];
                $this->construct->save_account($data);
                $this->constructReseller->save_request($dataReq);
                return back()->with('success', 'sent successfully!');
            }else{
                return redirect('sign-up')->withErrors('exist');
            }
    }
    //*login redirect
    function log_in(){
        return view('log-in');
    }
    //*login account
    function login(Request $login_data){
        $data=[
            'email' => $login_data->emailadd,
            'password' => hash("md5",$login_data->pwd),
        ];
        $check_account = $this->construct->login($data);
        $Pending_account = $this->construct->loginPending($data);
        if($Pending_account->count() > 0){
            foreach($Pending_account as $pedingAcc){
                if($pedingAcc->email == $data['email'] && $pedingAcc->password == $data['password']){
                    $applicantData = [
                        'fullName' => $pedingAcc->lastname . ", ".$pedingAcc->firstname,
                        'userID' => $pedingAcc->reseller_id,
                        'email' => $pedingAcc->email
                    ];
                    return view('Applicant-waiting-dashboard', compact('applicantData'));
                }
            }
        }else{
            if($check_account->count() > 0){
                foreach($check_account as $account){
                    if($account->email == $data['email'] && $account->password == $data['password']){
                        // Store a value in the session
                        session()->put(env('USER_SESSION_KEY'), $account->reseller_id);
                        session()->put(env('USER_SESSION_AUTHENTICATION_ID'), $account->user_authe);
                        session()->put(env('USER_SESSION_AUTHENTICATION_NAME'), $account->firstname);
                        // Retrieve a value from the session
                        $reqData = $this->construct->getALLrequest();
                        return redirect('dashboard')->with('success', 'login successfully!', ['reqData' => $reqData]);
                    }
                }
            }else{
                return back()->withErrors('Invalid email or password');
            }
        }
    }

}
