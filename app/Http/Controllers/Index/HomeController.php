<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class HomeController extends IndexController
{
    public function Index() {        
        
        if (Auth::guest()){      
            $refirect = redirect()->intended('/office');
        }
        else{
            $refirect = redirect()->intended('/office');
        }
        return $refirect;
	}
}
