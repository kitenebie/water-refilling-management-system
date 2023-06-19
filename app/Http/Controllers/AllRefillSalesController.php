<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllRefillSalesController extends Controller
{
    //

    function AddRefillSale(Request $request){
        echo $request->numberOFgallon. '<hr>';
        echo $request->refillCost. '<hr>';
        echo $request->refilltotal_amount. '<hr>';
        echo session()->get(env('USER_SESSION_KEY')). '<hr>';
        echo "working";
    }
}
