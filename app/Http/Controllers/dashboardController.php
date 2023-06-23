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
use App\Models\ResellerProducts;
use App\Models\refillRequest;
use Carbon\Carbon;

class dashboardController extends Controller
{

    private $constructSalse, $constructRefill, $constructApplicant, $constructProduct,
            $constructclient_stocks, $constructOrders, $constructResellerProducts,
            $constructRefillRequest;
    //* for total_income
    public $adminStocks, $pendingAmount, $proccessAmount,$refillprending, $refillprocess;



    function __construct()
    { 
            $this->constructApplicant = new LogInModel();
            $this->constructSalse = new AllSales();
            $this->constructRefill = new RefillSales();
            $this->constructProduct = new products();
            $this->constructclient_stocks = new client_stocks();
            $this->constructOrders = new orders();
            $this->constructResellerProducts = new ResellerProducts();
            $this->constructRefillRequest = new refillRequest();
    }

    function dashboard(){
        if(session()->get(env('USER_SESSION_KEY'))){
            $year = Carbon::now()->year;
            $year = date('Y');
            $reqData = $this->constructApplicant->getALLrequest();
            //*
            if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
               $adminStocks = $this->constructProduct->getALLAdminStocks();
            }
            if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
               $adminStocks = $this->constructclient_stocks->GetTotalSumOfAllUserStocks();
            }
            $this->constructSalse->GetAllUserCurrentYearlySALE(date('Y'));
            //*
            $RecentOrders = $this->constructOrders->getAllpendingOrders();
            $orders_DATA = $this->constructOrders->OrdersPendingProcessData();
            $TOTALAMOUNTSALE = $this->constructSalse->GetAllUserCurrentYearlySALE($year);
            return view('dashboard', compact('adminStocks','reqData', 'RecentOrders', 'orders_DATA', 'TOTALAMOUNTSALE'));
        }else{
            return view('log-in');
        }
    }

    function MyService(){
        if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
           $adminStocks = $this->constructProduct->getALLAdminStocks();
        }
        if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
           $adminStocks = $this->constructclient_stocks->GetTotalSumOfAllUserStocks();
        }
        if(session()->get(env('USER_SESSION_KEY'))){
            $year = Carbon::now()->year;
            $year = date('Y');
            $Client_Stocks = $this->constructclient_stocks->ClientStocks();
            $productData = $this->constructProduct->get_products();
            $RecentOrders = $this->constructOrders->getAllpendingOrders();
            $TOTALAMOUNTSALE = $this->constructSalse->GetAllUserCurrentYearlySALE($year);
            $ResellerProduct = $this->constructResellerProducts->GetAllResellerData();
            return view('My-service', compact('adminStocks','productData', 'ResellerProduct','RecentOrders','Client_Stocks','TOTALAMOUNTSALE'));
        }else{
            return view('log-in');
        }
    }

    function getsalesmonth(){
        
        if(session()->get(env('USER_SESSION_KEY'))){
        $year = Carbon::now()->year;
        $year = date('Y');
        $productMonth = [];
        $productMontlySales = [];
        $Currentsales = $this->constructSalse->getMonthlySales();
        foreach($Currentsales as $productSales)
        {
            $month = \DateTime::createFromFormat('!m', $productSales->Month)->format('F');
            $productMonth[] = strval($month);
            $productMontlySales[] = floatval($productSales->Amount);
            
        }
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
        ->whereYear('created_at', '=',  date('Y'))
        ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

        // Sum Amount column for each month from all_sales table
        $allSales = DB::table('all_sales')
        ->select(DB::raw('MONTH(created_at) AS month'), DB::raw('SUM(Amount) AS allAmount'))
        ->whereYear('created_at', '=', date('Y'))
        ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

        //Combine the sums from both tables
        $Generalsales = collect([]);
        if(!$refillSales == null){
            foreach ($refillSales as $refill) {
            $month = $refill->month;
            $refillAmount = $refill->refillAmount;
            @$allAmount = $allSales->where('month', $month)->first()->allAmount;
            $totalAmount = $refillAmount + $allAmount;

            $Generalsales->push([
                'month' => $month,
                'totalAmount' => $totalAmount
            ]);
        }
    }
        $RecentOrders = $this->constructOrders->getAllpendingOrders();
        $TOTALAMOUNTSALE = $this->constructSalse->GetAllUserCurrentYearlySALE($year);
        if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
           $adminStocks = $this->constructProduct->getALLAdminStocks();
        }

        if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            $adminStocks = $this->constructclient_stocks->GetTotalSumOfAllUserStocks();
        }

        $pendingAmount = $this->constructOrders->getTotalAmountPendingData();
        $proccessAmount = $this->constructOrders->getTotalAmountProccessData();
        $refillprending = $this->constructRefillRequest->RefillPendingData();
        $refillprocess = $this->constructRefillRequest->RefillProccessData();
         return view('Sales', compact('refillprending','refillprocess','pendingAmount','proccessAmount','adminStocks','productMonth','productMontlySales', 'refillSALES', 'Generalsales', 'RecentOrders', 'TOTALAMOUNTSALE'));
        }else{
            return view('log-in');
        }
    }

    function refillrequest(){
        if(session()->get(env('USER_SESSION_KEY'))){    
            $label_title = "Pending Refill Request";
            $statusRefill = $this->constructRefillRequest->statusPendingRefill();
            return view('Refill-Request', compact('statusRefill','label_title'));
        }else{
            return view('log-in');
        }
    }

    function Settings(){
        if(session()->get(env('USER_SESSION_KEY'))){    
            return view('Settings');
        }else{
            return view('log-in');
        }
    }
}
