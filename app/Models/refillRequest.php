<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refillRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    function SaveRefillRequest($refillrequestDATA){
        return $this->create($refillrequestDATA);
    }

    function RefillPendingData(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('status', 'Pending')
                        ->where('Reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->sum('TotalCost');
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Pending')
                        ->sum('TotalCost');
        }
    }
    function RefillProccessData(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('status', 'Process')
                        ->where('Reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->sum('TotalCost');
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Process')
                        ->sum('TotalCost');
        }
    }
}
