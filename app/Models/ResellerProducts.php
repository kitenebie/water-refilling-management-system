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
                                    ->where('User_ID', $ResellerItems['User_ID'])
                                    ->where('product_ID', $ResellerItems['product_ID'])
                                    ->first();
        if ($checkExistedProduct == null) {
            return $this->create($ResellerItems);
        }else{
            return DB::table('reseller_products')
                        ->where('user_id', $ResellerItems['User_ID'])
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

}
