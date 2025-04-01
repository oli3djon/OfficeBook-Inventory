<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use DB;

class InventoryController extends AdminController
{
    public function inventorys(Request $request , $id = 'all') {

        $menu_active = $this->menuactive();
        $menu_active['menu_inventory']= 'class="treeview active"';
        $menu_active['menu_inventory_all']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/inventorys"> Имущество</a></li>';
        $mesege = "<a href='/admin/inventorys' title='Все Имущество'>Имущество</a> / ";
        $inventorys_get = DB::table('inventorys')
            ->select('inventorys.*', 'inventorys.id as inventorys_id', 'groups.name as groups_name', 'groups.id as groups_id', 'inventorys.name as inventorys_name', 'points.name as points_name', 'points.id as points_id', 'peoples.name as peoples_name', 'peoples.surname as peoples_surname')
            ->join('groups', 'inventorys.groups', '=', 'groups.id')
            ->join('points', 'inventorys.points', '=', 'points.id')
            ->join('peoples', 'inventorys.peoples', '=', 'peoples.id')
            ->orderBy('name', 'asc');
        if($id > 0){
            $inventorys_get->where('inventorys.groups', '=', $id)->where('inventorys.state', '!=', '3');
            $group = DB::table('groups')->where('id', $id)->first();
            $mesege = $mesege.$group->name;
            $menu_active['menu_inventory_all']= '';
            $menu_active['menu_inventory_'.$id]= 'class="active"';
            $leftmenu = $leftmenu.'<li>'.$group->name.'</li>';
        }elseif($id == 'n'){
            $inventorys_get->where('inventorys.state', '=', '1')->where('inventorys.state', '!=', '3');
            $leftmenu = $leftmenu.'<li>Не используется</li>';
            $mesege = $mesege.' Не используется';
            $menu_active['menu_inventory_all']= '';
            $menu_active['menu_inventory_n']= 'class="active"';;
        }elseif($id == 's'){
            $inventorys_get->where('inventorys.state', '=', '3');
            $leftmenu = $leftmenu.'<li>Списаное</li>';
            $mesege = $mesege.' Списаное';
            $menu_active['menu_inventory_all']= '';
            $menu_active['menu_inventory_s']= 'class="active"';
        }else{
            $mesege = $mesege.' Все группы';
            $inventorys_get->where('inventorys.state', '!=', '3');
            $leftmenu = $leftmenu.'<li>Все группы</li>';
        }
        $inventorys = $inventorys_get->get();

        if($id == 0){$group = 1; }else{ $group = $id;}

        $texts = array();
        $states = array();
        foreach ($inventorys as $inventory){
            $texts[$inventory->id] = $this->textclip($inventory->text);
            if($inventory->state == 1){
                $states[$inventory->id] = '<a href="/admin/inventoryrun/stateon/'.$inventory->id.'"><span class="badge bg-yellow" title="'.$this->stateid($inventory->state).' - Сменить на '.$this->stateid('2').'"><i class="fa fa-fw  fa-toggle-off"></i></span></a><span style="color: #fff;">.</span>';
            }elseif ($inventory->state == 2){
                $states[$inventory->id] = '<a href="/admin/inventoryrun/stateoff/'.$inventory->id.'"><span class="badge bg-green" title="'.$this->stateid($inventory->state).' - Сменить на '.$this->stateid('1').'"><i class="fa fa-fw  fa-toggle-on"></i></span></a>';;
            }else{
                $states[$inventory->id] = '<a href="/admin/inventoryrun/stateon/'.$inventory->id.'"><span class="badge bg-red" title="'.$this->stateid($inventory->state).' - Сменить на '.$this->stateid('2').'"><i class="fa fa-fw  fa-toggle-off"></i></span></a>';;
            }
        }

        return view('admin.inventory.inventorys', array(
            'mesege' => $mesege,
            'group' => $group,
            'groups' => $this->groupmas(),
            'texts' => $texts,
            'states' => $states,
            'inventorys' => $inventorys,
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    public function inventory(Request $request, $id) {

        $menu_active = $this->menuactive();
        $menu_active['menu_inventory']= 'class="treeview active"';
        $menu_active['menu_inventory_all']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/inventorys"> Имущество</a></li>';
        $sevedapp = "";

        $inventory_count = DB::table('inventorys')->where('id', '=', $id)->count();
        if($inventory_count < 1){
            return redirect()->intended('/admin/inventorys');
        }

        $inventory = DB::table('inventorys')
            ->select('inventorys.*', 'inventorys.id as inventorys_id', 'groups.id as groups_id', 'groups.name as groups_name', 'inventorys.name as inventorys_name', 'points.id as points_id', 'points.name as points_name', 'peoples.id as peoples_id', 'peoples.name as peoples_name', 'peoples.surname as peoples_surname')
            ->join('groups', 'inventorys.groups', '=', 'groups.id')
            ->join('points', 'inventorys.points', '=', 'points.id')
            ->join('peoples', 'inventorys.peoples', '=', 'peoples.id')
            ->where('inventorys.id', '=', $id)
            ->first();

        $leftmenu = $leftmenu.'<li><a href="/admin/inventorys/'.$inventory->groups.'/">'.$inventory->groups_name.'</a></li><li>'.$inventory->name.'</li>';

        if($inventory->state == 1){
            $state = '<span class="badge bg-yellow" >'.$this->stateid($inventory->state).'</span>';
        }elseif ($inventory->state == 2){
            $state = '<span class="badge bg-green" >'.$this->stateid($inventory->state).'</span>';
            $booton_delist = '<a href="/admin/inventoryrun/stateoff/'.$inventory->id.'"> <button type="button"  title="Сменить на: Не используется"><i class="fa fa-fw  fa-toggle-on"></i></button></a>';
        }else{
            $state = '<span class="badge bg-red" >'.$this->stateid($inventory->state).'</span>';
            $booton_writeoff = '';
        }

        return view('admin.inventory.inventory', array(
            'groups' => $this->groupmas(),
            'inventory' => $inventory,
            'state' => $state,
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    public function inventoryedit(Request $request, $id) {

        $menu_active = $this->menuactive();
        $menu_active['menu_inventory']= 'class="treeview active"';
        $menu_active['menu_inventory_all']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/inventorys"> Имущество</a></li>';
        $sevedapp = "";

        if($request->isMethod('post')) {

            $inventory_old = DB::table('inventorys')->where('id', '=', $id)->first();
            $this->validate($request, [
                'name' => 'required|max:100|min:1',
                'peoples' => 'required',
            ]);

            $data = $request->except('_token');
            $id = $data['id'];
            $data['updated_at'] = date("Y-m-d H:i:s");
            DB::table('inventorys')->where('id', $id)->update($data);

            $this->add_history_inventory(
                '2', 
                Auth::id(),
                $id,
                '',
                $data['name'], 
                $this->peopleid($inventory_old->peoples),
                $this->peopleid($data['peoples']), 
                $this->groupid($inventory_old->groups),
                $this->groupid($data['groups']), 
                $this->pointid($inventory_old->points),
                $this->pointid($data['points']), 
                '',
                '', 
                $inventory_old->text,
                $data['text']
            );
        }

        $inventory_count = DB::table('inventorys')->where('id', '=', $id)->count();
        if($inventory_count < 1){
            return redirect()->intended('/admin/inventorys');
        }

        $inventory = DB::table('inventorys')
            ->select('inventorys.*', 'inventorys.id as inventorys_id', 'groups.name as groups_name', 'inventorys.name as inventorys_name', 'points.name as points_name')
            ->join('groups', 'inventorys.groups', '=', 'groups.id')
            ->join('points', 'inventorys.points', '=', 'points.id')
            ->where('inventorys.id', '=', $id)
            ->first();

        $leftmenu = $leftmenu.'<li><a href="/admin/inventorys/'.$inventory->groups.'/">'.$inventory->groups_name.'</a></li><li><a href="/admin/inventory/'.$inventory->id.'/">'.$inventory->name.'</a></li>';

        $booton_writeoff = '<a href="/admin/inventoryrun/delist/'.$inventory->id.'"> <button type="button"  title="Списать"><i class="fa fa-fw fa-times-circle-o"></i></button></a>';
        $booton_delist = '<a href="/admin/inventoryrun/stateon/'.$inventory->id.'"> <button type="button"  title="Сменить на: Используется"><i class="fa fa-fw  fa-toggle-off"></i></button></a>';
        if($inventory->state == 1){
            $state = '<span class="badge bg-yellow" >'.$this->stateid($inventory->state).'</span>';
        }elseif ($inventory->state == 2){
            $state = '<span class="badge bg-green" >'.$this->stateid($inventory->state).'</span>';
            $booton_delist = '<a href="/admin/inventoryrun/stateoff/'.$inventory->id.'"> <button type="button"  title="Сменить на: Не используется"><i class="fa fa-fw  fa-toggle-on"></i></button></a>';
        }else{
            $state = '<span class="badge bg-red" >'.$this->stateid($inventory->state).'</span>';
            $booton_writeoff = '';
        }

        $peoples = $this->peoplesmas();
        unset($peoples['']);

        return view('admin.inventory.inventoryedit', array(
            'inventory' => $inventory,
            'groups' => $this->groupmas(),
            'points' => $this->pointmas(),
            'peoples' => $peoples,
            'state' => $state,
            'booton_writeoff' => $booton_writeoff,
            'booton_delist' => $booton_delist,
            'sevedapp' => $sevedapp,
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    public function add(Request $request, $id=1) {

        $menu_active = $this->menuactive();
        $menu_active['menu_inventory']= 'class="treeview active"';
        $menu_active['menu_inventory_all']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/inventorys"> Имущество</a></li>';
        
        $peoplesmas = $this->peoplesmas();
        $groupmas = $this->groupmas();
        $pointmas = $this->pointmas();
        $statemas = $this->statemas();

        if($request->isMethod('post')) {

            $this->validate($request, [
                'id' => 'required|digits_between:1,100000000000|unique:inventorys',
                'name' => 'required|max:100|min:1',
                'peoples' => 'required',
            ]);

            $data = $request->except('_token');
            $indata = date("Y-m-d H:i:s");
            $data['created_at'] = $indata;
            $data['updated_at'] = $indata;

            if(@$data['state'] == 'on'){
                $data['state'] = 2;
            }else{
                $data['state'] = 1;
            }

            DB::table('inventorys')->insert($data);            
            $this->add_history_inventory(
                '1', 
                Auth::id(),
                $data['id'],
                '',
                $data['name'], 
                '',
                $peoplesmas[$data['peoples']], 
                '',
                $groupmas[$data['groups']], 
                '',
                $pointmas[$data['points']], 
                '',
                $statemas[$data['state']], 
                '',
                $data['text']
            );
            
            return redirect()->intended('admin/inventorys/'.$data['groups']);
        }
        else{
            $statement = DB::select("SHOW TABLE STATUS LIKE 'inventorys'");

            $inventory = array(
                'name'  => '',
                'id'  => $statement[0]->Auto_increment,
                'groups' => $id,
                'points' => '',
                'people' => '',
                'text' => '',
            );
        }

        return view('admin.inventory.inventoryadd', array(
            'inventory' =>$inventory,
            'groups' => $groupmas,
            'points' => $pointmas,
            'peoples' => $peoplesmas,
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    public function del($id) {

        $inventory = DB::table('inventorys')
            ->select('inventorys.*', 'inventorys.id as inventorys_id', 'inventorys.name as inventorys_name', 'inventorys.text as inventorys_text', 'groups.name as groups_name', 'points.name as points_name', 'peoples.name as peoples_surname')
            ->join('groups', 'inventorys.groups', '=', 'groups.id')
            ->join('points', 'inventorys.points', '=', 'points.id')
            ->join('peoples', 'inventorys.peoples', '=', 'peoples.id')
            ->where('inventorys.id', '=', $id)
            ->first();

        $hiid = DB::table('historys')->insertGetId([
            'id_doc' => $id,
            'typedoc' => 3,
            'typeedit' => 3,
            'user' => Auth::id(),
            'time' => date("Y-m-d H:i:s"),
        ]);

        DB::table('hiedits')->insert(['historys' => $hiid, 'name' => 'Название', 'old' => $inventory->inventorys_name, 'new' => '']);
        DB::table('hiedits')->insert(['historys' => $hiid, 'name' => 'Ответственный', 'old' => $inventory->peoples_surname, 'new' => '']);
        DB::table('hiedits')->insert(['historys' => $hiid, 'name' => 'Инвентарная группа', 'old' => $inventory->groups_name, 'new' => '']);
        DB::table('hiedits')->insert(['historys' => $hiid, 'name' => 'Место хранения', 'old' => $inventory->points_name, 'new' => '']);
        DB::table('hiedits')->insert(['historys' => $hiid, 'name' => 'Дополнительная информация', 'old' => $inventory->inventorys_text, 'new' => '']);
        DB::table('inventorys')->where('inventorys.id', '=', $id)->delete();

        return redirect()->back();
    }

    public function inventoryrun($run, $id) {

        $inventory = DB::table('inventorys')
            ->select('inventorys.*', 'inventorys.id as inventorys_id', 'inventorys.name as inventorys_name', 'inventorys.text as inventorys_text', 'groups.name as groups_name', 'points.name as points_name', 'peoples.name as peoples_surname')
            ->join('groups', 'inventorys.groups', '=', 'groups.id')
            ->join('points', 'inventorys.points', '=', 'points.id')
            ->join('peoples', 'inventorys.peoples', '=', 'peoples.id')
            ->where('inventorys.id', '=', $id)
            ->first();
        
        $data['state'] = 0;
        if($run == 'stateoff'){
            $data['state'] = 1;  
        }elseif($run == 'stateon'){
            $data['state'] = 2;   
        }elseif($run == 'delist'){
            $data['state'] = 3;   
        }
        
        if($data['state'] > 0){
            $data['updated_at'] = date("Y-m-d H:i:s");
            DB::table('inventorys')->where('id', $id)->update($data);
            $hiid = DB::table('historys')->insertGetId([
                'id_doc' => $id,
                'typedoc' => 3,
                'typeedit' => 2,
                'user' => Auth::id(),
                'time' => date("Y-m-d H:i:s"),
            ]);
            DB::table('hiedits')->insert(['historys' => $hiid, 'name' => 'Состояние', 'old' => $this->stateid($inventory->state), 'new' => $this->stateid($data['state'])]);
        }
        
        return redirect()->back();
    }
}
