<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class refillCost extends Model
{
    use HasFactory;
    protected $guarded = [];
    function createCost($rillcost){
        $findID = DB::table('refill_costs')->first();
        if ($findID == null){
            return $this->create($rillcost);
        }
        return  DB::table('refill_costs')->update($rillcost);
    }

    function getRefillCost(){
        $data = DB::select("SELECT * FROM `refill_costs`");
        foreach($data as $costonly){
            return $costonly->RefillCost;
        }
    }
}
