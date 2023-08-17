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
            'Fee' => $saveAddressWithFee->fee
        ];
        $findAddress = $this->where('Address', $Data['Address'])->first();
        if($findAddress == null){
            return $this->create($Data);
        }else{
            return back()->with('existed', 'Already Registerd!');
        }
        return back()->with('success', 'Registerd!');
    }

    function getAddress(){
        return $this->orderBy('id', 'desc')->get();
    }

    function Address(){
        return $this->orderBy('Address', 'desc')->get();
    }
}
