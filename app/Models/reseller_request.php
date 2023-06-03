<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reseller_request extends Model
{
    use HasFactory;
    protected $guarded = [];

    function getResellerRequest(){
        return $this->where('status', 'Pending')->get();
    }

    function save_request($dataReq){
        $this->create($dataReq);
    }

    function DeleteRequest($ID){
        return $this->where('id', $ID)->delete();
    }
}
