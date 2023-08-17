<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class refillRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    function SaveRefillRequest($refillrequestDATA){
        return $this->create($refillrequestDATA);
    }

    function RefillPendingData(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('status', 'Pending')
                        ->where('Reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->sum('TotalCost');
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Pending')
                        ->sum('TotalCost');
        }
    }
    function RefillProccessData(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return $this->where('status', 'Process')
                        ->where('Reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->sum('TotalCost');
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return $this->where('status', 'Process')
                        ->sum('TotalCost');
        }
    }

    function statusPendingRefill(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return DB::table('refill_requests')
                        ->join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                        ->where('refill_requests.Reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->where('refill_requests.status', 'Pending')
                        ->select('refill_requests.updated_at', 'refill_requests.id','refill_requests.Reseller_ID', 'refill_requests.NumberOfGallon', 'refill_requests.RefillCost', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost', 'refill_requests.status', 'log_in_models.firstname', 'log_in_models.lastname')
                        ->orderByDesc('refill_requests.updated_at')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return DB::table('refill_requests')
                        ->join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                        ->where('refill_requests.status', 'Pending')
                        ->select('refill_requests.updated_at', 'refill_requests.id','refill_requests.Reseller_ID', 'refill_requests.NumberOfGallon', 'refill_requests.RefillCost', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost', 'refill_requests.status', 'log_in_models.firstname', 'log_in_models.lastname')
                        ->orderByDesc('refill_requests.updated_at')->get();
        }
    }

    function statusProcessRefill(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return DB::table('refill_requests')
                        ->join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                        ->where('refill_requests.Reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->where('refill_requests.status', 'Process')
                        ->select('refill_requests.updated_at', 'refill_requests.id','refill_requests.Reseller_ID', 'refill_requests.NumberOfGallon', 'refill_requests.RefillCost', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost', 'refill_requests.status', 'log_in_models.firstname', 'log_in_models.lastname')
                        ->orderByDesc('refill_requests.updated_at')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return DB::table('refill_requests')
                        ->join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                        ->where('refill_requests.status', 'Process')
                        ->select('refill_requests.updated_at', 'refill_requests.id','refill_requests.Reseller_ID', 'refill_requests.NumberOfGallon', 'refill_requests.RefillCost', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost', 'refill_requests.status', 'log_in_models.firstname', 'log_in_models.lastname')
                        ->orderByDesc('refill_requests.updated_at')->get();
        }
    }

    function statusCompleteRefill(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return DB::table('refill_requests')
                        ->join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                        ->where('refill_requests.Reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->where('refill_requests.status', 'Completed')
                        ->select('refill_requests.updated_at', 'refill_requests.id','refill_requests.Reseller_ID', 'refill_requests.NumberOfGallon', 'refill_requests.RefillCost', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost', 'refill_requests.status', 'log_in_models.firstname', 'log_in_models.lastname')
                        ->orderByDesc('refill_requests.updated_at')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return DB::table('refill_requests')
                        ->join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                        ->where('refill_requests.status', 'Completed')
                        ->select('refill_requests.updated_at', 'refill_requests.id','refill_requests.Reseller_ID', 'refill_requests.NumberOfGallon', 'refill_requests.RefillCost', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost', 'refill_requests.status', 'log_in_models.firstname', 'log_in_models.lastname')
                        ->orderByDesc('refill_requests.updated_at')->get();
        }
    }

    function statusCancelledRefill(){
        if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER')){
            return DB::table('refill_requests')
                        ->join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                        ->where('refill_requests.Reseller_ID', session()->get(env('USER_SESSION_KEY')))
                        ->where('refill_requests.status', 'Cancelled')
                        ->select('refill_requests.updated_at', 'refill_requests.id','refill_requests.Reseller_ID', 'refill_requests.NumberOfGallon', 'refill_requests.RefillCost', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost', 'refill_requests.status', 'log_in_models.firstname', 'log_in_models.lastname')
                        ->orderByDesc('refill_requests.updated_at')->get();
        }
        if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN')){
            return DB::table('refill_requests')
                        ->join('log_in_models', 'refill_requests.Reseller_ID', '=', 'log_in_models.reseller_id')
                        ->where('refill_requests.status', 'Cancelled')
                        ->select('refill_requests.updated_at', 'refill_requests.id','refill_requests.Reseller_ID', 'refill_requests.NumberOfGallon', 'refill_requests.RefillCost', 'refill_requests.RefillShipFee', 'refill_requests.TotalCost', 'refill_requests.status', 'log_in_models.firstname', 'log_in_models.lastname')
                        ->orderByDesc('refill_requests.updated_at')->get();
        }
    }

    function Accept_refill($ref_ID){
        return $this->where('id', $ref_ID)
                    ->update([
                        'status' => 'Process'
                    ]);
    }

    function completed_refill($ID){
        $this->where('id', $ID)
                    ->update([
                        'status' => 'Completed'
                    ]);
    }

    function Decline_refill($ID){
        return $this->where('id', '=', $ID)->update(['status' => 'Cancelled']);
    }
}
