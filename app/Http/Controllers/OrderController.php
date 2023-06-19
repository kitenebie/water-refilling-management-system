<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\LogInModel;
use App\Models\products;
use App\Models\client_stocks;
use App\Models\AllSales;
use App\Models\ResellerProducts;

use PhpParser\Node\Stmt\Foreach_;

class OrderController extends Controller
{
    //do something
    private $constructOrder,$constructresseller,$constructProduct, $constructClientStocks, $constructAllSales, $constructResellerProduct;
    public $adminStocks;
    
    function __construct(){
        $this->constructOrder = new orders();
        $this->constructresseller = new LogInModel();
        $this->constructProduct = new Products();
        $this->constructClientStocks = new client_stocks();
        $this->constructAllSales = new AllSales();
        $this->constructResellerProduct = new ResellerProducts();
    }

    function orders(){
        if(session()->get(env('USER_SESSION_KEY'))){
            if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
               $adminStocks = $this->constructProduct->getALLAdminStocks();
            }
            $img_ = "img/header-dashboard.png";
            $productData = $this->constructProduct->get_products();

            return view('orders', compact('adminStocks','img_', 'productData'));
        }else{
            return view('log-in');
        }
    }
    function Request(){
        $label_title = "Request Orders";
        $resellerReqData = $this->constructOrder->get_orders_Request();
        $N3wData = [];
        foreach($resellerReqData as $eachRequestData){
            $N3wData[] .= $this->constructresseller->FindResellerID($eachRequestData->reseller_ID);
        }

        $img_ = "img/header-dashboard.png";
        return view('orders', compact('label_title','N3wData','resellerReqData','img_'));
    }

    function ToReceive(){
        $label_title = "To Receive Orders";
        $resellerReqData = $this->constructOrder->get_orders_ToReceive();
        $N3wData = [];
        foreach($resellerReqData as $eachRequestData){
            $N3wData[] .= $this->constructresseller->FindResellerID($eachRequestData->reseller_ID);
        }

        $img_ = "img/header-dashboard.png";
        return view('orders', compact('label_title','N3wData','resellerReqData','img_'));
    }

    function Completed(){
        $label_title = "Completed Orders";
        $resellerReqData = $this->constructOrder->get_orders_Completed();
        $N3wData = [];
        foreach($resellerReqData as $eachRequestData){
            $N3wData[] .= $this->constructresseller->FindResellerID($eachRequestData->reseller_ID);
        }

        $img_ = "img/header-dashboard.png";
        return view('orders', compact('label_title','N3wData','resellerReqData','img_'));
    }

    function cancelled(){
        $label_title = "Cancelled Orders";
        $resellerReqData = $this->constructOrder->get_orders_Cancelled();
        $N3wData = [];
        foreach($resellerReqData as $eachRequestData){
            $N3wData[] .= $this->constructresseller->FindResellerID($eachRequestData->reseller_ID);
        }

        $img_ = "img/header-dashboard.png";
        return view('orders', compact('label_title','N3wData','resellerReqData','img_'));
    }

    function SubmitProductRequest(Request $request_Product){
        $data_Submit = [
            'reseller_ID' => session()->get('key'),
            'product_ID' => $request_Product->product_ID,
            'order' => $request_Product->order,
            'Amount' => $request_Product->price,
            'status' => env('STATUS_ORDER_ONE'),

        ];
        $this->constructOrder->SubmitClientOrder($data_Submit);
    }

    function AcceptOrder($id, $qty, $pdtID){
        $this->constructProduct->decreaseStockUpdate($qty, $pdtID);
        $this->constructOrder->Accepted($id);
        return redirect('/orders/Request')->with('success', 'Order has been accepted!');
    }

    //* add to sale(admin) and complete reseller order
    function CompleteAddSale(Request $success_req){

        $client_stock_data = [
            'reseller_id' => $success_req->resellerID,
            'product_id' => $success_req->product_ID,
            'quantity' => $success_req->order
        ];
        $this->constructClientStocks->Save_Stocks($client_stock_data);
        $AddSale = [
            'Account_SaleID' => session()->get(env('USER_SESSION_KEY')),
            'ProductID' => $success_req->product_ID,
            'Quantity' => $success_req->order,
            'Amount' => $success_req->Amount
        ];
        $Reseller_AddToNewPRoduct = [
            'User_ID' => $success_req->resellerID,
            'product_ID' => $success_req->product_ID,
            'Price' => 0.00,
            'Quantity' => $success_req->order
        ];
        $this->constructAllSales->AddtoAdminSale($AddSale);
        $this->constructResellerProduct->ProductSave($Reseller_AddToNewPRoduct);
        $this->constructOrder->updateStateComplete($success_req->orderid);
        return redirect('/orders/ToReceive')->with('success', 'Order has been Completed!');
    }
}
