<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refillRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    function SaveRefillRequest($refillrequestDATA){
        var_dump($refillrequestDATA);
    }
}
