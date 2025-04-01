<?php

namespace App\Http\Controllers\Admin;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Gate;

class PeopleController extends AdminController
{
    //Все сотрудеики
    public function Peoples(Request $request , $id = 0) {
        $menu_active = $this->menuactive();
        $menu_active['menu_peoples']= 'class="treeview active"';
        $menu_active['menu_peoples_all']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/peoples"> Люди</a></li>';
        $mesege = "<a href='/admin/peoples'>Люди</a> / ";
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии
        $peoples_get = DB::table('peoples')->select('peoples.*', 'peoples.id as peoples_id', 'peoples.status as peoples_status', 'positions.id', 'positions.name as position_name', 'addresses.name as addresses_name', 'mailwork.name as mailwork_name')
            ->join('positions', 'peoples.position', '=', 'positions.id')
            ->join('addresses', 'peoples.addresses', '=', 'addresses.id')
            ->join('mailwork', 'peoples.mailwork', '=', 'mailwork.id');
        if($id > 0){
            $peoples_get->where('peoples.status', '=', $id);
            $menu_active['menu_peoples_all']= '';
            $menu_active['menu_peoples_'.$id]= 'class="active"';
            $stat = DB::table('status')->where('id', $id)->first();
            $mesege = $mesege.$stat->name;
            $leftmenu = $leftmenu.'<li>'.$stat->name.'</li>';

        }else{
            $mesege = $mesege.' Все';
            $leftmenu = $leftmenu.'<li>Все</li>';

        }
        $peoples = $peoples_get->orderBy('peoples.surname', 'asc')->get();

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

        return view('admin.peoples.peoples', array(
            'mesege' => $mesege,
            'groups' => $this->groupmas(),
            'mesalt' => $mesalt,
            'peoples_status' => $peoples_status,
            'peoples' => $peoples,
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    //Выбраный сотрудник
    public function People(Request $request, $id) {

        $menu_active = $this->menuactive();
        $menu_active['menu_peoples']= 'class="treeview active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/peoples"> Люди</a></li>';
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии
        $sevedapp = "";
        $peoplesmas = $this->peoplesmas();

        if($request->isMethod('post')) {
            $data = $request->except('_token');
            if($data ['peoples'] != $id and isset($data ['move'])){
                foreach ($data ['move'] as $key => $value){
                    $invent['peoples'] = $data ['peoples'];
                    DB::table('inventorys')->where('id', $key)->update($invent);
                    //Добавляем данные в истрию
                    $hiid = DB::table('historys')->insertGetId([
                        'id_doc' => $key, //ID дкумента
                        'typedoc' => 3, //Тип документа
                        'typeedit' => 2, //Тип правки
                        'user' => Auth::id(), //ID пользователя
                        'time' => date("Y-m-d H:i:s"), //Дата правки
                    ]);
                    DB::table('hiedits')->insert(['historys' => $hiid, 'name' => 'Ответственный за имущество', 'old' => $peoplesmas[$id], 'new' => $peoplesmas[$data['peoples']]]);
                }
                $sevedapp = '<div class="callout callout-success"><h4>Передано <a href="/admin/people/'.$data ['peoples'].'">'.$peoplesmas[$data['peoples']].'</a></h4></div>';
            }
        }

        $people = DB::table('peoples')
            ->select('peoples.*', 'peoples.id as peoples_id', 'positions.id', 'positions.name as position_name', 'addresses.name as addresses_name', 'mailwork.name as mailwork_name', 'mailwork.pass as mailwork_pass')
            ->join('positions', 'peoples.position', '=', 'positions.id')
            ->join('addresses', 'peoples.addresses', '=', 'addresses.id')
            ->join('mailwork', 'peoples.mailwork', '=', 'mailwork.id')
            ->where('peoples.id', '=', $id)
            ->first();

        $email = '';
        if($people->mailwork != 1){
            $mail_pass = '';
            if (Gate::allows('mailwork')){
                $mail_pass = "<label> Пароль: </label>".$people->mailwork_pass;
            }
            $email = "<label>E-mail рабочий:</label> <cite><a href='mailto:".$people->mailwork_name."'>".$people->mailwork_name."</a></cite> ".$mail_pass."<br />";
        }
        if($people->mailpersonal != ''){
            $email = $email."<label>E-mail личный:</label> <cite><a href='mailto:".$people->mailpersonal."'>".$people->mailpersonal."</a></cite><br />";
        }

        $tel = '';
        if($people->telwork != ''){
            $tel = "<label>Рабочий телефон:</label> <cite><a href='tel:".$this->telfix($people->telwork)."'> ".$this->telshort($people->telwork)." </a></cite></br>";
        }
        if($people->telpersonal != ''){
            $tel = $tel."<label>Личный телефон:</label> <cite><a href='tel:".$this->telfix($people->telpersonal)."'> ".$this->telshort($people->telpersonal)."</a></cite></br>";
        }

        $birthday = '';
        if($people->birthday != ''){
            $birthday = "<label>День рождения:</label> <cite>".$people->birthday."</cite>";
        }

        $inventorys = DB::table('inventorys')
            ->select('inventorys.*', 'inventorys.id as inventorys_id', 'groups.name as groups_name', 'groups.id as groups_id', 'inventorys.name as inventorys_name', 'points.name as points_name', 'points.id as points_id', 'peoples.name as peoples_name', 'peoples.surname as peoples_surname')
            ->join('groups', 'inventorys.groups', '=', 'groups.id')
            ->join('points', 'inventorys.points', '=', 'points.id')
            ->join('peoples', 'inventorys.peoples', '=', 'peoples.id')
            ->where('peoples.id', '=', $id)
            ->get();

        $leftmenu = $leftmenu.'<li>'.$people->surname.' '.$people->name.'</li>';

        $texts = array();
        $states = array();

        foreach ($inventorys as $inventory){
            $texts[$inventory->id] = iconv_substr ($inventory->text, 0 , 50 , 'UTF-8' );
            if($inventory->state == 1){
                $states[$inventory->id] = '<a href="/admin/inventoryrun/stateon/'.$inventory->id.'"><span class="badge bg-yellow" title="'.$this->stateid($inventory->state).' - Сменить на '.$this->stateid('2').'"><i class="fa fa-fw  fa-toggle-off"></i></span><span style="color: #fff;">.</span></a>';
            }elseif ($inventory->state == 2){
                $states[$inventory->id] = '<a href="/admin/inventoryrun/stateoff/'.$inventory->id.'"><span class="badge bg-green" title="'.$this->stateid($inventory->state).' - Сменить на '.$this->stateid('1').'"><i class="fa fa-fw  fa-toggle-on"></i></span></a>';;
            }else{
                $states[$inventory->id] = '<a href="/admin/inventoryrun/stateon/'.$inventory->id.'"><span class="badge bg-red" title="'.$this->stateid($inventory->state).' - Сменить на '.$this->stateid('2').'"><i class="fa fa-fw  fa-toggle-off"></i></span><span style="color: #fff;">..</span></a>';;
            }
        }

        return view('admin.peoples.people', array(
            'people' => $people,
            'email' => $email,
            'birthday' => $birthday,
            'tel' => $tel,
            'mesalt' => $mesalt,
            'peoples' => $this->peoplesmas(),
            'groups' => $this->groupmas(),
            'inventorys' => $inventorys,
            'texts' => $texts,
            'states' => $states,
            'positions' => $this->positmas(),
            'status' => $this->statusmas(),
            'sevedapp' => $sevedapp,
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    //Добавление нового сотрудника
    public function add(Request $request,$id=FALSE) {

        $menu_active = $this->menuactive();
        $menu_active['menu_peoples']= 'class="treeview active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/peoples"> Люди</a></li>';
        if($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required|max:40|min:1',
                'surname' => 'required|max:40|min:1',
                'telwork' => 'nullable|phone:AUTO|max:30',
                'telpersonal' => 'nullable|phone:AUTO|max:30',
                'mailpersonal' => 'nullable|email|max:50',
                'birthday' => 'nullable|date_format:"Y-m-d"',
                'text' => 'nullable|max:500',
            ]);

            $data = $request->except('_token');
            $indata = date("Y-m-d H:i:s"); //Текущая дата
            $data['created_at'] = $indata; //Датта создания
            $data['updated_at'] = $indata; //Дата редактирования
            DB::table('peoples')->insert($data);
            return redirect()->intended('admin/peoples/');
        }

        $errors = array();
        return view('admin.peoples.peopleadd', array(
            'mesege' => 'Создать сотрудника',
            'groups' => $this->groupmas(),
            'positions' => $this->positmas(),
            'addresses' => $this->addressesmas(),
            'status' => $this->statusmas(),
            'mailwork' => '1',
            'mailworks' => $this->mailworkmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }


    //Редактировать данные сотрудника
    public function edit(Request $request,$id=FALSE) {

        $menu_active = $this->menuactive();
        $menu_active['menu_peoples']= 'class="treeview active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/peoples"> Люди</a></li>';
        $sevedapp = "";
        $mesalt = $request->session()->get('mesalt', ''); //Получаем елемент сесии
        $request->session()->forget('mesalt'); //Удаляем елемент сесии
        if($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required|max:40|min:1',
                'surname' => 'required|max:40|min:1',
                'telwork' => 'nullable|phone:AUTO|max:30',
                'telpersonal' => 'nullable|phone:AUTO|max:30',
                'mailpersonal' => 'nullable|email|max:50',
                'birthday' => 'nullable|date_format:"Y-m-d"',
                'text' => 'nullable|max:500',
            ]);

            $indata = date("Y-m-d H:i:s"); //Текущая дата
            $data = $request->except('_token');

            if ($data['status'] == 2){
                $cloum = DB::table('inventorys')->where('peoples', '=', $id)->count();
                if($cloum > 0){
                    //echo"удалять нельзя!";
                    $peoples = DB::table('peoples')->where('id', '=', $id)->first();
                    $peoples_fullname = $peoples->name." ".$peoples->surname;
                    $request->session()->put('mesalt', 'Увольнять сотрудника: "'.$peoples_fullname.'" нельзя! Так как на нем числиться имущество.'); //Создаем елемент сесии
                    return redirect()->intended('admin/peopleedit/'.$id);
                }
            }

            $id = $data['id'];
            $people = DB::table('peoples')->where('peoples.id', '=', $id)->first();
            $data['updated_at'] = $indata; //Дата редактирования
            $data['created_at'] = $people->created_at; //Датта создания
            DB::table('peoples')->where('id', $id)->update($data);
            $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
        }

        $people = DB::table('peoples')
            ->select('peoples.*', 'peoples.id as peoples_id', 'positions.id', 'positions.name as position_name')
            ->join('positions', 'peoples.position', '=', 'positions.id')
            ->where('peoples.id', '=', $id)
            ->first();


        $leftmenu = $leftmenu.'<li><a href="/admin/people/'.$id.'">'.$people->surname.' '.$people->name.'</a></li>';

        return view('admin.peoples.peopleedit', array(
            'mesalt' => $mesalt,
            'people' => $people,
            'groups' => $this->groupmas(),
            'positions' => $this->positmas(),
            'addresses' => $this->addressesmas(),
            'status' => $this->statusmas(),
            'mailwork' => $this->mailworkmas(),
            'sevedapp' => $sevedapp,
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));

    }

    public function del(Request $request, $id) {
        $cloum = DB::table('inventorys')->where('peoples', '=', $id)->count();
        if($cloum > 0){
            //echo"удалять нельзя!";
            $peoples = DB::table('peoples')->where('id', '=', $id)->first();
            $name = $peoples->surname.' '.$peoples->name;
            $request->session()->put('mesalt', 'Удалять сотрудника: "'.$name.'" нельзя! Так как на нем числиться имущество.'); //Создаем елемент сесии
            return redirect()->back();
        }
        DB::table('peoples')->where('peoples.id', '=', $id)->delete();
        return redirect()->intended('admin/peoples/');
    }

}
