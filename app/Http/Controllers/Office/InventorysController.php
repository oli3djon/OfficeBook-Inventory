<?php

namespace App\Http\Controllers\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\OfficeController;
use DB;

class InventorysController extends OfficeController
{
    public function inventorys()
    {
        $inventorys = DB::table('inventorys')
            ->select('inventorys.*', 'inventorys.id as inventorys_id', 'groups.name as groups_name', 'groups.id as groups_id', 'inventorys.name as inventorys_name', 'points.name as points_name', 'points.id as points_id', 'peoples.id as peoples_id', 'peoples.name as peoples_name', 'peoples.surname as peoples_surname')
            ->join('groups', 'inventorys.groups', '=', 'groups.id')
            ->join('points', 'inventorys.points', '=', 'points.id')
            ->join('peoples', 'inventorys.peoples', '=', 'peoples.id')
            ->get();

        $texts = array();
        $states = array();
        foreach ($inventorys as $inventory){
            $texts[$inventory->id] = iconv_substr ($inventory->text, 0 , 50 , 'UTF-8' );
            $states[$inventory->id] = $this->stateid($inventory->state);
        }



        $mesege = "Имущество";
        return view('office.inventorys.inventorys', array(
            'mesege' => $mesege,
            'rol' => $this->usrol(),
            'inventorys' => $inventorys,
        ));
    }
}
