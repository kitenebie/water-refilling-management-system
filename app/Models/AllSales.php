<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllSales extends Model
{
    use HasFactory;

    protected $gruarded = [];


    function getMonthlySales()
    {
        $sales = DB::table('all_sales')
            ->select(DB::raw('YEAR(created_at) AS Year, MONTH(created_at) AS Month, SUM(Amount) AS TotalSales'))
            ->where('Account_SaleID', session()->get('key'))
            ->whereYear('created_at', '=',  date('Y'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();

        return $sales->toArray();
    }
    function getALLSales()
    {
        $Allsales = DB::table('all_sales')
            ->select(DB::raw('YEAR(created_at) AS Year, SUM(Amount) AS TotalSales'))
            ->where('Account_SaleID', session()->get('key'))
            ->whereYear('created_at', '=',  date('Y'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'))
            ->get();

        return $Allsales->toArray();
    }
    protected $fillable = [
        'Account_SaleID',
        'ProductID',
        'Quantity',
        'Amount'
    ];
    function AddtoAdminSale($AddSale){
        return $this->create($AddSale);
    }

    function GetAllUserCurrentYearlySALE($year){
        $totalUserAmount =  DB::table('all_sales')
                            ->where('Account_SaleID', session()->get(env('USER_SESSION_KEY')))
                            ->whereYear('created_at', $year)
                            ->sum('Amount');
        return session()->put('totalUserAmount',  $totalUserAmount);
        //session()->get('totalUserAmount');
    }
}
