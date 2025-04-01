<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use DB;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('adminpanel', function ($user) {
            $user = Auth::user();
            if($user->apanel == 'checked'){
                return true;
            }
            return false;
        });

        Gate::define('history', function ($user) {
            $user = Auth::user();
            if($user->history == 'checked'){
                return true;
            }
            return false;
        });

        Gate::define('root', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                if($role->id == '1'){
                    return true;
                }
            }
            return false;
        });

        Gate::define('user', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '1')
                    ->where('read', '1')
                    ->where('edit', '1')
                    ->where('delete', '1')
                    ->count();
                if($access_count > 0){
                    return true;
                }
            }
            return false;
        });

        Gate::define('user_edit', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '1')
                    ->where('edit', '1')
                    ->count();
                if($access_count > 0){
                    return true;
                }
            }
            return false;
        });

        Gate::define('user_delete', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '1')
                    ->where('delete', '1')
                    ->count();
                if($access_count > 0){
                    return true;
                }
            }
            return false;
        });

        Gate::define('people', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '2')
                    ->where('read', '1')
                    ->count();
                if($access_count > 0){
                    return true;
                }
            }
            return false;
        });

        Gate::define('people_edit', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '2')
                    ->where('edit', '1')
                    ->count();
                if($access_count > 0){
                    return true;
                }
            }
            return false;
        });

        Gate::define('people_delele', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '2')
                    ->where('delete', '1')
                    ->count();
                if($access_count > 0){
                    return true;
                }
            }
            return false;
        });

        Gate::define('inventory', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '3')
                    ->where('read', '1')
                    ->count();
                if($access_count > 0){
                    return true;
                }
            }
            return false;
        });

        Gate::define('inventory_edit', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '3')
                    ->where('edit', '1')
                    ->count();
                if($access_count > 0){
                    return true;
                }
            }
            return false;
        });

        Gate::define('inventory_delete', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '3')
                    ->where('delete', '1')
                    ->count();
                if($access_count > 0){
                    return true;
                }
            }
            return false;
        });

        Gate::define('position', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '7')
                    ->where('read', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('position_edit', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '7')
                    ->where('edit', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('position_delete', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '7')
                    ->where('delete', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('mailwork', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '8')
                    ->where('read', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('mailwork_edit', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '8')
                    ->where('edit', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('mailwork_delete', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '8')
                    ->where('delete', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('addresses', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '6')
                    ->where('read', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('addresses_edit', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '6')
                    ->where('edit', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('addresses_delete', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role){
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '6')
                    ->where('delete', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('point', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role) {
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '5')
                    ->where('read', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('point_edit', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role) {
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '5')
                    ->where('edit', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('point_delete', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role) {
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '5')
                    ->where('delete', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('group', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role) {
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '4')
                    ->where('read', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('group_edit', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role) {
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '4')
                    ->where('edit', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('group_delete', function ($user) {
            $user = Auth::user();
            foreach($user->roles as $role) {
                $access_count = DB::table('accessdoc')
                    ->where('roles', $role->id)
                    ->where('doc', '4')
                    ->where('delete', '1')
                    ->count();
                if ($access_count > 0) {
                    return true;
                }
            }
            return false;
        });

    }
}
