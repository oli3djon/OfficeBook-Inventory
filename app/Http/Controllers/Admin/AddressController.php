<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use DB;

class AddressController extends AdminController
{
    //Места хранения
    public function addresses(Request $request) {

        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_addresses']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li> Адреса </li>';
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии

        $addresses = DB::table('addresses')->select('*')->get();
        return view('admin.address.addresses', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'mesalt' => $mesalt,
            'groups' => $this->groupmas(),
            'addresses' => $addresses
        ));
    }

    //Добавляем
    public function add(Request $request) {
        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_addresses']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/addresses">  Адреса </a></li><li> Добавить адрес </li>';
        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:100|min:1|unique:addresses',
            ]);
            $data = $request->except('_token');
            DB::table('addresses')->insert($data);
            return redirect()->intended('admin/addresses/');
        }
        $point = array('name'  => '');
        return view('admin.address.addressadd', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'groups' => $this->groupmas(),
            'point' => $point
        ));
    }

    //Редактируем
    public function address(Request $request, $id) {

        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_addresses']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/addresses"> Адреса </a></li>';
        $sevedapp = "";
        $point_old = DB::table('addresses')->where('id', '=', $id)->first();
        if($request->isMethod('post')) {
            $data = $request->except('_token');
            if($point_old->name != $data['name']) {
                $this->validate($request, [
                    'name' => 'required|max:100|min:1|unique:addresses',
                ]);
                $id = $data['id'];
                DB::table('addresses')->where('id', $id)->update($data);
                $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
            }
        }
        $address = DB::table('addresses')->where('id', '=', $id)->first();

        $leftmenu = $leftmenu.'<li><a href="/admin/addressin/'.$id.'">'.$address->name.' </a></li>';
        return view('admin.address.address', array(
            'address' => $address,
            'sevedapp' => $sevedapp,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    public function in(Request $request, $id) {
        $menu_active = $this->menuactive();
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_addresses']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/addresses">  Адреса </a></li>';
        $mesege = "<a href='/admin/peoples' > Люди </a> / ";
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии
        $peoples_get = DB::table('peoples')->select('peoples.*', 'peoples.id as peoples_id', 'peoples.status as peoples_status', 'positions.id', 'positions.name as position_name', 'addresses.name as addresses_name', 'mailwork.name as mailwork_name')
            ->join('positions', 'peoples.position', '=', 'positions.id')
            ->join('addresses', 'peoples.addresses', '=', 'addresses.id')
            ->join('mailwork', 'peoples.mailwork', '=', 'mailwork.id')
            ->whereIn('status', [1, 3]);
        if($id > 0){
            $peoples_get->where('peoples.addresses', '=', $id);
            $menu_active['menu_peoples_all']= '';
            $menu_active['menu_peoples_'.$id]= 'class="active"';
            $addresses = DB::table('addresses')->where('id', $id)->first();
            $mesege = $mesege.$addresses->name;
            $leftmenu = $leftmenu.'<li>'.$addresses->name.'</li>';
        }else{
            $mesege = $mesege.' По всех адресах';
            $leftmenu = $leftmenu.'<li>По всех адресах</li>';
        }
        $peoples = $peoples_get->get();

        $peoples_status = array();
        foreach ($peoples as $people){

            if($people->peoples_status == 1){
                $peoples_status[$people->peoples_id] = '<span class="badge bg-green" title="'.$this->statusid($people->peoples_status).'">Сотрудник</span>';
            }elseif($people->peoples_status == 2){
                $peoples_status[$people->peoples_id] = '<span class="badge bg-red" title="'.$this->statusid($people->peoples_status).'">Уволен</span>';
            }elseif($people->peoples_status == 3){
                $peoples_status[$people->peoples_id] = '<span class="badge bg-yellow" title="'.$this->statusid($people->peoples_status).'">Подрядчик</span>';
            }else{
                $peoples_status[$people->peoples_id] = '';
            }
        }

        return view('admin.address.addressin', array(
            'mesege' => $mesege,
            'mesalt' => $mesalt,
            'peoples' => $peoples,
            'peoples_status' => $peoples_status,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    //Удаляем
    public function del(Request $request, $id) {
        $cloum = DB::table('peoples')->where('addresses', '=', $id)->count();
        if($cloum > 0){
            $аddress = DB::table('addresses')->where('id', '=', $id)->first();
            $аddress_name = $аddress->name;
            $request->session()->put('mesalt', 'Удалять адресс: "'.$аddress_name.'" нельзя! Так как по нему находяться люди.'); //Создаем елемент сесии
            return redirect()->intended('admin/addresses/');
        }
        DB::table('addresses')->where('id', '=', $id)->delete();
        return redirect()->intended('admin/addresses/');
    }
}
