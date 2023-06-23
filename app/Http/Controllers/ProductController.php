<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\ResellerProducts;

class ProductController extends Controller
{
    private $constructProduct, $comstructorResellerProducts;
    function __construct()
    { 
            $this->constructProduct = new products();
            $this->comstructorResellerProducts = new ResellerProducts();
            return $this;
    }

    function saving_product(Request $request){
        $data_PR0duct = [
            'User_ID' => session()->get(env('USER_SESSION_KEY')),
            'product_id' => $request->product_ID,
            'product_Name' => $request->product_Name,
            'price' => $request->product_Price,
            'stocks' => $request->product_qty,
        ];
        $this->constructProduct->save_new_product($data_PR0duct);
        return back()->with('success', 'Successfully Saved!');
    }

    function AddingStocks($id){
        $Product = $this->constructProduct->get_Data_to_Update($id);
        return view('Add-Stocks', compact('Product'));
    }

    function updateStocks(Request $prdReq){
        $this->constructProduct->updatingStocks($prdReq->prd_ID, $prdReq->qtyStocks);
        echo '<h1><a href="http://127.0.0.1:8000/My-service">Successfully Updated Stock!</a></h1>';
    }

    function delStocks($delID){
        $this->constructProduct->Deleting_Product($delID);
        echo '<h1><a href="http://127.0.0.1:8000/My-service">Successfully Deleted Product!</a></h1>';
    }

    function searchPresentProduct(Request $search_present_Product){
        $productData = $this->constructProduct->searchForPresentProduct($search_present_Product->search);
        return view('orders', compact('productData'));
    }

    function ResellerProductPrice(){
        return $this->comstructorResellerProducts->GetProductPrice();
    }

}
