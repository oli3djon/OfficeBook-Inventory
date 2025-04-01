<?php

namespace App\Http\Controllers\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\OfficeController;
use DB;

class StartController extends OfficeController
{
    public function index()
    {   
        return view('office.start.index', array(
            'rol' => $this->usrol(),
        ));
    }
}

