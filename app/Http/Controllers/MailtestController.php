<?php

namespace App\Http\Controllers;

use App\Mail\MailClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailtestController extends Controller
{
    public function send(Request $request)
	{

		//$name = $request->name;
		//$email = $request->email;
		//$msg = $request->msg;
        
        $name = 'Тест сенд';
		$email = 'test@itlux.com.ua';
		$msg = 'Тестовое сообщение';

		Mail::to('v@sinenko.in.ua')->send(new MailClass($name, $email, $msg));

	}
}
