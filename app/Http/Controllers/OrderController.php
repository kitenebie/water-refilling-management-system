<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\LogInModel;
use App\Models\products;
use App\Models\AllSales;
use App\Models\ResellerProducts;
use App\Models\refillRequest;
use App\Models\AddressFee;
use Illuminate\Support\Str;

use PhpParser\Node\Stmt\Foreach_;

class OrderController extends Controller
{
    //do something
    private $constructOrder,$constructresseller,$constructProduct,
             $constructAddressFee, $constructAllSales,
             $constructResellerProduct, $constructrefillRequest;

    function __construct(){
            $this->constructOrder = new orders();
            $this->constructresseller = new LogInModel();
            $this->constructProduct = new Products();
            $this->constructAddressFee = new AddressFee();
            $this->constructAllSales = new AllSales();
            $this->constructResellerProduct = new ResellerProducts();
            $this->constructrefillRequest = new refillRequest();
            return $this;
    }

    function orders(){
        if(session()->get(env('USER_SESSION_KEY'))){
            $productData = $this->constructProduct->get_products();
            $Fees = $this->constructAddressFee->isAddressFees();
            // foreach($Fees as $fee){
            //     echo $fee->Fee;
            // }
            return view('orders', compact('Fees', 'productData'));
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
        return back()->with('successOrder', 'done!');
    }

    function Decline($ID){
        $this->constructOrder->DeclineOrder($ID);
        return back()->with('Cancelled', 'Cancel!');
    }

    function AcceptOrder($id, $qty, $pdtID){
        $this->constructProduct->decreaseStockUpdate($qty, $pdtID);
        $this->constructOrder->Accepted($id);
        return redirect('/orders/Request')->with('success', 'Order has been accepted!');
    }

    //* add to sale(admin) and complete reseller order
    function CompleteAddSale($success_req){
        $AddSale = [];
        $Reseller_AddToNewPRoduct = [];
        $orderInfo = $this->constructOrder->getAllData($success_req);
        foreach($orderInfo as $info){
            $AddSale = [
                'Account_SaleID' => session()->get(env('USER_SESSION_KEY')),
                'ProductID' => $info->product_ID,
                'Quantity' => $info->order,
                'Amount' => $info->Amount
            ];
            $Reseller_AddToNewPRoduct = [
                'User_ID' => $info->reseller_ID,
                'product_ID' => $info->product_ID,
                'Price' => 0.00,
                'Quantity' => $info->order,
                'limit_stock' => 0
            ];
        }
        $this->constructAllSales->AddtoAdminSale($AddSale);
        $this->constructResellerProduct->ProductSave($Reseller_AddToNewPRoduct);
        $this->constructOrder->updateStateComplete($success_req);
        return redirect('/orders/ToReceive')->with('success', 'Order has been Completed!');
    }

    function SubmitRefillRequest(Request $request){
        $refillrequestDATA = [
            'Reseller_ID' => session()->get(env('USER_SESSION_KEY')),
            'NumberOfGallon' => $request->numberGalllon,
            'RefillCost' => $request->refillcost,
            'RefillShipFee' => $request->refillfee,
            'TotalCost' => $request->refilltotal,
            'status' => 'Pending'
        ];
        $this->constructrefillRequest->SaveRefillRequest($refillrequestDATA);
        return back()->with('clientrefilled', 'submitted request');
    }


}
