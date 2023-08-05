<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ResellerProducts extends Model
{
    use HasFactory;
    protected $guarded = [];

    function ProductSave($ResellerItems){
        $checkExistedProduct = DB::table('reseller_products')
                                    ->where('User_ID', '=',$ResellerItems['User_ID'])
                                    ->where('product_ID','=', $ResellerItems['product_ID'])
                                    ->first();
        if ($checkExistedProduct == null) {
            return $this->create($ResellerItems);
        }else{
            return DB::table('reseller_products')
                        ->where('User_ID','=', $ResellerItems['User_ID'])
                        ->where('product_ID','=', $ResellerItems['product_ID'])
                        ->update([
                        'Quantity' => DB::raw('Quantity + '.$ResellerItems['Quantity'].''),
                        ]);
        }
    }

    function GetAllResellerData(){
        // Join the two tables
        return DB::table('reseller_products')
        ->join('products', 'reseller_products.product_ID', '=', 'products.product_id')
        ->select('reseller_products.User_ID', 'reseller_products.product_ID','products.product_Name', 'reseller_products.Price', 'reseller_products.Quantity', 'products.product_Name')
        ->where('reseller_products.User_ID','=',session()->get(env('USER_SESSION_KEY')))
        ->get();
    }

    function GetProductPrice(){
        return DB::table('reseller_products')
        ->select('reseller_products.User_ID', 'reseller_products.product_ID','products.product_Name', 'reseller_products.Price', 'reseller_products.Quantity', 'products.product_Name')
        ->join('products', 'reseller_products.product_ID', '=', 'products.product_id')
        ->get();
    }

    function getproductDetails(){
        return DB::table('reseller_products')
                ->join('products', 'reseller_products.product_ID', '=', 'products.product_id')
                ->select('reseller_products.Price', 'products.product_Name', 'reseller_products.id')
                ->where('reseller_products.User_ID','=',session()->get(env('USER_SESSION_KEY')))
                ->get();
    }

    function updatePriceData($up_data, $info){
        return $this->where('reseller_products.User_ID','=',session()->get(env('USER_SESSION_KEY')))
                    ->where('reseller_products.id','=',$info)
                    ->update($up_data);
    }

    function Save_Stocks($client_stock_data){
        return $this->where('User_ID', session()->get(env('USER_SESSION_KEY')))
                    ->where('product_ID','=', $client_stock_data['product_id'])
                    ->update(['Quantity' => 'Quantity + '. $client_stock_data['quantity']]);
    }

    function getUserCurrentStocks(){
        return DB::select('SELECT * FROM reseller_products WHERE User_ID="'.session()->get(env('USER_SESSION_KEY')).'" AND Quantity <= limit_stock');
    }

    function ClientStocks(){
        return DB::table('reseller_products')
        ->join('products', 'reseller_products.product_ID', '=', 'products.product_id')
        ->where('reseller_products.User_ID', '=',session()->get(env('USER_SESSION_KEY')))
        ->select('products.product_Name', 'products.price', DB::raw('SUM(reseller_products.Quantity) AS total_quantity'))
        ->groupBy('products.product_id','products.product_Name', 'products.price')
        ->get();

    }

    function GetTotalSumOfAllUserStocks(){
        return $this->where('User_ID', session()->get(env('USER_SESSION_KEY')))
                    ->sum('Quantity');
    }

    function updateStocklimitID($up_limit, $limit_id){
            echo  "ID: ".$limit_id . " | Price: ". $up_limit. '<hr>';

        return $this->where('User_ID', '=', session()->get(env('USER_SESSION_KEY')))
                    ->where('product_ID', '=', $limit_id)
                    ->update(['limit_stock' => $up_limit]);
    }
}
