<?php

namespace App\Http\Controllers;
use App\Models\orders as order;
use App\Models\LogInModel;
use App\Models\RefillSales;
use App\Models\AllSales;
use Carbon\Carbon;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\refillRequest as refill;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
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

    function getyearlyReport($year){
        //Sales-yearly-report.blade.php
    //!ERROR
        $caption1 = "Product Sales Report " . $year;
        $caption2 = "Refill Sales Report " . $year;

        $allProductSalesRecords = AllSales::join('products', 'products.product_id', '=', 'all_sales.ProductID')
            ->where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
            ->select('products.product_id', 'products.product_Name', 'all_sales.Quantity', 'all_sales.Amount', 'all_sales.created_at')
            ->orderByDesc('all_sales.created_at')
            ->get();

        $sumOfallproductsales = AllSales::where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
            ->selectRaw('SUM(all_sales.Quantity) as AllTotalProductQty, SUM(all_sales.Amount) as AllTotalProductSale')
            ->first(); // Use first() instead of get() to retrieve a single row with the aggregated values.

        $refillAllSalesRecords = RefillSales::where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
            ->get();

        $refillAllSales = RefillSales::where('Account_SaleID', '=', session()->get(env('USER_SESSION_KEY')))
            ->selectRaw('SUM(Quantity) as refilltotalQty, SUM(Amount) as refilltotalAmount')
            ->first(); // Use first() instead of get() to retrieve a single row with the aggregated values.

        $pdfName1 = "Refill-Sales-Report-" . date('m-d-y') . ".pdf"; // Use '-' instead of '/' in the date format to avoid file name issues.
        $pdfName2 = "Product-Sales-Report-" . date('m-d-y') . ".pdf"; // Use '-' instead of '/' in the date format to avoid file name issues.

        // Assuming you have imported the PDF facade, if not, add the following line at the top:
        // use PDF;

        // Load the views and generate the PDFs
        PDF::loadView('refill-yearly-report', [
            'refillAllSalesRecords' => $refillAllSalesRecords,
            'refillAllSales' => $refillAllSales,
            'caption' => $caption1,
            'currentDate' => date('F Y'), // Change 'F-Y' to 'F Y' to have a space between the month and year.
        ])->save(public_path('pdf/' . $pdfName1)); // Save the PDF instead of downloading it directly.

        PDF::loadView('Sales-yearly-report', [
            'allProductSalesRecords' => $allProductSalesRecords,
            'sumOfallproductsales' => $sumOfallproductsales,
            'caption' => $caption2,
            'currentDate' => date('F Y'), // Change 'F-Y' to 'F Y' to have a space between the month and year.
        ])->save(public_path('pdf/' . $pdfName2)); // Save the PDF instead of downloading it directly.
    }
}
