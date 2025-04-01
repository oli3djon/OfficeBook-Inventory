<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App;
use DB;

class StartController extends AdminController
{
    public function Index() {
                
        //$user = Auth::user();
        $mesege = "Старотвая страница админки";
        $peoples = DB::table('peoples')->whereIn('status', [1, 3])->count();
        $users = DB::table('users')->count();
        $inventory = DB::table('inventorys')->count();

        $menuactive = $this->menuactive();

        $leftmenu = $this->leftmenu;
        return view('admin.start', array(
            'mesege' => $mesege,
            'peoples' => $peoples,
            'users' => $users,
            'inventory' => $inventory,
            'groups' => $this->groupmas(),
            'menuactive' => $menuactive,
            'leftmenu' => $leftmenu,
            ));
	}
    
}
