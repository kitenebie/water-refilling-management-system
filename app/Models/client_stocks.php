<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class client_stocks extends Model
{
    use HasFactory;

    protected $guarded = [];
    //!ERROR


    // function GetTotalSumOfAllUserStocks(){
    //     return DB::table('client_stocks')
    //                 ->where('reseller_id', session()->get(env('USER_SESSION_KEY')))
    //                 ->sum('quantity');
    // }
        /**
        *SELECT * FROM client_stocks INNER JOIN products ON client_stocks.product_id = products.product_id;
     */
    function ClientStocks(){
        return DB::table('client_stocks')
        ->join('products', 'client_stocks.product_id', '=', 'products.product_id')
        ->select('products.product_Name', 'products.price', DB::raw('SUM(client_stocks.quantity) AS total_quantity'))
        ->groupBy('products.product_id','products.product_Name', 'products.price')
        ->get();

    }

    function getUserCurrentStocks(){
        return DB::select('SELECT * FROM client_stocks WHERE reseller_id="'.session()->get(env('USER_SESSION_KEY')).'" AND quantity <= prdt_limit');
    }

    function stock_details(){
        $stocks_details = DB::table('reseller_products')
        ->join('products', 'reseller_products.product_ID', '=', 'products.product_id')
        ->select('reseller_products.User_ID', 'reseller_products.limit_stock', 'products.product_Name', 'reseller_products.product_ID')
        ->where('reseller_products.User_ID','=',session()->get(env('USER_SESSION_KEY')))
        ->get();

        $uniquestocks_details = [];
        $uniquestocks_limit = [];
        $uniquestocks_product_id = [];
        foreach ($stocks_details as $stocks_detail) {
        $prdctName = $stocks_detail->product_Name;
        $prdctprdt_limit = $stocks_detail->limit_stock;
        $prdct_prdctID =  $stocks_detail->product_ID;
        if (!in_array($prdctName, $uniquestocks_details)) {
            $uniquestocks_details[] = $prdctName;
            $uniquestocks_limit[] = $prdctprdt_limit;
            $uniquestocks_product_id[] = $prdct_prdctID;
        }
        }
        $storeData = [
            'P_ID' => $uniquestocks_product_id,
            'Name' => array_unique($uniquestocks_details),
            'limit' => $uniquestocks_limit
        ];
        return $storeData;
    }


}
