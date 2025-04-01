<?php

namespace App\Http\Controllers\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\OfficeController;
use Illuminate\Support\Facades\Gate;
use DB;

class ContactsController extends OfficeController
{
    public function Contacts()
    {
        $settings = $this->settings();
        $dates = array();
        $peoples = DB::table('peoples')->select('peoples.*', 'peoples.id as peoples_id', 'status.name as status_name', 'positions.id', 'positions.name as position_name', 'addresses.name as addresses_name', 'mailwork.name as mailwork_name')
            ->join('positions', 'peoples.position', '=', 'positions.id')
            ->join('addresses', 'peoples.addresses', '=', 'addresses.id')
            ->join('mailwork', 'peoples.mailwork', '=', 'mailwork.id')
            ->join('status', 'peoples.status', '=', 'status.id')
            ->whereIn('status', [1, 3])
            ->orderBy('peoples.surname', 'asc')->get();

        $country = $this->country();
        foreach ($peoples as $people){

            $dates['mail'][$people->peoples_id] = '';
            if($people->mailwork != 1 && $settings[8] == 1){
                $dates['mail'][$people->peoples_id] = "<a href='mailto:".$people->mailwork_name."'>".$people->mailwork_name."</a></br>";
            }
            if($people->peoples_id != ''){
                $dates['mail'][$people->peoples_id] = $dates['mail'][$people->peoples_id]."<a href='mailto:".$people->mailpersonal."'>".$people->mailpersonal."</a>";
            }

            $dates['tel'][$people->peoples_id] = '';
            if($people->telwork != '' && $settings[8] == 1){
                $dates['tel'][$people->peoples_id] = "<a href='tel:".$this->telfix($people->telwork)."'> ".$this->telshort($people->telwork, $country)." </a></br>";
            }
            if($people->telpersonal != ''){
                $dates['tel'][$people->peoples_id] = $dates['tel'][$people->peoples_id]."<a href='tel:".$this->telfix($people->telpersonal)."'> ".$this->telshort($people->telpersonal, $country)." </a>";
            }

        }

        $mesege = "Контакты";
        return view('office.contacts.contacts', array(
            'mesege' => $mesege,
            'rol' => $this->usrol(),
            'peoples' => $peoples,
            'dates' => $dates
        ));
    }

    public function Contact(Request $request, $id)
    {
        $country = $this->country();
        $settings = $this->settings();
        $people = DB::table('peoples')
            ->select('peoples.*', 'peoples.id as peoples_id', 'status.name as status_name', 'positions.name as position_name', 'addresses.name as addresses_name', 'mailwork.name as mailwork_name', 'mailwork.pass as mailwork_pass')
            ->join('status', 'peoples.status', '=', 'status.id')
            ->join('positions', 'peoples.position', '=', 'positions.id')
            ->join('addresses', 'peoples.addresses', '=', 'addresses.id')
            ->join('mailwork', 'peoples.mailwork', '=', 'mailwork.id')
            ->where('peoples.id', '=', $id)
            ->first();

        $inventorys = DB::table('inventorys')
            ->select('inventorys.*', 'inventorys.id as inventorys_id', 'groups.name as groups_name', 'groups.id as groups_id', 'inventorys.name as inventorys_name', 'points.name as points_name', 'points.id as points_id', 'peoples.name as peoples_name', 'peoples.surname as peoples_surname')
            ->join('groups', 'inventorys.groups', '=', 'groups.id')
            ->join('points', 'inventorys.points', '=', 'points.id')
            ->join('peoples', 'inventorys.peoples', '=', 'peoples.id')
            ->where('peoples.id', '=', $id)
            ->get();

        $email = '';
        if($people->mailwork != 1 && $settings[8] == 1){
            $email = "<label>E-mail рабочий:</label> <cite><a href='mailto:".$people->mailwork_name."'>".$people->mailwork_name."</a></cite><br />";
        }
        if($people->mailpersonal != ''){
            $email = $email."<label>E-mail личный:</label> <cite><a href='mailto:".$people->mailpersonal."'>".$people->mailpersonal."</a></cite><br />";
        }

        $tel = '';
        if($people->telwork != '' && $settings[8] == 1){
            $tel = "<label>Рабочий телефон:</label> <cite><a href='tel:".$this->telfix($people->telwork)."'> ".$this->telshort($people->telwork, $country)." </a></cite></br>";
        }
        if($people->telpersonal != ''){
            $tel = $tel."<label>Личный телефон:</label> <cite><a href='tel:".$this->telfix($people->telpersonal)."'> ".$this->telshort($people->telpersonal, $country)."</a></cite>";
        }

        $texts = array();
        $states = array();
        foreach ($inventorys as $inventory){
            $texts[$inventory->id] = iconv_substr ($inventory->text, 0 , 50 , 'UTF-8' );
            $states[$inventory->id] = $this->stateid($inventory->state);
        }

        $mesege = "Контакт";
        return view('office.contacts.contact', array(
            'people' => $people,
            'email' => $email,
            'tel' => $tel,
            'rol' => $this->usrol(),
            'mesege' => $mesege,
            'groups' => $this->groupmas(),
            'inventorys' => $inventorys,
            'states' => $states,
        ));
    }
}
