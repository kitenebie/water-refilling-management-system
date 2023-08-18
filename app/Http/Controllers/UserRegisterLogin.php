<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogInModel;
use App\Models\reseller_request;
use App\Http\Controllers\NotificationController;

class UserRegisterLogin extends Controller
{
    private $construct, $constructReseller, $NotificationController;
    function __construct()
    {
            $this->construct = new LogInModel();
            $this->constructReseller = new reseller_request();
            $this->NotificationController = new NotificationController();
            return $this;
    }

    //* Save new user
    function register(Request $request){
        $records = $this->construct->find_username($request->username);
            if(!$records->count() > 0){
                $data = [
                    'reseller_id' => $request->Reseller_ID,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'address' => $request->address,
                    'Birthday' => $request->Birthday,
                    'contact' => $request->contact,
                    'username' => $request->username,
                    'password' => hash("md5",$request->password),
                    'user_authe' => env('USER_CREDINTIAL_RESELLER'),
                    'Token' => '',
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
            'username' => $login_data->username,
            'password' => hash("md5",$login_data->pwd),
        ];
        $check_account = $this->construct->login($data);
        $Pending_account = $this->construct->loginPending($data);
        if($Pending_account->count() > 0){
            foreach($Pending_account as $pedingAcc){
                if($pedingAcc->username == $data['username'] && $pedingAcc->password == $data['password']){
                    $applicantData = [
                        'fullName' => $pedingAcc->lastname . ", ".$pedingAcc->firstname,
                        'userID' => $pedingAcc->reseller_id,
                        'username' => $pedingAcc->username
                    ];
                    return view('Applicant-waiting-dashboard', compact('applicantData'));
                }
            }
        }else{
            if($check_account->count() > 0){
                foreach($check_account as $account){
                    if($account->username == $data['username'] && $account->password == $data['password']){
                        // Store a value in the session
                        session()->put(env('USER_SESSION_KEY'), $account->reseller_id);
                        session()->put(env('USER_SESSION_AUTHENTICATION_ID'), $account->user_authe);
                        session()->put(env('USER_SESSION_AUTHENTICATION_NAME'), $account->firstname);
                        session()->put('username', $account->username);
                        session()->put(env('USER_CURRENT_ADDRESS'), $account->address);
                        $this->NotificationController->delete_Notification();
                        // Retrieve a value from the session
                        $reqData = $this->construct->getALLrequest();
                        $this->NotificationController->Save_Reseller_Stocks();
                        return redirect('dashboard')->with('success', 'login successfully!', ['reqData' => $reqData]);
                    }
                }
            }else{
                return back()->withErrors('Invalid username or password');
            }
        }
    }

}
