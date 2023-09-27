<?php

namespace App\Http\Controllers;
use App\Models\orders as order;
use Carbon\Carbon;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\refillRequest as refill;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    function RefillreportBetween($dateStart, $dateEnd){
        $startDate = Carbon::parse($dateStart)->format('F j, Y');
        $endDate = Carbon::parse($dateEnd)->format('F j, Y');
        $refills = null;
        $NewtotalAmount = null;
        $Qty = null;
        $caption = 'Refill Sales From '  .$startDate. ' to ' .$endDate;
        if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
        {
            $refills = DB::table('refill_requests')
                    ->join('log_in_models', 'refill_requests.Reseller_ID','log_in_models.reseller_id')
                    ->select('refill_requests.*', 'log_in_models.firstname',
                    'log_in_models.lastname'
                    )->where('refill_requests.status', '=', 'Completed')
                    ->whereBetween('refill_requests.created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                    ->orderBy('refill_requests.created_at', 'DESC')->get();

            $NewtotalAmount = DB::table('refill_requests')
                    ->whereBetween('created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                    ->where('status', '=', 'Completed')
                                    ->select(DB::raw('SUM(TotalCost) as TotalCost'))
                                    ->sum('TotalCost');

            $Qty = DB::table('refill_requests')
                    ->where('status', '=', 'Completed')
                    ->whereBetween('created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                    ->select(DB::raw('SUM(NumberOfGallon) as NumberOfGallon'))
                    ->sum('NumberOfGallon');
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

                    
            $NewtotalAmount = DB::table('refill_requests')
            ->whereBetween('created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])

                                    ->where('status', '=', 'Completed')
                                    ->where('Reseller_ID', '=', session()->get(env('USER_SESSION_KEY')))
                                    ->sum('TotalCost');

            $Qty = DB::table('refill_requests')
            ->whereBetween('created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])

                    ->where('status', '=', 'Completed')
                    ->where('Reseller_ID', '=', session()->get(env('USER_SESSION_KEY')))
                    ->sum('NumberOfGallon');
        }
        // dd($refills, $NewtotalAmount[0]->TotalCost, $Qty[0]->NumberOfGallon);
        return PDF::loadView('report-range-pdf', ['refills' => $refills, 'NewtotalAmount' => $NewtotalAmount,
                            'caption' => $caption, 'Qty' => $Qty])->download('Product Report'. $startDate .'-'. $endDate.'.pdf');
    }


    function ProductreportBetween($dateStart, $dateEnd){
        $startDate = Carbon::parse($dateStart)->format('F j, Y');
        $endDate = Carbon::parse($dateEnd)->format('F j, Y');
        $Sales = null;
        $NewtotalAmount = null;
        $Qty = null;
        $caption = 'Product Sales From '  .$startDate. ' to ' .$endDate;
        if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
        {
            $Sales = DB::table('orders')->join('products', 'orders.product_ID', 'products.product_id')
                        ->join('log_in_models', 'orders.reseller_ID','log_in_models.reseller_id')
                        ->select('orders.*', 'log_in_models.firstname',
                        'log_in_models.lastname', 'products.product_Name'
                        )->where('orders.status', '=', 'Completed')
                        ->whereBetween('orders.created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                        ->orderBy('orders.created_at', 'DESC')->get();

            $NewtotalAmount = DB::table('orders')
            ->where('status', '=', 'Completed')
                        ->whereBetween('created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                        ->sum('Amount');

            $Qty = DB::table('orders')
            ->where('status', '=', 'Completed')
                        ->whereBetween('created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                        ->sum('order');
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

                    
            $NewtotalAmount = DB::table('orders')
                                    ->whereBetween('created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                                    ->where('status', '=', 'Completed')
                                    ->where('reseller_ID', '=', session()->get(env('USER_SESSION_KEY')))
                                    ->sum('Amount');

            $Qty = DB::table('orders')
                    ->whereBetween('created_at', [Carbon::parse($dateStart)->subDay(), Carbon::parse($dateEnd)->addDay()])
                    ->where('status', '=', 'Completed')
                    ->where('reseller_ID', '=', session()->get(env('USER_SESSION_KEY')))
                    ->sum('order');
        }
        // dd($Sales, $NewtotalAmount, $Qty);
        return PDF::loadView('report-range-pdf', ['Sales' => $Sales, 'NewtotalAmount' => $NewtotalAmount,
                            'caption' => $caption, 'Qty' => $Qty])->download('Refill Report'. $startDate .'-'. $endDate.'.pdf');
    }


    function get_toReceive_orders(){
        $caption = "Delivery Orders List";
         $ordersData = Order::join('log_in_models', 'orders.reseller_ID', '=', 'log_in_models.reseller_id')
                            ->join('products', 'orders.product_ID', '=', 'products.product_id')
                            ->where('orders.status', 'Process')
                            ->select('log_in_models.firstname', 'log_in_models.lastname', 'log_in_models.address',
                                'products.product_Name', 'orders.order', 'orders.Amount', 'products.updated_at')
                            ->orderByDesc('products.updated_at')
                            ->get();

        $totalAmount = order::where('orders.status', 'Process')
                        ->selectRaw('SUM(orders.Amount) as TheAmount')->get();
        $NewtotalAmount = $totalAmount[0]->TheAmount;

        $pdfName = "Orders-".date('m/d/y').".pdf";
        return PDF::loadView('orders-process', ['Orders' => $ordersData, 'NewtotalAmount' => $NewtotalAmount,
                            'caption' => $caption])->download( $pdfName);

    }

    function get_completed_orders(){
        $caption = "Completed Orders Report";
        $currentMonth = Carbon::now()->month;
        $ordersData = order::join('log_in_models', 'orders.reseller_ID', '=' ,'log_in_models.reseller_id')
                    ->join('products', 'orders.product_ID', '=' ,'products.product_id')
                    ->where('orders.status', '=', 'Completed')
                    ->whereMonth('orders.updated_at', $currentMonth)
                    ->select('log_in_models.firstname', 'log_in_models.lastname', 'log_in_models.address',
                        'products.product_Name', 'orders.order', 'orders.Amount', 'products.updated_at')
                    ->orderByDesc('products.updated_at')
                    ->get();

        $totalAmount = order::where('orders.status', 'Completed')
                    ->whereMonth('orders.updated_at', $currentMonth)
                    ->selectRaw('SUM(orders.Amount) as TheAmount')->get();
        $NewtotalAmount = $totalAmount[0]->TheAmount;

        $pdfName = "Completed-Report-".date('m/d/y').".pdf";
        return PDF::loadView('orders-process', ['Orders' => $ordersData, 'NewtotalAmount' => $NewtotalAmount,
                            'caption' => $caption, 'currentDate' => date('F-Y')])->download($pdfName);
    }


    function get_toReceive_refill(){
        $caption = "Delivery Refill List";
         $refillsData = refill::join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                            ->where('refill_requests.status', 'Process')
                            ->select('refill_requests.updated_at', 'log_in_models.lastname', 'log_in_models.firstname', 'log_in_models.address',
                            'refill_requests.NumberOfGallon', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost')
                            ->orderByDesc('refill_requests.updated_at')
                            ->get();

        $totalAmount = refill::where('refill_requests.status', 'Process')
                        ->selectRaw('SUM(refill_requests.TotalCost) as TheAmount')->get();
        $NewtotalAmount = $totalAmount[0]->TheAmount;

        $pdfName = "Refill Trasaction-".date('m/d/y').".pdf";
        return PDF::loadView('refill-process', ['refills' => $refillsData, 'NewtotalAmount' => $NewtotalAmount,
                            'caption' => $caption])->download($pdfName);
    }

    function get_complete_refill(){
        $caption = "Completed Refill Report";
        $currentMonth = Carbon::now()->month;
        $refillsData = refill::join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                        ->where('refill_requests.status', 'Completed')
                        ->whereMonth('refill_requests.updated_at', $currentMonth)
                        ->select('refill_requests.updated_at','log_in_models.lastname', 'log_in_models.firstname', 'log_in_models.address',
                        'refill_requests.NumberOfGallon', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost')
                        ->orderByDesc('refill_requests.updated_at')
                        ->get();

        $totalAmount = refill::where('refill_requests.status', 'Completed')
                    ->whereMonth('refill_requests.updated_at', $currentMonth)
                    ->selectRaw('SUM(refill_requests.TotalCost) as TheAmount')->get();
        $NewtotalAmount = $totalAmount[0]->TheAmount;

        $pdfName = "Completed-refill-Report-".date('m/d/y').".pdf";
        return PDF::loadView('refill-process', ['refills' => $refillsData, 'NewtotalAmount' => $NewtotalAmount,
                            'caption' => $caption, 'currentDate' => date('F-Y')])->download($pdfName);
    }

    function downloadRefill($datayear){
        $caption = "Jonel's WRS Product Sales Report" . $datayear;
        $refillsData = DB::table('refill_sales')
                        ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
                        ->whereYear('created_at', $datayear)
                        ->orderBy(DB::raw('MONTH(created_at)'))
                        ->get();

        $totalAmount = DB::table('refill_sales')
                    ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
                    ->whereYear('created_at', $datayear)
                    ->selectRaw('SUM(Amount) as TheAmount')->get();


        $totalQuantity = DB::table('refill_sales')
                    ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
                    ->whereYear('created_at', $datayear)
                    ->selectRaw('SUM(Quantity) as Qty')->get();
        $NewtotalAmount = $totalAmount[0]->TheAmount;
        $totalQty = $totalQuantity[0]->Qty;
        $pdfName = $datayear."-refill-Report-".date('m/d/y').".pdf";
        return PDF::loadView('refill-yearly-report', ['refills' => $refillsData, 'NewtotalAmount' => $NewtotalAmount,
                            'caption' => $caption, 'Qty' => $totalQty, 'currentDate' => date('F-Y')])->download($pdfName);
    }

    function downloadSales($datayear){
        $caption = "Jonel's WRS Product Sales Report" . $datayear;
        $SalesData = DB::table('all_sales')
                        ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
                        ->whereYear('created_at', $datayear)
                        ->orderBy(DB::raw('MONTH(created_at)'))
                        ->get();

        $totalAmount = DB::table('all_sales')
                    ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
                    ->whereYear('created_at', $datayear)
                    ->selectRaw('SUM(Amount) as TheAmount')->get();


        $totalQuantity = DB::table('all_sales')
                    ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
                    ->whereYear('created_at', $datayear)
                    ->selectRaw('SUM(Quantity) as Qty')->get();
        $NewtotalAmount = $totalAmount[0]->TheAmount;
        $totalQty = $totalQuantity[0]->Qty;
        $pdfName = $datayear."-Sales-Report-".date('m/d/y').".pdf";
        return PDF::loadView('Sales-yearly-report', ['SalesData' => $SalesData, 'NewtotalAmount' => $NewtotalAmount,
                            'caption' => $caption, 'Qty' => $totalQty, 'currentDate' => date('F-Y')])->download($pdfName);
    }

    function getyearlyReport($year){ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body onload="loadthis()">

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose Report Type</h5>
            </div>
            <div class="modal-body d-flex flex-column justify-center gap-2">
                <a href="/download-Sales/<?= $year ?>" type="button" style="background-color: rgba(54, 162, 235);" class="btn text-white"><i class='bx bxs-file-pdf' ></i>Download Product Sales PDF Report <?= $year ?> <i class='bx bxs-download'></i></a>
                <a href="/download-refill/<?= $year ?>" type="button" style="background-color: #FD7238;" class="btn text-white"><i class='bx bxs-file-pdf' ></i>Download Refill Sales PDF Report <?= $year ?> <i class='bx bxs-download'></i></a>
            </div>
            <div class="modal-footer">
                <a href="<?= route('getsalesmonth') ?>" type="button" class="btn text-white" style="background-color: #DB504A;">Close</a>
            </div>
            </div>
        </div>
        </div>
        <script>
           var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), focus);
           function loadthis(){
            myModal.show();
           }
        </script>
    </body>
    </html>
<?php
}
}
?>
