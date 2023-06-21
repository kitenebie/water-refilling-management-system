<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefillSales;
use Illuminate\Support\Str;

class AllRefillSalesController extends Controller
{
    private $constructRefill;

    function __construct()
    {
        return $this->constructRefill = new RefillSales();
    }
    function AddProductSales(Request $request){
        echo "<center><h1>ONGOING PROGRAM</h1></center>";
    }
    function AddRefillSalesAdmin(Request $request){
        $randomNumber = Str::random(12);
        $refillData = [
            'Account_SaleID' => session()->get(env('USER_SESSION_KEY')),
            'Refill_ID' =>  $randomNumber,
            'Quantity' => $request->numberGalllon,
            'Amount' => $request->refilltotal
        ];
        $this->constructRefill->SaveRefillSales($refillData);
        return back()->with('refilled', 'Successfully Purchased!');
    }
    function AddRefillSale(Request $request){
        $randomNumber = Str::random(12);
        $refillData = [
            'Account_SaleID' => session()->get(env('USER_SESSION_KEY')),
            'Refill_ID' =>  $randomNumber,
            'Quantity' => $request->numberOFgallon,
            'Amount' => $request->refilltotal_amount
            ];
            $this->constructRefill->SaveRefillSales($refillData);
            return back()->with('refilled', 'Successfully Purchased!');
    }
}
