<?php

namespace App\Http\Controllers;
use App\Models\orders as order;
use App\Models\LogInModel;
use App\Models\products;
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
}
