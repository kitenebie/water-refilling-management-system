<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
}
