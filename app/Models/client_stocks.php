<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class client_stocks extends Model
{
    use HasFactory;

    protected $guarded = [];

    function Save_Stocks($client_stock_data){
        return $this->create($client_stock_data);
    }

    function GetTotalSumOfAllUserStocks(){
        return DB::table('client_stocks')
                    ->where('reseller_id', session()->get(env('USER_SESSION_KEY')))
                    ->sum('quantity');
    }
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
        $stocks_details = DB::table('client_stocks')
        ->join('products', 'client_stocks.product_id', '=', 'products.product_id')
        ->select('client_stocks.prdt_limit', 'products.product_Name', 'client_stocks.product_id')
        ->where('client_stocks.reseller_id','=',session()->get(env('USER_SESSION_KEY')))
        ->get();

        $uniquestocks_details = [];
        $uniquestocks_limit = [];
        $uniquestocks_product_id = [];
        foreach ($stocks_details as $stocks_detail) {
        $prdctName = $stocks_detail->product_Name;
        $prdctprdt_limit = $stocks_detail->prdt_limit;
        $prdct_prdctID =  $stocks_detail->product_id;
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

    function updateStocklimitID($up_limit, $limit_id){
        return $this->where('reseller_id','=',session()->get(env('USER_SESSION_KEY')))
                    ->where('product_id','=',$limit_id)
                    ->update($up_limit);
    }
}
