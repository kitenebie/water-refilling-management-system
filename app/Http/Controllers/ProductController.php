<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\ResellerProducts;
use Illuminate\Support\Str;

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
            'product_id' => 'Product-'.Str::random(6),
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
        return redirect('My-service')->with('updated', 'updated');
    }

    function delStocks($delID){
        $this->constructProduct->Deleting_Product($delID);
        return back()->with('delete', 'deleted');
    }

    function searchPresentProduct(Request $search_present_Product){
        $productData = $this->constructProduct->searchForPresentProduct($search_present_Product->search);
        return view('orders', compact('productData'));
    }

    function ResellerProductPrice(){
        return $this->comstructorResellerProducts->GetProductPrice();
    }

    function productPrices($data) {
        // Get the price of the product associated with the field1 parameter.
        $price = $this->constructProduct->getprice($data);

        // Return the price.
        return $price;
    }

}
