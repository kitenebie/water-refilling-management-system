<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $guarded = [];

    function get_orders(){
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'pending')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('reseller_ID', session()->get('key'))->where('status', 'pending')->get();
        }
    }

    function get_orders_Request(){

        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Pending')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('reseller_ID', session()->get('key'))->where('status', 'Pending')->get();
        }
    }


    function get_orders_ToReceive(){
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Process')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('reseller_ID', session()->get('key'))->where('status', 'Process')->get();
        }
    }

    function get_orders_Completed(){
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Completed')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('reseller_ID', session()->get('key'))->where('status', 'Completed')->get();
        }
    }


    function get_orders_Cancelled(){
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Cancelled')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('reseller_ID', session()->get('key'))->where('status', 'Cancelled')->get();
        }
    }

    function SubmitClientOrder($submit_req){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            echo '<h1><a href="http://127.0.0.1:8000/orders">Successfully Saved!</a></h1>';
            return $this->create($submit_req);
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            echo '<h1><a href="http://127.0.0.1:8000/orders">No function</a></h1>';
        }
    }

    function Accepted($ID){
        return $this->where('id', $ID)->update(['status' => 'Process']);
    }

    function updateStateComplete($orderID){
        return $this->where('id', $orderID)->update(['status' => 'Completed']);
    }


    function getAllpendingOrders(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('status', 'Pending')
                        ->orwhere('status', 'Process')
                        ->where('orders.reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->count();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Pending')
                        ->orwhere('status', 'Process')
                        ->count();
        }
    }

    function OrdersPendingProcessData(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return orders::join('products', 'orders.product_id', '=', 'products.product_id')
                            ->join('log_in_models', 'orders.reseller_id', '=', 'log_in_models.reseller_id')
                            ->where('reseller_ID', session()->get(env('USER_SESSION_KEY')))
                            ->where('orders.status', 'Pending')
                            ->orWhere('orders.status', 'Process')
                            ->where('orders.reseller_ID', session()->get(env('USER_SESSION_KEY')))
                            ->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return orders::join('products', 'orders.product_id', '=', 'products.product_id')
                            ->join('log_in_models', 'orders.reseller_id', '=', 'log_in_models.reseller_id')
                            ->where('orders.status', 'Pending')
                            ->orWhere('orders.status', 'Process')
                            ->get();
        }
    }

    function getTotalAmountPendingData(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('status', 'Pending')
                        ->where('reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->sum('Amount');
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Pending')
                        ->sum('Amount');
        }
    }
    function getTotalAmountProccessData(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('status', 'Process')
                        ->where('reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->sum('Amount');
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Process')
                        ->sum('Amount');
        }
    }
}
