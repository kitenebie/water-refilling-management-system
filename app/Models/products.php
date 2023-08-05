<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class products extends Model
{
    use HasFactory;

    protected $guarded = [];

    function get_products(){
        return $this->all();
    }

    function get_product_info($option){
        return $this->where('product_id', $option)->get();
    }

    function save_new_product($data_product){
        return $this->create($data_product);
    }

    function get_Data_to_Update($prd_ID){
        return $this->where('id', $prd_ID)->get();
    }

    function updatingStocks($ID, $qty){
        $Stocks = $this->where('id', $ID)->get('stocks');
        foreach($Stocks as $stock){
            $NewStocks = $stock->stocks + $qty;
            return $this->where('id', $ID)->update(['stocks' => $NewStocks]);
        }
    }

    function Deleting_Product($prdID){
        return $this->where('id', $prdID)->delete();
    }

    function searchForPresentProduct($search){
        return $this->where('product_Name','LIKE', '%'.$search.'%')->get();
    }

    function getALLAdminStocks(){
        return $this->sum('stocks');
    }

    function decreaseStockUpdate($qty, $pdtID){
         $this->where('user_id', session()->get(env('USER_SESSION_KEY')))
                        ->where('product_id', '=', $pdtID)
                        ->where('stocks', '>', $qty)
                        ->update([
                        'stocks' => DB::raw('stocks - '.$qty.''),
                        ]);
    }

    function getprice($ID){
        $dataPrice = $this->where('id', '=', $ID)->get();
        foreach($dataPrice as $price){
            return $price->price;
        }
    }
}
