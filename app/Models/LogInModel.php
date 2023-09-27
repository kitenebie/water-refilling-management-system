<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogInModel extends Model
{
    use HasFactory;

    protected $guarded = [];

    //* User Authentication Login
    function login($data){
        return $this->where('username', $data['username'])->where('password', $data['password'])->where('status', 'Active')->get();
    }

    function loginPending($data){
        return $this->where('username', $data['username'])->where('password', $data['password'])->where('status', 'Pending')->get();
    }
    //* User Authentication Register
    function find_username($username){
        return $this->where('username', $username)->get();
    }
    //* save account
    function save_account($data){
        return $this->create($data);
    }
    //* find resellerID
    function FindResellerID($reseller_id){
        return $this->where('reseller_id',$reseller_id)->get();
    }

    //*get opending status
    function getALLrequest(){
        return $this->where('Status', 'Pending')->get();
    }

    function getResellerID($rsID){
        return $this->where('Status', 'Pending')->where('reseller_id', $rsID)->get();
    }

    function ApprovalRequest($ID, $Token){
        return $this->where('id', $ID)->update(['Status' => 'Approved', 'Token' => $Token]);
    }

    function ApprovalRequestToken($Token){
        return $this->where('Token', $Token)->update(['Status' => 'Active', 'Token' => '']);
    }

    function DeclineRequest($ID){
        return $this->where('id', $ID)->delete();
    }

    function storeNewUpdateProfile($data){
        return $this->where('reseller_id', session()->get(env('USER_SESSION_KEY')))
             ->update($data);
    }

    function getDetails(){
        return $this->where('reseller_id', session()->get(env('USER_SESSION_KEY')))->get();
    }

    function getMembers(){
        return $this->where('user_authe', '=', 'Reseller')
                ->where('Status', '=', 'Active')->get();
    }

    function checkEmailAddress($email, $pwd)
    {
        $result =  $this->where('username', '=', $email)->get();
        if($result->count() > 0)
        {
            $url = env('URL_WEB_EMAIL');
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_POSTFIELDS => http_build_query([
                    "recipient" => $email,
                    "subject"   => 'Password Change Verification',
                    "body"      => 'Dear ['.$email.'],'.PHP_EOL.
                    PHP_EOL.PHP_EOL.
                    'We have received a request to change your password for your Jonel\'s Water Refilling Station  account. To ensure the security of your account, please verify your email address by clicking the link below:'.
                    PHP_EOL.PHP_EOL.
                    'http://127.0.0.1:8000/Change-My-Password/'. $email. '/'.hash('md5',$pwd).
                    PHP_EOL.PHP_EOL.
                    'If you did not initiate this password change request, please ignore this email, and your account password will remain unchanged. It is possible that someone else may have entered your email address by mistake.'.
                    PHP_EOL.PHP_EOL.
                    'If you have any questions, please do not hesitate to contact us.'.
                    PHP_EOL.PHP_EOL.
                    'Thank you,'.PHP_EOL.
                    'Jonel Water Refilling Station'
                ])
            ]);
            curl_exec($ch);
            return true;
        }
        return false;
    }
    function channgeNewPwd($email, $pwd)
    {
        return $this->where('username', '=', $email)->update(['password'=>$pwd]);
    }
}
