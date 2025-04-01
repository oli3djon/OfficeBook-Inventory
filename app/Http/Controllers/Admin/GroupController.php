<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use DB;

class GroupController extends AdminController
{

    //Группы техники
    public function groups(Request $request) {

        $menu_active = $this->menuactive();
        $leftmenu = $this->leftmenu.'<li><a href="/admin/groups"> Номенклатурные группы </a></li>';
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_groupprod']= 'class="active"';
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии
        return view('admin.groups.groups', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'mesalt' => $mesalt,
            'groups' => $this->groupmas(),
        ));
    }

    //Добавляем
    public function Add(Request $request) {
        $menu_active = $this->menuactive();
        $leftmenu = $this->leftmenu.'<li><a href="/admin/groups"> Номенклатурные группы </a></li>';
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_groupprod']= 'class="active"';
        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:50|min:3',
            ]);
            $data = $request->except('_token');
            DB::table('groups')->insert($data);
            return redirect()->intended('admin/groups/');
        }
        $group = array('name'  => '');
        return view('admin.groups.groupadd', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'groups' => $this->groupmas(),
            'group' => $group
        ));
    }

    //Редактируем
    public function group(Request $request, $id) {

        $menu_active = $this->menuactive();
        $leftmenu = $this->leftmenu.'<li><a href="/admin/groups"> Номенклатурные группы </a></li>';
        $menu_active['menu_dir']= 'class="treeview active"';
        $menu_active['menu_groupprod']= 'class="active"';
        $sevedapp = "";
        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:50|min:3',
            ]);
            $data = $request->except('_token');
            $id = $data['id'];
            DB::table('groups')->where('id', $id)->update($data);
            $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
        }
        $group = DB::table('groups')->where('id', '=', $id)->first();

        $leftmenu = $leftmenu.'<li><a href="/admin/inventorys/'.$id.'"> '.$group->name.' </a></li>';
        return view('admin.groups.group', array(
            'group' => $group,
            'groups' => $this->groupmas(),
            'sevedapp' => $sevedapp,
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    //Удаляем
    public function del(Request $request, $id) {

        $cloum = DB::table('inventorys')->where('groups', '=', $id)->count();
        if($cloum > 0){
            $groups = DB::table('groups')->where('id', '=', $id)->first();
            $groups_name = $groups->name;
            $request->session()->put('mesalt', 'Удалять группу: "'.$groups_name.'" нельзя! Так как в ней находиться имущество.'); //Создаем елемент сесии
            return redirect()->intended('admin/groups/');
        }
        DB::table('groups')->where('id', '=', $id)->delete();
        return redirect()->intended('admin/groups/');
    }
}
