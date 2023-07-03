<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogInModel;
use App\Models\ResellerProducts;
use App\Models\client_stocks;
use App\Models\Notifications;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    private $constructLoginUser, $constructResellerProducts, $constructclient_stocks, $NotificationController;
    
    function __construct()
    { 
        $this->constructLoginUser = new LogInModel();
        $this->constructResellerProducts = new ResellerProducts();
        $this->constructclient_stocks = new client_stocks();
        $this->NotificationController = new Notifications();
        return $this;
    }
    function updateProfile(Request $request)
    {
        // Check if the user has uploaded an image.
        if (!empty($request->image)) {

        }else{
            $data = [
                'firstname' => $request->fname,
                'lastname' => $request->lname
            ];
            $this->constructLoginUser->storeNewUpdateProfile($data);
            return back()->with('imgsuccess', 'Image uploaded successfully!');
        }
    }

    function UpdatePrice(Request $data){
        $setNum = 0;
        foreach($data->ID as $info){
            $up_data = [
                'Price' => $data->price[$setNum],
            ];
            $this->constructResellerProducts->updatePriceData($up_data, $info);
            $setNum++;
        }
        return back()->with('imgsuccess', 'Image uploaded successfully!');
    }

    function updateLimitStocks(Request $limitID){
        $setNum = 0;
        foreach($limitID->myID as $limit_id){
            // echo  "ID: ".$limit_id . " | Price: ". $limitID->prdt_limit[$setNum]. '<hr>';
            $up_limit = [
                'prdt_limit' => $limitID->prdt_limit[$setNum],
            ];
            $this->constructclient_stocks->updateStocklimitID($up_limit, $limit_id);
            $setNum++;
        }
        $this->NotificationController->deleteNotification();
        return back()->with('imgsuccess', 'Image uploaded successfully!');

    }
}
