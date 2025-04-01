<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use DB;

class SettingsController extends AdminController
{
    public function Index(Request $request) {

        $menu_active = $this->menuactive();
        $menu_active['menu_settings'] = 'class="treeview active"';
        $menu_active['menu_settings_org'] = 'class="active"';
        $tabactiv['1'] = 'class="active"';
        $tabactiv['2'] = '';
        $panelactiv['1'] = 'active';
        $panelactiv['2'] = '';
        $sevedapp = '';
        

        if($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required|max:50',
                'text' => 'max:200',
                'email' => 'email',
            ]);
            $data = $request->except('_token');
            $data_name['data'] = $data['name'];
            $data_text['data'] = $data['text'];
            $data_email['data'] = $data['email'];
            DB::table('settings')->where('id', 2)->update($data_name);
            DB::table('settings')->where('id', 3)->update($data_text);
            DB::table('settings')->where('id', 4)->update($data_email);
            $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
            
        }
        $sets = DB::table('settings')->get();

        foreach($sets as $set)
        {
            $settings[$set->id]=$set->data;
            $setname[$set->id]=$set->name;
        }
        if($setname['1'] ==1){$ipon = 'checked';}else{$ipon = '';}

        $leftmenu = $this->leftmenu.'<li><a href="/admin/inventorys"> Настройки</a></li>';
        $mesege = "Настройки";

        $ipstring = $settings['1'];
        $ipmas = explode(',', $ipstring);

        return view('admin.settings.settings', array(
            'mesege' => $mesege,
            'tabactiv' => $tabactiv,
            'panelactiv' => $panelactiv,
            'ipon' => $ipon,
            'moyip' => $request->ip(),
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'settings' => $settings,
            'ipmas' => $ipmas,
            'sevedapp' => $sevedapp,
            ));
	}
}
