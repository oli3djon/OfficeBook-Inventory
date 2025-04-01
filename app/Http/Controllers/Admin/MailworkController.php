<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use DB;

class MailworkController extends AdminController
{
    public function mailworks(Request $request) {

        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_mailworks']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li> Почта рабочая </li>';

        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'email|required|max:50|min:3|unique:mailwork',
                'pass' => 'required|max:50|min:3',
            ]);
            $data = $request->except('_token');
            DB::table('mailwork')->insert($data);
        }

        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии

        $mailworks = DB::table('mailwork')->select('*')->orderBy('name', 'asc')->get();
        return view('admin.mailwork.mailworks', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'mesalt' => $mesalt,
            'groups' => $this->groupmas(),
            'mailworks' => $mailworks
        ));
    }

    public function mailwork(Request $request, $id) {

        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_mailworks']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/mailworks/">Почта рабочая</a></li>';

        if($request->isMethod('post')) {
            $this->validate($request, [
                'pass' => 'required|max:50|min:3',
            ]);
            $data = $request->except('_token');
            DB::table('mailwork')->where('id', $id)->update($data);

        }

        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии

        //Проверяем за кем закреплен этот ящик
        $peoples = DB::table('peoples')
            ->select('peoples.*', 'positions.id', 'peoples.id as peoples_id', 'positions.name as position_name')
            ->join('positions', 'peoples.position', '=', 'positions.id')
            ->where('mailwork', '=', $id)
            ->get();

        $cloum = DB::table('peoples')->where('mailwork', '=', $id)->count();
        $mailwork = DB::table('mailwork')->where('id', '=', $id)->first();
        if($cloum > 0){$del_button ='';}else{$del_button ='<td width="50"><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-default" title="Удалить"><i class="fa fa-fw fa-times"></i></button></td>';}
        $leftmenu = $leftmenu.'<li>'.$mailwork->name.'</li>';
        return view('admin.mailwork.mailwork', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'mesalt' => $mesalt,
            'groups' => $this->groupmas(),
            'mailwork' => $mailwork,
            'del_button' => $del_button,
            'cloum' => $cloum,
            'peoples' => $peoples
        ));
    }

    public function del(Request $request, $id) {
        $cloum = DB::table('peoples')->where('mailwork', '=', $id)->count();
        echo$cloum;
        if($cloum < 1){
            //echo"удалять можно!";
            DB::table('mailwork')->where('id', '=', $id)->delete();
            return redirect()->intended('admin/mailworks/');
        }else{
            //echo"удалять нельзя!";
            return redirect()->intended('admin/mailwork/'.$id);

        }
    }

    public function mailworkpeopledel(Request $request, $id) {
        $people = DB::table('peoples')->where('id', '=', $id)->first();
        $mail_id = $people->mailwork;
        $data['mailwork'] = '1';
        DB::table('peoples')->where('id', $id)->update($data);
        return redirect()->intended('admin/mailwork/'.$mail_id);
    }
}
