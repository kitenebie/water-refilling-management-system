<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\LogInModel;
use App\Models\AllSales;
use App\Models\RefillSales;
use App\Models\products;
use App\Models\client_stocks;
use App\Models\orders;

class dashboardController extends Controller
{

    private $constructSalse, $constructRefill, $constructApplicant, $constructProduct,
            $constructclient_stocks, $constructOrders;
    //* for total_income


    function __construct()
    {
        $this->constructApplicant = new LogInModel();
        $this->constructSalse = new AllSales();
        $this->constructRefill = new RefillSales();
        $this->constructProduct = new products();
        $this->constructclient_stocks = new client_stocks();
        $this->constructOrders = new orders();
    }

    function dashboard(){
        $reqData = $this->constructApplicant->getALLrequest();
        //*
        $this->constructclient_stocks->GetTotalSumOfAllUserStocks();
        if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            $this->constructProduct->getALLAdminStocks();
        }
        $this->constructSalse->GetAllUserCurrentYearlySALE(date('Y'));
        //*
        $RecentOrders = $this->constructOrders->getAllpendingOrders();
        $orders_DATA = $this->constructOrders->OrdersPendingProcessData();
        return view('dashboard', compact('reqData', 'RecentOrders', 'orders_DATA'));
    }

    function MyService(){
        $productData = $this->constructProduct->get_products();
        $RecentOrders = $this->constructOrders->getAllpendingOrders();
        return view('My-service', compact('productData', 'RecentOrders'));
    }

    function getsalesmonth(){
        $Currentsales = $this->constructSalse->getMonthlySales();
        $AllSale = $this->constructSalse->getALLSales();
        $Salesyearly = 0;
        foreach($AllSale as $YEARsALE){
            $Salesyearly = $YEARsALE->TotalSales;
        }

        $refillSALES = $this->constructRefill->RefillgetMonthlySales();
        $AllRefillSale = $this->constructRefill->getRefillALLSales();
        $yearlyrefilSale = 0;
        foreach($AllRefillSale as $refillSALE){
            $yearlyrefilSale = $refillSALE->TotalSales;
        }

       // Sum Amount column for each month from refill_sales table
        $refillSales = DB::table('refill_sales')
        ->select(DB::raw('MONTH(created_at) AS month'), DB::raw('SUM(Amount) AS refillAmount'))
        ->where('Account_SaleID', session()->get('key'))
        ->whereYear('created_at', '=',  date('Y'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

        // Sum Amount column for each month from all_sales table
        $allSales = DB::table('all_sales')
        ->select(DB::raw('MONTH(created_at) AS month'), DB::raw('SUM(Amount) AS allAmount'))
        ->where('Account_SaleID', session()->get('key'))
        ->whereYear('created_at', '=',  date('Y'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

        // Combine the sums from both tables
        $Generalsales = collect([]);
            foreach ($refillSales as $refill) {
            $month = $refill->month;
            $refillAmount = $refill->refillAmount;
            $allAmount = $allSales->where('month', $month)->first()->allAmount;
            $totalAmount = $refillAmount + $allAmount;

            $Generalsales->push([
                'month' => $month,
                'totalAmount' => $totalAmount
            ]);
        }

        $RecentOrders = $this->constructOrders->getAllpendingOrders();

        return view('Sales', compact('Currentsales', 'refillSALES', 'Generalsales', 'RecentOrders'));
    }
}
