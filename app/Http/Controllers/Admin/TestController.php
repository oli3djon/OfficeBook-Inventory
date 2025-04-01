<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Mail;

class TestController extends AdminController
{
    public function Index(Request $request, $id=300) {


        return view('admin.test', array(

        ));
	}
}
