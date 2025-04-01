<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use DB;

class SecurityController extends AdminController
{
    public function Index(Request $request) {

        $menu_active = $this->menuactive();
        $menu_active['menu_settings'] = 'class="treeview active"';
        $menu_active['menu_security'] = 'class="treeview active"';
        $leftmenu = $this->leftmenu.'<li>Безопасность</li>';
        $mesege = "Безопасность";
        $sevedapp = '';
        
        if($request->isMethod('post')) {

            $set_van = DB::table('settings')->where('id', '=', 1)->first();
            $data = $request->except('_token');
            $data_ip['data'] = $set_van->data;
            if(@$data['ipon'] == 'on'){$data_ip['name'] = 1;}else{$data_ip['name'] = 0;}            
            if(@$data['inventory'] == 'on'){$checked_5['data'] = 1;}else{$checked_5['data'] = 0;}
            DB::table('settings')->where('id', 5)->update($checked_5);
            
            if(@$data['contact'] == 'on'){
                $checked_6['data'] = 1;
                if(@$data['position'] == 'on'){$checked_7['data'] = 1;}else{$checked_7['data'] = 0;}
                if(@$data['tel'] == 'on'){$checked_8['data'] = 1;}else{$checked_8['data'] = 0;}
                if(@$data['address'] == 'on'){$checked_9['data'] = 1;}else{$checked_9['data'] = 0;}
                
            }else{
                $checked_6['data'] = 0;
                $checked_7['data'] = 0;
                $checked_8['data'] = 0;
                $checked_9['data'] = 0;
            }
            DB::table('settings')->where('id', 6)->update($checked_6);
            DB::table('settings')->where('id', 7)->update($checked_7);
            DB::table('settings')->where('id', 8)->update($checked_8);
            DB::table('settings')->where('id', 9)->update($checked_9);
            
            if($data['ip'] !='') {
                $this->validate($request, [
                    'ip' => 'ipv4',
                ]);
                $data_ip['data'] = $set_van->data.','.$data['ip'];
            }
            DB::table('settings')->where('id', 1)->update($data_ip);
            $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
            
        }
        
        $sets = DB::table('settings')->get();
        
        foreach($sets as $set)
        {
            $settings[$set->id]=$set->data;
            $setname[$set->id]=$set->name;
            if($set->data == 1){
                $checked[$set->id] = 'checked';
            }else{
                $checked[$set->id] = '';
            }   
        }
        
        if($setname['1'] == 1){$ipon = 'checked';}else{$ipon = '';}
        
        $ipstring = $settings['1'];
        $ipmas = explode(',', $ipstring);

        return view('admin.security.security', array(
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'sevedapp' => $sevedapp,
            'ipon' => $ipon,
            'moyip' => $request->ip(),
            'ipmas' => $ipmas,
            'inventory' => $checked['5'],
            'contact' => $checked['6'],
            'position' => $checked['7'],
            'tel' => $checked['8'],
            'address' => $checked['9'],
            ));
	}
    
    public function ipdel(Request $request, $id) {
        $settings = DB::table('settings')->where('id', 1)->first();
        $iplist = $settings->data;
        $iplists = explode(',', $iplist);
        unset($iplists[$id]);
        if(!in_array($request->ip(), $iplists)){
            array_push($iplists, $request->ip());
        }
        $data_ip['data'] = implode(",", $iplists);
        DB::table('settings')->where('id', 1)->update($data_ip);
        return redirect()->back();
    }
}
