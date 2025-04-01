<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use DB;

class PointController extends AdminController
{
    //Места хранения
    public function points(Request $request) {

        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_points']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li> Mеста храения </li>';
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии

        $points = DB::table('points')->select('*')->orderBy('name', 'asc')->get();
        return view('admin.points.points', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'mesalt' => $mesalt,
            'groups' => $this->groupmas(),
            'points' => $points
        ));
    }

    //Добавляем
    public function add(Request $request) {
        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_points']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/points">  Места храения </a></li>';
        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:100|min:1|unique:points',
            ]);
            $data = $request->except('_token');
            DB::table('points')->insert($data);
            return redirect()->intended('admin/points/');
        }
        $point = array('name'  => '');
        return view('admin.points.pointadd', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'groups' => $this->groupmas(),
            'point' => $point
        ));
    }

    //Редактируем
    public function point(Request $request, $id) {

        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_points']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/points">  Места храения </a></li>';
        $sevedapp = "";
        $point_old = DB::table('points')->where('id', '=', $id)->first();
        if($request->isMethod('post')) {
            $data = $request->except('_token');
            if($point_old->name != $data['name']) {
                $this->validate($request, [
                    'name' => 'required|max:100|min:1|unique:points',
                ]);
                $id = $data['id'];
                DB::table('points')->where('id', $id)->update($data);
                $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
            }
        }
        $point = DB::table('points')->where('id', '=', $id)->first();

        $leftmenu = $leftmenu.'<li><a href="/admin/pointin/'.$id.'"> '.$point->name.' </a></li>';
        return view('admin.points.point', array(
            'point' => $point,
            'sevedapp' => $sevedapp,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    public function in(Request $request, $id) {
        $pointmas = $this->pointmas();
        $sevedapp = '';
        $texts = array();
        $states = array();
        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_points']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/points">  Места храения </a></li>';
        $mesege = "<a href='/admin/inventorys' title='Вся компьютерная техника'> Места храения</a> / ";

        if($request->isMethod('post')) {
            $data = $request->except('_token');
            if($data ['points'] != $id and isset($data ['move'])){
                foreach ($data ['move'] as $key => $value){
                    $insert['points'] = $data ['points'];
                    DB::table('inventorys')->where('id', $key)->update( $insert);
                    //Добавляем данные в истрию
                    $hiid = DB::table('historys')->insertGetId([
                        'id_doc' => $key, //ID дкумента
                        'typedoc' => 3, //Тип документа
                        'typeedit' => 2, //Тип правки
                        'user' => Auth::id(), //ID пользователя
                        'time' => date("Y-m-d H:i:s"), //Дата правки
                    ]);
                    DB::table('hiedits')->insert(['historys' => $hiid, 'name' => 'Место хранения', 'old' => $pointmas[$id], 'new' => $pointmas[$data['points']]]);
                }
                $sevedapp = '<div class="callout callout-success"><h4>Перемещенно в  <a href="/admin/pointin/'.$data ['points'].'">'.$pointmas[$data['points']].'</a></h4></div>';
            }
        }

        $inventorys_get = DB::table('inventorys')
            ->select('inventorys.*', 'inventorys.id as inventorys_id', 'groups.name as groups_name', 'groups.id as groups_id', 'inventorys.name as inventorys_name', 'points.name as points_name', 'points.id as points_id', 'peoples.name as peoples_name', 'peoples.surname as peoples_surname')
            ->join('groups', 'inventorys.groups', '=', 'groups.id')
            ->join('points', 'inventorys.points', '=', 'points.id')
            ->join('peoples', 'inventorys.peoples', '=', 'peoples.id')
            ->orderBy('name', 'asc');
        if($id > 0){
            $inventorys_get->where('inventorys.points', '=', $id);
            $point = DB::table('points')->where('id', $id)->first();
            $mesege = $mesege.$point->name;
        }
        $inventorys = $inventorys_get->get();
        $leftmenu = $leftmenu.'<li> '.$point->name.' </li>';

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

        return view('admin.points.pointin', array(
            'id' => $id,
            'mesege' => $mesege,
            'sevedapp' => $sevedapp,
            'inventorys' => $inventorys,
            'points' => $this->pointmas(),
            'texts' => $texts,
            'states' => $states,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    //Удаляем
    public function del(Request $request, $id) {
        $cloum = DB::table('inventorys')->where('points', '=', $id)->count();
        if($cloum > 0){
            $point = DB::table('points')->where('id', '=', $id)->first();
            $point_name = $point->name;
            $request->session()->put('mesalt', 'Удалять место: "'.$point_name.'" нельзя! Так как в нем находиться техника.'); //Создаем елемент сесии
            return redirect()->intended('admin/points/');
        }
        DB::table('points')->where('id', '=', $id)->delete();
        return redirect()->intended('admin/points/');
    }

}
