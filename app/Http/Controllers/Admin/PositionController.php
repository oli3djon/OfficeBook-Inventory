<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use DB;

class PositionController extends AdminController
{
    public function positions(Request $request)
    {
        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_us_positions']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li> Должности </li>';
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии

        $positions = DB::table('positions')->select('*')->orderBy('name', 'asc')->get();
        return view('admin.positions.positions', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'mesalt' => $mesalt,
            'groups' => $this->groupmas(),
            'positions' => $positions
        ));
    }

    public function add(Request $request)
    {
        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_us_positions']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/positions"> Должности </a></li>';
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии

        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:200|min:1|unique:positions',
            ]);
            $data = $request->except('_token');
            DB::table('positions')->insert($data);
            return redirect()->intended('admin/positions/');
        }

        $position = array('name'  => '');
        return view('admin.positions.positionadd', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'mesalt' => $mesalt,
            'groups' => $this->groupmas(),
            'position' => $position
        ));
    }

    public function position(Request $request, $id) {

        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_us_positions']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/positions"> Должности </a></li>';
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии

        $sevedapp = "";
        $position_old = DB::table('positions')->where('id', '=', $id)->first();
        if($request->isMethod('post')) {
            $data = $request->except('_token');
            if($position_old->name != $data['name']) {
                $this->validate($request, [
                    'name' => 'required|max:200|min:1|unique:positions',
                ]);
                $id = $data['id'];
                DB::table('positions')->where('id', $id)->update($data);
                $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
            }
        }
        $position = DB::table('positions')->where('id', '=', $id)->first();
        $cloum = DB::table('peoples')->where('position', '=', $id)->whereIn('status', [1, 3])->count();

        if($cloum > 0){$del_button ='';}else{$del_button ='<button type="button" data-toggle="modal" data-target="#modal-default" title="Удалить"><i class="fa fa-fw fa-times"></i></button>';}

        $peoples = DB::table('peoples')
            ->select('peoples.*', 'peoples.id as peoples_id', 'peoples.name as people_name', 'peoples.surname as people_surname', 'addresses.id as addresses_id', 'addresses.name as addresses_name')
            ->join('addresses', 'peoples.addresses', '=', 'addresses.id')
            ->where('position', '=', $id)
            ->whereIn('status', [1, 3])
            ->orderBy('peoples.surname', 'asc')
            ->get();

        $leftmenu = $leftmenu.'<li> '.$position->name.' </li>';
        return view('admin.positions.position', array(
            'position' => $position,
            'sevedapp' => $sevedapp,
            'mesalt' => $mesalt,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'cloum' => $cloum,
            'del_button' => $del_button,
            'peoples' => $peoples,
        ));
    }

    //Удаляем
    public function del(Request $request, $id) {
        $cloum = DB::table('peoples')->where('position', '=', $id)->count();
        if($cloum > 0){
            $point = DB::table('positions')->where('id', '=', $id)->first();
            $point_name = $point->name;
            $request->session()->put('mesalt', 'Удалять должность: "'.$point_name.'" нельзя! Так как на ней назначены люди.'); //Создаем елемент сесии
            return redirect()->intended('admin/positions/');
        }
        DB::table('positions')->where('id', '=', $id)->delete();
        return redirect()->intended('admin/positions/');
    }

    //Снять с должности
    public function positionoff(Request $request, $id) {
        $people = DB::table('peoples')->where('id', '=', $id)->first();
        $position_id = $people->position;
        $data['position'] = '1';
        DB::table('peoples')->where('id', $id)->update($data);
        return redirect()->intended('admin/position/'.$position_id);
    }
}
