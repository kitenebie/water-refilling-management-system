<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllSales as Sale;
use App\Models\RefillSales as Refill;
use App\Models\orders;
use App\Models\refillRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class rangeSalesController extends Controller
{
    private $constructSalse, $constructOrders,
    $constructRefillRequest, $rageDate = [];

    function __construct()
    {
            $this->constructSalse = new Sale();
            $this->constructOrders= new orders();
            $this->constructRefillRequest= new refillRequest();
            return;
    }
    function getAllBetweenSales(Request $date)
    {

        $startDate = $date->dateStart;
        $endDate = $date->dateEnd;
        $dateRange = ' ('.Carbon::parse($startDate)->format('F j, Y') . ' to '. Carbon::parse($endDate)->format('F j, Y').')';
        $existingYears = $this->constructSalse->availableYear();

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
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day')
        )
            ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
            ->where('paymentMethod', '=', "Walk in")
            ->whereBetween('created_at', [Carbon::parse($startDate)->subDay(), Carbon::parse($endDate)->addDay()])
            ->groupBy('year', 'month', 'day')
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'ASC')
            ->orderBy('day', 'ASC')
            ->get();
        
        $WalkInallSalesTotal = [];
        
        foreach ($Walksales as $Walksale) {
            $WalkInallSalesTotal[] = $Walksale->totalAmount;
        }

        $Walkrefillsales = Refill::select(
            DB::raw('SUM(Amount) as totalAmount'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day')
        )
        ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
        ->where('paymentMethod', '=', "Walk in")
        ->whereBetween('created_at', [Carbon::parse($startDate)->subDay(), Carbon::parse($endDate)->addDay()])
        ->groupBy('year', 'month', 'day')
        ->orderBy('year', 'ASC')
        ->orderBy('month', 'ASC')
        ->orderBy('day', 'ASC')
        ->get();
        // dd($Walksales, $Walkrefillsales);
        $WalkInallrefillDates = [];
        $WalkInallrefillSalesTotal = [];
        
        foreach ($Walkrefillsales as $Walkrefillsale) {
            $WalkInallrefillDates[] = Carbon::parse($Walkrefillsale->year.'-'.$Walkrefillsale->month.'-'.$Walkrefillsale->day)->format('F j, Y');
            $WalkInallrefillSalesTotal[] = $Walkrefillsale->totalAmount;
        }
        
        $walkInOverALLtotalAmount = addArrays($WalkInallSalesTotal, $WalkInallrefillSalesTotal);

        //*******COD******** */
        

        $COD_sales = Sale::select(
            DB::raw('SUM(Amount) as totalAmount'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'))
            ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
            ->where('paymentMethod', '=', "Cash on Delivery")
            ->whereBetween('created_at', [Carbon::parse($startDate)->subDay(), Carbon::parse($endDate)->addDay()])
            ->groupBy('year', 'month', 'day')
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'ASC')
            ->orderBy('day', 'ASC')
            ->get();
        $COD_InallSalesTotal = [];
        
        foreach ($COD_sales as $COD_sale) {
            $COD_InallSalesTotal[] = $COD_sale->totalAmount;
        }

        $COD_refillsales = Refill::select(
            DB::raw('SUM(Amount) as totalAmount'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'))
        ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
        ->where('paymentMethod', '=', "Cash on Delivery")
        ->whereBetween('created_at', [Carbon::parse($startDate)->subDay(), Carbon::parse($endDate)->addDay()])
        ->groupBy('year', 'month', 'day')
        ->orderBy('year', 'ASC')
        ->orderBy('month', 'ASC')
        ->orderBy('day', 'ASC')
        ->get();
    
        // dd($COD_sales, $COD_refillsales);
        $COD_InallrefillDates = [];
        $COD_InallrefillSalesTotal = [];
        
        foreach ($COD_refillsales as $COD_refillsale) {
            $COD_InallrefillDates[] = Carbon::parse($COD_refillsale->year.'-'.$COD_refillsale->month.'-'.$COD_refillsale->day)->format('F j, Y');
            $COD_InallrefillSalesTotal[] = $COD_refillsale->totalAmount;
        }
        $COD_InOverALLtotalAmount = addArrays($COD_InallSalesTotal, $COD_InallrefillSalesTotal);
        $pendingAmount = $this->constructOrders->getTotalAmountPendingData();
        $proccessAmount = $this->constructOrders->getTotalAmountProccessData();
        $refillprending = $this->constructRefillRequest->RefillPendingData();
        $refillprocess = $this->constructRefillRequest->RefillProccessData();

        return view('Sales', compact('pendingAmount', 'proccessAmount', 'refillprending',
                    'refillprocess','existingYears','WalkInallrefillDates', 'WalkInallSalesTotal', 
                    'WalkInallrefillSalesTotal', 'walkInOverALLtotalAmount',
                    'COD_InallrefillDates', 'COD_InallSalesTotal', 
                    'COD_InallrefillSalesTotal', 'COD_InOverALLtotalAmount',
                    'startDate','endDate', 'dateRange'));
    }

    function SellerWalkIngetAllBetweenSales(Request $date){
        
        $startDate = $date->dateStart;
        $endDate = $date->dateEnd;
        $dateRange = ' ('.Carbon::parse($startDate)->format('F j, Y') . ' to '. Carbon::parse($endDate)->format('F j, Y').')';
        $existingYears = $this->constructSalse->availableYear();

        function AddWalkInsales($Walkarr1, $arr2) {
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
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day')
        )
            ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
            ->where('paymentMethod', '=', "Walk in")
            ->whereBetween('created_at', [Carbon::parse($startDate)->subDay(), Carbon::parse($endDate)->addDay()])
            ->groupBy('year', 'month', 'day')
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'ASC')
            ->orderBy('day', 'ASC')
            ->get();
        
        $WalkInallSalesTotal = [];
        
        foreach ($Walksales as $Walksale) {
            $WalkInallSalesTotal[] = $Walksale->totalAmount;
        }

        $Walkrefillsales = Refill::select(
            DB::raw('SUM(Amount) as totalAmount'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day')
        )
        ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
        ->where('paymentMethod', '=', "Walk in")
        ->whereBetween('created_at', [Carbon::parse($startDate)->subDay(), Carbon::parse($endDate)->addDay()])
        ->groupBy('year', 'month', 'day')
        ->orderBy('year', 'ASC')
        ->orderBy('month', 'ASC')
        ->orderBy('day', 'ASC')
        ->get();
            // dd($Walksales,$Walkrefillsales);
        $WalkInallrefillDates = [];
        $WalkInallrefillSalesTotal = [];
        
        foreach ($Walkrefillsales as $Walkrefillsale) {
            $WalkInallrefillDates[] = Carbon::parse($Walkrefillsale->year.'-'.$Walkrefillsale->month.'-'.$Walkrefillsale->day)->format('F j, Y');
            $WalkInallrefillSalesTotal[] = $Walkrefillsale->totalAmount;
        }
        
        $walkInOverALLtotalAmount = AddWalkInsales($WalkInallSalesTotal, $WalkInallrefillSalesTotal);
        $pendingAmount = $this->constructOrders->getTotalAmountPendingData();
        $proccessAmount = $this->constructOrders->getTotalAmountProccessData();
        $refillprending = $this->constructRefillRequest->RefillPendingData();
        $refillprocess = $this->constructRefillRequest->RefillProccessData();

        return view('Sales', compact('pendingAmount', 'proccessAmount', 'refillprending',
        'refillprocess','existingYears','WalkInallrefillDates', 'WalkInallSalesTotal', 
        'WalkInallrefillSalesTotal', 'walkInOverALLtotalAmount', 'startDate','endDate', 'dateRange'));
    }
     
    function showSalesTbl($dateStart, $dateEnd)
    {
        $startDate = Carbon::parse($dateStart)->format('F j, Y');
        $endDate = Carbon::parse($dateEnd)->format('F j, Y');
        $Sales = null;
        if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
        {
            $Sales = DB::table('orders')->join('products', 'orders.product_ID', 'products.product_id')
                    ->join('log_in_models', 'orders.reseller_ID','log_in_models.reseller_id')
                    ->select('orders.*', 'log_in_models.firstname',
                    'log_in_models.lastname', 'products.product_Name'
                    )->where('orders.status', '=', 'Completed')
                    ->whereBetween('orders.created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                    ->orderBy('orders.created_at', 'DESC')->get();
        }
        if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
        {
            $Sales = DB::table('orders')->join('products', 'orders.product_ID', 'products.product_id')
                    ->join('log_in_models', 'orders.reseller_ID','log_in_models.reseller_id')
                    ->select('orders.*', 'log_in_models.firstname',
                    'log_in_models.lastname', 'products.product_Name'
                    )->where('orders.status', '=', 'Completed')
                    ->where('orders.reseller_ID', '=', session()->get(env('USER_SESSION_KEY')))
                    ->whereBetween('orders.created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                    ->orderBy('orders.created_at', 'DESC')->get();
        }
        return view('sales-info', compact('startDate','endDate', 'Sales'));
    }

    function showrefillTbl($dateStart, $dateEnd){
        $startDate = Carbon::parse($dateStart)->format('F j, Y');
        $endDate = Carbon::parse($dateEnd)->format('F j, Y');
        $refills = null;
        if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
        {
            $refills = DB::table('refill_requests')
                    ->join('log_in_models', 'refill_requests.Reseller_ID','log_in_models.reseller_id')
                    ->select('refill_requests.*', 'log_in_models.firstname',
                    'log_in_models.lastname'
                    )->where('refill_requests.status', '=', 'Completed')
                    ->whereBetween('refill_requests.created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                    ->orderBy('refill_requests.created_at', 'DESC')->get();
        }
        if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
        {
            $refills = DB::table('refill_requests')
                    ->join('log_in_models', 'refill_requests.Reseller_ID','log_in_models.reseller_id')
                    ->select('refill_requests.*', 'log_in_models.firstname',
                    'log_in_models.lastname'
                    )->where('refill_requests.status', '=', 'Completed')
                    ->where('refill_requests.Reseller_ID', '=', session()->get(env('USER_SESSION_KEY')))
                    ->whereBetween('refill_requests.created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                    ->orderBy('refill_requests.created_at', 'DESC')->get();
        }
        return view('sales-info', compact('startDate','endDate', 'refills'));
    }
}
