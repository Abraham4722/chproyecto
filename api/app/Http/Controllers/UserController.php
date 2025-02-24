<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function sendEmail(){

    
        $data['code']=rand(1000,9999);
        $to="tuluquin.013@gmail.com";
        $subject="Código de verificación";
        Mail::send('mails.verification',$data, function($message) use ($to,$subject){
            $message->to($to)
            ->subject($subject);
            $message->from('tuluquin.013@gmail.com',"Bienvenido a Mi Tienda Online");
        });
        echo "SE ENVIO EL CORREO";
    }
}
