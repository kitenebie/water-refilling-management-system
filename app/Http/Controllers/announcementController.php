<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\announcementPosting;
use Illuminate\Support\Str;

class announcementController extends Controller
{
    private $constructAnnoucement;

    function __construct(){
        return $this->constructAnnoucement=new announcementPosting();
    }

    function Announcement_Post(Request $req){
        $req_data = [
            'announce_Code' => Str::random(20),
            'annoucements_content' => $req->annoucements_content
        ];
        $this->constructAnnoucement->Posting_announcement($req_data);
        return back()->with('posted', 'posted!');
    }

    function Announcement_remove($announce_Code){
        $this->constructAnnoucement->removing_announcement($announce_Code);
        return back()->with('removePost', 'deleted!');
    }

    function get_annoucement(){
        return $this->constructAnnoucement->get_announcement();
    }
}
