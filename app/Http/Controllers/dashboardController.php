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
use App\Models\AddressFee;
use App\Http\Controllers\NotificationController;
use App\Models\refillCost;
use Carbon\Carbon;
use App\Models\AllSales as Sale;
use App\Models\RefillSales as Refill;

class dashboardController extends Controller
{

    private $constructSalse, $constructRefill, $constructApplicant, $constructProduct,
            $constructclient_stocks, $constructOrders, $constructResellerProducts,
            $constructRefillRequest, $NotificationController, $constructAddress, $constructrefillCost;
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
            $this->NotificationController = new NotificationController();
            $this->constructAddress = new AddressFee();
            $this->constructrefillCost = new refillCost();
            return $this;
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
                $this->NotificationController->getNotificationByUser();
               $adminStocks = $this->constructResellerProducts->GetTotalSumOfAllUserStocks();
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
           $adminStocks = $this->constructResellerProducts->GetTotalSumOfAllUserStocks();
        }
        if(session()->get(env('USER_SESSION_KEY'))){
            $year = Carbon::now()->year;
            $year = date('Y');
            $Client_Stocks = $this->constructResellerProducts->ClientStocks();
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
        $Currentsales = $this->constructSalse->getMonthlySales(date('Y'));
        $existingYears = $this->constructSalse->availableYear();
        foreach($Currentsales as $productSales)
        {
            $month = \DateTime::createFromFormat('!m', $productSales->Month)->format('F');
            $productMonth[] = strval($month);
            $productMontlySales[] = floatval($productSales->Amount);

        }
        $AllSale = $this->constructSalse->getALLSales(date('Y'));
        $Salesyearly = 0;
        foreach($AllSale as $YEARsALE){
            $Salesyearly = $YEARsALE->TotalSales;
        }

        $refillSALES = $this->constructRefill->RefillgetMonthlySales(date('Y'));
        $AllRefillSale = $this->constructRefill->getRefillALLSales(date('Y'));
        $yearlyrefilSale = 0;
        foreach($AllRefillSale as $refillSALE){
            $yearlyrefilSale = $refillSALE->TotalSales;
        }

       // Sum Amount column for each month from refill_sales table
    //    $RefillAllSaleSales = DB::table('refill_sales')
    //    ->select(
    //        DB::raw('MONTH(created_at) AS month'), 
    //        DB::raw('SUM(Amount) AS AllSaleAmount'))
    //    ->whereYear('created_at', '=', date('Y'))
    //    ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
    //    ->where('paymentMethod', '=', "Walk in")
    //    ->groupBy(DB::raw('MONTH(created_at)')) // Include it in the GROUP BY
    //    ->get();

    //    insertcode

        function addArrays($Walkarr1, $arr2) {
            $result = [];
            $maxLength = max(count($Walkarr1), count($arr2));
        
            for ($i = 0; $i < $maxLength; $i++) {
                $val1 = isset($Walkarr1[$i]) ? $Walkarr1[$i] : 0;
                $val2 = isset($arr2[$i]) ? $arr2[$i] : 0;
                $result[] = $val1 + $val2;
            }
        
            return $result;
        }
        
        $Walksales = Sale::select(
            DB::raw('SUM(Amount) as totalAmount'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
            ->where('paymentMethod', '=', "Walk in")
            ->whereYear('created_at', '=', date('Y'))
            ->groupBy('month')
            ->get();
        
        $WalkInallSalesTotal = [];
        
        foreach ($Walksales as $Walksale) {
            $WalkInallSalesTotal[] = $Walksale->totalAmount;
        }

        $Walkrefillsales = Refill::select(
            DB::raw('SUM(Amount) as totalAmount'),
            DB::raw('MONTH(created_at) as month')
        )
        ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
        ->where('paymentMethod', '=', "Walk in")
        ->whereYear('created_at', '=', date('Y'))
        ->groupBy('month')
        ->get();
            // dd($Walksales,$Walkrefillsales);
        $WalkInallrefillDates = [];
        $WalkInallrefillSalesTotal = [];
        
        foreach ($Walkrefillsales as $Walkrefillsale) {
            $WalkInallrefillDates[] = date('F', mktime(0, 0, 0, $Walkrefillsale->month, 1));
            $WalkInallrefillSalesTotal[] = $Walkrefillsale->totalAmount;
        }
        
        $walkInOverALLtotalAmount = addArrays($WalkInallSalesTotal, $WalkInallrefillSalesTotal);

        //*******COD******** */
        

        $COD_sales = Sale::select(
            DB::raw('SUM(Amount) as totalAmount'),
            DB::raw('MONTH(created_at) as month'))
            ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
            ->where('paymentMethod', '=', "Cash on Delivery")
            ->whereYear('created_at', '=', date('Y'))
            ->groupBy('month')
            ->get();
        
        $COD_InallSalesTotal = [];
        
        foreach ($COD_sales as $COD_sale) {
            $COD_InallSalesTotal[] = $COD_sale->totalAmount;
        }

        $COD_refillsales = Refill::select(
            DB::raw('SUM(Amount) as totalAmount'),
            DB::raw('MONTH(created_at) as month'))
        ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
        ->where('paymentMethod', '=', "Cash on Delivery")
        ->whereYear('created_at', '=', date('Y'))
        ->groupBy('month')
        ->get();
    
        $COD_InallrefillDates = [];
        $COD_InallrefillSalesTotal = [];
        
        foreach ($COD_refillsales as $COD_refillsale) {
            $COD_InallrefillDates[] = date('F', mktime(0, 0, 0, $COD_refillsale->month, 1));
            $COD_InallrefillSalesTotal[] = $COD_refillsale->totalAmount;
        }
        $COD_InOverALLtotalAmount = addArrays($COD_InallSalesTotal, $COD_InallrefillSalesTotal);

    //end code
            //end
        $RecentOrders = $this->constructOrders->getAllpendingOrders();
        $TOTALAMOUNTSALE = $this->constructSalse->GetAllUserCurrentYearlySALE($year);
        if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
           $adminStocks = $this->constructProduct->getALLAdminStocks();
        }

        if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            $adminStocks = $this->constructResellerProducts->GetTotalSumOfAllUserStocks();
        }

        $pendingAmount = $this->constructOrders->getTotalAmountPendingData();
        $proccessAmount = $this->constructOrders->getTotalAmountProccessData();
        $refillprending = $this->constructRefillRequest->RefillPendingData();
        $refillprocess = $this->constructRefillRequest->RefillProccessData();
        return view('Sales', compact('existingYears','refillprending','refillprocess',
        'pendingAmount','proccessAmount','adminStocks','productMonth',
        'productMontlySales', 'refillSALES', 'RecentOrders', 'TOTALAMOUNTSALE',
        'WalkInallrefillDates', 'WalkInallSalesTotal', 
                    'WalkInallrefillSalesTotal', 'walkInOverALLtotalAmount',
                    'COD_InallrefillDates', 'COD_InallSalesTotal', 
                    'COD_InallrefillSalesTotal', 'COD_InOverALLtotalAmount'));
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
            $details = $this->constructApplicant->getDetails();
            $ProductPrice = $this->constructResellerProducts->getproductDetails();
            $StockDetails = $this->constructclient_stocks->stock_details();
            $AddressFees = $this->constructAddress->getAddress();
            $getRefillCost =  $this->constructrefillCost->getRefillCost();
            $getproductLogs = DB::table('products')
                    ->where('products.status', '=', 'Removed')
                    ->orderBy('products.updated_at', 'DESC')
                    ->get();
            $getaddrLogs = DB::table('address_fees')
                            ->where('address_fees.status', '=', 'Removed')
                            ->orderBy('address_fees.updated_at', 'DESC')
                            ->get();
                    // dd($getproductLogs, $getaddrLogs);
            return view('Settings', compact('getproductLogs',
            'getaddrLogs','ProductPrice','details',
            'StockDetails', 'AddressFees', 'getRefillCost'));
        }else{
            return view('log-in');
        }
    }

}
