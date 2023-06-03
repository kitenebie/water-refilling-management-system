<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class client_stocks extends Model
{
    use HasFactory;

    protected $gruarded = [];
    protected $fillable = [
        'reseller_id',
        'product_id',
        'quantity'
    ];
    function Save_Stocks($client_stock_data){
        return $this->create($client_stock_data);
    }

    function GetTotalSumOfAllUserStocks(){
        $totalStock = DB::table('client_stocks')
                    ->where('reseller_id', session()->get(env('USER_SESSION_KEY')))
                    ->sum('quantity');
        return session()->put('totalStock',  $totalStock);
        //session()->get('totalStock');
    }
}
