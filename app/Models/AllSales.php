<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllSales extends Model
{
    use HasFactory;

    protected $guarded = [];

    function availableYear(){
        $allSales = DB::table('all_sales')
            ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
            ->select('created_at')
            ->get();

            $uniqueSales = [];
            foreach ($allSales as $sale) {
            $year = $sale->created_at;
            if (!in_array($year, $uniqueSales)) {
                $uniqueSales[] = date('Y', strtotime($year));
            }
            }

            return array_unique($uniqueSales);
    }
    function getMonthlySales($yearlySALE)
    {
        $sales = DB::table('all_sales')
            ->select(DB::raw('YEAR(created_at) AS Year, MONTH(created_at) AS Month, SUM(Amount) AS Amount'))
            ->whereYear('created_at', '=',  date($yearlySALE))
            ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();

        // var_dump($sales->toArray());
        return $sales->toArray();
    }
    function getALLSales($yearlySALE)
    {
        $Allsales = DB::table('all_sales')
            ->select(DB::raw('YEAR(created_at) AS Year, SUM(Amount) AS TotalSales'))
            ->whereYear('created_at', '=',  date($yearlySALE))
            ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'))
            ->get();

        return $Allsales->toArray();
    }

    function AddtoAdminSale($AddSale){
        return $this->create($AddSale);
    }

    function GetAllUserCurrentYearlySALE($year){
        $productSales =  DB::table('all_sales')
                            ->whereYear('created_at', $year)
                            ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
                            ->sum('Amount');
        $refillSales = DB::table('refill_sales')
                        ->whereYear('created_at', $year)
                        ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
                        ->sum('Amount');
        return $productSales + $refillSales;
    }

    function AddResellerSales($Items_data){
        DB::table('reseller_products')
            ->where('user_id', $Items_data['Account_SaleID'])
            ->where('product_id', $Items_data['ProductID'])
            ->update(['quantity' => DB::raw('quantity - '.$Items_data['Quantity'].'')]);
        DB::table('client_stocks')
        ->where('reseller_id', $Items_data['Account_SaleID'])
        ->where('product_id',  $Items_data['ProductID'])
        ->update(['quantity' => DB::raw('quantity - '.$Items_data['Quantity'].'')]);
        return $this->create($Items_data);
    }
}
