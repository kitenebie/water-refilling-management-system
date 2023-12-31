<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RefillSales extends Model
{
    use HasFactory;

    protected $guarded = [];

    function RefillgetMonthlySales($searchyear)
    {
        $refillsales = DB::table('refill_sales')
                        ->select(DB::raw('YEAR(created_at) AS Year, MONTH(created_at) AS Month, SUM(Amount) AS TotalSales'))
                        ->where('Account_SaleID', session()->get('key'))
                        ->WhereYear('created_at', '=', date($searchyear))
                        ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
                        ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
                        ->get();
       return $refillsales->toArray();

    }

    function getRefillALLSales($searchyear)
    {
        $refillAllsales = DB::table('refill_sales')
            ->select(DB::raw('YEAR(created_at) AS Year, SUM(Amount) AS TotalSales'))
            ->where('Account_SaleID', session()->get('key'))
            ->WhereYear('created_at', '=', date($searchyear))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'))
            ->get();

        return $refillAllsales->toArray();

    }

    function SaveRefillSales($refillData){
        return $this->create($refillData);
    }

}
