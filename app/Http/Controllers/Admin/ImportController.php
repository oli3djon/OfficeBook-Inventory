<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App;
use DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ImportController extends AdminController
{    
    public function Import(Request $request) {
        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_import_excel'] = 'class="active"';
        
        $leftmenu = $this->leftmenu.'<li>Експотр в Excel</li>';;
        $mesege = "Старотвая страница админки";
        $country = $this->country();
        $peoples = array();
        $inventorys = array();
        $people = '';
        $invent = '';
        $errors_mes = '';
        $stopimort = 'no';
        $header['people'] = '<span class="text-green">Импорт сотрудников выполнен!</span>';
        $header['invent'] = '<span class="text-green">Импорт имущества выполнен!</span>';
        
        if($request->isMethod('post')){
            $file = $request->file('file');
             $this->validate($request, ['file' => 'required|max:50000|mimes:xlsx']);    
            
            if($request->hasFile('file')){
                $file->move(public_path() . '/export','imort.xlsx');
            }
            
            $filename = public_path().'/export/imort.xlsx'; 
            //Проверяем есть ли файл
            if (file_exists($filename)) {
                $inputFileName = $filename;
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $reader->setLoadSheetsOnly('Сотрудники');
                $spreadsheet = $reader->load($filename);
                $cells = $spreadsheet->getActiveSheet();
                $title = $cells->getTitle();
                $row_num = $cells->getHighestDataRow();
                
                $msa_people = $this->peoplesallmas();
                $msa_status = $this->statusmas();
                $msa_position = $this->positmas();
                $msa_addresses = $this->addressesmas();
                $msa_mailwork = $this->mailworkmas();
                
                for ($row = 3; $row <= $row_num; $row++){
                    
                    $people_id = $cells->getCell('A'.$row)->getValue();
                    $people_status = $cells->getCell('B'.$row)->getValue();
                    $people_surname = $cells->getCell('C'.$row)->getValue();
                    $people_name = $cells->getCell('D'.$row)->getValue();
                    $people_position = $cells->getCell('E'.$row)->getValue();
                    $people_addresses = $cells->getCell('F'.$row)->getValue();
                    $people_mailwork = $cells->getCell('G'.$row)->getValue();
                    $people_mailpersonal = $cells->getCell('H'.$row)->getValue();
                    $people_telwork = $cells->getCell('I'.$row)->getValue();
                    $people_telpersonal = $cells->getCell('J'.$row)->getValue();
                    $people_birthday = $cells->getCell('K'.$row)->getValue();
                    $people_text = $cells->getCell('L'.$row)->getValue();
                    
                     $validator = Validator::make(
                        array(
                            'ID' => $people_id,
                            'Имя' => $people_name,
                            'Фамилия' => $people_surname,
                            'Рабочий телефон' => $people_telwork,
                            'Личный телефон' => $people_telpersonal,
                            'Рабочий e-mail' => $people_mailwork,
                            'Личный e-mail' => $people_mailpersonal,
                            'День рождения' => $people_birthday,
                            'Дополнительная информация' => $people_text,
                        ),
                        array(
                            'ID' => 'required|digits_between:1,100000000000',
                            'Имя' => 'required|max:40|min:1',
                            'Фамилия' => 'required|max:40|min:1',
                            'Рабочий телефон' => 'nullable|max:50',
                            'Личный телефон' => 'nullable|max:50',
                            'Рабочий e-mail' => 'nullable|email|max:50',
                            'Личный e-mail' => 'nullable|email|max:50',
                            'День рождения' => 'nullable|date_format:"Y-m-d"',
                            'Дополнительная информация' => 'nullable|max:500',
                        )
                    );
                    
                    if ($validator->fails()) {                                               
                        $errors = $validator->errors();
                        $header['people'] = '<span class="text-red">При импорте сотрудников возникла ошибка!</span>';
                        $errors_mes = "На листе 'Сотрудники' в строке: ". $row;
                        $stopimort = 'yes'; 
                        break;                                                                    
                    }else{
                        $errors = array();
                    
                        $people_yes = 1;
                        if (in_array($people_surname." ".$people_name, $msa_people)) {
                            $people_new_id = array_search($people_surname." ".$people_name, $msa_people);
                        }else{
                            $people_yes = 0;
                            $people_new_id = $people_id;
                        }
                        
                        if (in_array($people_status, $msa_status)) {
                            $people_status = array_search($people_status, $msa_status);
                        }else{
                            $people_status = 1;
                        }
                        
                        if (in_array($people_position, $msa_position)) {
                            $people_position = array_search($people_position, $msa_position);
                        }else{
                            $positions_id = DB::table('positions')->insertGetId(['name' => $people_position]);
                            $msa_position[$positions_id] = $people_position;
                            $people_position = $positions_id;
                        }
                        
                        if (in_array($people_addresses, $msa_addresses)) {
                            $people_addresses = array_search($people_addresses, $msa_addresses);
                        }else{
                            $addresses_id = DB::table('addresses')->insertGetId(['name' => $people_addresses]);
                            $msa_addresses[$addresses_id] = $people_addresses;
                            $people_addresses = $addresses_id;
                        }
                        
                        if($people_mailwork == ''){$people_mailwork = 'Нет!';}
                        
                        if (in_array($people_mailwork, $msa_mailwork)) {
                            $people_mailwork = array_search($people_mailwork, $msa_mailwork);
                        }else{
                            $mailwork_id = DB::table('mailwork')->insertGetId(['name' => $people_mailwork, 'pass' => 'pass']);
                            $msa_mailwork[$mailwork_id] = $people_mailwork;
                            $people_mailwork = $mailwork_id;
                        }
                        $peoples_add = '';
                        
                        if($people_yes > 0){
                            DB::table('peoples')->where('id', $people_new_id)->update([
                                'name' => $people_name,
                                'surname' => $people_surname,
                                'status' => $people_status, 
                                'position' => $people_position,
                                'addresses' => $people_addresses,
                                'mailwork' => $people_mailwork,
                                'mailpersonal' => $people_mailpersonal,
                                'telwork' => $people_telwork,
                                'telpersonal' => $people_telpersonal,
                                'birthday' => $people_birthday,
                                'text' => $people_text,
                            ]);
                            $peoples_add = '<span class="text-green"> - Обновил!</span>';
                        }else{                        
                             DB::table('peoples')->insert([
                                'name' => $people_name,
                                'surname' => $people_surname,
                                'status' => $people_status, 
                                'position' => $people_position,
                                'addresses' => $people_addresses,
                                'mailwork' => $people_mailwork,
                                'mailpersonal' => $people_mailpersonal,
                                'telwork' => $people_telwork,
                                'telpersonal' => $people_telpersonal,
                                'birthday' => $people_birthday,
                                'text' => $people_text,
                            ]);
                            
                            $peoples_add = '<span class="text-yellow"> - Создал!</span>';
                        }
                        
                        $peoples[$people_id]['status'] = $msa_status[$people_status];
                        $peoples[$people_id]['name'] = "<a href='/admin/people/".$people_new_id."'>".$people_surname." ".$people_name."</br> ".$peoples_add;
                        $peoples[$people_id]['position'] = $msa_position[$people_position];
                        $peoples[$people_id]['addresses'] = $msa_addresses[$people_addresses];
                        $peoples[$people_id]['mailwork'] = $msa_mailwork[$people_mailwork];
                        $peoples[$people_id]['mailpersonal'] = $people_mailpersonal;
                        $peoples[$people_id]['telwork'] = $this->telshort($people_telwork, $country);
                        $peoples[$people_id]['telpersonal'] = $this->telshort($people_telpersonal);
                        $peoples[$people_id]['birthday'] = $people_birthday;
                        $peoples[$people_id]['text'] = $people_text;
                    }   
                }
                
                if($stopimort == 'no'){
                    //Читаем таблицу Инвентарные еденици
                    $reader->setLoadSheetsOnly('Инвентарные единицы');
                    $spreadsheet = $reader->load($filename);
                    $cells = $spreadsheet->getActiveSheet();
                    $title = $cells->getTitle();
                    $row_num = $cells->getHighestDataRow();
                    
                    $msa_invent = $this->inventmas();
                    $msa_groups = $this->groupmas();
                    $msa_points = $this->pointmas();
                    $msa_people = $this->peoplesallmas();
                    $msa_state = $this->statemas();
                    
                    for ($row = 3; $row <= $row_num; $row++){
                        
                        $invent_id = $cells->getCell('A'.$row)->getValue();
                        $invent_group = $cells->getCell('B'.$row)->getValue();
                        $invent_name = $this->textcheck50($cells->getCell('C'.$row)->getValue());
                        $invent_point = $cells->getCell('D'.$row)->getValue();
                        $invent_people = $cells->getCell('E'.$row)->getValue();
                        $invent_state = $cells->getCell('F'.$row)->getValue();
                        $invent_text = $cells->getCell('G'.$row)->getValue();
                        
                        $validator = Validator::make(
                            array(
                                'ID' => $invent_id,
                                'Группа' => $invent_group,
                                'Названеие' => $invent_name,
                                'Место хараения' => $invent_point,
                                'Ответственный' => $invent_people,
                                'Статус' => $invent_state,
                                'Дополнительная информация' => $invent_text
                            ),
                            array(
                                'ID' => 'required|digits_between:1,100000000000',
                                'Группа' => 'required|max:100|min:1',
                                'Названеие' => 'required|max:100|min:1',
                                'Место хараения' => 'required|max:100|min:1',
                                'Ответственный' => 'required|max:100|min:1',
                                'Статус' => 'required|max:50|min:1',
                                'Дополнительная информация' => 'nullable|max:500'
                            )
                        );
                        
                        if ($validator->fails()) {                                               
                            $errors = $validator->errors();
                            $header['invent'] = '<span class="text-red">При импорте инвентарных единиц возникла ошибка!</span>';
                            $errors_mes = "На листе 'Инвентарные единицы' в строке: ". $row;
                            break;                                                                         
                        }else{
                            $errors = array();
                            $invent_yes = 0;
                            if (in_array($invent_id, $msa_invent)) {
                                $invent_yes = 1;
                            }
                            
                            if (in_array($invent_group, $msa_groups)) {
                                $invent_group = array_search($invent_group, $msa_groups);
                            }else{
                                $positions_id = DB::table('groups')->insertGetId(['name' => $invent_group]);
                                $msa_groups[$positions_id] = $invent_group;
                                $invent_group = $positions_id;
                                $menu_active['menu_inventory_'.$positions_id]='';
                            }
                            
                            if (in_array($invent_point, $msa_points)) {
                                $invent_point = array_search($invent_point, $msa_points);
                            }else{
                                $point_id = DB::table('points')->insertGetId(['name' => $invent_point]);
                                $msa_points[$point_id] = $invent_point;
                                $invent_point = $point_id;
                            }
                            
                            if (in_array($invent_people, $msa_people)) {
                                $invent_people = array_search($invent_people, $msa_people);
                                $add_people = '';
                            }else{
                                
                                $add_people = ' - Создал!'.$invent_people;
                                $people_name_mas = explode(" ", $invent_people);
                                $people_io = @$people_name_mas[1]." ".@$people_name_mas[2]." ".@$people_name_mas[3];
                                $people_id = DB::table('peoples')->insertGetId(['name' => $people_io, 'surname' => $people_name_mas[0], 'status' => 1, 'position' => 1,'addresses' => 1, 'mailwork' => 1]);
                                $msa_people[$people_id] = $invent_people;   
                            }
                            
                            if (in_array($invent_state, $msa_state)) {
                                $invent_state = array_search($invent_state, $msa_state);
                            }else{
                                $invent_state = 1;
                            }
                            
                            if($invent_yes == 1){
                                $inventory_old = DB::table('inventorys')->where('id', '=', $invent_id)->first();
                                DB::table('inventorys')->where('id', $invent_id)->update([
                                    'name' => $invent_name,
                                    'peoples' => $invent_people, 
                                    'groups' => $invent_group,
                                    'points' => $invent_point,
                                    'state' => $invent_state,
                                    'text' => $invent_text,
                                    'updated_at' => date("Y-m-d H:i:s"),
                                ]);
                                
                                $this->add_history_inventory(
                                    '2', 
                                    Auth::id(),
                                    $invent_id,
                                    $inventory_old->name,                     
                                    $invent_name, 
                                    $msa_people[$inventory_old->peoples],
                                    $msa_people[$invent_people], 
                                    $msa_groups[$inventory_old->groups],
                                    $msa_groups[$invent_group], 
                                    $msa_points[$inventory_old->points],
                                    $msa_points[$invent_point], 
                                    $msa_state[$inventory_old->state],
                                    $msa_state[$invent_state], 
                                    $inventory_old->text,
                                    $invent_text
                                );
                                
                                $invent_add = '<span class="text-green"> - Обновил!</span>';
                            }else{
                                 DB::table('inventorys')->insert([
                                    'id' => $invent_id,
                                    'name' => $invent_name,
                                    'peoples' => $invent_people, 
                                    'groups' => $invent_group,
                                    'points' => $invent_point,
                                    'state' => $invent_state,
                                    'text' => $invent_text,
                                    'created_at' => date("Y-m-d H:i:s"),
                                    'updated_at' => date("Y-m-d H:i:s"),
                                ]);
                                
                                $this->add_history_inventory(
                                    '1', 
                                    Auth::id(),
                                    $invent_id,
                                    '',
                                    $invent_name, 
                                    '',
                                    $msa_people[$invent_people], 
                                    '',
                                    $msa_groups[$invent_group], 
                                    '',
                                    $msa_points[$invent_point], 
                                    '',
                                    $msa_state[$invent_state], 
                                    '',
                                    $invent_text
                                );
                                
                                $invent_add = '<span class="text-yellow"> - Создал!</span>';
                            }
                            
                            $inventorys[$invent_id]['invent_add'] = $invent_add;
                            $inventorys[$invent_id]['group'] = $msa_groups[$invent_group];
                            $inventorys[$invent_id]['name'] = "<a href='/admin/inventory/".$invent_id."'>".$invent_name."</a>";
                            $inventorys[$invent_id]['point'] = $msa_points[$invent_point];
                            $inventorys[$invent_id]['people'] = $msa_people[$invent_people]." ".$add_people;
                            $inventorys[$invent_id]['text'] = $invent_text;
                        }                                   
                    } 
                }
            }else{
                $people = "Файл $filename не существует";
            }
        
        }else{
            $errors = array();
        }
                        
        return view('admin.import.import', array(
            'errors' => $errors,
            'errors_mes' => $errors_mes,                
            'header' => $header,
            'peoples' => $peoples,
            'inventorys' => $inventorys,
            'mesege' => $mesege,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));        
    }
}
