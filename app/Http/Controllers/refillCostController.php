<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\refillCost;

class refillCostController extends Controller
{
    //do something
    private $constructrefillCost;

    function __construct(){
        return $this->constructrefillCost = new refillCost();
    }
    function RefillCost(Request $rillcost){
        $data = ['RefillCost' => $rillcost->refillCost];
        $this->constructrefillCost->createCost($data);
        return back()->with('UpdateCost', 'updated');
    }
}
