<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class orders extends Model
{
    use HasFactory;

    protected $guarded = [];

    function get_orders(){
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'pending')->orderByDesc('updated_at')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('reseller_ID', session()->get('key'))->where('status', 'pending')->get();
        }
    }

    function get_orders_Request(){

        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            // return $this->where('status', 'Pending')->orderByDesc('updated_at')->get();
            return DB::table('orders')
                   ->join('products', 'orders.product_ID','products.product_id')
                   ->select(
                       'orders.reseller_ID',
                       'orders.product_ID',
                       'orders.order',
                       'orders.Amount',
                       'orders.paymentMethod',
                       'orders.status',
                       'orders.created_at',
                       'orders.id as orderID',
                       'orders.updated_at as theID',
                       'products.*'
                   )
                   ->where('orders.status', 'Pending')->orderBy('orders.id', 'DESC')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return DB::table('orders')
            ->join('products', 'orders.product_ID','products.product_id')
            ->select(
                'orders.reseller_ID',
                'orders.product_ID',
                'orders.order',
                'orders.Amount',
                'orders.paymentMethod',
                'orders.status',
                'orders.created_at',
                'orders.id as orderID',
                'orders.updated_at as theID',
                'products.*'
            )
            ->where('orders.reseller_ID', session()->get('key'))
            ->where('orders.status', 'Pending')
            ->orderBy('orders.id', 'DESC')->get();
        }
    }


    function get_orders_ToReceive(){
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            // return $this->where('status', 'Process')->orderBy('created_at')->get();
            return DB::table('orders')
            ->join('products', 'orders.product_ID','products.product_id')
            ->select(
                'orders.reseller_ID',
                'orders.product_ID',
                'orders.order',
                'orders.Amount',
                'orders.paymentMethod',
                'orders.status',
                'orders.created_at',
                'orders.id as orderID',
                'orders.updated_at as theID',
                'products.*'
            )
            ->where('orders.status', 'Process')->orderByDesc('theID')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return DB::table('orders')
            ->join('products', 'orders.product_ID','products.product_id')
            ->select(
                'orders.reseller_ID',
                'orders.product_ID',
                'orders.order',
                'orders.Amount',
                'orders.paymentMethod',
                'orders.status',
                'orders.created_at',
                'orders.id as orderID',
                'orders.updated_at as theID',
                'products.*'
            )
            ->where('orders.status', 'Process')
            ->where('reseller_ID', session()->get('key'))
            ->orderByDesc('theID')->get();
        }
    }

    function get_orders_Completed(){
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            // return $this->where('status', 'Completed')->orderByDesc('updated_at')->get();
            return DB::table('orders')
            ->join('products', 'orders.product_ID','products.product_id')
            ->select(
                'orders.reseller_ID',
                'orders.product_ID',
                'orders.order',
                'orders.Amount',
                'orders.paymentMethod',
                'orders.status',
                'orders.created_at',
                'orders.id as orderID',
                'orders.updated_at as theID',
                'products.*'
            )
            ->where('orders.status', 'Completed')->orderByDesc('theID')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return DB::table('orders')
            ->join('products', 'orders.product_ID','products.product_id')
            ->select(
                'orders.reseller_ID',
                'orders.product_ID',
                'orders.order',
                'orders.Amount',
                'orders.paymentMethod',
                'orders.status',
                'orders.created_at',
                'orders.id as orderID',
                'orders.updated_at as theID',
                'products.*'
            )
            ->where('orders.status', 'Completed')
            ->where('reseller_ID', session()->get('key'))
            ->orderByDesc('theID')->get();
        }
    }


    function get_orders_Cancelled(){
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            // return $this->where('status', 'Cancelled')->orderByDesc('updated_at')->get();
            return DB::table('orders')
            ->join('products', 'orders.product_ID','products.product_id')
            ->select(
                'orders.reseller_ID',
                'orders.product_ID',
                'orders.order',
                'orders.Amount',
                'orders.paymentMethod',
                'orders.status',
                'orders.created_at',
                'orders.id as orderID',
                'orders.updated_at as theID',
                'products.*'
            )
            ->where('orders.status', 'Cancelled')->orderByDesc('theID')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return DB::table('orders')
            ->join('products', 'orders.product_ID','products.product_id')
            ->select(
                'orders.reseller_ID',
                'orders.product_ID',
                'orders.order',
                'orders.Amount',
                'orders.paymentMethod',
                'orders.status',
                'orders.created_at',
                'orders.id as orderID',
                'orders.updated_at as theID',
                'products.*'
            )
            ->where('orders.status', 'Cancelled')
            ->where('reseller_ID', session()->get('key'))
            ->orderByDesc('theID')->get();
        }
    }

    function SubmitClientOrder($submit_req){
        // dd($submit_req);
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            $this->create($submit_req);
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
            $orders = orders::where('status', 'Pending')
                            ->orwhere('status', 'Process')
                            ->get();
            $filtered_orders = $orders->where('reseller_ID', '=', session()->get(env('USER_SESSION_KEY')))
                                    ->count();
            return  $filtered_orders;

        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Pending')
                        ->orwhere('status', 'Process')
                        ->count();
        }
    }

    function OrdersPendingProcessData(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            $orders =  orders::join('products', 'orders.product_id', '=', 'products.product_id')
                        ->join('log_in_models', 'orders.reseller_ID', '=', 'log_in_models.reseller_id')
                        ->select('products.*', 'log_in_models.*', 'orders.*', 'orders.status AS theSTS')
                        ->orderBy('theSTS', 'DESC')
                        ->where('orders.reseller_ID',  session()->get(env('USER_SESSION_KEY')))
                        ->get();
            $filtered_orders = $orders->filter(function ($order) {
                return $order->status === 'Pending' || $order->status === 'Process';
            });

            return  $filtered_orders;

        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return orders::join('products', 'orders.product_id', '=', 'products.product_id')
                            ->join('log_in_models', 'orders.reseller_ID', '=', 'log_in_models.reseller_id')
                            ->select('products.*', 'log_in_models.*', 'orders.*', 'orders.status AS theSTS')
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

    function getAllData($ID){
        return $this->where('id','=', $ID)->get();
    }

    function DeclineOrder($ID){
        return $this->where('id', '=', $ID)->update(['status' => 'Cancelled']);
    }

    function updateNewQty($id, $updatedValue){
        return $this->where('id', '=', $id)
                    ->update($updatedValue);
    }
}
