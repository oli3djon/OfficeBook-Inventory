<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\MainController;
use DB;

class AdminController extends MainController
{
    public $leftmenu = '<li><a href="/admin" title="Главная"><i class="fa fa-home"></i></a></li>';

    //Масив номенклатуры для меню
    public function menuactive(){

        $nom = array(
            'menu_peoples' => 'class="treeview"',
            'menu_peoples_all' => '',
            'menu_inventory' => 'class="treeview"',
            'menu_inventory_all' => '',
            'menu_inventory_n' => '',
            'menu_inventory_s' => '',
            'menu_dir' => 'class="treeview"',
            'menu_us_users' => '',
            'menu_us_positions' => '',
            'menu_us_accessrole' => '',
            'menu_points' => '',
            'menu_addresses' => '',
            'menu_mailworks' => '',
            'menu_groupprod' => '',
            'menu_history' => '',
            'menu_export_excel' => '',
            'menu_import_excel' => '',
            'menu_settings' => 'class="treeview"',
            'menu_settings_org' => '',
            'menu_security' => '',
        );

        foreach($this->groupmas() as $key => $value)
        {
            $nom['menu_inventory_'.$key]='';
        }

        foreach($this->statusmas() as $key => $value)
        {
            $nom['menu_peoples_'.$key]='';
        }
        return $nom;
    }

    public function add_history_inventory(
            $typeedit, 
            $user, 
            $id, 
            $name, 
            $name_new, 
            $people, 
            $people_new, 
            $group = '', 
            $group_new = '', 
            $point = '', 
            $point_new = '', 
            $state = '', 
            $state_new = '', 
            $text = '', 
            $text_new = ''
            ){
            
        $hiid = DB::table('historys')->insertGetId([
            'id_doc' => $id,
            'typedoc' => 3,
            'typeedit' => $typeedit,
            'user' => $user,
            'time' => date("Y-m-d H:i:s"),
        ]);
        
        $del_hiid = 1;
        $hiedits = array();        
        if($name != $name_new){
           $hiedits[] = array('historys' => $hiid, 'name' => 'Название', 'old' => $name, 'new' => $name_new); $del_hiid = 0;
        }
        
        if($people != $people_new){
           $hiedits[] = array('historys' => $hiid, 'name' => 'Ответственный', 'old' => $people, 'new' => $people_new); $del_hiid = 0;
        }
        
        if($group != $group_new){
            $hiedits[] = array('historys' => $hiid, 'name' => 'Инвентарная группа', 'old' => $group, 'new' => $group_new); $del_hiid = 0;
        }

        if($point != $point_new){
            $hiedits[] = array('historys' => $hiid, 'name' => 'Место хранения', 'old' => $point, 'new' => $point_new); $del_hiid = 0;
        }
        
        if($state != $state_new){
            $hiedits[] = array('historys' => $hiid, 'name' => 'Статус', 'old' => $state, 'new' => $state_new); $del_hiid = 0;
        }

        if($text != $text_new){
            $hiedits[] = array('historys' => $hiid, 'name' => 'Дополнительная информация', 'old' => $text, 'new' => $text_new); $del_hiid = 0;
        }
        
        if($del_hiid == 1){
            DB::table('historys')->where('id', '=', $hiid)->delete();
        }else{
            DB::table('hiedits')->insert($hiedits);
        }
    }
    
}
