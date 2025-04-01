<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends AdminController
{
    //Пользователи
    public function Index() {
        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_us_users']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li> Пользователи </li>';
        $users = DB::table('users')->get();
        $mesege = "Пользовотели ";
        $peoples = $this->peoplesmas();

        foreach ($users as $user){
            if($user->peoples > 0){
                $peopleus[$user->id] = '<a href="/admin/people/'.$user->peoples.'">'.$peoples[$user->peoples].'</a>';
            }
            else{
                $peopleus[$user->id] = 'Не задан';
            }
        }


        return view('admin.user.users', array(
            'mesege' => $mesege,
            'users' => $users,
            'peopleus' =>  $peopleus,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
	}

    public function User(Request $request, $id) {

        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_us_users']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/users" > Пользователи </a></li>';
        $sevedapp = '';
        $rolesus = DB::table('roles')->select('*')->get();

        if($request->isMethod('post')) {
            $rolespost = $request->role;
            DB::table('users_roles')->where('user_id', '=', $id)->delete(); //Удаляем существующие привелегии
            if(isset($rolespost)){
                foreach ($rolesus as $role) {
                    if (array_key_exists($role->id, $rolespost)) {
                        $data['user_id'] = $id;
                        $data['role_id'] = $role->id;
                        DB::table('users_roles')->insert($data); //Вносим данные по каждой роли
                    }
                }
            }

            $indata['name'] = $request->name;
            $indata['email'] = $request->email;
            $indata['peoples'] = $request->peoples;
            $indata['apanel'] = '';
            if($request->apanel == 'on'){
                 $indata['apanel'] = 'checked';  
            }
            $indata['history'] = '';
            if($request->history == 'on'){
                 $indata['history'] = 'checked';  
            }
            DB::table('users')->where('id', $id)->update($indata);
            $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
        }

        $roles = DB::table('roles')->select('*')->get();
        $user = DB::table('users')->select('*')->where('id', '=', $id)->first();
        $user_roles = DB::table('users_roles')->select('*')->where('user_id', '=', $id)->get();

        //Создаем масив с активными ролями
        $roleson = array();
        foreach ($user_roles as $usrole) {
            $roleson[$usrole->role_id] = 1;
        }

        //Создаем масив с пометкой включенных ролей
        $checkboxrole = array();
        foreach ($roles as $role) {
            $checkboxrole[$role->id] = '';
            if (array_key_exists($role->id, $roleson)) {
                $checkboxrole[$role->id] = 'checked';
            }
        }

        $leftmenu = $leftmenu.'<li> '.$user->name.' </li>';

        $mesege = "Настройки пользователя";
        return view('admin.user.user', array(
            'id' => $id,
            'mesege' => $mesege,
            'user' => $user,
            'peoples' =>  $this->peoplesmas(),
            'roles' => $roles,
            'checkboxrole' => $checkboxrole,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'sevedapp' => $sevedapp,
        ));
    }

    //Роли пользователей
	public function Roles() {
        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_us_roles']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li> Пользовательские роли </li>';
        $roles = DB::table('roles')->select('*')->where('id', '>', 1)->get();
        $mesege = "Роли пользователей";
        return view('admin.user.roles', array(
            'mesege' => $mesege,
            'roles' => $roles,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    //Роль пользователей
    public function Role(Request $request, $id) {
        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_us_roles']= 'class="active"';

        $sevedapp = '';

        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:50|min:3',
            ]);
            $data = $request->except('_token');
            DB::table('roles')->where('id', $id)->update($data);
            $sevedapp = '<div class="callout callout-success"><h4>Сохранено!</h4></div>';
        }

        $role = DB::table('roles')->where('id', '=', $id)->first();

        $cloum = DB::table('users_roles')
            ->select('users_roles.*', 'users.*')
            ->join('users', 'users_roles.user_id', '=', 'users.id')
            ->where('role_id', $id)
            ->count();

        $users = DB::table('users_roles')
            ->select('users_roles.*', 'users.*', 'users.name as users_name', 'users.id as users_id')
            ->join('users', 'users_roles.user_id', '=', 'users.id')
            ->where('role_id', $id)
            ->get();

        $leftmenu = $this->leftmenu.'<li><a href="/admin/accessrole"> Матрица прав </a></li><li>'.$role->name.'</li>';
        $mesege = "Роли пользователей";
        return view('admin.user.role', array(
            'mesege' => $mesege,
            'role' => $role,
            'cloum' => $cloum,
            'users' => $users,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
            'sevedapp' => $sevedapp,
        ));

    }

    //Роль пользователей
    public function Roleadd(Request $request) {
        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_us_roles']= 'class="active"';

        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:50|min:3',
            ]);
            $data = $request->except('_token');
            $inid = DB::table('roles')->insertGetId($data);
            $docs = $this->typedocs();
            foreach ($docs as $key => $doc){
                $access = array(
                    'roles' => $inid,
                    'doc' => $key,
                );
                DB::table('accessdoc')->insert($access);

            }
            return redirect()->intended('/admin/accessrole/');
        }

        $leftmenu = $this->leftmenu.'<li><a href="/admin/accessrole"> Матрица прав </a></li><li>Добавить роль</li>';
        return view('admin.user.roleadd', array(
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }

    //Роль пользователей
    public function Roledel(Request $request, $id) {
        $cloum = DB::table('users_roles')->where('role_id', '=', $id)->count();
        if($cloum > 0){
            DB::table('users_roles')->where('role_id', '=', $id)->delete();
        }
        DB::table('accessdoc')->where('roles', '=', $id)->delete();
        DB::table('roles')->where('id', '=', $id)->delete();
        return redirect()->intended('/admin/accessrole/');
    }
    
    //Смена пароля любого пользователя
    public function userpassall(Request $request, $id) {
        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_us_roles']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li><a href="/admin/users"> Пользователи </a></li>';
        $sevedapp = '';
        $user = DB::table('users')->select('*')->where('id', '=', $id)->first();
        
        if($request->isMethod('post')) {
            
            $this->validate($request, [
                'id' => 'digits_between:1,100000000000',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]);
            $data = $request->except('_token');
            $user = User::find($data ['id']);

            $user->password = Hash::make($request->password);
            $user->save(); 
            $sevedapp = '<div class="callout callout-success"><h4>Пароль обновлен!</h4></div>';  
  
        }
        $leftmenu = $leftmenu.'<li><a href="/admin/user/'.$id.'"> '.$user->name.' </a></li><li>Смена пароля</li>';
        
        return view('admin.user.userpassall', array(
            'id' => $id,
            'sevedapp' => $sevedapp,
            'user' => $user->name,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }
    
    //Смена пароля в своем аккаунте
    public function userpass(Request $request) {
        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_us_roles']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li>Смена пароля</li>';
        $id = $this->userid();
        $sevedapp = '';
        
        if($request->isMethod('post')) {
            
            $this->validate($request, [
                'id' => 'digits_between:1,100000000000',
                'current' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]);
            $data = $request->except('_token');
            
            if($id == $data ['id']){
                $user = User::find($data ['id']);
                if (!Hash::check($request->current, $user->password)) {
                    $sevedapp = '<div class="callout callout-warning"><h4>Текущий пароль не совпадает</h4></div>';
                }else{
                    $user->password = Hash::make($request->password);
                    $user->save(); 
                    $sevedapp = '<div class="callout callout-success"><h4>Пароль обновлен!</h4></div>';  
                }
            }
            
        }
        
        return view('admin.user.userpass', array(
            'id' => $id,
            'sevedapp' => $sevedapp,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }
    
    //Роль пользователей
    public function userprofile(Request $request) {
        $menu_active = $this->menuactive();
        $menu_active['menu_settings']= 'class="treeview active"';
        $menu_active['menu_us_users']= 'class="active"';
        $leftmenu = $this->leftmenu.'<li> Мой профиль </li>';
        $peoples_mas = $this->peoplesmas();
        $id = $this->userid();
        $sevedapp = '';

        if($request->isMethod('post')) {

            $indata['name'] = $request->name;
            $indata['email'] = $request->email;
            DB::table('users')->where('id', $id)->update($indata);
            $sevedapp = '<div class="callout callout-success"><h4>Сохранил!</h4></div>';
        }

        $user = DB::table('users')->select('*')->where('id', '=', $id)->first();
        $roles = DB::table('roles')->select('*')->get();
        $user_roles = DB::table('users_roles')->select('*')->where('user_id', '=', $id)->get();

        $roleson = array();
        foreach ($user_roles as $usrole) {
            $roleson[$usrole->role_id] = 1;
        }
        
        $userroles = array();
        foreach ($roles as $role) {
            if (array_key_exists($role->id, $roleson)) {
                $userroles[] = $role->name;
            }
        }
        
        $mesege = "Мой профиль";
        return view('admin.user.userprofile', array(
            'id' => $id,
            'mesege' => $mesege,
            'user' => $user,
            'peoples' => $peoples_mas[$user->peoples],
            'sevedapp' => $sevedapp,
            'userroles' => $userroles,
            'groups' => $this->groupmas(),
            'menuactive' => $menu_active,
            'leftmenu' => $leftmenu,
        ));
    }
}
