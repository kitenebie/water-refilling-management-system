<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\LogInModel;
use App\Models\AllSales;
use App\Models\RefillSales;
use App\Models\products;
use App\Models\client_stocks;
use App\Models\orders;
use App\Models\ResellerProducts;
use App\Models\refillRequest;
use App\Http\Controllers\NotificationController;
use Carbon\Carbon;
use App\Models\AllSales as Sale;
use App\Models\RefillSales as Refill;

class AllRefillSalesController extends Controller
{

    private $constructSalse, $constructRefill, $constructApplicant, $constructProduct,
            $constructclient_stocks, $constructOrders, $constructResellerProducts,
            $constructRefillRequest, $NotificationController;
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
            return $this;
    }

    function AddProductSales(Request $request){
       $data = [
        'Account_SaleID' => session()->get(env('USER_SESSION_KEY')),
        'ProductID' => $request->product_ID,
        'Quantity' => $request->order,
        'paymentMethod' => 'Walk in',
        'Amount' => $request->price,
       ];
       $this->constructSalse->AddAdminSale($data);
       return back()->with('created', 'done!');
    }
    function AddRefillSalesAdmin(Request $request){
        $randomNumber = Str::random(12);
        $refillData = [
            'Account_SaleID' => session()->get(env('USER_SESSION_KEY')),
            'Refill_ID' =>  $randomNumber,
            'Quantity' => $request->numberGalllon,
            'Amount' => $request->refilltotal,
            'paymentMethod' => 'Walk in'
        ];
        $this->constructRefill->SaveRefillSales($refillData);
        var_dump($refillData);
       return back()->with('refilled', 'Successfully Purchased!');
    }

    function AddRefillSale(Request $request){
        $randomNumber = Str::random(12);
        $refillData = [
            'Account_SaleID' => session()->get(env('USER_SESSION_KEY')),
            'Refill_ID' =>  $randomNumber,
            'Quantity' => $request->numberOFgallon,
            'Amount' => $request->refilltotal_amount,
            'paymentMethod' => 'Walk in'
            ];
            $this->constructRefill->SaveRefillSales($refillData);
            return back()->with('refilled', 'Successfully Purchased!');
    }

    function AcceptRequest($ref_ID){
        $this->constructRefillRequest->Accept_refill($ref_ID);
        return back()->with('Accepted', 'Successfull');
    }

    function CompleteRequest($ID, $Quantity, $Amount, $pymt){
        $ref_DATA = [
            'Account_SaleID' =>  session()->get(env('USER_SESSION_KEY')),
            'Refill_ID' => Str::random(12),
            'Quantity' => $Quantity,
            'paymentMethod' => $pymt,
            'Amount' => $Amount
        ];
        $this->constructRefillRequest->completed_refill($ID);
        $this->constructRefill->SaveRefillSales($ref_DATA);
        return back()->with('Completed', 'Successfull');
    }

    function refilltoreceive(){
        $label_title = "Process Refill Request";
        $statusRefill = $this->constructRefillRequest->statusProcessRefill();
        return view('Refill-Request', compact('statusRefill','label_title'));
    }

    function refilltocompleted(){
        $label_title = "Completed Refill Request";
        $statusRefill = $this->constructRefillRequest->statusCompleteRefill();
        return view('Refill-Request', compact('statusRefill','label_title'));
    }

    function refilltocancelled(){
        $label_title = "Cancelled Refill Request";
        $statusRefill = $this->constructRefillRequest->statusCancelledRefill();
        return view('Refill-Request', compact('statusRefill','label_title'));
    }

    function submitFindSaleyear(Request $selectedyear){

        if(session()->get(env('USER_SESSION_KEY'))){
            $year = Carbon::now()->year;
            $year = $selectedyear->yearSale;
            $productMonth = [];
            $productMontlySales = [];
            $Currentsales = $this->constructSalse->getMonthlySales($selectedyear->yearSale);
            $existingYears = $this->constructSalse->availableYear();
            $thisyear = $selectedyear->yearSale;
            foreach($Currentsales as $productSales)
            {
                $month = \DateTime::createFromFormat('!m', $productSales->Month)->format('F');
                $productMonth[] = strval($month);
                $productMontlySales[] = floatval($productSales->Amount);

            }
            $AllSale = $this->constructSalse->getALLSales($selectedyear->yearSale);
            $Salesyearly = 0;
            foreach($AllSale as $YEARsALE){
                $Salesyearly = $YEARsALE->TotalSales;
            }

            $refillSALES = $this->constructRefill->RefillgetMonthlySales($selectedyear->yearSale);
            $AllRefillSale = $this->constructRefill->getRefillALLSales($selectedyear->yearSale);
            $yearlyrefilSale = 0;
            foreach($AllRefillSale as $refillSALE){
                $yearlyrefilSale = $refillSALE->TotalSales;
            }

           // Sum Amount column for each month from refill_sales table
       // Sum Amount column for each month from refill_sales table
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

            $pendingAmount = $this->constructOrders->getTotalAmountPendingData();
            $proccessAmount = $this->constructOrders->getTotalAmountProccessData();
            $refillprending = $this->constructRefillRequest->RefillPendingData();
            $refillprocess = $this->constructRefillRequest->RefillProccessData();
             return view('Sales', compact('thisyear','existingYears','refillprending','refillprocess','pendingAmount','proccessAmount','productMonth','productMontlySales', 'refillSALES',  'RecentOrders', 'TOTALAMOUNTSALE',         
        'WalkInallrefillDates', 'WalkInallSalesTotal', 
        'WalkInallrefillSalesTotal', 'walkInOverALLtotalAmount',
        'COD_InallrefillDates', 'COD_InallSalesTotal', 
        'COD_InallrefillSalesTotal', 'COD_InOverALLtotalAmount'));
            }else{
                return view('log-in');
            }
    }

    function Decline($ID){
        $this->constructRefillRequest->Decline_refill($ID);
        return back()->with('Cancelled', 'Cancel!');
    }
}
