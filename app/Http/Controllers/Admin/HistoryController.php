<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use DB;

class HistoryController extends AdminController
{
    //Редактируем
    public function history(Request $request, $typedoc, $id) {

        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_history'] = 'class="active"';

        $leftmenu = $this->leftmenu;
        $historys  = array();
        $hi_edits = array();
        $passedtime  = array();
        $link_doc = '';
        //Определяем существует ли на данный момент данный документ
        $count_doc = DB::table($this->typedoclik($typedoc).'s')->where('id', '=', $id)->count();

        if($count_doc == 0){
            $leftmenu = '<li><i class="fa fa-history"></i> Документа с ID '.$id.' нет!</li>';
        }else{
            $data_doc = DB::table($this->typedoclik($typedoc).'s')->where('id', '=', $id)->first();
            $leftmenu = '<li><i class="fa fa-history"></i> Истрия изминения документа</li><li class="active">'.$this->typedoc($typedoc).'</li><li class="active"><a href="/admin/'.$this->typedoclik($typedoc).'/'.$id.'">'.$data_doc->name.'</a></li>';
            //Поверяем есть ли данне истории
            $count_edit = DB::table('historys')->where('typedoc', '=', $typedoc)->where('id_doc', '=', $id)->count();
            $hi_edits = array();
            if($count_edit >= 1){
                $historys = DB::table('historys')
                    ->select('historys.*', 'typeedit.name as typeedit_name', 'users.name as users_name')
                    ->join('typeedit', 'historys.typeedit', '=', 'typeedit.id')
                    ->join('users', 'historys.user', '=', 'users.id')
                    ->where('historys.typedoc', '=', $typedoc)
                    ->where('historys.id_doc', '=', $id)
                    ->orderBy('id', 'desc')
                    ->get();

                $hi_edits =array();
                foreach ($historys as $history){
                    $count_hiedits = DB::table('hiedits')->where('historys', '=', $history->id)->count();
                    if($count_hiedits >= 1){
                        $hiedits = DB::table('hiedits')->where('historys', '=', $history->id)->get();
                        $passedtime[$history->id] = $this->passed_time($history->time)." назад";
                        $n = 0;
                        foreach ($hiedits as $hiedit){
                            $n = $n + 1;
                            if($hiedit->old ==''){$old_print = '';}else{$old_print = '<span class="text-yellow"> было </span>'.$hiedit->old;}
                            $new_print = '<span class="text-yellow">стало </span>'.$hiedit->new;
                            $hi_edits[$history->id][$n] = array(
                                'name' => $hiedit->name,
                                'old' => $old_print,
                                'new' => $new_print,
                            );
                        }
                    }else{
                        //Если в даной метке истории нет правок, то удаляем эту метку
                        DB::table('historys')->where('id', '=', $history->id)->delete();
                        return redirect()->intended('admin/history/'.$typedoc.'/'.$id);
                    }
                }
            }else{
                $leftmenu = "<li><i class=\"fa fa-history\"></i> Истрия по данному документу отсутствует!</li>";
            }
        }

        return view('admin.history.history', array(
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'groups' => $this->groupmas(),
            'historys' => $historys,
            'hi_edits' => $hi_edits,
            'passedtime' => $passedtime,
        ));

    }
    public function historys(Request $request) {
        $leftmenu = '<li><i class="fa fa-history"></i> Истрия изминения документов</li>';
        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_history'] = 'class="active"';

        $historys = DB::table('historys')
            ->select('historys.*', 'typedoc.name as typedoc_name', 'typeedit.name as typeedit_name', 'users.name as users_name')
            ->join('typedoc', 'historys.typedoc', '=', 'typedoc.id')
            ->join('typeedit', 'historys.typeedit', '=', 'typeedit.id')
            ->join('users', 'historys.user', '=', 'users.id')
            ->orderBy('historys.time', 'desc')
            ->get();

        return view('admin.history.historys', array(
            'mesege' => 'Истрия изминения документов',
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'historys' => $historys,
            'groups' => $this->groupmas(),
        ));

    }
}
