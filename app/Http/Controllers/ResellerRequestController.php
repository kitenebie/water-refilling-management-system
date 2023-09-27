<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reseller_request;
use App\Models\refillRequest;

class ResellerRequestController extends Controller
{
    //
    private $constructreseller_request, $refillRequest;
    function __construct()
    {
            $this->constructreseller_request = new reseller_request();
            $this->refillRequest = new refillRequest();
            return $this;
    }
    function update_changeRefill(Request $change)
    {
        $data = [
            'NumberOfGallon' => $change->newQTY,
            'TotalCost' => ($change->pymentMeth != 'Walk in' && $change->newQTY < 10) ? ($change->newQTY*($change->refill_cost+$change->shifee)) : ($change->newQTY*$change->refill_cost),
           
        ];
        $this->refillRequest->update_Refill($change->orderID, $data);
        return back()->with('updated', 'done!');

    }
}
