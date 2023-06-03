<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reseller_request;

class ResellerRequestController extends Controller
{
    //
    private $constructreseller_request;
    function __construct()
    {
        return $this->constructreseller_request = new reseller_request();
    }

}
