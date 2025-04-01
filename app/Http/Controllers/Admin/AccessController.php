<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use DB;

class AccessController extends AdminController
{
    public function Accessrole(Request $request) {

        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_us_accessrole']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li>Матрица прав</li>';
        $sevedapp = '';
        if($request->isMethod('post')) {
            $data = $request->except('_token');
            if (array_key_exists("role", $data)) {
                $roleins = $data['role'];
            }else{
                $roleins = array();
            }
            $inids = $data['id'];
            $roles = $this->rolemas();
            $typedocs = $this->typedocs();

            foreach ($roles as $idrol => $role){
                foreach ($typedocs as $iddoc => $typedoc){
                    $datain[$idrol][$iddoc]['1'] = '0';
                    $datain[$idrol][$iddoc]['2'] = '0';
                    $datain[$idrol][$iddoc]['3'] = '0';
                    if($idrol == 1){
                        $datain[$idrol][$iddoc]['1'] = '1';
                        $datain[$idrol][$iddoc]['2'] = '1';
                        $datain[$idrol][$iddoc]['3'] = '1';
                    }
                }
            }

            foreach ($roleins as $idrol => $rolein){
                foreach ($rolein as $iddoc => $doc){

                    if (array_key_exists('1', $doc)) {
                        $datain[$idrol][$iddoc]['1'] = '1';
                    }

                    if (array_key_exists('2', $doc)) {
                        $datain[$idrol][$iddoc]['1'] = '1';
                        $datain[$idrol][$iddoc]['2'] = '1';
                    }

                    if (array_key_exists('3', $doc)) {
                        $datain[$idrol][$iddoc]['1'] = '1';
                        $datain[$idrol][$iddoc]['2'] = '1';
                        $datain[$idrol][$iddoc]['3'] = '1';
                    }
                }
            }

            foreach ($roles as $idrol => $role){
                foreach ($typedocs as $iddoc => $typedoc){
                    $id = $inids[$idrol][$iddoc];
                    $indata['read'] = $datain[$idrol][$iddoc]['1'];
                    $indata['edit'] = $datain[$idrol][$iddoc]['2'];
                    $indata['delete'] = $datain[$idrol][$iddoc]['3'];
                    DB::table('accessdoc')->where('id', $id)->update($indata);
                }
            }
            $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
        }
        $chek['0'] = ''; $chek['1'] = 'checked';
        $accessdocs = DB::table('accessdoc')->select('*')->get();
        foreach($accessdocs as $access){

            $accessdoc[$access->roles][$access->doc]['id'] = $access->id;
            $accessdoc[$access->roles][$access->doc]['1'] = $chek[$access->read];
            $accessdoc[$access->roles][$access->doc]['2'] = $chek[$access->edit];
            $accessdoc[$access->roles][$access->doc]['3'] = $chek[$access->delete];

            $accessdocdis[$access->roles][$access->doc]['1'] = '';
            $accessdocdis[$access->roles][$access->doc]['2'] = '';
            $accessdocdis[$access->roles][$access->doc]['3'] = '';

            //Запрещаем редактировать права (ограничивать) пользователю Root
            if($access->roles == 1 ){
                $accessdocdis[$access->roles][$access->doc]['1'] = 'disabled';
                $accessdocdis[$access->roles][$access->doc]['2'] = 'disabled';
                $accessdocdis[$access->roles][$access->doc]['3'] = 'disabled';
            }

            //Запрещаем давать права на удаление всем пользователям кроме Root и системного администратора
            if($access->roles != 1 || $access->roles != 2){
                $accessdocdis[$access->roles][$access->doc]['3'] = 'disabled';
            }

            //Запрещаем доступ к управлению пользователям всем кроме Root
            if($access->doc == 1){
                $accessdocdis[$access->roles][$access->doc]['1'] = 'disabled';
                $accessdocdis[$access->roles][$access->doc]['2'] = 'disabled';
                $accessdocdis[$access->roles][$access->doc]['3'] = 'disabled';
            }
        }

        return view('admin.access.accessrole', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'groups' => $this->groupmas(),
            'accessdoc' => $accessdoc,
            'accessdocdis' => $accessdocdis,
            'roles' => $this->rolemas(),
            'typedocs' => $this->typedocs(),
            'sevedapp' => $sevedapp,
        ));
    }

    public function Denied() {
        $menu_active = $this->menuactive();
        $leftmenu = $this->leftmenu.'<li>Доступ закрыт!</li>';
        return view('admin.access.accessdenied', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'groups' => $this->groupmas(),
        ));
    }
}
