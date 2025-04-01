<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use DB;
use Psr\Log\NullLogger;

class MainController extends Controller
{
    
    public function country (){
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = @json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        if(isset($details->country)){
            $country = $details->country;
        }else{
            $country = 'US';
        } 
        return $country;
    }
    
    public function siteurl(){
        $siteurl='http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'];
        return $siteurl;
    }

    //Масив с настройками
    public function settings(){
        $sets = DB::table('settings')->get();
        foreach($sets as $set)
        {
            $settings[$set->id]=$set->data;
        }
        return $settings;
    }

    public function setting($id){
        $data = DB::table('settings')->where('id', '=', $id)->first();
        $res = $data->data;
        return $res;
    }

    //Роли пользователя
    public function usrol(){
        $rol='user';
        if(Auth::id() == 1){
            $rol = 'admin';
        } 
        return $rol;
    }

    //Масив ролей пользователя
    public function rolemas(){
        $sends_data = DB::table('roles')->get();
        foreach($sends_data as $data)
        {
            $mas[$data->id]=$data->name;
        }
        return $mas;
    }

    //Получить ID пользователя
    public function userid(){
        if(@Auth::user()->id > 0){$id = Auth::id();}else{$id = 0;}
        return $id;
    }

    //Масив типов документов
    public function typedocs(){
        $sends_data = DB::table('typedoc')->get();
        foreach($sends_data as $data)
        {
            $type[$data->id]=$data->name;
        }
        return $type;
    }

    public function typedoc($id){
        $data = DB::table('typedoc')->where('id', '=', $id)->first();
        $res = $data->name;
        return $res;
    }

    //Масив линков документов
    public function typedoclinks(){
        $sends_data = DB::table('typedoc')->get();
        foreach($sends_data as $data)
        {
            $type[$data->id]=$data->link;
        }
        return $type;
    }

    public function typedoclik($id){
        $data = DB::table('typedoc')->where('id', '=', $id)->first();
        $res = $data->link;
        return $res;
    }
    
    //Масив должностей 
    public function positmas(){
        $sends_data = DB::table('positions')->orderBy('name', 'asc')->get();
        foreach($sends_data as $data)
        {
            $positions[$data->id]=$data->name;
        }
        return $positions;
    }

    public function positionid($id){
        $data = DB::table('positions')->where('id', '=', $id)->first();
        $res = $data->name;
        return $res;
    }

    //Масив состояний инвентарной еденици
    public function statemas(){
        $sends_data = DB::table('state')->get();
        foreach($sends_data as $data)
        {
            $positions[$data->id]=$data->name;
        }
        return $positions;
    }

    public function stateid($id){
        $data = DB::table('state')->where('id', '=', $id)->first();
        $res = $data->name;
        return $res;
    }

    //Масив с адрессами
    public function addressesmas(){
        $sends_data = DB::table('addresses')->get();
        foreach($sends_data as $data)
        {
            $addresses[$data->id]=$data->name;
        }
        return $addresses;
    }

    public function addressesid($id){
        $data = DB::table('addresses')->where('id', '=', $id)->first();
        $res = $data->name;
        return $res;
    }
    
    //Масив групп имущества 
    public function inventmas(){
        $mas = array();
        $sends_data = DB::table('inventorys')->get();
        foreach($sends_data as $data)
        {
            $mas[]=$data->id;
        }
        return $mas;
    }
    
    //Масив групп имущества 
    public function groupmas(){
        $groups = array();
        $sends_data = DB::table('groups')->orderBy('name', 'asc')->get();
        foreach($sends_data as $data)
        {
            $groups[$data->id]=$data->name;
        }
        return $groups;
    }

    public function groupid($id){
        $data = DB::table('groups')->where('id', '=', $id)->first();
        $res = $data->name;
        return $res;
    }
    
    //Масив мест нахождения 
    public function pointmas(){
        $sends_data = DB::table('points')->orderBy('name', 'asc')->get();
        foreach($sends_data as $data)
        {
            $points[$data->id]=$data->name;
        }
        return $points;
    }

    public function pointid($id){
        $data = DB::table('points')->where('id', '=', $id)->first();
        $res = $data->name;
        return $res;
    }
    
    //Масив со статусами сотрудников
    public function statusmas(){
        $sends_data = DB::table('status')->get();
        foreach($sends_data as $data)
        {
            $status[$data->id]=$data->name;
        }
        return $status;
    }

    public function statusid($id){
        $data = DB::table('status')->where('id', '=', $id)->first();
        $res = $data->name;
        return $res;
    }

    //Масив с рабочей почтой
    public function mailworkmas(){
        $sends_data = DB::table('mailwork')->orderBy('name', 'asc')->get();
        foreach($sends_data as $data)
        {
            $status[$data->id]=$data->name;
        }
        return $status;
    }

    public function mailworkid($id){
        $data = DB::table('mailwork')->where('id', '=', $id)->first();
        $res['1'] = $data->name;
        $res['2'] = $data->pass;
        return $res;
    }
    
    //Масив сотрудников
    public function peoplesmas(){
        $sends_data = DB::table('peoples')->whereIn('status', [1, 3])->orderBy('surname', 'asc')->get();
        $peoples[''] = "Не задан!";
        foreach($sends_data as $data)
        {
            $peoples[$data->id]=$data->surname." ".$data->name;
        }
        return $peoples;
    }
    
    public function peoplesallmas(){
        $sends_data = DB::table('peoples')->get();
        $peoples[''] = "Не задан!";
        foreach($sends_data as $data)
        {
            $peoples[$data->id]=$data->surname." ".$data->name;
        }
        return $peoples;
    }

    //Масив настроек
    public function settings_data(){
        $settings = DB::table('setings')->get();
        foreach($settings as $setting)
        {
            $settings[$setting->id]=$setting->data;
        }
        return $settings;
    }

    public function peopleid($id){
        $data = DB::table('peoples')->where('id', '=', $id)->first();
        $res = $data->surname." ".$data->name;
        return $res;
    }

    public function textcheck50($text){
        $text = iconv_substr ($text, 0 , 50 , 'UTF-8' ); //брезаем до 50 символов
        $text = str_ireplace('>', '', $text); //Убераем тег <p>
        $text = str_ireplace('<', '', $text);
        $text = str_ireplace('"', '', $text);
        $text = str_ireplace("'", '', $text);
        return $text;
    }
    
    public function textclip($text){
        $text = iconv_substr ($text, 0 , 50 , 'UTF-8' ); //брезаем до 50 символов
        $text = str_ireplace('<p>', '', $text); //Убераем тег <p>
        $text = str_ireplace('</p>', ' ', $text);
        return $text;
    }

    public function telfix($text){
        $text = iconv_substr ($text, 0 , 50 , 'UTF-8' ); //брезаем до 50 символов
        $text = str_ireplace(' ', '', $text);
        $text = str_ireplace('-', '', $text);
        $text = str_ireplace('(', '', $text);
        $text = str_ireplace(')', '', $text);
        return $text;
    }
    public function telshort($text, $country='UA'){
        
        $text = iconv_substr ($text, 0 , 50 , 'UTF-8' ); //брезаем до 50 символов
        if($country == 'UA'){
            $text = str_ireplace('+38', '', $text);
        }
        return $text;
    }

    public function textpp($text){
        $text = str_ireplace('<p>', '', $text); //Убераем тег <p>
        $text = str_ireplace('</p>', ' ', $text);
        return $text;
    }

    public function passed_time( $eventTime) {

        $totaldelay = time() - strtotime($eventTime);
        if($totaldelay <= 0)
        {
            return '';
        }
        else {
            $first = '';
            $marker = 0;
            $timesince = '';
            if ($years = floor($totaldelay / 31536000)) {
                $totaldelay = $totaldelay % 31536000;
                if ($years == 1){
                    $interval = $years . " год";
                } elseif($years < 4){
                    $interval = $years . " года";
                }else{
                    $interval = $years . " лет";
                }
                $timesince = $timesince . $first . $interval;
                if ($marker) return $timesince;
                $marker = 1;
                $first = ", ";
            }
            if ($months = floor($totaldelay / 2628000)) {
                $totaldelay = $totaldelay % 2628000;
                $plural = '';
                if ($months > 1) $plural = 'ев';
                $interval = $months . " месяц" . $plural;
                $timesince = $timesince . $first . $interval;
                if ($marker) return $timesince;
                $marker = 1;
                $first = ", ";
            }
            if ($days = floor($totaldelay / 86400)) {
                $totaldelay = $totaldelay % 86400;
                if ($days == 1){
                    $interval = $days . " днеь";
                }elseif ($days < 4){
                    $interval = $days . " дня";
                }else{
                    $interval = $days . " дней";
                }
                $timesince = $timesince . $first . $interval;
                if ($marker) return $timesince;
                $marker = 1;
                $first = ", ";
            }
            if ($marker) return $timesince;
            if ($hours = floor($totaldelay / 3600)) {
                $totaldelay = $totaldelay % 3600;
                $plural = '';
                if ($hours > 1) $plural = 'ов';
                $interval = $hours . " час" . $plural;
                $timesince = $timesince . $first . $interval;
                if ($marker) return $timesince;
                $marker = 1;
                $first = ", ";

            }
            if ($minutes = floor($totaldelay / 60)) {
                $totaldelay = $totaldelay % 60;
                if ($minutes > 1){
                    $interval = $minutes . " минут";
                }else{
                    $interval = $minutes . " минуту";
                }
                $timesince = $timesince . $first . $interval;
                if ($marker) return $timesince;
                $first = ", ";
            }
            if ($seconds = floor($totaldelay / 1)) {
                $totaldelay = $totaldelay % 1;
                $interval = $seconds . " секунд";
                $timesince = $timesince . $first . $interval;
            }
            return $timesince;
        }
    }
}
