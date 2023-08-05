<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\ResellerProducts;
use App\Models\announcementPosting;
use DateTime;

class NotificationController extends Controller
{
    private $constructNotify, $constructResellerProducts, $announcementPost;
    private $notificationTable = "notifications";
    public $id;
    public $title;
    public $message;
    public $ntime;
    public $repeat;
    public $nloop;
    public $publish_date;
	public $username;
    function __construct()
    {
        $this->constructNotify = new Notifications();
        $this->constructResellerProducts = new ResellerProducts();
        $this->announcementPost = new announcementPosting();
        return $this;
    }
    function test(){
        return view('test');
    }

    function Save_Reseller_Stocks()
    {
        $remainigStocks = $this->constructResellerProducts->getUserCurrentStocks();
        $date = new DateTime();
        foreach($remainigStocks as $remainigStock){
            $data = [
                'title' => "Jonel's Refilling Station",//$notify->title,
                'message' => $remainigStock->product_ID." is out of Stocks, Remaining Stocks: ". $remainigStock->Quantity,//$notify->message,
                'ntime' =>  $date,//$notify->ntime,
                'repeat' => 1,//$notify->repeat,
                'nloop' => 1,//$notify->nloop,
                'username' => session()->get('username'),//$notify->username,
                'publish_date' => $date
            ];
            $this->constructNotify->saveNotification($data);
        }
    }

    function delete_Notification(){
        return $this->constructNotify->deleteNotification();
    }

    function getNotificationByUser(){
        $result = $this->constructNotify->getNotificationUser();
        $array=array();
        $rows=array();
        $totalNotification = 0;
        $user = '';
        foreach($result as $userNotification){
         $data['title'] = $userNotification->title;
         $data['message'] = $userNotification->message;
         $data['icon'] = 'https://hercynian-versions.000webhostapp.com/img/header-dashboard.png';
         $data['url'] = 'https://hercynian-versions.000webhostapp.com/Settings';
         $rows[] = $data;
         $user =$userNotification->username;
         $nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+($userNotification->repeat*60));
        $this->constructNotify->ntime = $nextime;
        $this->constructNotify->id = $userNotification->id;
         $totalNotification++;
        }
        $array['notif'] = $rows;
        $array['count'] = $totalNotification;
        $array['username'] = $user;
        $array['result'] = true;
        return json_encode($array);
    }

    function ShowPostNotification(){
        $dataAnnouncements = $this->announcementPost->get_announcement();
        return view('Notification', compact('dataAnnouncements'));
    }
}
