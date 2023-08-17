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
            'Amount' => $request->refilltotal
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
            'Amount' => $request->refilltotal_amount
            ];
            $this->constructRefill->SaveRefillSales($refillData);
            return back()->with('refilled', 'Successfully Purchased!');
    }

    function AcceptRequest($ref_ID){
        $this->constructRefillRequest->Accept_refill($ref_ID);
        return back()->with('Accepted', 'Successfull');
    }

    function CompleteRequest($ID, $Quantity, $Amount){
        $ref_DATA = [
            'Account_SaleID' =>  session()->get(env('USER_SESSION_KEY')),
            'Refill_ID' => Str::random(12),
            'Quantity' => $Quantity,
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
            $year = date('Y');
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
            $refillSales = DB::table('refill_sales')
            ->select(DB::raw('MONTH(created_at) AS month'), DB::raw('SUM(Amount) AS refillAmount'))
            ->whereYear('created_at', '=',  date($selectedyear->yearSale))
            ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

            // Sum Amount column for each month from all_sales table
            $allSales = DB::table('all_sales')
            ->select(DB::raw('MONTH(created_at) AS month'), DB::raw('SUM(Amount) AS allAmount'))
            ->whereYear('created_at', '=', date($selectedyear->yearSale))
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
             return view('Sales', compact('thisyear','existingYears','refillprending','refillprocess','pendingAmount','proccessAmount','adminStocks','productMonth','productMontlySales', 'refillSALES', 'Generalsales', 'RecentOrders', 'TOTALAMOUNTSALE'));
            }else{
                return view('log-in');
            }
    }

    function Decline($ID){
        $this->constructRefillRequest->Decline_refill($ID);
        return back()->with('Cancelled', 'Cancel!');

    }
}
