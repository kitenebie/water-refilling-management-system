<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notifications extends Model
{
    use HasFactory;
    protected $guarded = [];

    function saveNotification($data){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            $this->create($data);
        }
        return $this;
    }

    function deleteNotification(){
        return $this->where('username', session()->get('username'))->delete();
    }

    function getNotificationUser(){
        $notifications = $this->where('username', session()->get('username'))
            ->where('nloop', '>', 0)
            ->where('ntime', '<=', now())
            ->get();
        return $notifications;

	}	

}
