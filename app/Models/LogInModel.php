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
        return $this->where('email', $data['email'])->where('password', $data['password'])->where('status', 'Active')->get();
    }

    function loginPending($data){
        return $this->where('email', $data['email'])->where('password', $data['password'])->where('status', 'Pending')->get();
    }
    //* User Authentication Register
    function find_username($email){
        return $this->where('email', $email)->get();
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

    function ApprovalRequest($ID){
        return $this->where('id', $ID)->update(['Status' => 'Active']);
    }

    function DeclineRequest($ID){
        return $this->where('id', $ID)->delete();
    }
}
