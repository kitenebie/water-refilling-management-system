<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class client_stocks extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = [
    //     'reseller_id',
    //     'product_id',
    //     'quantity'
    // ];
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
}
