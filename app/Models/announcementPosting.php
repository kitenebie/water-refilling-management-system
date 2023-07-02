<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class announcementPosting extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    function Posting_announcement($req_data){
        return $this->create();
    }

    function removing_announcement($announce_Code){
        return $this->where('announce_Code', '=', $announce_Code)->delete();
    }

    function get_announcement(){
        return $this->get();
    }
}
