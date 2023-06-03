<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\AllSales;

class month_sale_controller extends Controller
{
    private $constructorders;
    private $constructSalse;
    // private $constructstocks;

    function __construct()
    {
        $this->constructSalse = new AllSales();
        // $this->constructstocks = new sale_stocks();
    }



}
