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
        $totalStock = DB::table('products')
                    ->sum('stocks');
        return session()->put('totalStock',  $totalStock);
    }
}
