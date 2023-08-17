<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
// use App\Mail\MailNotification;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function index()
    // {
    //     $data = [
    //         'title' => 'Sample Email',
    //         'content' => 'This is a sample email sent using Laravel Mail.'
    //     ];

    //     $recipientEmail = 'kent14328@gmail.com';
    //     $recipientName = 'Recipient Name';

    //     Mail::to($recipientEmail, $recipientName)
    //         ->send(new MailNotification($data));

    //     return "Email sent successfully!";
    // }
}
