<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AddressFee extends Model
{
    use HasFactory;

    protected $guarded = [];

    function saveAddressFee(Request $saveAddressWithFee){
        $Data = [
            'Address' => $saveAddressWithFee->address,
            'Fee' => $saveAddressWithFee->fee,
            'RefillFee' => $saveAddressWithFee->Refillfee,
        ];
        $findAddress = $this->where('Address', $Data['Address'])->first();
        if($findAddress == null){
            $this->create($Data);
        }else{
            return back()->with('existed', 'Already Registerd!');
        }
        return back()->with('success', 'Registerd!');
    }

    function getAddress(){
        return $this->where('status', '=', null)->orderBy('Address', 'ASC')->get();
    }

    function Address(){
        return $this->where('status', '=', null)->orderBy('Address', 'ASC')->get();
    }

    function DeleteAddressFee($id){
        $this->where('id', '=', $id)->update(['status' => 'Removed']);
        return back()->with('Deleted', 'Done!');
    }

    function isAddressFees(){
        return $this->where('Address', session()->get('USER_CURRENT_ADDRESS'))->get();
    }
}
