<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App;
use DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends AdminController
{
    public function Index(Request $request) {

        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_export_excel'] = 'class="active"';

        if($request->isMethod('post')) {

            $data = $request->except('_token');

            if(array_key_exists("peoples", $data) || array_key_exists("inventorys", $data) || array_key_exists("historys", $data)){
                //echo"Экспортируем!";
                //Очищаем папку export
                if (file_exists('export/'))
                foreach (glob('export/*') as $file){unlink($file);}

                $header = 'Данные на '.date("Y-m-d H:i:s");//Подпись
                $spreadsheet = new Spreadsheet();

                //Стили ячеек
                $tablehrader = array(
                    'font'  => array(
                        'bold' => true,
                        'color' => array('rgb' => '000000'),
                        'size'  => 10,
                        'name'  => 'arial'
                    ),
                    'alignment' => array(
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'rotation'   => 0,
                        'wrap'       => true
                    ),
                    'borders' => array(
                        'allBorders' => array(
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, //BORDER_THIN BORDER_MEDIUM BORDER_HAIR
                            'color' => array('rgb' => '000000')
                        )
                    ),
                    'fill' => array(
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'Color' => 'FFA0A0A0'
                    )
                );

                $tablebody = array(
                    'font'  => array(
                        'size'  => 10,
                        'name'  => 'arial'
                    ),
                    'borders' => array(
                        'allBorders' => array(
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, //BORDER_THIN BORDER_MEDIUM BORDER_HAIR
                            'color' => array('rgb' => '000000')
                        )
                    )
                );

                //Люди
                if(array_key_exists("peoples", $data)){
                    //echo"Люди ";
                    $peoples = DB::table('peoples')->select(
                        'peoples.*',
                        'peoples.id as peoples_id',
                        'peoples.name as peoples_name',
                        'peoples.surname as peoples_surname',
                        'peoples.mailpersonal as peoples_mailpersonal',
                        'peoples.telwork as peoples_telwork',
                        'peoples.telpersonal as peoples_telpersonal',
                        'peoples.birthday as peoples_birthday',
                        'peoples.text as peoples_text',
                        'positions.id',
                        'status.name as status_name',
                        'positions.name as position_name',
                        'addresses.name as addresses_name',
                        'mailwork.name as mailwork_name',
                        'peoples.created_at as peoples_created_at',
                        'peoples.updated_at as peoples_updated_at'
                    )
                        ->join('status', 'peoples.status', '=', 'status.id')
                        ->join('positions', 'peoples.position', '=', 'positions.id')
                        ->join('addresses', 'peoples.addresses', '=', 'addresses.id')
                        ->join('mailwork', 'peoples.mailwork', '=', 'mailwork.id')
                        ->orderBy('peoples.surname', 'asc')
                        ->get();

                    $sheet = $spreadsheet->getActiveSheet()->setTitle('Сотрудники');
                    $n = 2;
                    $spreadsheet->getActiveSheet()->getRowDimension($n)->setRowHeight(25);
                    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

                    $sheet->getStyle('A'.$n.':N'.$n)->applyFromArray($tablehrader);
                    $sheet->setCellValue('A1', $header);
                    $sheet->setCellValue('A'.$n, "ID");
                    $sheet->setCellValue('B'.$n, "Статус");
                    $sheet->setCellValue('C'.$n, "Фамилия");
                    $sheet->setCellValue('D'.$n, "Имя");
                    $sheet->setCellValue('E'.$n, "Должность");
                    $sheet->setCellValue('F'.$n, "Адресс");
                    $sheet->setCellValue('G'.$n, "E-mail рабочий");
                    $sheet->setCellValue('H'.$n, "E-mail личный");
                    $sheet->setCellValue('I'.$n, "Тел. рабочий");
                    $sheet->setCellValue('J'.$n, "Тел. личный");
                    $sheet->setCellValue('K'.$n, "День рождения");
                    $sheet->setCellValue('L'.$n, "Дополнительная информация");
                    $sheet->setCellValue('M'.$n, "Создан");
                    $sheet->setCellValue('N'.$n, "Изменен");

                    foreach ($peoples as $people){
                        $n = $n+1;
                        $text = $this->textpp($people->peoples_text); //Убираем теги абзацев
                        if($people->mailwork_name == 'Нет!'){
                            $mailwork_name = '';
                        }else{
                            $mailwork_name = $people->mailwork_name;
                        }
                        
                        $sheet->setCellValue('A'.$n, $people->peoples_id);
                        $sheet->setCellValue('B'.$n, $people->status_name);
                        $sheet->setCellValue('C'.$n, $people->peoples_surname);
                        $sheet->setCellValue('D'.$n, $people->peoples_name);
                        $sheet->setCellValue('E'.$n, $people->position_name);
                        $sheet->setCellValue('F'.$n, $people->addresses_name);
                        $sheet->setCellValue('G'.$n, $mailwork_name);
                        $sheet->setCellValue('H'.$n, $people->peoples_mailpersonal);
                        $sheet->setCellValue('I'.$n, $people->peoples_telwork);
                        $sheet->setCellValue('J'.$n, $people->peoples_telpersonal);
                        $sheet->setCellValue('K'.$n, $people->peoples_birthday);
                        $sheet->setCellValue('L'.$n, $text);
                        $sheet->setCellValue('M'.$n, $people->peoples_created_at);
                        $sheet->setCellValue('N'.$n, $people->peoples_updated_at);
                    }
                    $sheet->getStyle('A3:N'.$n)->applyFromArray($tablebody);
                    $spreadsheet->getActiveSheet()->setAutoFilter('A2:N'.$n);

                }

                //Номенклатура
                if(array_key_exists("inventorys", $data)){
                    $inventorys = DB::table('inventorys')
                        ->select('inventorys.*',
                            'inventorys.id as inventorys_id',
                            'groups.name as groups_name',
                            'groups.id as groups_id',
                            'inventorys.name as inventorys_name',
                            'points.name as points_name',
                            'points.id as points_id',
                            'peoples.name as peoples_name',
                            'peoples.surname as peoples_surname',
                            'state.name as state_name',
                            'inventorys.created_at as inventorys_created_at',
                            'inventorys.updated_at as inventorys_updated_at'
                        )
                        ->join('groups', 'inventorys.groups', '=', 'groups.id')
                        ->join('points', 'inventorys.points', '=', 'points.id')
                        ->join('peoples', 'inventorys.peoples', '=', 'peoples.id')
                        ->join('state', 'inventorys.state', '=', 'state.id')
                        ->orderBy('name', 'asc')
                        ->get();

                    //Лист - Инвентарные еденици
                    $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Инвентарные единицы');
                    $sheet = $spreadsheet->addSheet($myWorkSheet, 1);
                    $n = 2;

                    $sheet->getRowDimension($n)->setRowHeight(25);
                    $sheet->getColumnDimension('A')->setAutoSize(true);
                    $sheet->getColumnDimension('B')->setAutoSize(true);
                    $sheet->getColumnDimension('C')->setAutoSize(true);
                    $sheet->getColumnDimension('D')->setAutoSize(true);
                    $sheet->getColumnDimension('E')->setAutoSize(true);
                    $sheet->getColumnDimension('F')->setAutoSize(true);
                    $sheet->getColumnDimension('G')->setAutoSize(true);
                    $sheet->getColumnDimension('H')->setAutoSize(true);
                    $sheet->getColumnDimension('I')->setAutoSize(true);

                    $sheet->getStyle('A'.$n.':I'.$n)->applyFromArray($tablehrader);
                    $sheet->setCellValue('A1', $header);
                    $sheet->setCellValue('A'.$n, "Инвентарный №");
                    $sheet->setCellValue('B'.$n, "Группа");
                    $sheet->setCellValue('C'.$n, "Найменование");
                    $sheet->setCellValue('D'.$n, "Место нахождения");
                    $sheet->setCellValue('E'.$n, "Ответственный");
                    $sheet->setCellValue('F'.$n, "Статус");
                    $sheet->setCellValue('G'.$n, "Доп. инф.");
                    $sheet->setCellValue('H'.$n, "Создан");
                    $sheet->setCellValue('I'.$n, "Изменен");

                    foreach ($inventorys as $inventory){
                        $n = $n+1;
                        $sheet->setCellValue('A'.$n, $inventory->inventorys_id);
                        $sheet->setCellValue('B'.$n, $inventory->groups_name);
                        $sheet->setCellValue('C'.$n, $inventory->inventorys_name);
                        $sheet->setCellValue('D'.$n, $inventory->points_name);
                        $sheet->setCellValue('E'.$n, $inventory->peoples_surname." ".$inventory->peoples_name);
                        $sheet->setCellValue('F'.$n, $inventory->state_name);
                        $sheet->setCellValue('G'.$n, $this->textpp($inventory->text));
                        $sheet->setCellValue('H'.$n, $inventory->inventorys_created_at);
                        $sheet->setCellValue('I'.$n, $inventory->inventorys_updated_at);
                    }

                    $sheet->getStyle('A3:I'.$n)->applyFromArray($tablebody);
                    $spreadsheet->getActiveSheet()->setAutoFilter('A2:I'.$n);
                }

                //История
                if(array_key_exists("historys", $data)){
                    $historys = DB::table('historys')
                        ->select('historys.*', 'historys.id as historys_id', 'historys.id_doc as historys_id_doc', 'typedoc.name as typedoc_name', 'typeedit.name as typeedit_name', 'users.name as users_name')
                        ->join('typedoc', 'historys.typedoc', '=', 'typedoc.id')
                        ->join('typeedit', 'historys.typeedit', '=', 'typeedit.id')
                        ->join('users', 'historys.user', '=', 'users.id')
                        ->orderBy('historys.id', 'desc')
                        ->get();

                    //Лист - История
                    $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'История');
                    $sheet = $spreadsheet->addSheet($myWorkSheet, 2);
                    $n = 2;
                    $sheet->getRowDimension($n)->setRowHeight(25);
                    $sheet->getColumnDimension('A')->setAutoSize(true);
                    $sheet->getColumnDimension('B')->setAutoSize(true);
                    $sheet->getColumnDimension('C')->setAutoSize(true);
                    $sheet->getColumnDimension('D')->setAutoSize(true);
                    $sheet->getColumnDimension('E')->setAutoSize(true);
                    $sheet->getColumnDimension('F')->setAutoSize(true);

                    $sheet->getStyle('A'.$n.':F'.$n)->applyFromArray($tablehrader);
                    $sheet->setCellValue('A1', $header);
                    $sheet->setCellValue('A'.$n, "Тип документа");
                    $sheet->setCellValue('B'.$n, "№ документа");
                    $sheet->setCellValue('C'.$n, "Вид правки");
                    $sheet->setCellValue('D'.$n, "Автор");
                    $sheet->setCellValue('E'.$n, "Время");
                    $sheet->setCellValue('F'.$n, "№ праки");

                    foreach ($historys as $history){
                        $n = $n+1;
                        $sheet->setCellValue('A'.$n, $history->typedoc_name);
                        $sheet->setCellValue('B'.$n, $history->historys_id_doc);
                        $sheet->setCellValue('C'.$n, $history->typeedit_name);
                        $sheet->setCellValue('D'.$n, $history->users_name);
                        $sheet->setCellValue('E'.$n, $history->time);
                        $sheet->setCellValue('F'.$n, $history->historys_id);
                    }
                    $sheet->getStyle('A3:F'.$n)->applyFromArray($tablebody);
                    $spreadsheet->getActiveSheet()->setAutoFilter('A2:F'.$n);

                    //Правки
                    $hiedits = DB::table('hiedits')
                        ->select('hiedits.*')
                        ->get();

                    //Лист - История
                    $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'История - правки');
                    $sheet = $spreadsheet->addSheet($myWorkSheet, 3);
                    $n = 2;
                    $sheet->getRowDimension($n)->setRowHeight(25);
                    $sheet->getColumnDimension('A')->setAutoSize(true);
                    $sheet->getColumnDimension('B')->setAutoSize(true);
                    $sheet->getColumnDimension('C')->setAutoSize(true);
                    $sheet->getColumnDimension('D')->setAutoSize(true);

                    $sheet->getStyle('A'.$n.':D'.$n)->applyFromArray($tablehrader);
                    $sheet->setCellValue('A1', $header);
                    $sheet->setCellValue('A'.$n, "№ правки");
                    $sheet->setCellValue('B'.$n, "Название");
                    $sheet->setCellValue('C'.$n, "Было");
                    $sheet->setCellValue('D'.$n, "Стало");

                    foreach ($hiedits as $hiedit){
                        $n = $n+1;
                        $sheet->setCellValue('A'.$n, $hiedit->historys);
                        $sheet->setCellValue('B'.$n, $hiedit->name);
                        $sheet->setCellValue('C'.$n, $this->textpp($hiedit->old));
                        $sheet->setCellValue('D'.$n, $this->textpp($hiedit->new));
                    }
                    $sheet->getStyle('A3:D'.$n)->applyFromArray($tablebody);
                    $spreadsheet->getActiveSheet()->setAutoFilter('A2:D'.$n);
                }

                $writer = new Xlsx($spreadsheet);
                $datefile = date("Ymd_Hi");
                $logo = $_SERVER['SERVER_NAME'].'_'.$datefile;
                $writer->save('export/'.$logo.'.xlsx');
                $refirect = redirect()->intended('export/'.$logo.'.xlsx');
                return $refirect;
            }
        }

        //$user = Auth::user();
        $mesege = "Старотвая страница админки";
        $peoples = DB::table('peoples')->count();
        $users = DB::table('users')->count();

        $leftmenu = $this->leftmenu.'<li>Експотр в Excel</li>';;
        return view('admin.export.export', array(
            'mesege' => $mesege,
            'peoples' => $peoples,
            'users' => $users,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }
}
