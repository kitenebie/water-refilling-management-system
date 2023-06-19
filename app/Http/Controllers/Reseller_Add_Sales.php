<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllSales;

class Reseller_Add_Sales extends Controller
{
    //
    private $Contruct_AllSales;

    function __construct(){
        return $this->Contruct_AllSales = new AllSales();
    }

    function RessellerProductAddToSales(Request $request){
        $Items_data = [
            'Account_SaleID' => session()->get(env('USER_SESSION_KEY')),
            'ProductID' => $request->product_id,
            'Quantity' => $request->Cqty,
            'Amount' => $request->total_amount
        ];
        $this->Contruct_AllSales->AddResellerSales($Items_data);
        return back()->with('AddedSales', 'Order has been saved!');
    }
}
