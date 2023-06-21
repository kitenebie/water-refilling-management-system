<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefillSales;
use App\Models\refillRequest;
use Illuminate\Support\Str;

class AllRefillSalesController extends Controller
{
    private $constructRefill, $constructrefillRequest;

    function __construct()
    {
        $this->constructRefill = new RefillSales();
        $this->constructrefillRequest = new refillRequest();
        return $this;
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

    function AcceptRequest($ref_ID){
        $this->constructrefillRequest->Accept_refill($ref_ID);
        return back()->with('Accepted', 'Successfull');
    }
    
    function CompleteRequest(Request $request){
        $ref_DATA = [
            'Account_SaleID' =>  session()->get(env('USER_SESSION_KEY')),
            'Refill_ID' => Str::random(12),
            'Quantity' => $request->Quantity,
            'Amount' => $request->Amount
        ];
        $this->constructrefillRequest->completed_refill($request->id);
        $this->constructRefill->SaveRefillSales($ref_DATA);
        return back()->with('Completed', 'Successfull');
    }

    function refilltoreceive(){
        $label_title = "Process Refill Request";
        $statusRefill = $this->constructrefillRequest->statusProcessRefill();
        return view('Refill-Request', compact('statusRefill','label_title')); 
    }

    function refilltocompleted(){
        $label_title = "Completed Refill Request";
        $statusRefill = $this->constructrefillRequest->statusCompleteRefill();
        return view('Refill-Request', compact('statusRefill','label_title')); 
    }
}
